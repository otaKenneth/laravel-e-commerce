<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\FileStorageService;
use App\Models\Admin;
use App\Models\Order;
use App\Models\OrdersLog;
use App\Models\OrdersProduct;
use App\Models\Payment;
use App\Models\Refunds;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Render User 'My Orders' page    
    public function orders($id = null) { // If the slug {id?} (Optional Parameters) is passed in, this means go to the front/orders/order_details.blade.php page, and if not, this means go to the front/orders/orders.blade.php page    // Optional Parameters: https://laravel.com/docs/9.x/routing#parameters-optional-parameters    
        if (empty($id)) { // if the order id is not passed in in the route (URL) as an Optional Parameter (slug), this means go to front/orders/orders.blade.php page
            // Get all the orders of the currently authenticated/logged-in user
            $orders = Order::with('orders_products')
                ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
                ->where('order_status', '!=', 'Cancelled')
                ->orderBy('id', 'Desc')
                ->paginate(10); // Retrieving The Authenticated User: https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user    
                // Eager Loading: https://laravel.com/docs/9.x/eloquent-relationships#eager-loading    
                // 'orders_products' is the relationship method name in Order.php model
            // dd($orders);

            return view('front.orders.orders')->with(compact('orders'));

        } else { // if the order id is passed in in the route (URL) as an Optional Parameter (slug), this means go to front/orders/order_details.blade.php page
            $orderDetails = Order::with('orders_products')->where('id', $id)->first()->toArray();// Eager Loading: https://laravel.com/docs/9.x/eloquent-relationships#eager-loading    // 'orders_products' is the relationship method name in Order.php model
            // dd($orderDetails);


            return view('front.orders.order_details')->with(compact('orderDetails'));
        }

    }

    public function cancelOrder(Request $request, Order $order) {
        try {
            if (in_array($order->order_status, ["1", "New", "Paid", "Pending", "In Progress"])) {
                
                // Notify customer for cancellation
                $orderDetails = $order->with('orders_products')->first()->toArray();
                $email = $order->email;
                
                // The email message data/variables that will be passed in to the email view
                $messageData = [
                    'email'        => $order->email,
                    'name'         => $order->name, 
                    'order_id'     => $order->id,
                    'orderDetails' => $orderDetails
                ];
                
                \Illuminate\Support\Facades\Mail::send('emails.order', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Order Cancelled - Kapiton Store');
                });

                // Notify vendor for cancellation
                $vendors = $order->order_vendors;
                foreach ($vendors as $vendor) {
                    $email = $vendor->vendorbusinessdetails->shop_email;
                    $orderDetails = $order->with(['orders_products' => function ($query) use ($vendor) {
                        return $query->where('vendor_id', $vendor->id);
                    }])->first()->toArray();

                    // The email message data/variables that will be passed in to the email view
                    $messageData = [
                        'email'           => $email,
                        'name'            => $vendor->vendorbusinessdetails->shop_name,
                        'order_id'        => $order->id,
                        'orderDetails'    => $orderDetails,
                        'order_status'    => "Cancelled",
                        'courier_name'    => "",
                        'tracking_number' => ""
                    ];

                    \Illuminate\Support\Facades\Mail::send('emails.order_status', $messageData, function ($message) use ($email) { // Sending Mail: https://laravel.com/docs/9.x/mail#sending-mail    // 'emails.order_status' is the order_status.blade.php file inside the 'resources/views/emails' folder that will be sent as an email    // We pass in all the variables that order_status.blade.php will use    // https://www.php.net/manual/en/functions.anonymous.php
                        $message->to($email)->subject('Order Status Updated - ' . env('APP_URL'));
                    });
                }

                // If paid, then refund order
                $order_log = OrdersLog::where('order_id', $order->id)
                    ->where('order_status', 'Paid')->count();

                if ($order_log > 0) {
                    // activate refund
                    DB::transaction(function () use ($order) {
                        $order->order_status = "Pending Refund";
                        $order->update();
    
                        foreach ($order->orders_products as $order_product) {
                            $order_product->item_status = "Pending Refund";
                            $order_product->update();
                        }
    
                        $log = new OrdersLog;
                        $log->order_id = $order->id;
                        $log->order_status = "Pending Refund";
                        $log->save();
                    });

                    // >>>>
                    $orderDetails = $order->with('orders_products')->first()->toArray();
                    $messageData = [
                        'email'        => $order->email,
                        'name'         => $order->name,
                        'order_id'     => $order->id,
                        'orderDetails' => $orderDetails,
                        'order_status' => $order->order_status,
                        'reason'       => "Order Cancellation",
                    ];
        
                    // send an email to user
                    $email = $order->email;
                    \Illuminate\Support\Facades\Mail::send('emails.order_product_refund_request', $messageData, function ($message) use ($email) {
                        $message->to($email)->subject('Order Status Updated - ' . env('APP_URL'));
                    });
        
                    // send an email to vendor
                    foreach ($vendors as $vendor) {
                        $messageData['orderDetails'] = $orderDetails = $order->with(['orders_products' => function ($query) use ($vendor) {
                            return $query->where('vendor_id', $vendor->id);
                        }])->first()->toArray();
                        $email = $vendor->email;
                        $ccEmails = Admin::select('email')->where('vendor_id', 0)->where('status', 1)->whereIn('type', ['superadmin', 'admin'])->get()->pluck('email')->toArray();
                        array_push($ccEmails, $vendor->vendorbusinessdetails->shop_email);
            
                        \Illuminate\Support\Facades\Mail::send('emails.vendor_order_product_refund', $messageData, function ($message) use ($email, $ccEmails) {
                            $message->to($email)->subject('Order Status Updated - ' . env('APP_URL'));
            
                            // Adding CC emails
                            foreach ($ccEmails as $ccEmail) {
                                $message->cc($ccEmail);
                            }
                        });
                    }
        
                    // save new refund data
                    DB::transaction(function () use ($order) {
                        $payment = Payment::where('order_id', $order->id)->first();
            
                        $refund = new Refunds;
                        $refund->order_id = $order->id;
                        $refund->payment_id = $payment->id;
                        $refund->amount = $order->grand_total;
                        $refund->status = $order->order_status;
                        $refund->reason = "Order Cancellation";
                        $refund->save();
                    });
                    // <<<<
                }

                DB::transaction(function () use ($order) {
                    $order->order_status = "Cancelled";
                    $order->update();
    
                    foreach ($order->orders_products as $order_product) {
                        $order_product->item_status = "Pending Refund";
                        $order_product->update();
                    }
        
                    $log = new OrdersLog;
                    $log->order_id = $order->id;
                    $log->order_status = "Cancelled";
                    $log->save();
                });
        
                $message = "Order {$order->id} has been cancelled.";
                $message .= $order_log > 0 ? " Your product is being reviewed by the vendor for refund. This may take some time.":"";
    
                return response()->json([
                    'success' => true,
                    'message' => $message
                ]);
            }
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function refundOrder(Request $request, Order $order) { // id product to be refunded
        // Notify vendor that there is a product for refund
        // $order = Order::find($request->order_id);
        $order_product = OrdersProduct::find($request->order_item_id);
        $vendor = Vendor::find($order_product->vendor_id);
        $user = User::find($order->user_id);
        $refund = Refunds::where('order_id', $request->order_id)->where('orders_product_id', $request->order_item_id)->first();

        if (!is_null($refund)) {
            return response()->json([
                'success' => false,
                'message' => "{$refund->status}"
            ]);
        }
        
        try {
            // update status
            // update order product status
            $order_product->item_status = "Pending Refund";
            $order_product->update();

            // add order log
            $log = new OrdersLog;
            $log->order_id = $order->id;
            $log->order_item_id = $order_product->id;
            $log->order_status = "Pending Refund";
            $log->save();

            // send email to vendor and admins
            $deliveryDetails = Order::select('mobile', 'email', 'name')->where('id', $order->id)->first()->toArray();

            $messageData = [
                'email'        => $user->email,
                'name'         => $deliveryDetails['name'],
                'order_id'     => $order->id,
                'orderDetails' => $order->load(['orders_products' => function ($query) use ($order_product) {
                    return $query->where('id', $order_product->id);
                }])->toArray(),
                'order_status' => $order_product->item_status,
                'reason'       => $request->reason,
            ];

            // send an email to user
            $email = $user->email;
            \Illuminate\Support\Facades\Mail::send('emails.order_product_refund_request', $messageData, function ($message) use ($email) {
                $message->to($email)->subject('Order Status Updated - ' . env('APP_URL'));
            });

            // send an email to vendor
            $email = $vendor->email;
            $ccEmails = Admin::select('email')->where('vendor_id', 0)->where('status', 1)->whereIn('type', ['superadmin', 'admin'])->get()->pluck('email')->toArray();
            array_push($ccEmails, $vendor->vendorbusinessdetails->shop_email);

            \Illuminate\Support\Facades\Mail::send('emails.vendor_order_product_refund', $messageData, function ($message) use ($email, $ccEmails) {
                $message->to($email)->subject('Order Status Updated - ' . env('APP_URL'));

                // Adding CC emails
                foreach ($ccEmails as $ccEmail) {
                    $message->cc($ccEmail);
                }
            });

            // save new refund data
            $payment = Payment::where('order_id', $order->id)->first();

            $refund = new Refunds;
            $refund->order_id = $order->id;
            $refund->orders_product_id = $order_product->id;
            $refund->payment_id = $payment->id;
            $refund->amount = $order_product->product_price * $order_product->product_qty;
            $refund->status = $order_product->item_status;
            $refund->reason = $request->reason;
            $refund->save();

            if ($request->hasFile('image_proof')) {
                $images = $request->file('image_proof');
                // dd($images);

                foreach ($images as $key => $image) {
                    // Uploading the images:
                    // Generate Temp Image
                    $fileStorageService = new FileStorageService;

                    // Get image name
                    $image_name = $image->getClientOriginalName();
                    // dd($image_tmp);

                    // Get image extension
                    $extension = $image->getClientOriginalExtension();

                    // Generate a new random name for the uploaded image (to avoid that the image might get overwritten if its name is repeated)
                    $imageName = str_replace(".{$extension}", "", $image_name) . "-". rand(111, 99999) . '.' . $extension; // e.g. 5954.png

                    // Assigning the uploaded images path inside the 'public' folder
                    // We will have three folders: small, medium and large, depending on the images sizes
                    $arr_filePaths = [
                        [
                            'path' => 'front/images/refund_proof_images/large/'  . $imageName,
                            'size' => [
                                'width' => 1000,
                                'height' => 1000,
                            ]
                        ], // 'large'  images folder 
                        [
                            'path' => 'front/images/refund_proof_images/medium/' . $imageName,
                            'size' => [
                                'width' => 500,
                                'height' => 500,
                            ]
                        ], // 'medium' images folder
                        [
                            'path' => 'front/images/refund_proof_images/small/'  . $imageName,
                            'size' => [
                                'width' => 250,
                                'height' => 250,
                            ]
                        ] // 'small'  images folder
                    ];

                    // Upload the image using the 'Intervention' package and save it in our THREE paths (folders) inside the 'public' folder
                    foreach ($arr_filePaths as $key => $path) {
                        $fileStorageService->storeFile($image, $path['path'], $path['size']);
                    }

                    $refund->refund_images()->create([
                        'image' => $imageName
                    ]);
                }
            }

            return [
                'success' => true,
                'message' => "Your product is being reviewed by the vendor for your request to refund. This may take some time."
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }

    }

    public function updateOrderStatus(Request $request, Order $order, OrdersProduct $ordersProduct) {
        try {
            // create new order log
            $log = new OrdersLog;
            $log->order_id = $order->id;
            $log->order_item_id = $ordersProduct->id;
            $log->order_status = $request->status;
            $log->save();

            // update product item status
            $ordersProduct->item_status = $request->status;
            $ordersProduct->update();

            if ($request->status == "Delivered") {
                // create new order log
                $log = new OrdersLog;
                $log->order_id = $order->id;

                // get counts of all products under order
                $ordersProducts_count = OrdersProduct::where('order_id', $order->id)
                    ->count();
                
                // get count of all products that is Delivered
                $ordersProducts_delivered_count = OrdersProduct::where('order_id', $order->id)
                    ->where('item_status', 'Delivered')
                    ->count();
                
                if ($ordersProducts_count == $ordersProducts_delivered_count) {
                    $order->order_status = "Delivered";
                    $log->order_status = $order->order_status;
                } else {
                    $order->order_status = "Partially Delivered";
                    $log->order_status = $order->order_status;
                }
                // update product item status
                $order->update();
                $log->save();
            }

            return response()->json([
                'success' => true,
                'message' => "Order status has been updated. Thank you!!"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
        
    }

}