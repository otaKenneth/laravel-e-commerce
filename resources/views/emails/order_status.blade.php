{{-- This is the order "Update Order Status" by 'admin' email file using Mailtrap --}} {{-- All the variables (like $name, $mobile, $email, ...) used here are passed in from the updateOrderStatus() method in Admin/OrderController.php --}}



<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>


    <?php /*
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
    */ ?>

    <div style="box-sizing: border-box; padding: 20px; background: #f0f5f0; border-radius: 10px; max-width: 630px; width: 90%; margin-left: auto; margin-right: auto; font-family: 'Lexend', Sans-serif;">
        <!--EMAIL SUBJECT: Your order is on the way - Order#{{-- $ --}}-->

        <p style="margin: 0 0 20px 0;">Dear {{ $name }},</p>
        @if($order_status == 'Delivered')
        <p style="margin: 0 0 20px 0;">Great news! Your <span style="font-weight: bold;">order#</span>{{ $order_id }} has been delivered to the provided address. We hope you're thrilled with your purchase!</p>
        @elseif($order_status == 'Cancelled')
        <p style="margin: 0 0 20px 0;">We want to confirm that <b>order #</b>{{ $order_id }} has been successfully canceled as per your request.</p>
        <p style="margin: 0 0 20px 0;">If the customer has already made a payment, the refund process will be initiated and the amount will be returned to their chosen payment method within 30 days. Please ensure to keep records of this transaction for your reference.</p>
        <p style="margin: 0 0 20px 0;">Thank you for your understanding and for being valued partner on our platform. We look forward to support your future sales!</p>
        @else
        <p style="margin: 0 0 20px 0;">The Order #{{ $order_id }} status has been updated to {{ $order_status }}.</p>
        @endif

        @if (!empty($courier_name) && !empty($tracking_number))
        <p style="margin: 0 0 20px 0;">Courier Name is {{ $courier_name }} and Tracking Number is {{ $tracking_number }} </p>
        @endif
        
        <hr>
            <h3 style="margin: 0 0 20px 0;">Order Summary:</h3>
            <p style="margin: 0 0 20px 0;"><span style="font-weight: bold;">Order Number: </span>{{ $order_id }}</p>
            <div style="width: 100%; max-width: 100vw; overflow: auto; margin-bottom: 30px;">
                <table style="width:auto; min-width: 100%; border-spacing: 0; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #1f1f22;">
                            <th style="font-size: 14px; padding: 10px 20px; background: #1f1f22; color: white;">Item</th>
                            <th style="font-size: 14px; padding: 10px 20px; background: #1f1f22; color: white;">Product Code</th>
                            <th style="font-size: 14px; padding: 10px 20px; background: #1f1f22; color: white;">Color</th>
                            <th style="font-size: 14px; padding: 10px 20px; background: #1f1f22; color: white;">Size</th>
                            <th style="font-size: 14px; padding: 10px 20px; background: #1f1f22; color: white;">Quantity</th>
                            <th style="font-size: 14px; padding: 10px 20px; background: #1f1f22; color: white;">Price</th>
                        </tr>
                    </thead>
                    <tbody style="border: 1px solid #1f1f22;">
                    @foreach ($orderDetails['orders_products'] as $order)
                        <tr bgcolor="#f9f9f9">
                            <td style="font-size: 12px; padding: 10px 20px;">{{ $order['product_name'] }}</td>
                            <td style="font-size: 12px; padding: 10px 20px;">{{ $order['product_code'] }}</td>
                            <td style="font-size: 12px; padding: 10px 20px;">{{ $order['product_size'] }}</td>
                            <td style="font-size: 12px; padding: 10px 20px;">{{ $order['product_color'] }}</td>
                            <td style="font-size: 12px; padding: 10px 20px;">{{ $order['product_qty'] }}</td>
                            <td style="font-size: 12px; padding: 10px 20px;">{{ $order['product_price'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td style="font-size: 12px; padding: 10px 20px;"></td>
                            <td style="font-size: 12px; padding: 10px 20px;"></td>
                            <td style="font-size: 12px; padding: 10px 20px;"></td>
                            <td style="font-size: 12px; padding: 10px 20px;"></td>
                            <td style="border-left: 1px solid #1f1f22;">Shipping Charges:</td>
                            <td style="border-right: 1px solid #1f1f22;">PHP {{ $orderDetails['shipping_charges'] }}</td>
                        </tr>
                        <tr>
                            <td style="font-size: 12px; padding: 10px 20px;"></td>
                            <td style="font-size: 12px; padding: 10px 20px;"></td>
                            <td style="font-size: 12px; padding: 10px 20px;"></td>
                            <td style="font-size: 12px; padding: 10px 20px;"></td>
                            <td style="border-left: 1px solid #1f1f22;">Coupon Discount:</td>
                            <td style="border-right: 1px solid #1f1f22;">PHP {{ $orderDetails['coupon_amount'] }}</td>
                        </tr>
                        <tr style="background: #1f1f22; color: white;">
                            <td style="font-size: 12px; padding: 10px 20px;"></td>
                            <td style="font-size: 12px; padding: 10px 20px;"></td>
                            <td style="font-size: 12px; padding: 10px 20px;"></td>
                            <td style="font-size: 12px; padding: 10px 20px;"></td>
                            <td style="font-size: 12px; padding: 10px 20px; border-left: 1px solid #1f1f22; background: #1f1f22; color: white">Grand Total:</td>
                            <td style="font-size: 12px; padding: 10px 20px; border-right: 1px solid #1f1f22; background: #1f1f22; color: white">PHP {{ $orderDetails['grand_total'] }}</td>
                        </tr>
                    </tfoot>

                    
                </table>
            </div>
        <hr>
        <br>
        <p style="margin: 0 0 20px 0;"><span style="font-weight: bold;">Delivery Details:</p>
        <ul style="margin: 0 0 30px 0;">
            <li>Name: {{ $orderDetails['name'] }}</li>
            <li>Address: {{ $orderDetails['address'] }}, {{ $orderDetails['city'] }}, {{ $orderDetails['state'] }}, {{ $orderDetails['country'] }}, {{ $orderDetails['pincode'] }}</li>
            <li>Phone: {{ $orderDetails['mobile'] }}</li>
            <li>Email: {{ $email }}</li>
        </ul>
        <hr>
        <br>
        
        
        <p style="margin: 0 0 20px 0;">For any questions or assistance, feel free to contact us at <a href="mailto:kapiton.marketplace@gmail.com">kapiton.marketplace@gmail.com</a></p>
        

        <br>
        <p>--</p>
        <p style="font-weight: bold; font-style: italic;"><strong><em>Best Regards,</strong></em></p>
        <div>
            <div style="padding: 12px; background: #1f1f22; max-width: 140px; border-radius: 3px; margin-bottom: 15px;">
                <img style="width: 100%; display: block; margin: 0;" src="{{ asset('front/images/main-logo/2023-12-logo-white-text.png') }}">
            </div>
            <p style="margin: 0 0 4px 0 !important; font-size: 12px;"><b>MOBILE:</b> &nbsp;(+63) 917 170 6796</p>
            <p style="margin: 0 0 4px 0 !important; font-size: 12px;"><a target="_blank" href="https://kapiton.store/">WEBSITE</a><span style="margin: 0 4px;">&nbsp;|&nbsp;</span><a target="_blank" href="https://www.facebook.com/kapiton.store">FACEBOOK</a><span style="margin: 0 4px;">&nbsp;|&nbsp;</span><a target="_blank" href="https://www.instagram.com/kapiton.store/">INSTAGRAM</a></p>
        </div>
    </div>





    </body>
</html>