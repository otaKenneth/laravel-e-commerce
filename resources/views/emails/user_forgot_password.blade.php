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
    </style>

    <div class="email_template">
        <!--EMAIL SUBJECT: Your New Password - Kapiton -->
        <p class="greet">Dear Von Miles Gacutan<?php /* {{-- $name --}} */ ?>,</p>
        <p>We've received your request to reset your password. Below are your updated login details:</p>
        <ul>
            <li>Email: voncaraccessories@gmail.com<?php /* {{-- $email --}} */ ?></li>
            <li>Temporary Password: x/!s412Avgh<?php /* {{-- $password --}} */ ?></li>
        </ul>

        <p>For your security, we strongly recommend updating your password immediately after logging in. <br>You can do so by:</p>
            <p class="indented">Navigating to: <span class="bold">My Account > Profile > Change Password</span> <br>or by visiting this link</p>
        <p>If you didn't request this password reset or need any assistance, please contact us right away to ensure your account remains secure.</p>
    

        
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