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
        <!--EMAIL SUBJECT: Order Cancelled - Order#{{-- $ --}}-->

        <p class="greet">Dear {{ $name }},</p>
        <p style="margin-bottom: 2px;">Your <span class="bold">order #</span>{{$order_id}} with {{ $business_name }} has been requested for Refund for your reason(s) as below:</p>
        <p style="background-color: #f0f0f0; border-radius: 5px; padding: 3px 2px;">{{$reason}}</p>

        <p>Rest assured, your refund will be processed within 30 days and returned to your selected payment method. You'll receive a confirmation email once the refund has been completed.</p>
       
        <hr>
            <h3 class="heading">Order Summary:</h3>
            <p><span class="bold">Order Number: </span>{{$order_id}}</p>
            <div class="table-wrapper">
                <table>
                    <tbody>
                        <tr class="headtr">
                            <th>Item</th>
                            <th>Product Code</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
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
                            <td style="border-right: 1px solid #1f1f22;">PHP 
                                @if ($orderDetails['coupon_amount'] > 0)
                                    {{ $orderDetails['coupon_amount'] }}
                                @else
                                    0
                                @endif
                            </td>
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
        <p>We're sorry to see this order go, but we hope to serve you again soon. If there's anything we can do to assist or improve your experience, please don't hesitate to contact us at <a href="mailto:kapiton.marketplace@gmail.com">kapiton.marketplace@gmail.com</a></p>
        

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
   
   
   
