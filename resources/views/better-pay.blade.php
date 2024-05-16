<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post" action="{{ route('better-pay.process-payment') }}">
        @csrf
        <table>
            <tr>
                <td colspan="2">Please fill up the details below to test the payment.</td>
            </tr>
            <tr>
                <td>Amount</td>
                <td>: <input type="text" name="amount" value="{{ old('amount') }}"
                        placeholder="Amount to pay, e.g., 12.20" size="30"></td>
            </tr>
            <tr>
                <td>Payment Description (Not more than 1,000 characters)</td>
                <td>: <input type="text" name="payment_desc" value="{{ old('payment_desc') }}"
                        placeholder="Description of the transaction" size="30"></td>
            </tr>
            <tr>
                <td>Invoice (Not more than 17 characters without '-'):</td>
                <td>: <input type="text" name="invoice" value="{{ old('invoice') }}"
                        placeholder="Unique ID to reference the transaction or order" size="30"></td>
            </tr>
            <tr>
                <td colspan="2">
                    @if ($errors->any())
                    <div style="color: red;">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </td>
            </tr>
            <tr>
                <td><input type="submit" value="Submit"></td>
            </tr>
        </table>
    </form>
</body>

</html>