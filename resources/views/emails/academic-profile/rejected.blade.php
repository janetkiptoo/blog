<p>Hello {{ $profile->user->name }},</p>

<p>Your academic profile was <strong>rejected</strong>.</p>

<p><strong>Reason:</strong></p>
<p>{{ $profile->rejection_reason }}</p>

<p>Please correct the details and resubmit.</p>
