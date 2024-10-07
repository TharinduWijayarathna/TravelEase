<!DOCTYPE html>
<html>
<head>
    <title>Booking Payment Pending</title>
</head>
<body>
    <h1>{{ $booking->name }},</h1>
    <p>Your booking for {{ $booking->pickup_name }} to {{ $booking->dropoff_name }} is now set to <strong>Payment Pending</strong>.</p>
</body>
</html>
