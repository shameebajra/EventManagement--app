<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ticket Purchase Confirmation</title>
</head>
<body>
    <h1>Thank You for Your Purchase, {{ $purchasedTicket->name }}!</h1>
    <p>We are excited to have you at the event.</p>

    <p><strong>Ticke ID:{{ $purchasedTicket->id}}</strong> </p>

    <h2>Event Details:</h2>
    <p><strong>Event:</strong> {{ $purchasedTicket->ticketTypes->event->event_name }}</p>


    <p><strong>Date:</strong>{{ \Carbon\Carbon::parse($purchasedTicket->ticketTypes->event->date)->format('Y-m-d') }}</p>
    <p><strong>Time:</strong>{{ \Carbon\Carbon::parse($purchasedTicket->ticketTypes->event->time)->format('h:i:s A') }} Onwards</p>

    <p><strong>Quantity:</strong> {{ $purchasedTicket->quantity }}</p>
    <p><strong>Total:</strong> Rs. {{ number_format($purchasedTicket->total, 2) }}</p>

    <h2>Your Contact Information:</h2>
    <p><strong>Email:</strong> {{ $purchasedTicket->email }}</p>
    <p><strong>Phone Number:</strong> {{ $purchasedTicket->phone_number }}</p>

    <p>If you have any questions or need further assistance, feel free to contact our support team.</p>

    <p>Enjoy the event!</p>
</body>
</html>
