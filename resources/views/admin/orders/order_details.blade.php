
{{-- This page is rendered by orderDetails() method inside Admin/OrderController.php --}}
@extends('admin.layout.layout')


@section('content')
    <div class="main-panel">
        <div class="content-wrapper">


            {{-- Displaying Laravel Validation Errors: https://laravel.com/docs/9.x/validation#quick-displaying-the-validation-errors --}}    
            {{-- Determining If An Item Exists In The Session (using has() method): https://laravel.com/docs/9.x/session#determining-if-an-item-exists-in-the-session --}}
            @if (Session::has('error_message')) <!-- Check AdminController.php, updateAdminPassword() method -->
                @if (is_array(Session::get('error_message')))
                    @foreach (Session::get('error_message') as $messages)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error:</strong> {{ $messages }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endforeach
                @else
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error:</strong> {{ Session::get('error_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            @endif



            {{-- Displaying Laravel Validation Errors: https://laravel.com/docs/9.x/validation#quick-displaying-the-validation-errors --}}    
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{-- <strong>Error:</strong> {{ Session::get('error_message') }} --}}

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif


            {{-- Displaying The Validation Errors: https://laravel.com/docs/9.x/validation#quick-displaying-the-validation-errors AND https://laravel.com/docs/9.x/blade#validation-errors --}} 
            {{-- Determining If An Item Exists In The Session (using has() method): https://laravel.com/docs/9.x/session#determining-if-an-item-exists-in-the-session --}}
            {{-- Our Bootstrap success message in case of updating admin password is successful: --}}
            {{-- Displaying Success Message --}}
            @if (Session::has('success_message')) <!-- Check vendorRegister() method in Front/VendorController.php -->
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success:</strong> {{ Session::get('success_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif



            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Order Details</h3>
                            <h6 class="font-weight-normal mb-0"><a href="{{ url('admin/orders') }}">Back to Orders</a></h6>
                        </div>
                        <div class="col-12 col-xl-4">
                            <div class="justify-content-end d-flex">
                                <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                    <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                        <a class="dropdown-item" href="#">January - March</a>
                                        <a class="dropdown-item" href="#">March - June</a>
                                        <a class="dropdown-item" href="#">June - August</a>
                                        <a class="dropdown-item" href="#">August - November</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Order Details</h4>
                            <div class="form-group" style="height: 15px">
                                <label style="font-weight: 550">Order ID: </label>
                                <label>#{{ $orderDetails['id'] }}</label>
                            </div>
                            <div class="form-group" style="height: 15px">
                                <label style="font-weight: 550">Order Date: </label>
                                <label>{{ date('Y-m-d h:i:s', strtotime($orderDetails['created_at'])) }}</label>
                            </div>
                            <div class="form-group" style="height: 15px">
                                <label style="font-weight: 550">Order Status: </label>
                                <label>{{ $orderDetails['order_status'] }}</label>
                            </div>
                            <div class="form-group" style="height: 15px">
                                <label style="font-weight: 550">Order Total: </label>
                                <label>₱{{ $orderDetails['grand_total'] }}</label>
                            </div>
                            <div class="form-group" style="height: 15px">
                                <label style="font-weight: 550">Shipping Charges: </label>
                                <label>₱{{ $orderDetails['shipping_charges'] }}</label>
                            </div>

                            @if (!empty($orderDetails['coupon_code']))
                                <div class="form-group" style="height: 15px">
                                    <label style="font-weight: 550">Coupon Code: </label>
                                    <label>{{ $orderDetails['coupon_code'] }}</label>
                                </div>
                                <div class="form-group" style="height: 15px">
                                    <label style="font-weight: 550">Coupon Amount: </label>
                                    <label>₱{{ $orderDetails['coupon_amount'] }}</label>
                                </div>                                
                            @endif

                            <div class="form-group" style="height: 15px">
                                <label style="font-weight: 550">Payment Method: </label>
                                <label>{{ $orderDetails['payment_method'] }}</label>
                            </div>
                            <div class="form-group" style="height: 15px">
                                <label style="font-weight: 550">Payment Gateway: </label>
                                <label>{{ $orderDetails['payment_gateway'] }}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Customer Details</h4>
                            <div class="form-group" style="height: 15px">
                                <label style="font-weight: 550">Name: </label>
                                <label>{{ $userDetails['first_name'] }} {{ $userDetails['last_name'] }}</label>
                            </div>

                            @if (!empty($userDetails['address']))
                                <div class="form-group" style="height: 15px">
                                    <label style="font-weight: 550">Address: </label>
                                    <label>{{ $userDetails['address'] }}</label>
                                </div>
                            @endif

                            @if (!empty($userDetails['city']))
                                <div class="form-group" style="height: 15px">
                                    <label style="font-weight: 550">City: </label>
                                    <label>{{ $userDetails['city'] }}</label>
                                </div>
                            @endif

                            @if (!empty($userDetails['state']))
                                <div class="form-group" style="height: 15px">
                                    <label style="font-weight: 550">State: </label>
                                    <label>{{ $userDetails['state'] }}</label>
                                </div>
                            @endif
                            
                            @if (!empty($userDetails['country']))
                                <div class="form-group" style="height: 15px">
                                    <label style="font-weight: 550">Country: </label>
                                    <label>{{ $userDetails['country'] }}</label>
                                </div>
                            @endif
                            
                            @if (!empty($userDetails['pincode']))
                                <div class="form-group" style="height: 15px">
                                    <label style="font-weight: 550">Pincode: </label>
                                    <label>{{ $userDetails['pincode'] }}</label>
                                </div>
                            @endif

                            <div class="form-group" style="height: 15px">
                                <label style="font-weight: 550">Mobile: </label>
                                <label>{{ $userDetails['mobile'] }}</label>
                            </div>
                            <div class="form-group" style="height: 15px">
                                <label style="font-weight: 550">Email: </label>
                                <label>{{ $userDetails['email'] }}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Delivery Address</h4>
                            <div class="form-group" style="height: 15px">
                                <label style="font-weight: 550">Name: </label>
                                <label>{{ $orderDetails['name'] }}</label>
                            </div>

                            @if (!empty($orderDetails['address']))
                                <div class="form-group" style="height: 15px">
                                    <label style="font-weight: 550">Address: </label>
                                    <label>{{ $orderDetails['address'] }}</label>
                                </div>
                            @endif

                            @if (!empty($orderDetails['city']))
                                <div class="form-group" style="height: 15px">
                                    <label style="font-weight: 550">City: </label>
                                    <label>{{ $orderDetails['city'] }}</label>
                                </div>
                            @endif

                            @if (!empty($orderDetails['state']))
                                <div class="form-group" style="height: 15px">
                                    <label style="font-weight: 550">State: </label>
                                    <label>{{ $orderDetails['state'] }}</label>
                                </div>
                            @endif
                            
                            @if (!empty($orderDetails['country']))
                                <div class="form-group" style="height: 15px">
                                    <label style="font-weight: 550">Country: </label>
                                    <label>{{ $orderDetails['country'] }}</label>
                                </div>
                            @endif
                            
                            @if (!empty($orderDetails['pincode']))
                                <div class="form-group" style="height: 15px">
                                    <label style="font-weight: 550">Pincode: </label>
                                    <label>{{ $orderDetails['pincode'] }}</label>
                                </div>
                            @endif

                            <div class="form-group" style="height: 15px">
                                <label style="font-weight: 550">Mobile: </label>
                                <label>{{ $orderDetails['mobile'] }}</label>
                            </div>

                            <div>
                            <h5 class="card-title">Delivery Details</h5>

                            @if ($orderDetails['order_status'] == "For Delivery" && !empty($orderDetails['courier_name']))
                                <div class="form-group" style="height: 15px">
                                    <label style="font-weight: 550">Courier Name: </label>
                                    <label><a href="{{$orderDetails['courier_name']}}" target="_blank" >{{Lalamove}}</a></label>
                                </div>
                            @else
                                <div class="form-group" style="height: 15px">
                                    <label style="font-weight: 550">Courier Name: </label>
                                    <label>{{$orderDetails['courier_name']}}</label>
                                </div>
                            @endif
                            

                            @if (!empty($orderDetails['tracking_number']))
                                <div class="form-group" style="height: 15px">
                                    <label style="font-weight: 550">Tracking Number: </label>
                                    <label>{{ $orderDetails['tracking_number'] }}</label>
                                </div>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Update Order Status</h4>  {{-- determined by 'admin'-s ONLY, not 'vendor'-s --}}

                            {{-- Allowing the general "Update Order Status" feature for 'admin'-s ONLY, and restricting it from 'vendor'-s ('vendor'-s can update their Ordered Products item statuses ONLY (at this page bottom)) --}} 
                            @if (Auth::guard('admin')->user()->type != 'vendor') {{-- If the authenticated/logged-in user is 'admin', allow "Update Order Status" feature --}} {{-- Accessing Specific Guard Instances: https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances --}} {{-- Retrieving The Authenticated User: https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user --}}
                                
                                {{-- Note: The `order_statuses` table contains all kinds of order statuses (that can be updated by 'admin'-s ONLY in `orders` table) like: pending, in progress, shipped, canceled, ...etc. In `order_statuses` table, the `name` column can be: 'New', 'Pending', 'Canceled', 'In Progress', 'Shipped', 'Partially Shipped', 'Delivered', 'Partially Delivered' and 'Paid'. 'Partially Shipped': If one order has products from different vendors, and one vendor has shipped their product to the customer while other vendor (or vendors) didn't!. 'Partially Delivered': if one order has products from different vendors, and one vendor has shipped and DELIVERED their product to the customer while other vendor (or vendors) didn't!    // The `order_item_statuses` table contains all kinds of order statuses (that can be updated by both 'vendor'-s and 'admin'-s in `orders_products` table) like: pending, in progress, shipped, canceled, ...etc. --}}
                                <form action="{{ url('admin/update-order-status') }}" method="post">  {{-- determined by 'admin'-s ONLY, not 'vendor'-s. This is in contrast to 'Order Item Status' which can be updated by both 'vendor'-s and 'admin'-s --}}
                                    @csrf {{-- Preventing CSRF Requests: https://laravel.com/docs/9.x/csrf#preventing-csrf-requests --}}

                                    <input type="hidden" name="order_id" value="{{ $orderDetails['id'] }}">

                                    <select name="order_status" id="order_status" required>
                                        <option value="" selected>Select</option>
                                        @foreach ($orderStatuses as $status)
                                            <option value="{{ $status['name'] }}"  @if (!empty($orderDetails['order_status']) && $orderDetails['order_status'] == $status['name']) selected @endif>{{ $status['name'] }}</option>
                                        @endforeach
                                    </select>

                                    {{-- // Note: There are two types of Shipping Process: "manual" and "automatic". "Manual" is in the case like small businesses, where the courier arrives at the owner warehouse to to pick up the order for shipping, and the small business owner takes the shipment details (like courier name, tracking number, ...) from the courier, and inserts those details themselves in the Admin Panel when they "Update Order Status" Section (by an 'admin') or "Update Item Status" Section (by a 'vendor' or 'admin') (in admin/orders/order_details.blade.php). With "automatic" shipping process, we're integrating third-party APIs and orders go directly to the shipping partner, and the updates comes from the courier's end, and orders are automatically delivered to customers --}}
                                    <input type="text" name="courier_name"    id="courier_name"    placeholder="Courier Name">    {{-- This input field will only show up when 'Shipped' <option> is selected. Check admin/js/custom.js --}}
                                    <input type="text" name="tracking_number" id="tracking_number" placeholder="Tracking Number"> {{-- This input field will only show up when 'Shipped' <option> is selected. Check admin/js/custom.js --}}

                                    <button type="submit">Update</button>
                                </form>
                                <br>

                            @else
                                {{-- If the authenticated/logged-in user is 'vendor', restrict the "Update Order Status" feature --}}
                                This feature is restricted.
                            @endif
                            <hr>
                            <br>
                            <div style="overflow-y: scroll; max-height: 250px;">
                            {{-- Show the "Update Order Status" History/Log in admin/orders/order_details.blade.php     --}}
                            @foreach ($orderLog as $key => $log)
                                @php
                                    // echo '<pre>', var_dump($log), '</pre>';
                                    // echo '<pre>', var_dump($log['orders_products']), '</pre>';
                                    // echo '<pre>', var_dump($key), '</pre>';
                                    // echo '<pre>', var_dump($log['orders_products'][$key]), '</pre>';
                                    // echo '<pre>', var_dump($log['orders_products'][$key]['product_code']), '</pre>';
                                @endphp

                                <strong>{{ $log['order_status'] }}</strong>

                                {{-- Shiprocket API integration --}}
                                @if ($orderDetails['is_pushed'] == 1) {{-- If the Order has been pushed to Shiprocket, state this --}}
                                    <span style="color: green">(Order Pushed to Lalamove)</span>
                                @endif

                                {{-- Note: There are two types of Shipping Process: "manual" and "automatic". "Manual" is in the case like small businesses, where the courier arrives at the owner warehouse to to pick up the order for shipping, and the small business owner takes the shipment details (like courier name, tracking number, ...) from the courier, and inserts those details themselves in the Admin Panel when they "Update Order Status" Section (by an 'admin') or "Update Item Status" Section (by a 'vendor' or 'admin') (in admin/orders/order_details.blade.php). With "automatic" shipping process, we're integrating third-party APIs and orders go directly to the shipping partner, and the updates comes from the courier's end, and orders are automatically delivered to customers --}}

                                {{-- Show if the order status previewed in "Update Order Status" Section in admin/orders/order_details.blade.php is whether updated from "Update Item Status" Section (which can updated by either `vendor`-s or `admin`-s) (in case the `order_item_id` column is NOT zero 0 (it is 0 zero in case of updated by `admin`-s only in the "Update Order Status" Section)) or from "Update Order Status" Section (can be updated by `admin`-s ONLY). Check updateOrderItemStatus() method in Admin/OrderController.php     --}}
                                @if (isset($log['order_item_id']) && $log['order_item_id'] > 0) {{-- In case the "Item Status" Section is updated by a 'vendor' or 'admin', the `order_item_id` column in `orders_logs` table references (is a foreign key to) the `id` column in `orders_products` table, otherwise, it takes 0 zero as a value (in case of 'admin'). Check updateOrderItemStatus() method in Admin/OrderController.php --}}
                                    @php
                                        $getItemDetails = \App\Models\OrdersLog::getItemDetails($log['order_item_id']);
                                    @endphp
                                    - for item {{ $getItemDetails['product_code'] }}

                                    @if (in_array($log['order_status'], ['For Delivery', 'Delivered', 'Shipped']))
                                        @if (!empty($getItemDetails['courier_name']))
                                            <br>
                                            <span>Courier Name: 
                                                <label><a href="{{ $getItemDetails['courier_name'] }}" target="_blank" >Lalamove</a></label>
                                            </span>
                                        @endif

                                        @if (!empty($getItemDetails['tracking_number']))
                                            <br>
                                            <span>Tracking Number: {{ $getItemDetails['tracking_number'] }}</span>
                                        @endif
                                    @endif

                                @endif

                                <br>
                                {{ date('Y-m-d h:i:s', strtotime($log['created_at'])) }}
                                <br>

                                @if ($log['order_status'] == "Pending Refund")
                                <button class="btn-primary attached_refund_image" style="margin: 10px 0 0 3px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="20px">
                                        <path fill="#ffffff" d="M160 32c-35.3 0-64 28.7-64 64l0 224c0 35.3 28.7 64 64 64l352 0c35.3 0 64-28.7 64-64l0-224c0-35.3-28.7-64-64-64L160 32zM396 138.7l96 144c4.9 7.4 5.4 16.8 1.2 24.6S480.9 320 472 320l-144 0-48 0-80 0c-9.2 0-17.6-5.3-21.6-13.6s-2.9-18.2 2.9-25.4l64-80c4.6-5.7 11.4-9 18.7-9s14.2 3.3 18.7 9l17.3 21.6 56-84C360.5 132 368 128 376 128s15.5 4 20 10.7zM192 128a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zM48 120c0-13.3-10.7-24-24-24S0 106.7 0 120L0 344c0 75.1 60.9 136 136 136l320 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-320 0c-48.6 0-88-39.4-88-88l0-224z"/>
                                    </svg>
                                </button>


                                <style>
                                    .refund_image_popup_container{
                                        position: fixed;
                                        z-index: 9;
                                        left: 0;
                                        right: 0;
                                        top: 0;
                                        bottom: 0;
                                        background: #000000a8;
                                        height: 100vh;
                                        display: none;
                                    }
                                    .refund_image_popup_container.active{
                                        display: flex !important;
                                    }
                                    .refund_image_popup_container img{
                                        display: block; 
                                        width: 100%;
                                        max-width: 700px;
                                        border-radius: 10px;
                                        margin-bottom: 10px
                                    }
                                    .close_refund_popup{
                                        background: white;
                                        color: black;
                                        padding: 5px;
                                        top: 10px;
                                        position: absolute;
                                        left: auto;
                                        right: 20px;
                                        border-radius: 100px;
                                        height: 30px;
                                        width: 30px;
                                        text-align: center;
                                        display: flex;
                                        align-content: center;
                                        justify-content: center;
                                        align-items: center;
                                        font-weight: bold;
                                        transition: all 0.3s ease;
                                        box-shadow: 0 0 0px white;
                                    }
                                    .refund_image_popup_container > div{
                                        background: white;
                                        padding: 30px;
                                        width: 470px !important;
                                        border-radius: 20px;
                                        margin: auto;
                                        max-width: 90vw !important;
                                        
                                    }
                                    .refund_image_popup_container div div{
                                        max-height: 590px;
                                        overflow-y: auto;
                                    }
                                </style>

                                <div class="refund_image_popup_container">
                                
                                    <a href="#" class="close_refund_popup">X</a>
                                    <div>
                                        <div>
                                            <p style="text-align: center; margin: 30px 10px;"><b>CUSTOMER:</b> &nbsp;The item is broken. Please check the attached image. Thank you!!</p>
                                            <img src="{{ $getImage('front/images/product/', 'no-available-image.jpg') }}">
                                            <img src="{{ $getImage('front/images/product/', 'no-available-image.jpg') }}">
                                            <img src="{{ $getImage('front/images/product/', 'no-available-image.jpg') }}">
                                            <img src="{{ $getImage('front/images/product/', 'no-available-image.jpg') }}">
                                        </div>
                                    </div>
                                </div>

                                @endif
                                <hr>
                            @endforeach
                            </div>

                        </div>
                    </div>
                </div>

                
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Ordered Products</h4>

                            <div class="table-responsive">
                                {{-- Order products info table --}}
                                <table class="table table-striped table-borderless">
                                    <tr class="table-danger">
                                        <th>Product Image</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Size</th>
                                        <th>Color</th>
                                        <th>Unit Price</th> 
                                        <th>Product Qty</th>
                                        <th>Total Price</th> 

                                        
                                        @if (\Illuminate\Support\Facades\Auth::guard('admin')->user()->type != 'vendor') {{-- If the authenticated/logged-in user is an 'admin', 'superadmin' or 'subadmin', NOT 'vendor' --}} {{-- Accessing Specific Guard Instances: https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances --}}
                                            <th>Product by</th>
                                        @endif

                                        
                                        
                                        <th>Commission</th> {{-- Vendor's Commission percentage must be paid on every product sold to the Website Owner --}}
                                        <th>Final Amount</th> {{-- Vendor's profit after paying (deducting) the Commission percentage --}}

                                        <th>Item Status</th> {{-- can be updated by both 'vendor'-s and 'admin'-s. This is in contrast to 'Update Order Status' which can be updated by 'admin'-s ONLY --}} 
                                        {{-- Note: The `order_statuses` table contains all kinds of order statuses (that can be updated by 'admin'-s ONLY in `orders` table) like: pending, in progress, shipped, canceled, ...etc. In `order_statuses` table, the `name` column can be: 'New', 'Pending', 'Canceled', 'In Progress', 'Shipped', 'Partially Shipped', 'Delivered', 'Partially Delivered' and 'Paid'. 'Partially Shipped': If one order has products from different vendors, and one vendor has shipped their product to the customer while other vendor (or vendors) didn't!. 'Partially Delivered': if one order has products from different vendors, and one vendor has shipped and DELIVERED their product to the customer while other vendor (or vendors) didn't!    // The `order_item_statuses` table contains all kinds of order statuses (that can be updated by both 'vendor'-s and 'admin'-s in `orders_products` table) like: pending, in progress, shipped, canceled, ...etc. --}}
                                    </tr>

                                    @foreach ($orderDetails['orders_products'] as $product)
                                        <tr>
                                            <td>
                                                @php
                                                    $getProductImage = \App\Models\Product::getProductImage($product['product_id']);
                                                @endphp

                                                <a target="_blank" href="{{ url('product/' . $product['product_id']) }}">
                                                    <img src="{{ asset('front/images/product_images/small/' . $getProductImage) }}">
                                                </a>
                                            </td>
                                            <td>{{ $product['product_code'] }}</td>
                                            <td>{{ $product['product_name'] }}</td>
                                            <td>{{ $product['product_size'] }}</td>
                                            <td>{{ $product['product_color'] }}</td>
                                            <td>{{ $product['product_price'] }}</td> 
                                            <td>{{ $product['product_qty'] }}</td>
                                            <td>
                                                
                                                @if ($product['vendor_id'] > 0) {{-- if the product belongs to a 'vendor', not 'admin' --}}

                                                    
                                                    @if ($orderDetails['coupon_amount'] > 0) {{-- If there's a Coupon Code used --}}

                                                        @if (\App\Models\Coupon::couponDetails($orderDetails['coupon_code'])['vendor_id'] > 0) {{-- if a Coupon Code has been used, and this Coupon Code belongs to a 'vendor', not 'admin' (Because in `coupons` table, if the `vendor_id` column is 1 one, this means that the Coupon Code is added by a 'vendor', not 'admin', and if the `vendor_id` column is 0 zero, this means that the Coupon Code is added by an 'admin', not 'vendor') --}}
                                                            @php
                                                                // dd(\App\Models\Coupon::couponDetails($orderDetails['coupon_code'])['vendor_id']);    
                                                            @endphp
                                                            
                                                        {{ $total_price = ($product['product_price'] * $product['product_qty']) - $item_discount }}
                                                        @else {{-- if a Coupon Code has been used, and this Coupon Code belongs to an 'admin', not 'vendor' (Because in `coupons` table, if the `vendor_id` column is 1 one, this means that the Coupon Code is added by a 'vendor', not 'admin', and if the `vendor_id` column is 0 zero, this means that the Coupon Code is added by an 'admin', not 'vendor') --}}
                                                            {{ $total_price = $product['product_price'] * $product['product_qty'] }}
                                                        @endif
                                                    
                                                    @else {{-- If there isn't a Coupon Code used --}}
                                                        {{ $total_price = $product['product_price'] * $product['product_qty'] }}
                                                    @endif

                                                @else {{-- if the product belongs to an 'admin', not 'vendor' --}}
                                                    {{ $total_price = $product['product_price'] * $product['product_qty'] }}
                                                @endif
                                            </td> {{-- Total Price = Unit Price * Quantity --}} 

                                            
                                            @if (\Illuminate\Support\Facades\Auth::guard('admin')->user()->type != 'vendor') {{-- If the authenticated/logged-in user is an 'admin', 'superadmin' or 'subadmin', NOT 'vendor' --}} {{-- Accessing Specific Guard Instances: https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances --}}
                                                @if ($product['vendor_id'] > 0) {{-- if the product belongs to a 'vendor' --}}
                                                    <td>
                                                        <a href="/admin/view-vendor-details/{{ $product['admin_id'] }}" target="_blank">Vendor</a>
                                                    </td>
                                                @else
                                                    <td>Admin</td>
                                                @endif
                                            @endif

                                            
                                            
                                            @if ($product['vendor_id'] > 0) {{-- if the product belongs to a 'vendor' --}}
                                                <td>{{ $commission = round($total_price * $product['commission'] / 100, 2) }}</td> 
                                                <td>{{ $total_price - $commission }}</td>
                                            @else
                                                <td>0</td>
                                                <td>{{ $total_price }}</td>
                                            @endif

                                            
                                            <td>
                                                
                                                {{-- Note: The `order_statuses` table contains all kinds of order statuses (that can be updated by 'admin'-s ONLY in `orders` table) like: pending, in progress, shipped, canceled, ...etc. In `order_statuses` table, the `name` column can be: 'New', 'Pending', 'Canceled', 'In Progress', 'Shipped', 'Partially Shipped', 'Delivered', 'Partially Delivered' and 'Paid'. 'Partially Shipped': If one order has products from different vendors, and one vendor has shipped their product to the customer while other vendor (or vendors) didn't!. 'Partially Delivered': if one order has products from different vendors, and one vendor has shipped and DELIVERED their product to the customer while other vendor (or vendors) didn't!    // The `order_item_statuses` table contains all kinds of order statuses (that can be updated by both 'vendor'-s and 'admin'-s in `orders_products` table) like: pending, in progress, shipped, canceled, ...etc. --}}
                                                <form action="{{ url('admin/update-order-item-status') }}" method="post">  {{-- can be updated by both 'vendor'-s and 'admin'-s. This is in contrast to 'Update Order Status' which can be updated by 'admin'-s ONLY --}}
                                                    @csrf {{-- Preventing CSRF Requests: https://laravel.com/docs/9.x/csrf#preventing-csrf-requests --}}

                                                    <input type="hidden" name="order_item_id" value="{{ $product['id'] }}">

                                                    <select id="order_item_status" name="order_item_status" required>
                                                        <option value="">Select</option>
                                                        @foreach ($orderItemStatuses as $status)
                                                            <option value="{{ $status['name'] }}"  @if (!empty($product['item_status']) && $product['item_status'] == $status['name']) selected @endif>{{ $status['name'] }}</option>
                                                        @endforeach
                                                    </select>

                                                    {{-- // Note: There are two types of Shipping Process: "manual" and "automatic". "Manual" is in the case like small businesses, where the courier arrives at the owner warehouse to to pick up the order for shipping, and the small business owner takes the shipment details (like courier name, tracking number, ...) from the courier, and inserts those details themselves in the Admin Panel when they "Update Order Status" Section (by an 'admin') or "Update Item Status" Section (by a 'vendor' or 'admin') (in admin/orders/order_details.blade.php). With "automatic" shipping process, we're integrating third-party APIs and orders go directly to the shipping partner, and the updates comes from the courier's end, and orders are automatically delivered to customers --}}
                                                    <input style="width: 110px" type="text" name="item_courier_name"    id="item_courier_name"    placeholder="Item Courier Name"    @if (!empty($product['courier_name']))    value="{{ $product['courier_name'] }}"    @endif> {{-- This input field will only show up when 'Shipped' <option> is selected. Check admin/js/custom.js --}}
                                                    <input style="width: 110px" type="text" name="item_tracking_number" id="item_tracking_number" placeholder="Item Tracking Number" @if (!empty($product['tracking_number'])) value="{{ $product['tracking_number'] }}" @endif> {{-- This input field will only show up when 'Shipped' <option> is selected. Check admin/js/custom.js --}}

                                                    <button type="submit">Update</button>
                                                </form>
                                            </td>
                                        </tr>         
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
        <!-- content-wrapper ends -->

        {{-- Footer --}}
        @include('admin.layout.footer')
        <!-- partial -->
    </div>
@endsection