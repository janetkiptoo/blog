@extends('layouts.adminn')

@section('content')
<h2 class="text-xl font-bold mb-4">Ticket #{{ $ticket->id }}</h2>

<div class="space-y-4 mb-6">
    <div class="bg-gray-100 p-4 rounded">
        <strong>Student:</strong><br>
        {{ $ticket->message }}
    </div>

    @foreach($ticket->replies as $reply)
        <div class="bg-blue-50 p-4 rounded text-right">
            <strong>Admin:</strong><br>
            {{ $reply->message }}
        </div>
    @endforeach
</div>

<form method="POST" action="{{ route('admin.support.reply', $ticket) }}">
    @csrf
    <textarea name="message" class="w-full border rounded p-3" rows="4"
        placeholder="Write your reply..."></textarea>

    <button class="mt-3 bg-blue-600 text-white px-5 py-2 rounded">
        Send Reply
    </button>
</form>

@endsection
