<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<body>
<p>Hello {{ $ticket->name }},</p>

<p>We have responded to your support request:</p>

<hr>

<p><strong>Your Message:</strong></p>
<p>{{ $ticket->message }}</p>

<hr>

<p><strong>Our Reply:</strong></p>
<p>{{ $reply->message }}</p>
<hr>

<p>
If you need further assistance, feel free to reply to this email or
visit your dashboard.
</p>

<p>— Student Loan Support Team</p>
</body>
</html>
