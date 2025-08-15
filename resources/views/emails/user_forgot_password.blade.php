{{-- This is the User Forgot Password E-mail using Mailtrap --}} {{-- All the variables (like $name, $mobile, $email, $code, ...) used here are passed in from the forgotPassword() method in Front/UserController.php --}}



<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
    <div style="box-sizing: border-box; padding: 20px; background: #f0f5f0; border-radius: 10px; max-width: 630px; width: 90%; margin-left: auto; margin-right: auto; font-family: 'Lexend', Sans-serif;">
        <!--EMAIL SUBJECT: Your New Password - Kapiton -->
        <p style="margin: 0 0 20px 0;">Dear {{ $name }},</p>
        <p style="margin: 0 0 20px 0;">We've received your request to reset your password. Below are your updated login details:</p>
        <ul style="margin: 0 0 30px 0;">
            <li>Email: {{$email}}</li>
            <li>Temporary Password: {{$password}}</li>
        </ul>

        <p style="margin: 0 0 20px 0;">For your security, we strongly recommend updating your password immediately after logging in. <br>You can do so by:</p>
        <p style="padding: 0 20px; font-weight: bold;">Navigating to: <span style="font-weight: bold;">My Account > Profile > Change Password</span> <br>or by visiting this link</p>
        <p style="margin: 0 0 20px 0;">If you didn't request this password reset or need any assistance, please contact us right away to ensure your account remains secure.</p>
    
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