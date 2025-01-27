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
        <!--EMAIL SUBJECT: Your order has been delivered! - Order#{{-- $ --}}-->

        <p class="greet">Dear Von Miles Gacutan<?php /* {{-- $name --}} */ ?>,</p>
        <p>Great news! Your <span class="bold">order#</span>32132<?php /* {{-- $ --}} */ ?> has been delivered to the provided address. We hope you're thrilled with your purchase!</p>

        <p>Here are the details of your order:</p>
       
        <hr>
            <h3 class="heading">Order Summary:</h3>
            <p><span class="bold">Order Number: </span>32133<?php /* {{-- $ --}} */ ?></p>
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
                        <tr>
                            <td>Rays Wheels TE37</td>
                            <td>TE37V-PRO</td>
                            <td>Silver</td>
                            <td>15inch</td>
                            <td>4</td>
                            <td>PHP 42,000.32</td>
                        </tr>
                        <tr>
                            <td>Rays Wheels TE37</td>
                            <td>TE37V-PRO</td>
                            <td>Silver</td>
                            <td>15inch</td>
                            <td>4</td>
                            <td>PHP 42,000.32</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr class="tablefoot">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="border-left: 1px solid #1f1f22;">Shipping Charges:</td>
                            <td style="border-right: 1px solid #1f1f22;">PHP - 231.00<?php /* {{ $orderDetails['shipping_charges'] }} */ ?></td>
                        </tr>
                        <tr class="tablefoot">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="border-left: 1px solid #1f1f22;">Coupon Discount:</td>
                            <td style="border-right: 1px solid #1f1f22;">PHP - 0<?php /* {{ $orderDetails['coupon_amount'] }} */ ?></td>
                        </tr>
                        <tr class="tablefoot grandtotal">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="border-left: 1px solid #1f1f22; background: #1f1f22; color: white">Grand Total:</td>
                            <td style="border-right: 1px solid #1f1f22; background: #1f1f22; color: white">PHP - 42,231.32<?php /* {{ $orderDetails['grand_total'] }} */ ?></td>
                        </tr>
                    </tfoot>

                    
                </table>
            </div>
        <hr>
        <br>
        <p>We hope you're enjoying your new purchase! Your feedback means the world to us. Please take a moment to share your experience by leaving a review:</p>
        <a class="btn" href="# <?php /* {{ url('/user/confirm/' . $code) }} */ ?>"> &#x1F449; Leave a Review Here &#x1F448;</a>
        <p>Your thoughts help us improve and bring joy to more customers like you!</p>
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



    <?php /*
        <table style="width: 700px">
            <tr><td>&nbsp;</td></tr>
            <tr><td><img src="{{ asset('front/images/main-logo/main-logo.png') }}"></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Hello {{ $name }}</td></tr>
            <tr><td>&nbsp;<br></td></tr>
            <tr><td>Your Order #{{ $order_id }} status has been updated to {{ $order_status }}</td></tr>
            <tr><td>&nbsp;</td></tr>

            
            @if (!empty($courier_name) && !empty($tracking_number))
                <tr>
                    <td>Courier Name is {{ $courier_name }} and Tracking Number is {{ $tracking_number }}</td>
                </tr>
                <tr><td>&nbsp;</td></tr>
            @endif

            <tr><td>Your Order details are as below:</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>
                <table style="width: 95%" cellpadding="5" cellspacing="5" bgcolor="#f7f4f4">
                    <tr bgcolor="#cccccc">
                        <td>Product Name</td>
                        <td>Product Code</td>
                        <td>Product Size</td>
                        <td>Product Color</td>
                        <td>Product Quantity</td>
                        <td>Product Price</td>
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
                    <tr>
                        <td colspan="5" align="right">Shipping Charges</td>
                        <td>PHP {{ $orderDetails['shipping_charges'] }}</td>
                    </tr>
                    <tr>
                        <td colspan="5" align="right">Coupon Discount</td>
                        <td>
                            PHP
                            @if ($orderDetails['coupon_amount'] > 0)
                                {{ $orderDetails['coupon_amount'] }}
                            @else
                                0
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" align="right">Grand Total</td>
                        <td>PHP {{ $orderDetails['grand_total'] }}</td>
                    </tr>
                </table>
            </td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>
                <table>
                    <tr>
                        <td><strong>Delivery Address:</strong></td>
                    </tr>
                    <tr>
                        <td>{{ $orderDetails['name'] }}</td>
                    </tr>
                    <tr>
                        <td>{{ $orderDetails['address'] }}</td>
                    </tr>
                    <tr>
                        <td>{{ $orderDetails['city'] }}</td>
                    </tr>
                    <tr>
                        <td>{{ $orderDetails['state'] }}</td>
                    </tr>
                    <tr>
                        <td>{{ $orderDetails['country'] }}</td>
                    </tr>
                    <tr>
                        <td>{{ $orderDetails['pincode'] }}</td>
                    </tr>
                    <tr>
                        <td>{{ $orderDetails['mobile'] }}</td>
                    </tr>
                </table>    
            </td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>For any queries, you can contact us at <a href="mailto:info@kapiton.com">info@kapiton.com</a></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Regards,<br>Team Kapiton</td></tr>
            <tr><td>&nbsp;</td></tr>
        </table>
    */ ?>


    </body>
</html>