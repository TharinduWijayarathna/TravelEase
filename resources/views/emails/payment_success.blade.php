<!DOCTYPE html>
<html>
<head>
    <title>Payment Successful</title>
</head>
<body>
    <h1>Hello {{ $booking->name }},</h1>
    <p>Your payment for the booking from {{ $booking->pickup_name }} to {{ $booking->dropoff_name }} has been successfully processed.</p>
    <p>Thank you for booking with us!</p>
</body>
</html>
