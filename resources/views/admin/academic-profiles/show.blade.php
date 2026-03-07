@extends('layouts.adminn')

@section('title', 'User Academic Profile Review')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">

    <h2 class="text-2xl font-bold mb-6">Academic Profile Review</h2>

    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <p><strong>Student:</strong> {{ $academicProfile->user->name }}</p>
        <p><strong>Institution Type:</strong> {{ $academicProfile->institution_type }}</p>
        <p><strong>Institution:</strong> {{ $academicProfile->institution_name }}</p>
        <p><strong>Student Registration Number:</strong> {{ $academicProfile->student_registration_number }}</p>
        <p><strong>Course:</strong> {{ $academicProfile->course_name }}</p>
        <p><strong>Year/Level:</strong> {{ $academicProfile->level }}</p>
    </div>

   
    <div class="mb-6">
        <strong>ID Document:</strong><br>
        <img src="{{ asset('storage/' . $academicProfile->student_document) }}"
             class="mt-2 w-40 md:w-60 border rounded shadow">
    </div>

   
    <p class="mb-4">
        <strong>Status:</strong>
        <span class="px-2 py-1 rounded
            {{ $academicProfile->status === 'approved' ? 'bg-green-100 text-green-700' :
               ($academicProfile->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
            {{ ucfirst($academicProfile->status) }}
        </span>
    </p>

  
    @if($academicProfile->status === 'pending')
        <div class="flex flex-col md:flex-row gap-4 mb-6">
           
            <form method="POST" action="{{ route('admin.academic-profiles.approve', $academicProfile) }}">
                @csrf
                <button class="bg-green-600 hover:bg-green-500 text-white px-6 py-2 rounded shadow transition">
                    Approve
                </button>
            </form>

           
            <form method="POST" action="{{ route('admin.academic-profiles.reject', $academicProfile) }}" class="flex-1 flex flex-col gap-2">
                @csrf
                <textarea name="rejection_reason" class="border rounded w-full p-2"
                          placeholder="Reason for rejection" required></textarea>
                <button class="bg-red-600 hover:bg-red-500 text-white px-6 py-2 rounded shadow transition w-full md:w-auto">
                    Reject
                </button>
            </form>
        </div>
    @endif

   
    @if ($academicProfile->status === 'rejected' && $academicProfile->rejection_reason)
        <div class="mb-6 p-4 border-l-4 border-red-600 bg-red-50 rounded">
            <strong>Rejection Reason:</strong>
            <p class="text-red-600 mt-1">{{ $academicProfile->rejection_reason }}</p>
        </div>
    @endif

   
    <a href="{{ route('admin.users.show', $academicProfile->user) }}"
       class="inline-block bg-gray-400 hover:bg-gray-300 text-white px-4 py-2 rounded shadow">
        Back to User
    </a>

</div>
@endsection