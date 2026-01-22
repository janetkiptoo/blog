@extends('layouts.adminn')

@section('title', 'View User')

@section('content')
<div class="py-6">

    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-6">User Details</h2>

        <div class="grid grid-cols-2 gap-4">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Phone:</strong> {{ $user->phone }}</p>
            <p><strong>Nationa_id:</strong> {{ $user->national_id }}</p>
            <p><strong>Role:</strong> {{ $user->role }}</p>
            <p><strong>Created At:</strong> {{ $user->created_at }}</p>
           

        </div>

        <div class="mt-6 flex gap-4">
            <a href="{{ route('admin.users.edit', $user) }}" class="bg-blue-600 text-white px-4 py-2 rounded">Edit
            </a>

            <form method="POST" action="{{ route('admin.users.destroy', $user) }}">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Delete this user?')"
                        class="bg-red-600 text-white px-4 py-2 rounded">
                    Delete
                </button>
            </form>

            <a href="{{ route('admin.users.index') }}"
               class="bg-gray-400 text-white px-4 py-2 rounded">
                Back
            </a>
        </div>
    </div>

</div>
@endsection
