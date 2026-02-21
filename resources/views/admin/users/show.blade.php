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
            <a href="{{ route('admin.users.edit', $user) }}" class="bg-primary-700 hover:bg-primary-500 text-white px-4 py-2 rounded">Edit </a>
            <a href="{{ route('admin.personal-profiles.show', $user->personalProfile) }}">Personal Profile</a>
            <a href="{{ route('admin.academic-profiles.show', $user->academicProfile) }}">Academic Profile</a>
            <a href="{{ route('admin.guarantors.index', $user) }}" class="bg-primary-700 hover:bg-primary-500 text-white px-4 py-2 rounded">Guarantors </a>
            <a href="{{ route('admin.loans', $user) }}" class="bg-primary-700 hover:bg-primary-500 text-white px-4 py-2 rounded">loans </a>
            <a href="{{ route('admin.repayments.show', $user) }}" class="bg-primary-700 hover:bg-primary-500 text-white px-4 py-2 rounded">Repayments </a>

            <form method="POST" action="{{ route('admin.users.destroy', $user) }}">
                @csrf
                @method('DELETE')
                <button onclick="openModal({{ $user->id }})" class="mt-2 px-3 py-1 text-sm bg-red-100 text-red-600 rounded hover:bg-red-200">
                    Delete
                </button>
            </form>

<div id="removeModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-lg p-6 max-w-sm w-full mx-4">
        <h3 class="text-lg font-semibold text-black mb-2">Delete User</h3>
        <p class="text-sm text-black mb-6">Are you sure you want to delete this user? This action cannot be undone.</p>
        <div class="flex justify-end gap-3">
            <button onclick="closeModal()" class="px-4 py-2 text-sm rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50">
                Cancel
            </button>
            <form id="removeForm" method="POST">
               
                <button type="submit" class="px-4 py-2 text-sm rounded-lg bg-red-500 text-white hover:bg-red-600">
                    Yes, Remove
                </button>
            
        </div>
    </div>
</div>

<script>
    function openModal(userId) {
        const form = document.getElementById('removeForm');
        form.action = `/admin/users/${userId}`;
        const modal = document.getElementById('removeModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal() {
        const modal = document.getElementById('removeModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    
    document.getElementById('removeModal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });
</script>

            <a href="{{ route('admin.users.index') }}"
               class="bg-gray-400 text-white px-4 py-2 rounded">
                Back
            </a>
        </div>
    </div>
    

</div>
@endsection
