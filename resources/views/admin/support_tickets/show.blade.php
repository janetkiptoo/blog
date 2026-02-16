@extends('layouts.adminn')

@section('title', 'Reply to Ticket')

@section('content')
<div class="p-6 max-w-4xl mx-auto">

    <a href="{{ route('admin.support-tickets.index') }}"
       class="text-blue-600 text-sm mb-4 inline-block">
        Back to tickets
    </a>

    <h1 class="text-2xl font-bold mb-4">Support Ticket #{{ $ticket->id }}</h1>

    {{-- Ticket Info --}}
    <div class="bg-white shadow rounded p-6 mb-6">
        <p><strong>Name:</strong> {{ $ticket->name }}</p>
        <p><strong>Email:</strong> {{ $ticket->email }}</p>
        <p><strong>Category:</strong> {{ $ticket->category }}</p>
        <p><strong>Status:</strong>
            <span class="px-2 py-1 rounded text-xs
                {{ $ticket->status === 'resolved' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                {{ ucfirst($ticket->status) }}
            </span>
        </p>

        <div class="mt-4">
            <strong>Student Message:</strong>
            <p class="mt-2 text-gray-700">{{ $ticket->message }}</p>
        </div>
    </div>

    {{-- Replies --}}
    <div class="bg-gray-50 shadow rounded p-6 mb-6">
        <h2 class="font-semibold mb-4">Conversation</h2>

        @forelse($ticket->replies as $reply)
            <div class="mb-4">
                <div class="text-sm text-gray-500">
                    {{ $reply->is_admin ? 'Admin' : 'Student' }} •
                    {{ $reply->created_at->diffForHumans() }}
                </div>
                <div class="bg-white border rounded p-3 mt-1">
                    {{ $reply->message }}
                </div>
            </div>
        @empty
            <p class="text-gray-500 text-sm">No replies yet.</p>
        @endforelse
    </div>

    {{-- Reply Form --}}
    <div class="bg-white shadow rounded p-6">
        <h2 class="font-semibold mb-4">Reply to Student</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.support-tickets.reply', $ticket) }}">
            @csrf

            <textarea name="message" rows="4"
                class="w-full border rounded px-4 py-2 mb-4"
                placeholder="Type your reply here..." required></textarea>

            <button type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700">
                Send Reply
            </button>
        </form>
    </div>

</div>
@endsection
