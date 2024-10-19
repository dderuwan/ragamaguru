<!DOCTYPE html>
<html>
<head>
    <title>Payment Success</title>
</head>
<body>
    <h1>Payment Successful!</h1>
    <p>Transaction ID: {{ $data['trId'] }}</p>
    <p>Merchant Reference ID: {{ $data['merchantRID'] }}</p>
    <p>Order Amount: {{ $data['order']['amount'] }}</p>
</body>
</html>
