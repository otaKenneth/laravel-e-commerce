<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>


    <div style="box-sizing: border-box; padding: 20px; background: #f0f5f0; border-radius: 10px; max-width: 630px; width: 90%; margin-left: auto; margin-right: auto; font-family: 'Lexend', Sans-serif;">
        <p style="margin: 0 0 20px 0;">A new product has been added by {{$vendor['vendorbusinessdetails']['shop_name']}}. Here are the details:,</p>
        <ul style="margin: 0 0 30px 0;">
            <li><strong>Product Name:</strong> {{ $product_name }}</li>
            <li><strong>Category:</strong> {{$category['category_name']}}</li>
            <li><strong>Merchant:</strong> {{$vendor['vendorbusinessdetails']['shop_name']}}</li>
            <li><strong>Price:</strong> {{$product_price }}</li>
            <li><strong>Product Link for Approval:</strong> <a href="{{url('admin/products?product_code=' . $product_code)}}">CLICK HERE</a></li>
        </ul>


        <p style="margin: 0 0 20px 0;">Please review and approve the listing as needed. If tany adjustments or verifications are required, kindly coordinate with the vendor.</p>
        <br>
        <p style="margin: 0 0 20px 0;">Let's keep the marketplace thriving with great products!🚀</p>
        
        <br>
       
    </div>
</body>
</html>