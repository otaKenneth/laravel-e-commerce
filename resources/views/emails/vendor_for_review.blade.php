<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Vendor Registration</title>
</head>
<body>
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
</body>
</html>
