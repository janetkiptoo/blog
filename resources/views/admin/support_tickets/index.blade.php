@extends('layouts.adminn')

@section('title', 'Support Tickets')

@section('content')
<div class="p-6">

    <h1 class="text-2xl font-bold mb-6">Support Tickets</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow rounded">
        <table class="w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Ticket ID</th>
                    <th class="p-3 text-left">Name</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Category</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Created</th>
                    <th class="p-3 text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($tickets as $ticket)
                    <tr class="border-t">
                        <td class="p-3">{{ $ticket->id }}</td>
                        <td class="p-3">{{ $ticket->name }}</td>
                        <td class="p-3">{{ $ticket->email }}</td>
                        <td class="p-3">{{ $ticket->category }}</td>
                        <td class="p-3">
                            <span class="px-2 py-1 rounded text-xs
                                {{ $ticket->status === 'resolved' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ ucfirst($ticket->status) }}
                            </span>
                        </td>
                        <td class="p-3">{{ $ticket->created_at->diffForHumans() }}</td>
                        <td class="p-3 text-center">
                            <a href="{{ route('admin.support-tickets.show', $ticket) }}"
                               class="bg-blue-600 text-white px-4 py-1 rounded text-xs hover:bg-blue-700">
                                View & Reply
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-6 text-center text-gray-500">
                            No support tickets found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
