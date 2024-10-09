<!DOCTYPE html>
<html>

<head>
    <title>Payment Failed</title>
</head>

<body>
    <h1>Hello {{ $booking->name }},</h1>
    <p>Your payment for the booking from {{ $booking->pickup_name }} to {{ $booking->dropoff_name }} has failed.</p>
    <p>Please try again to complete the payment process.</p>
</body>

</html>
