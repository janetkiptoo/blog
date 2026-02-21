@extends('layouts.adminn')

@section('title', 'Add User')

@section('content')
<div class="max-w-xl mx-auto py-6 bg-white p-6 rounded shadow">

    <h2 class="text-xl font-semibold mb-4">Add New User</h2>

    <form method="POST" action="{{ route('admin.users.store') }}"  enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block font-medium">Name</label>
            <input type="text" name="name" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Email</label>
            <input type="email" name="email" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Password</label>
            <input type="password" name="password" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Role</label>
            <select name="role" class="w-full border rounded p-2">
                <option value="student">Student</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        
         <div class="mb-4">
            <label class="block font-medium">phone</label>
            <input type="phone" name="phone" class="w-full border rounded p-2" required>
        </div>

        

        <button class="bg-primary-700 hover:bg-primary-500 text-white px-4 py-2 rounded"> Create User</button>
    </form>

</div>
@endsection
