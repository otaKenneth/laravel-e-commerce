{{-- This is the User Confirmation E-mail after Registration (which contains the 'Activation Link') file using Mailtrap --}} {{-- All the variables (like $name, $mobile, $email, $code, ...) used here are passed in from the userRegister() method in Front/UserController.php --}}



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
            font-weight: bold
        }
    </style>
    */ ?>

    <div style="box-sizing: border-box; padding: 20px; background: #f0f5f0; border-radius: 10px; max-width: 630px; width: 90%; margin-left: auto; margin-right: auto; font-family: 'Lexend', Sans-serif;">
        <!--EMAIL SUBJECT: Confirm Your Kapiton Account -->
        <p style="margin: 0 0 20px 0;">Dear {{ $name }}<?php /* {{-- $name --}} */ ?>,</p>
        <p style="margin: 0 0 20px 0;">Thank you for signing up with Kapiton! To complete your registration, please confirm your account by clicking the button below:</p>
        <a href="# <?php /* {{ url('/user/confirm/' . $code) }} */ ?>" style="font-weight: 500; text-transform: uppercase; border-radius: 100px; border: none; text-decoration: none !important; color: white !important; background: #1f1f22; padding: 8px; margin-top: 20px; display: block; width: fit-content; margin-bottom: 30px;">📣Confirm Account</a>
        <p style="margin: 0 0 20px 0;">Once confirmed, you'll be able to access all the features of your new account.</p>
        <p style="margin: 0 0 20px 0;">If you need assistance or have any questions, feel free to reach out to us.</p>
        
        <br>
        <p style="margin: 0 0 20px 0;">--</p>
        <p style="margin: 0 0 20px 0; font-weight: bold; font-style: italic;"><strong><em>Best Regards,</em></strong></p>
        
        <div>
            <div style="padding: 12px; background: #1f1f22; max-width: 140px; border-radius: 3px; margin-bottom: 15px;">
                <img src="{{ asset('front/images/main-logo/2023-12-logo-white-text.png') }}" style="width: 100%; display: block; margin: 0;">
            </div>
            <p style="margin: 0 0 4px 0 !important; font-size: 12px;"><b>MOBILE:</b> &nbsp;(+63) 917 170 6796</p>
            <p style="margin: 0 0 4px 0 !important; font-size: 12px;">
                <a target="_blank" href="https://kapiton.store/" style="text-decoration: underline; color: #0000ee;">WEBSITE</a>
                <span style="margin: 0 4px;">&nbsp;|&nbsp;</span>
                <a target="_blank" href="https://www.facebook.com/kapiton.store" style="text-decoration: underline; color: #0000ee;">FACEBOOK</a>
                <span style="margin: 0 4px;">&nbsp;|&nbsp;</span>
                <a target="_blank" href="https://www.instagram.com/kapiton.store/" style="text-decoration: underline; color: #0000ee;">INSTAGRAM</a>
            </p>
        </div>
    </div>



    <?php /*

        <table>
            <tr><td>Dear {{ $name }},</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Please click on below link to activate your Kapiton account:-</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td><a href="{{ url('/user/confirm/' . $code) }}">Confirm Account</a></td></tr> {{-- $code is passed in from userRegister() method in UserController.php --}}
            <tr><td>&nbsp;</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Thanks & Regards,</td></tr>
            <tr><td>Kapiton</td></tr>
        </table>
    */ ?>


    </body>
</html>
