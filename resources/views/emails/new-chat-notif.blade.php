{{-- This is the User Confirmation E-mail after Registration (which contains the 'Activation Link') file using Mailtrap --}} {{-- All the variables (like $name, $mobile, $email, $code, ...) used here are passed in from the userRegister() method in Front/UserController.php --}}



<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>



    <div style="box-sizing: border-box; padding: 20px; background: #f0f5f0; border-radius: 10px; max-width: 630px; width: 90%; margin-left: auto; margin-right: auto; font-family: 'Lexend', Sans-serif;">
        <!--EMAIL SUBJECT: New Message from <?php /* {{-- $customer____name --}} */ ?> -->
        <p style="margin: 0 0 20px 0;">Dear <strong>{{ $business_name }}</strong><?php /* {{-- $business_name --}} */ ?>,</p>
        <p style="margin: 0 0 20px 0;">You've received a new message from <strong>{{ $orderDetails['name'] }}</strong>! Please review their inquiry and respond promptly to ensure a smooth customer experience.</p>
        <p style="margin: 0 0 20px 0;">To access Chats, log in using your merchant account and navigate to <strong>Store &gt; Chats</strong> in your dashboard or by clicking this <a href="{{ $chatUrl }}">link</a></p>
        
        
        
        
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
<div>
    <p>Hello,</p>
    <p>You have received a new message from a user:</p>

    <blockquote>{{ $messageContent }}</blockquote>

    <p>Click the link below to view the chat:</p>
    <a href="{{ $chatUrl }}">View Chat</a>

    <p>Thanks,<br>{{ config('app.name') }}</p>
</div>

    */ ?>

   

    </body>
</html>


