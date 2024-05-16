<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST" action="{{ route('better-pay.store') }}">
        @csrf
        <table>
            <tr>
                <td colspan="2">Please fill up the detail below in order to test the payment.</td>
            </tr>
            <tr>
                <td>Amount</td>
                <td>: <input type="text" name="amount" value="125.00" placeholder="Amount to pay, for example 12.20"
                        size="30">
                </td>
            </tr>
            <tr>
                <td>Payment Description (Not more than 1,000 character)</td>
                <td>: <input type="text" name="payment_desc" value="This is a payment"
                        placeholder="Description of the transaction" size="30"></td>
            </tr>
            <tr>
                <td>Invoice (Not more than 17 char without '-')</td>
                <td>: <input type="text" name="invoice" value="INV0001"
                        placeholder="Unique id to reference the transaction or order" size="30"></td>
            </tr>

            <tr>
                <td><input type="submit" value="Submit"></td>
            </tr>
        </table>
    </form>
</body>

</html>