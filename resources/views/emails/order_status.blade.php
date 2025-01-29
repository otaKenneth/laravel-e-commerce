{{-- This is the order "Update Order Status" by 'admin' email file using Mailtrap --}} {{-- All the variables (like $name, $mobile, $email, ...) used here are passed in from the updateOrderStatus() method in Admin/OrderController.php --}}



<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>



    <style>
        .email_template{
            box-sizing: border-box ;
            padding: 20px;
            background: #f0f5f0;
            border-radius: 10px;
            max-width: 630px;
            width: 90%;
            margin-left: auto;
            margin-right: auto;
            font-family: "Lexend", Sans-serif;
        }
        .email_template p{
            margin: 0 0 20px 0;
        }
        .email_template ul{
            margin: 0 0 30px 0;
        }
        .btn{
            font-weight: 500;
            text-transform: uppercase;
            border-radius: 100px 100px 100px 100px;
            border: none;
            text-decoration: none !important;
            color: white !important;
            background: #1f1f22;
            padding: 8px;
            margin-top: 20px;
            display: block;
            width: fit-content;
            margin-bottom: 30px;
        }
        p.end{
            font-weight: bold;
            font-style: italic;
        }
        .logo{
            padding: 12px;
            background: #1f1f22;
            max-width: 140px;
            border-radius: 3px;
            margin-bottom: 15px;
        }
        .logo img{
            width: 100%;
            display: block;
            margin: 0;
        }
        .small-text{
            margin: 0 0 4px 0 !important;
            font-size: 12px;
        }
        .small-text span{
            margin: 0 4px;
        }
        .small-text a{
            text-decoration: underline;
            color: #0000ee;
        }
        .indented{
            padding: 0 20px;
        }
        .bold{
            font-weight: bold
        }
        .table-wrapper{
            width: 100%;
            max-width: 100vw;
            overflow: auto;
            margin-bottom: 30px;
        }
        table{
            width:auto;
            min-width: 100%;
            border-spacing: 0;
            border-collapse: collapse;
        }
        th{
            background: #1f1f22;
            color: white;
            font-size: 14px;
            padding: 10px 20px;
        }
        .headtr{
            background: #1f1f22;
        }
        td{
            font-size: 14px;
            text-align: center;
            padding: 10px;
            background: white;
        }
        .tablefoot td{
            text-align: left;
            padding: 5px;
        }
        .tablefoot td:empty{
            background: #f0f5f0;
        }
        table tr{
            border: none;
        }
        table tbody{
            border: 1px solid #1f1f22;
        }
        .tablefoot td{
            font-size: 12px;
        }
        .tablefoot td:last-child{
            text-align: right;
        }
    </style>

    <div class="email_template">
        <!--EMAIL SUBJECT: Your order is on the way - Order#{{-- $ --}}-->

        <p class="greet">Dear {{ $name }},</p>
        @if($order_status == 'Delivered')
        <p>Great news! Your <span class="bold">order#</span>{{ $order_id }} has been delivered to the provided address. We hope you're thrilled with your purchase!</p>
        @elseif($order_status == 'Cancelled')
        <p>We want to confirm that <b>order #</b>{{ $order_id }} has been successfully canceled as per your request.</p>
        <p>If the customer has already made a payment, the refund process will be initiated and the amount will be returned to their chosen payment method within 30 days. Please ensure to keep records of this transaction for your reference.</p>
        <p>Thank you for your understanding and for being valued partner on our platform. We look forward to support your future sales!</p>
        @else
        <p>The Order #{{ $order_id }} status has been updated to {{ $order_status }}.</p>
        @endif

        @if (!empty($courier_name) && !empty($tracking_number))
        <p>Courier Name is {{ $courier_name }} and Tracking Number is {{ $tracking_number }} </p>
        @endif
        
        <hr>
            <h3 class="heading">Order Summary:</h3>
            <p><span class="bold">Order Number: </span>{{ $order_id }}</p>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr class="headtr">
                            <th>Item</th>
                            <th>Product Code</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($orderDetails['orders_products'] as $order)
                        <tr bgcolor="#f9f9f9">
                            <td>{{ $order['product_name'] }}</td>
                            <td>{{ $order['product_code'] }}</td>
                            <td>{{ $order['product_size'] }}</td>
                            <td>{{ $order['product_color'] }}</td>
                            <td>{{ $order['product_qty'] }}</td>
                            <td>{{ $order['product_price'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="tablefoot">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="border-left: 1px solid #1f1f22;">Shipping Charges:</td>
                            <td style="border-right: 1px solid #1f1f22;">PHP {{ $orderDetails['shipping_charges'] }}</td>
                        </tr>
                        <tr class="tablefoot">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="border-left: 1px solid #1f1f22;">Coupon Discount:</td>
                            <td style="border-right: 1px solid #1f1f22;">PHP {{ $orderDetails['coupon_amount'] }}</td>
                        </tr>
                        <tr class="tablefoot grandtotal">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="border-left: 1px solid #1f1f22; background: #1f1f22; color: white">Grand Total:</td>
                            <td style="border-right: 1px solid #1f1f22; background: #1f1f22; color: white">PHP {{ $orderDetails['grand_total'] }}</td>
                        </tr>
                    </tfoot>

                    
                </table>
            </div>
        <hr>
        <br>
        <p><span class="bold">Delivery Details:</p>
        <ul>
            <li>Name: {{ $orderDetails['name'] }}</li>
            <li>Address: {{ $orderDetails['address'] }}, {{ $orderDetails['city'] }}, {{ $orderDetails['state'] }}, {{ $orderDetails['country'] }}, {{ $orderDetails['pincode'] }}</li>
            <li>Phone: {{ $orderDetails['mobile'] }}</li>
            <li>Email: {{ $email }}</li>
        </ul>
        <hr>
        <br>
        
        
        <p>For any questions or assistance, feel free to contact us at <a href="mailto:kapiton.marketplace@gmail.com">kapiton.marketplace@gmail.com</a></p>
        

        <br>
        <p>--</p>
        <p class="end">Best Regards,</p>
        <div class="company-info">
            <div class="logo">
                <img src="{{ $getImage('front/images/main-logo/', '2023-12-logo-white-text.png') }}">
            </div>
            <p class="small-text"><b>MOBILE:</b> &nbsp;(+63) 917 170 6796</p>
            <p class="small-text"><a target="_blank" href="https://kapiton.store/">WEBSITE</a><span>|</span><a target="_blank" href="https://www.facebook.com/kapiton.store">FACEBOOK</a><span>|</span><a target="_blank" href="https://www.instagram.com/kapiton.store/">INSTAGRAM</a></p>
        </div>
    </div>





    </body>
</html>