@extends('layouts.adminn')

@section('title', 'Users Management')

@section('content')
<div class="py-6 grid gap-6">

   
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-semibold text-gray-800">Users</h2>
        <a href="{{ route('admin.users.create') }}"
           class="bg-primary-700 hover:bg-primary-600 transition text-white px-4 py-2 rounded-lg shadow">
            + Add User
        </a>
    </div>

  
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full text-sm text-left text-gray-700">
            <thead class="bg-gray-100 text-black uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">Name</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Role</th>
                    <th class="px-6 py-3 text-center">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @foreach($users as $user)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-medium text-black">
                        {{ $user->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $user->email }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1  text-xs font-semibold
                            {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <a href="{{ route('admin.users.show', $user) }}"
                           class="inline-block bg-primary-700 hover:bg-primary-600 transition text-white px-4 py-2 rounded-md text-xs font-semibold">
                            View
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
