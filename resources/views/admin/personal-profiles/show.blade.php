@extends('layouts.adminn')

@section('title', 'Personal Profile Review')

@section('content')
<div class="max-w-4xl mx-auto py-8">

    <div class="bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-6">Personal Profile Review</h1>

       
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <p><strong>Name:</strong> {{ $personalProfile->user->name }}</p>
            <p><strong>Gender:</strong> {{ $personalProfile->gender }}</p>
            <p><strong>Nationality:</strong> {{ $personalProfile->nationality }}</p>
            <p><strong>Date of Birth:</strong> {{ $personalProfile->date_of_birth }}</p>
            <p><strong>ID Type:</strong> {{ $personalProfile->government_id_type }}</p>
            <p><strong>ID Number:</strong> {{ $personalProfile->government_id_number }}</p>
            <p class="col-span-2"><strong>Address:</strong> {{ $personalProfile->address }}</p>
        </div>

        
        <div class="mt-4">
            <strong>ID Document:</strong><br>
            <img src="{{ asset('storage/' . $personalProfile->id_image) }}" 
                 class="mt-2 w-40 border rounded">
        </div>

       
        <div class="mt-4">
            <strong>Status:</strong>
            <span class="px-3 py-1 rounded text-sm
                {{ $personalProfile->status === 'approved' ? 'bg-green-100 text-green-700' :
                   ($personalProfile->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                {{ ucfirst($personalProfile->status) }}
            </span>
        </div>

        
        @if($personalProfile->status === 'pending')
            <div class="mt-6 flex flex-col sm:flex-row gap-4">
                <form method="POST" action="{{ route('admin.personal-profiles.approve', $personalProfile) }}">
                    @csrf
                    <button class="bg-green-600 text-white px-4 py-2 rounded w-full sm:w-auto">
                        Approve
                    </button>
                </form>

                <form method="POST" action="{{ route('admin.personal-profiles.reject', $personalProfile) }}" class="flex-1">
                    @csrf
                    <textarea name="rejection_reason" class="border p-2 rounded w-full mb-2"
                              placeholder="Reason for rejection" required></textarea>
                    <button class="bg-red-600 text-white px-4 py-2 rounded w-full sm:w-auto">
                        Reject
                    </button>
                </form>
            </div>
        @endif

       
        @if($personalProfile->status === 'rejected' && $personalProfile->rejection_reason)
            <div class="mt-4 text-red-600">
                <strong>Rejection Reason:</strong>
                <p>{{ $personalProfile->rejection_reason }}</p>
            </div>
        @endif

     
        <div class="mt-6">
            <a href="{{ route('admin.users.show', $personalProfile->user) }}"
               class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">
                Back to User
            </a>
        </div>
    </div>

</div>
@endsection