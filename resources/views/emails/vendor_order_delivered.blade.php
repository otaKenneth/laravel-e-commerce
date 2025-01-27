{{-- This is the User Forgot Password E-mail using Mailtrap --}} {{-- All the variables (like $name, $mobile, $email, $code, ...) used here are passed in from the forgotPassword() method in Front/UserController.php --}}



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
        <!--EMAIL SUBJECT: Order Delivered - Order#{{-- $ --}}-->

        <p class="greet">Dear Von's Car Accessories<?php /* {{-- $business_name --}} */ ?>,</p>
        <p>We're pleased to inform you that the product for order #32133<?php /* {{-- $ --}} */ ?> has been successfully delivered to the customer.</p>
      
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
                            <td style="border-right: 1px solid #1f1f22;">PHP - 231.00</td>
                        </tr>
                        <tr class="tablefoot">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="border-left: 1px solid #1f1f22;">Coupon Discount:</td>
                            <td style="border-right: 1px solid #1f1f22;">PHP - 0</td>
                        </tr>
                        <tr class="tablefoot grandtotal">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="border-left: 1px solid #1f1f22; background: #1f1f22; color: white">Grand Total:</td>
                            <td style="border-right: 1px solid #1f1f22; background: #1f1f22; color: white">PHP - 42,231.32</td>
                        </tr>
                    </tfoot>

                    
                </table>
            </div>
        <hr>
        <br>
        <p><span class="bold">Delivery Details:</p>
        <ul>
            <li>Name: Von Miles Gacutan<?php /* {{-- $ --}} */ ?></li>
            <li>Address: #325 Sampaguita St., San Pablo, Laguna<?php /* {{-- $ --}} */ ?></li>
            <li>Phone: +63 943 321 5412<?php /* {{-- $ --}} */ ?></li>
            <li>Email: vonmiles@gmail.com<?php /* {{-- $ --}} */ ?></li>
        </ul>
        <hr>
        <p>Please ensure your record are updated to reflect the delivery status for this order. If there are any issue or further actions required, feel free to contact us at <a href="mailto:kapiton.marketplace@gmail.com">kapiton.marketplace@gmail.com</a></p>
        <p>Thank you for your continued partnership with <span class="bold">Kapiton!</span></p>
        <p>For any questions or assistance, feel free to contact our support team at <a href="mailto:kapiton.marketplace@gmail.com">kapiton.marketplace@gmail.com</a></p>


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
        <table>
            <tr><td>Dear {{ $name }},</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>You requested to change your password. New Password is as below:-</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Email: {{ $email }}</td></tr> {{-- $email is passed in from forgotPassword() method in UserController.php --}}
            <tr><td>&nbsp;</td></tr>
            <tr><td>Password: {{ $password }}</td></tr> {{-- $password is passed in from forgotPassword() method in UserController.php --}}
            <tr><td>&nbsp;</td></tr>
            <tr><td>Thanks & Regards,</td></tr>
            <tr><td>Kapiton</td></tr>
        </table>
    */ ?>


    </body>
</html>