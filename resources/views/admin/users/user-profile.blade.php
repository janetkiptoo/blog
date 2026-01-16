@extends('layouts.adminn')

@section('title', 'Users Management')

@section('content')
<div class="max-w-7xl mx-auto py-6 grid grid-cols-3 gap-6">

    {{-- USERS TABLE --}}
    <div class="col-span-2 bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Users</h2>

        <table class="w-full border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2">Name</th>
                    <th class="p-2">Email</th>
                    <th class="p-2">Role</th>
                    <th class="p-2">Action</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="border-t">
                    <td class="p-2">{{ $user->name }}</td>
                    <td class="p-2">{{ $user->email }}</td>
                    <td class="p-2">{{ $user->role }}</td>
                    <td class="p-2">
                        <a href="{{ route('admin.users.show', $user) }}"
                           class="text-blue-600 underline">
                            View
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    

</div>
@endsection
