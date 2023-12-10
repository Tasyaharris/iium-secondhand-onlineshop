<!-- resources/views/emails/order_confirmation.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body>
    <h2>Order Confirmation</h2>

    <p>Dear User</p>

    <p>You have new order</p>

    <ul>
        <li>Order ID: {{ $order->id }}</li>
        <!-- Add more order details as needed -->
    </ul>

    <p>Please proceess your order</p>

    <p>Best regards,<br>IIUM Second-Hand Online Shop</p>
</body>
</html>
