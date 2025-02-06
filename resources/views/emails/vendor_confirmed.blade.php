{{-- This is the vendor confirmation/registration Success Mail file using Mailtrap --}} {{-- All the variables (like
$name, $mobile, $email, ...) used here are passed in from the vendorRegister() method in Front/VendorController.php --}}


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
    </style>
*/ ?>

    <div style="box-sizing: border-box; padding: 20px; background: #f0f5f0; border-radius: 10px; max-width: 630px; width: 90%; margin-left: auto; margin-right: auto; font-family: 'Lexend', Sans-serif;">
        <!--EMAIL SUBJECT: Your Account is Confirmed -->
        <p style="margin: 0 0 20px 0;">Dear Von Miles Gacutan<?php /* {{-- $name --}} */ ?>,</p>
        <p style="margin: 0 0 20px 0;">We are pleased to confirm the registration of your Vendor Email. Our sales team will contact you shortly with your login details.</p>
        <p style="margin: 0 0 20px 0;">Below are your registered Vendor Account details for your reference:</p>
        <ul style="margin: 0 0 30px 0;">
            <li>Name: Von Miles Gacutan<?php /* {{-- $name --}} */ ?></li>
            <li>Business Name: Von's Car Accessories<?php /* {{-- $business_name --}} */ ?></li>
            <li>Mobile: (+63) 917 170 6796<?php /* {{-- $mobile --}} */ ?></li>
            <li>Email: voncaraccessories@gmail.com<?php /* {{-- $email --}} */ ?></li>
        </ul>
        <p style="margin: 0 0 20px 0;">Thank you for choosing Kapiton. Should you have any question in the meantime, please don't hesitate to reach us at <a href="mailto:kapiton.marketplace@gmail.com">kapiton.marketplace@gmail.com</a></p>
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

        <tr>
            <td>Dear {{ $name }},</td>
        </tr>
        <tr>
            <td>&nbsp;<br></td>
        </tr>
        <tr>
            <td>
                We are pleased to confirm the registration of your Vendor Email. Our sales team will contact you shortly
                with your login details.
            </td>
        </tr>
        <tr>
            <td>&nbsp;<br></td>
        </tr>
        <tr>
            <td>Below are your registered Vendor Account details for your reference:</td>
        </tr>
        <tr>
            <td>&nbsp;<br></td>
        </tr>
        <tr>
            <td>Name: {{ $name }}</td>
        </tr>
        <tr>
            <td>&nbsp;<br></td>
        </tr>
        <tr>
            <td>Business Name: {{ $business_name }}</td>
        </tr>
        <tr>
            <td>&nbsp;<br></td>
        </tr>
        <tr>
            <td>Mobile: {{ $mobile }}</td>
        </tr>
        <tr>
            <td>&nbsp;<br></td>
        </tr>
        <tr>
            <td>Email: {{ $email }}</td>
        </tr>
        <tr>
            <td>&nbsp;<br></td>
        </tr>
        <tr>
            <td>
                Thank you for choosing Kapiton. Should you have any questions in the meantime, please don't hesitate to
                reach out to
                <a href="mailto:kapiton.marketplace@gmail.com">kapiton.marketplace@gmail.com</a>.
            </td>
        </tr>
        <tr>
            <td>&nbsp;<br></td>
        </tr>
        <tr>
            <td>Best regards,</td>
        </tr>
        <tr>
            <td>&nbsp;<br></td>
        </tr>
        <tr>
            <td>Kapiton Solutions Inc.</td>
        </tr>
    */ ?>

</body>

</html>