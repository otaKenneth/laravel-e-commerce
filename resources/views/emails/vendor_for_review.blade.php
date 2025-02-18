<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Vendor Registration</title>
</head>
<body>


    <div style="box-sizing: border-box; padding: 20px; background: #f0f5f0; border-radius: 10px; max-width: 630px; width: 90%; margin-left: auto; margin-right: auto; font-family: 'Lexend', Sans-serif;">
        <!--EMAIL SUBJECT: New Vendor Sign-Up Alert {{ $business_name }} ?> -->
        <p style="margin: 0 0 20px 0;">A new vendor has signed up on <strong>Kapiton</strong>. Below are the details:</p>
        <ul style="margin: 0 0 30px 0;">
            <li><strong>Business Name:</strong> {{ $name }}</li>
            <li><strong>Contact Person:</strong> {{ $XXX['xxx'] }}</li>
            <li><strong>Email:</strong> {{ $email }}</li>
            <li><strong>Phone Number:</strong> {{ $XXX['xxx'] }}</li>
            <li><strong>Registration Date:</strong> {{ $XXX['xxx'] }}</li>

        </ul>


        <p style="margin: 0 0 20px 0;">Please review their account and take the necessary steps to <strong>verify, approve or onboard</strong> them as needed. If any additional action is required, kindly coordinate with the relevant team.</p>
        <p style="margin: 0 0 20px 0;">Let's ensure they have a smooth onboarding experience!🚀</p>
        
        
        
        
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
    <p>Hello Admin/s,</p>
    <p>A new vendor has been registered to the system:</p>
    
    <ul>
        <li>Name: {{ $name }}</li>
        <li>Email: {{ $email }}</li>
        <li>Initial Password: {{ $initial_password }}</li>
    </ul>

    <p>Please take necessary actions to verify and activate the vendor account.</p>
    
    <p>Thank you!</p>
    <div width="150px">
        <img src="{{ asset('front/images/main-logo/main-logo.png') }}">
    </div>
*/ ?>


</body>
</html>
