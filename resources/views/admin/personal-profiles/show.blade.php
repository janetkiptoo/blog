@extends('layouts.adminn')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">

    <h1 class="text-2xl font-bold mb-6">Personal Profile Review</h1>

    <div class="grid grid-cols-2 gap-6 text-sm">
        <p><strong>Name:</strong> {{ $personalProfile->user->name }}</p>
        <p><strong>Gender:</strong> {{ $personalProfile->gender }}</p>
        <p><strong>Nationality:</strong> {{ $personalProfile->nationality }}</p>
        <p><strong>Date of Birth:</strong> {{ $personalProfile->date_of_birth }}</p>
        <p><strong>ID Type:</strong> {{ $personalProfile->government_id_type }}</p>
        <p><strong>ID Number:</strong> {{ $personalProfile->government_id_number }}</p>
        <p class="col-span-2">
            <strong>Address:</strong> {{ $personalProfile->address }}
        </p>
    </div>

    <div class="mt-6">
        <strong>ID Document:</strong><br>
        <img src="{{ asset('storage/'.$personalProfile->id_image) }}"
             class="mt-2 w-40 border rounded">
    </div>

    <div class="mt-6">
        <strong>Status:</strong>
        <span class="px-3 py-1 rounded text-sm
            {{ $personalProfile->status === 'approved' ? 'bg-green-100 text-green-700' :
               ($personalProfile->status === 'rejected' ? 'bg-red-100 text-red-700' :
               'bg-yellow-100 text-yellow-700') }}">
            {{ ucfirst($personalProfile->status) }}
        </span>
    </div>

    @if ($personalProfile->status === 'pending')
        <div class="mt-6 flex gap-4">
            <form method="POST" action="{{ route('admin.personal-profiles.approve', $personalProfile) }}">
                @csrf
                <button class="bg-green-600 text-white px-4 py-2 rounded">
                    Approve
                </button>
            </form>

            <form method="POST" action="{{ route('admin.personal-profiles.reject', $personalProfile) }}">
                @csrf
                <textarea name="rejection_reason"
                          class="border p-2 rounded w-64"
                          placeholder="Reason for rejection" required></textarea>

                <button class="bg-red-600 text-white px-4 py-2 rounded mt-2">
                    Reject
                </button>
            </form>
        </div>
    @endif

    @if ($personalProfile->status === 'rejected')
        <div class="mt-4 text-red-600">
            <strong>Rejection Reason:</strong>
            <p>{{ $personalProfile->rejection_reason }}</p>
        </div>
    @endif

</div>
@endsection
