@extends('layouts.adminn')

@section('title', 'Users Management')

@section('content')
<div class="py-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <h2 class="text-2xl font-semibold text-gray-800">Users</h2>
        <a href="{{ route('admin.users.create') }}"
           class="bg-primary-700 hover:bg-primary-600 text-white px-4 py-2 rounded-lg shadow">
            + Add User
        </a>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="w-full min-w-[640px] text-sm text-left text-gray-700">
            <thead class="bg-gray-100 text-black uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">Name</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Role</th>
                    <th class="px-6 py-3">Profiles</th>
                    <th class="px-6 py-3 text-center">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @foreach($users as $user)
                <tr class="hover:bg-gray-50 transition">
                    <!-- Name -->
                    <td class="px-6 py-4 font-medium text-black">{{ $user->name }}</td>

                    <!-- Email -->
                    <td class="px-6 py-4">{{ $user->email }}</td>

                    <!-- Role -->
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-xs font-semibold rounded
                            {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>

                    <!-- Profiles -->
                    <td class="px-6 py-4 flex flex-wrap gap-2">
                        @if($user->role === 'student')
                            <span class="px-2 py-1 text-xs rounded {{ $user->personalProfile ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                Personal
                            </span>
                            <span class="px-2 py-1 text-xs rounded {{ $user->academicProfile ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                Academic
                            </span>
                        @else
                            <span class="px-2 py-1 text-xs rounded bg-gray-200 text-gray-600">N/A</span>
                        @endif
                    </td>

                    <!-- Actions -->
                    <td class="px-6 py-4 text-center">
                        <div class="inline-flex gap-2 justify-center">
                            <a href="{{ route('admin.users.show', $user) }}"
                               class="bg-primary-700 hover:bg-primary-600 text-white px-3 py-1 rounded text-xs">View</a>
                            <a href="{{ route('admin.users.edit', $user) }}"
                               class="bg-yellow-500 hover:bg-yellow-400 text-white px-3 py-1 rounded text-xs">Edit</a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-600 hover:bg-red-500 text-white px-3 py-1 rounded text-xs">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Optional: Pagination -->
    <div class="mt-4">
       
    </div>
</div>
@endsection