@extends('layouts.adminn')

@section('content')

<div class="max-w-4xl mx-auto space-y-8">

    <div>
        <h1 class="text-2xl font-bold text-gray-800">Notifications</h1>
        <p class="text-gray-500 text-sm">Manage and review system activity</p>
    </div>


   
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        
        <div class="p-4 border-b">
            <h2 class="font-semibold text-gray-700">
                Unread ({{ auth()->user()->unreadNotifications->count() }})
            </h2>
        </div>

        @forelse(auth()->user()->unreadNotifications as $notification)

            <a href="{{ route('admin.notifications.read', $notification->id) }}"
               class="flex items-start gap-4 p-4 border-b hover:bg-gray-50 transition duration-150">

                
                <div class="mt-1">
                    @if($notification->data['type'] === 'support_ticket')
                        <div class="bg-blue-100 text-blue-600 p-2 rounded-full">
                            <p>New Message</p>
                        </div>
                    @elseif($notification->data['type'] === 'loan_application')
                        <div class="bg-green-100 text-green-600 p-2 rounded-full">
                               <p>New Loan Application</p>
                        </div>
                    @endif
                </div>

                
                <div class="flex-1">

                    @if($notification->data['type'] === 'support_ticket')

                        <p class="font-semibold text-gray-800">
                            New Support Ticket
                        </p>

                        <p class="text-sm text-gray-600">
                            <span class="font-medium">
                                {{ $notification->data['student'] }}
                            </span>
                            submitted a ticket: 
                            "{{ $notification->data['subject'] }}"
                        </p>

                    @elseif($notification->data['type'] === 'loan_application')

                        <p class="font-semibold text-gray-800">
                            New Loan Application
                        </p>

                        <p class="text-sm text-gray-600">
                            <span class="font-medium">
                                {{ $notification->data['student'] }}
                            </span>
                            applied for 
                            <span class="font-medium text-green-600">
                                KES {{ number_format($notification->data['amount'], 2) }}
                            </span>
                        </p>

                    @endif

                    <p class="text-xs text-gray-400 mt-1">
                        {{ $notification->created_at->diffForHumans() }}
                    </p>
                </div>

                
                <div class="w-2 h-2 bg-blue-500 rounded-full mt-3"></div>

            </a>

        @empty
            <div class="p-6 text-center text-gray-500">
                No unread notifications 
            </div>
        @endforelse
    </div>


  
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        
        <div class="p-4 border-b">
            <h2 class="font-semibold text-gray-700">
                Read Notifications
            </h2>
        </div>

        @forelse(auth()->user()->readNotifications as $notification)

            <div class="p-4 border-b bg-gray-50 text-sm text-gray-600">
                {{ $notification->data['student'] ?? 'Notification' }}
                <div class="text-xs text-gray-400 mt-1">
                    {{ $notification->created_at->diffForHumans() }}
                </div>
            </div>

        @empty
            <div class="p-6 text-center text-gray-500">
                No read notifications
            </div>
        @endforelse
    </div>

</div>

@endsection