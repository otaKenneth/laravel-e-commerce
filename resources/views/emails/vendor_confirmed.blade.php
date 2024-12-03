{{-- This is the vendor confirmation/registration Success Mail file using Mailtrap --}} {{-- All the variables (like
$name, $mobile, $email, ...) used here are passed in from the vendorRegister() method in Front/VendorController.php --}}


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
</head>

<body>
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

</body>

</html>