<div>
<table style="width: 700px">
        <tr><td>&nbsp;</td></tr>
        <tr><td><img src="{{ asset('front/images/main-logo/main-logo.png') }}"></td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Hello {{ $name }}</td></tr>
        <tr><td>&nbsp;<br></td></tr>
        <tr><td>An Order <a href="{{ seller_url('admin/orders/' . $order_id) }}">#{{ $order_id }}</a> status has been updated to {{ $order_status }}</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>For reason: {{$reason}}</td></tr>
        <tr><td>The Order details are as below:</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>
            <table style="width: 95%" cellpadding="5" cellspacing="5" bgcolor="#f7f4f4">
                <tr bgcolor="#cccccc">
                    <td>Product Name</td>
                    <td>Product Code</td>
                    <td>Product Size</td>
                    <td>Product Color</td>
                    <td>Product Quantity</td>
                    <td>Product Price</td>
                </tr>
                @foreach ($orderDetails['orders_products'] as $order)
                    <tr bgcolor="#f9f9f9">
                        <td>{{ $order['product_name'] }}</td>
                        <td>{{ $order['product_code'] }}</td>
                        <td>{{ $order['product_size'] }}</td>
                        <td>{{ $order['product_color'] }}</td>
                        <td>{{ $order['product_qty'] }}</td>
                        <td>{{ $order['product_price'] }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="5" align="right">Shipping Charges</td>
                    <td>PHP {{ $orderDetails['shipping_charges'] }}</td>
                </tr>
                <tr>
                    <td colspan="5" align="right">Coupon Discount</td>
                    <td>
                        PHP
                        @if ($orderDetails['coupon_amount'] > 0)
                            {{ $orderDetails['coupon_amount'] }}
                        @else
                            0
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="5" align="right">Grand Total</td>
                    <td>PHP {{ $orderDetails['grand_total'] }}</td>
                </tr>
            </table>
        </td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>For any queries, you can contact us at <a href="mailto:info@kapiton.com">info@kapiton.com</a></td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Regards,<br>Team Kapiton</td></tr>
        <tr><td>&nbsp;</td></tr>
    </table>
</div>
