<!DOCTYPE html>
<html>
<body>
    <p>Hello {{ $profile->user->name }},</p>

    <p>Your personal profile was <strong>rejected</strong>.</p>

    <p><strong>Reason:</strong></p>
    <p>{{ $profile->rejection_reason }}</p>

    <p>Please log in, correct the information, and resubmit.</p>

    <p>Support Team</p>
</body>
</html>
