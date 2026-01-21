@extends('layouts.adminn')

@section('title', 'Edit User')

@section('content')
<div class="max-w-3xl mx-auto py-6">

    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-6">Edit User</h2>

        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-semibold">Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block font-semibold">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block font-semibold">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block font-semibold">Student ID</label>
                <input type="text" value="{{ $user->student_id }}" disabled class="w-full border p-2 rounded bg-gray-100">
            </div>

            <div>
                <label class="block font-semibold">Role</label>
                <select name="role" class="w-full border p-2 rounded">
                    <option value="student" @selected($user->role === 'student')>
                        Student
                    </option>
                    <option value="admin" @selected($user->role === 'admin')>
                        Admin
                    </option>
                </select>
            </div>

            <div class="flex gap-4 mt-6">
                <button class="bg-blue-600 text-white px-4 py-2 rounded">
                    Update User
                </button>

                <a href="{{ route('admin.users.show', $user) }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded">
                    Cancel
                </a>
            </div>
        </form>
    </div>

</div>
@endsection
