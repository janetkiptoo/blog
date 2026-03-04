@extends('layouts.adminn')

@section('content')


<h2 class="font-bold mb-2">Unread</h2>
@foreach(auth()->user()->unreadNotifications as $notification)
    <a href="{{ route('admin.notifications.read', $notification->id) }}"
       class="block border-b p-3 hover:bg-gray-100">

        <strong>New Loan Application</strong><br>

        Student: {{ $notification->data['student'] ?? 'N/A' }}<br>

        Amount: KES {{ number_format($notification->data['amount'] ?? 0, 2) }}

        <div class="text-sm text-gray-500">
            {{ $notification->created_at->diffForHumans() }}
        </div>

    </a>
@endforeach

<h2 class="font-bold mt-6 mb-2">Read</h2>
@foreach(auth()->user()->readNotifications as $notification)
    <div class="border-b p-3 bg-gray-50">
        {{ $notification->data['student'] ?? '' }}
    </div>
@endforeach

@endsection