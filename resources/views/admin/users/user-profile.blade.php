@extends('layouts.adminn')

@section('title', 'Users Management')

@section('content')
    <div class=" py-6 grid  gap-6">
    <div class="flex justify-between items-center mb-4">
    <h2 class="text-xl font-semibold">Users</h2>
     <a href="{{ route('admin.users.create') }}"class="bg-primary-700 hover:bg-primary-500 text-white px-4 py-2 rounded"> + Add User </a>
    </div>

    <div class=" bg-white p-6 rounded shadow">
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
                    <a href="{{ route('admin.users.show', $user) }}"class="text-white px-4 py-2 rounded bg-primary-700 hover:bg-primary-500">View</a> </td>
                </tr>
                @endforeach
            </tbody>
        </table>

</div>

@endsection
