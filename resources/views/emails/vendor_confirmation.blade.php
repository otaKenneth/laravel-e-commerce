{{-- This is the vendor Confirmation Mail file using Mailtrap --}} {{-- All the variables (like $name, $code, ...) used here are passed in from the vendorRegister() method in Front/VendorController.php --}}


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
    </style>

    <div class="email_template">
        <!--EMAIL SUBJECT: Confirm Your Vendor Account -->
        <p class="greet">Dear Von's Car Accessories<?php /* {{-- $business_name --}} */ ?>,</p>
        <p>Welcome to Kapiton! To activate your vendor account and get started, please click the link below:</p>
        <a class="btn" href="# <?php /* {{ url('vendor/confirm/' . $code) }} */ ?>">📣Confirm Your Account</a>
        <p>Once your account is confirmed, you'll gain access to all vendor tools and features to support your business.</p>
        <p>If you have any questions or need assistance, don't hesitate to contact us.</p>
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
        <tr><td><img src="{{ asset('front/images/main-logo/main-logo.png') }}"></td></tr> 
        <tr><td>Dear {{-- $name --}}!</td></tr>
        <tr><td>&nbsp;<br></td></tr>
        <tr><td>Please click on the link below to confirm your Vendor Account :-</td></tr>
        <tr><td><a href="{{ url('vendor/confirm/' . $code) }}">{{ url('vendor/confirm/' . $code) }}</a></td></tr> {{-- Check the route in web.php --}} {{-- $code is the base64 encoded vendor `email` which will be sent to the route and will be decoded by confirmVendor() method in Front/VendorController.php --}}
        <tr><td>&nbsp;<br></td></tr>
        <tr><td>Thanks & Regards,</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Kapiton</td></tr>
    */ ?>


    </body>
</html>