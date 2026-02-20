<!DOCTYPE html>
<html>
<body>

<p>Hello Admin,</p>

<p>A student has removed one of their guarantors.</p>

<hr>

<p><strong>Student Name:</strong> {{ $guarantor->user->name }}</p>
<p><strong>Student Email:</strong> {{ $guarantor->user->email }}</p>

<p><strong>Guarantor Name:</strong> {{ $guarantor->name }}</p>
<p><strong>Relationship:</strong> {{ ucfirst($guarantor->relationship) }}</p>

<p><strong>Removed At:</strong> {{ now()->toDayDateTimeString() }}</p>

<hr>

<p>This guarantor has been soft-deleted and can be restored by an admin if necessary.</p>

<p>— Student Loan System</p>

</body>
</html>