{{-- This is the vendor Confirmation Mail file using Mailtrap --}} {{-- All the variables (like $name, $code, ...) used here are passed in from the vendorRegister() method in Front/VendorController.php --}}


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
    <div style="box-sizing: border-box; padding: 20px; background: #f0f5f0; border-radius: 10px; max-width: 630px; width: 90%; margin-left: auto; margin-right: auto; font-family: 'Lexend', Sans-serif;">
        <!--EMAIL SUBJECT: Confirm Your Vendor Account -->
        <p style="margin: 0 0 20px 0;">Dear {{ $name }},</p>
        <p style="margin: 0 0 20px 0;">Welcome to Kapiton! To activate your vendor account and get started, please click the link below:</p>
        <a style="font-weight: 500; text-transform: uppercase; border-radius: 100px 100px 100px 100px; border: none; text-decoration: none !important; color: white !important; background: #1f1f22; padding: 8px; margin-top: 20px; display: block; width: fit-content; margin-bottom: 30px;" href="{{ config('app.frontend_url') . '/vendor/confirm/' . $code }}">📣Confirm Your Account</a>
        <p style="margin: 0 0 20px 0;">Once your account is confirmed, you'll gain access to all vendor tools and features to support your business.</p>
        <p style="margin: 0 0 20px 0;">If you have any questions or need assistance, don't hesitate to contact us.</p>
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