{{-- This is the vendor Approval Success Mail file using Mailtrap --}} {{-- All the variables (like $name, $mobile, $email, ...) used here are passed in from the updateAdminStatus() method in Admin/AdminController.php --}}


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>


    <div style="box-sizing: border-box; padding: 20px; background: #f0f5f0; border-radius: 10px; max-width: 630px; width: 90%; margin-left: auto; margin-right: auto; font-family: 'Lexend', Sans-serif;">
        <!--EMAIL SUBJECT: Your Merchant Account is now LIVE!🚀 -->
        <p style="margin: 0 0 20px 0;">Great news! Your Merchant account is now live and ready to use. You can access your accoung anytime by visiting our <strong>Seller Center</strong> at <a href="https://seller.kapiton.store/" target="_blank">https://seller.kapiton.store/</a></p>
        <p style="margin: 0 0 20px 0;">If you have any questions or need any assistance, don't hesitate to reach out—we're here to help!</p>
        <br>
        <p style="margin: 0 0 20px 0;">Welcome aboard!</p>
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

    <?php /*
        <tr><td>Dear {{ $name }}!</td></tr>
        <tr><td>&nbsp;<br><br></td></tr>
        <tr><td>Your Vendor Account has been approved. Now you can login and add products.</td></tr>
        <tr><td>&nbsp;<br><br></td></tr>
        <tr><td>Your Vendor Account Details are as below :-<br></td></tr>
        <tr><td>&nbsp;<br></td></tr>
        <tr><td>Name: {{ $name }}</td></tr>
        <tr><td>&nbsp;<br></td></tr>
        <tr><td>Mobile: {{ $mobile }}</td></tr>
        <tr><td>&nbsp;<br></td></tr>
        <tr><td>Email: {{ $email }}</td></tr>
        <tr><td>&nbsp;<br></td></tr>
        <tr><td>Password: ***** (as chosen by you)</td></tr>
        <tr><td>&nbsp;<br><br></td></tr>
        <tr><td>Thanks & Regards,</td></tr>
        <tr><td>&nbsp;<br></td></tr>
        <tr><td>Kapiton</td></tr>
    */ ?>


    </body>
</html>