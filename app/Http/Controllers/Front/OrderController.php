<?php

namespace App\Http\Controllers\Front;

use App\Helpers\PaymongoRefundAPIHelper;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrdersLog;
use App\Models\OrdersProduct;
use App\Models\Payment;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Render User 'My Orders' page    
    public function orders($id = null) { // If the slug {id?} (Optional Parameters) is passed in, this means go to the front/orders/order_details.blade.php page, and if not, this means go to the front/orders/orders.blade.php page    // Optional Parameters: https://laravel.com/docs/9.x/routing#parameters-optional-parameters    
        if (empty($id)) { // if the order id is not passed in in the route (URL) as an Optional Parameter (slug), this means go to front/orders/orders.blade.php page
            // Get all the orders of the currently authenticated/logged-in user
            $orders = \App\Models\Order::with('orders_products')->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->orderBy('id', 'Desc')->paginate(10); // Retrieving The Authenticated User: https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user    // Eager Loading: https://laravel.com/docs/9.x/eloquent-relationships#eager-loading    // 'orders_products' is the relationship method name in Order.php model
            // dd($orders);

            return view('front.orders.orders')->with(compact('orders'));

        } else { // if the order id is passed in in the route (URL) as an Optional Parameter (slug), this means go to front/orders/order_details.blade.php page
            $orderDetails = \App\Models\Order::with('orders_products')->where('id', $id)->first()->toArray();// Eager Loading: https://laravel.com/docs/9.x/eloquent-relationships#eager-loading    // 'orders_products' is the relationship method name in Order.php model
            // dd($orderDetails);


            return view('front.orders.order_details')->with(compact('orderDetails'));
        }

    }

    public function refund_order(Request $request) { // id product to be refunded
        $payment = Payment::where('payment_id', $request->id)->first();
        $refund = new PaymongoRefundAPIHelper;
        // should create paymongo refund data
        $resp = $refund->set('amount', $payment->amount)->setAmount()
            ->set('notes', $request->notes)
            ->set('payment_id', $payment->id)
            ->set('reason', $request->reason)
            ->createRefund();
        
        \Log::info("Refund Order: " . json_encode($resp));
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