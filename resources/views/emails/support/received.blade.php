<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Support Request Received</title>
</head>
<body>
    <p>Hello {{ $ticket->name }},</p>

    <p>We have received your support request. Here are the details you submitted:</p>

    <ul>
        <li><strong>Category:</strong> {{ $ticket->category }}</li>
        <li><strong>Message:</strong> {{ $ticket->message }}</li>
    </ul>

    <p>Our team will review your inquiry and get back to you as soon as possible.</p>

    <p>Thank you,<br>
    Student Loan Support Team</p>
</body>
</html>
