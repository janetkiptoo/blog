<!DOCTYPE html>
<html>
<body>
<p>Hello {{ $guarantor->user->name }},</p>

<p>
We are pleased to inform you that your guarantor
<strong>{{ $guarantor->name }}</strong> has been <strong>approved</strong>.
</p>

<p>
You may proceed once all required guarantors are approved.
</p>

<p>
Regards,<br>
Student Loan Support Team
</p>
</body>
</html>
