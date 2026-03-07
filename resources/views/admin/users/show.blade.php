@extends('layouts.adminn')

@section('title', 'View User')

@section('content')
<div class="py-6">

    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-6">User Details</h2>

        
        <div class="grid grid-cols-2 gap-4">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Phone:</strong> {{ $user->phone ?? 'N/A' }}</p>
            <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
           
        </div>


        <div class="mt-6 flex gap-4">
            <a href="{{ route('admin.users.edit', $user) }}" 
               class="bg-primary-700 hover:bg-primary-500 text-white px-4 py-2 rounded">
                Edit
            </a>

            @if($user->personalProfile)
                <a href="{{ route('admin.personal-profiles.show', $user->personalProfile) }}" 
                   class="bg-primary-700 hover:bg-primary-500 text-white px-4 py-2 rounded">
                    Personal Profile
                </a>
            @endif

            @if($user->academicProfile)
                <a href="{{ route('admin.academic-profiles.show', $user->academicProfile) }}" 
                   class="bg-primary-700 hover:bg-primary-500 text-white px-4 py-2 rounded">
                    Academic Profile
                </a>
            @endif

            <button type="button" onclick="openModal({{ $user->id }})" 
                    class="bg-red-700 hover:bg-red-500 text-white px-4 py-2 rounded">
                Delete
            </button>

            <a href="{{ route('admin.users.index') }}"
               class="bg-gray-400 text-white px-4 py-2 rounded">
                Back
            </a>
        </div>

        
        @php
            $loans = $user->loans ?? collect();
            $repayments = $user->repayments ?? collect();
        @endphp

        @if($loans->isNotEmpty() || $repayments->isNotEmpty())
            <h3 class="text-xl font-semibold mt-6 mb-3">Loan Summary</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                <div class="bg-blue-50 p-4 rounded shadow">
                    <p>Total Applications:</p>
                    <p class="font-bold">{{ $loans->count() }}</p>
                </div>

                <div class="bg-green-50 p-4 rounded shadow">
                    <p>Approved:</p>
                    <p class="font-bold">{{ $loans->where('status', 'approved')->count() }}</p>
                </div>

                <div class="bg-yellow-50 p-4 rounded shadow">
                    <p>Pending:</p>
                    <p class="font-bold">{{ $loans->where('status', 'pending')->count() }}</p>
                </div>

                <div class="bg-red-50 p-4 rounded shadow">
                    <p>Rejected:</p>
                    <p class="font-bold">{{ $loans->where('status', 'rejected')->count() }}</p>
                </div>

                <div class="bg-indigo-50 p-4 rounded shadow">
                    <p>Total Applied Amount:</p>
                    <p class="font-bold">KES: {{ number_format($loans->sum('loan_amount'), 2) }}</p>
                </div>

                <div class="bg-indigo-100 p-4 rounded shadow">
                    <p>Total Approved Amount:</p>
                    <p class="font-bold">KES: {{ number_format($loans->where('status', 'approved')->sum('loan_amount'), 2) }}</p>
                </div>

                <div class="bg-green-100 p-4 rounded shadow">
                    <p>Total Repaid Amount:</p>
                    <p class="font-bold">KES: {{ number_format($repayments->sum('amount'), 2) }}</p>
                </div>
            </div>
        @endif
    </div>

</div>

<div id="removeModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-lg p-6 max-w-sm w-full mx-4">
        <h3 class="text-lg font-semibold text-black mb-2">Delete User</h3>
        <p class="text-sm text-black mb-6">Are you sure you want to delete this user? This action cannot be undone.</p>
        <div class="flex justify-end gap-3">
            <button type="button" onclick="closeModal()" 
                    class="px-4 py-2 text-sm rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50">
                Cancel
            </button>
            <form id="removeForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 text-sm rounded-lg bg-red-500 text-white hover:bg-red-600">
                    Yes, Remove
                </button>
            </form>
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

@endsection