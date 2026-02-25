@extends('layouts.adminn')

@section('title', 'User Guarantors')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
<h2 class="text-2xl font-bold mb-4">Academic Profile Review</h2>

<div class="grid grid-cols-2 gap-6">
<p><strong>Student:</strong> {{ $academicProfile->user->name }}</p>
<p><strong>Institution Type:</strong> {{ $academicProfile->institution_type}}</p>
<p><strong>Institution:</strong> {{ $academicProfile->institution_name }}</p>
<p><strong>StudentRegistration Number:</strong> {{ $academicProfile->student_registration_number }}</p>
<p><strong>Course:</strong> {{ $academicProfile->course_name }}</p>
<p><strong>Year:</strong> {{ $academicProfile->level }}</p>
<div>


 <div class="mt-6">
        <strong>ID Document:</strong><br>
        <img src="{{ asset('storage/'.$academicProfile->student_document) }}"
             class="mt-2 w-40 border rounded">
    </div>

<p class="mt-4">
    <strong>Status:</strong>
    <span class="px-2 py-1 rounded
        {{ $academicProfile->status === 'approved' ? 'bg-green-100 text-green-700' :
           ($academicProfile->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
        {{ ucfirst($academicProfile->status) }}
    </span>
</p>

@if($academicProfile->status === 'pending')
<div class="mt-6 flex gap-4">
    <form method="POST"
          action="{{ route('admin.academic-profiles.approve', $academicProfile) }}">
        @csrf
        <button class="bg-green-600 text-white px-4 py-2 rounded">
            Approve
        </button>
    </form>
</div>
<div class="mt-6 flex gap-4">
    <form method="POST"
          action="{{ route('admin.academic-profiles.reject', $academicProfile) }}">
        @csrf
        <textarea name="rejection_reason"class="border rounded w-full p-2 mb-2"
                  placeholder="Reason for rejection"></textarea>

        <button class="bg-red-600 text-white px-4 py-2 rounded-full">
            Reject
        </button>
    </form>
</div>
@endif

 @if ($academicProfile->status === 'rejected')
        <div class="mt-4 "><strong>Rejection Reason:</strong>
            <p class="text-red-600">{{ $academicProfile->rejection_reason }}</p>
        </div>
    @endif


    
@endsection
