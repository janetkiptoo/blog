@extends('layouts.adminn')

@section('content')

<table class="w-full border">
    <thead>
        <tr class="bg-gray-100">
            <th>Name</th>
            <th>Email</th>
            <th>Category</th>
            <th>Status</th>
            <th>Created</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tickets as $ticket)
        <tr class="border-t">
            <td>{{ $ticket->name }}</td>
            <td>{{ $ticket->email }}</td>
            <td>{{ $ticket->category }}</td>
            <td>{{ ucfirst($ticket->status) }}</td>
            <td>{{ $ticket->created_at->diffForHumans() }}</td>
        </tr>
        @endforeach
    </tbody>
</table>




@endsection