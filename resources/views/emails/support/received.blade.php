@extends('layouts.app')

@section('content')

{{-- resources/views/emails/support/received.blade.php --}}
<p>Hello {{ $ticket->name }},</p>

<p>
    Thank you for contacting Student Loan Support.
    We have received your request and our team will review it shortly.
</p>

<p>
    <strong>Ticket Reference:</strong> #{{ $ticket->id }} <br>
    <strong>Category:</strong> {{ $ticket->category }}
</p>

<p>
    Our typical response time is within <strong>24–48 business hours</strong>.
</p>

<p>
    Please do not reply to this email with sensitive personal or financial information.
</p>

<p>
    Regards,<br>
    Student Loan Support Team
</p>

@endsection