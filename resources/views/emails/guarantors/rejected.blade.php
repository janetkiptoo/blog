<!DOCTYPE html>
<html>
<body>
<p>Hello {{ $guarantor->user->name }},</p>

<p>
Your guarantor <strong>{{ $guarantor->name }}</strong> was <strong>rejected</strong>.
</p>

<p><strong>Reason:</strong></p>
<p>{{ $guarantor->rejection_reason }}</p>

<p>
Please update the guarantor details or submit a new guarantor.
</p>

<p>
Regards,<br>
Student Loan Support Team
</p>
</body>
</html>
