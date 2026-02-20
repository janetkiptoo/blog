@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">

    <h1 class="text-3xl font-bold mb-6 text-center">Student Dashboard</h1>


    <div class="mb-6 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-semibold mb-4">
            Welcome, {{ Auth::user()->name }}
        </h2>

        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        <p><strong>Institution:</strong> {{ Auth::user()->institution_name}}</p>
        <p><strong>Course:</strong> {{ Auth::user()->course_name }}</p>
        <p><strong>Level:</strong> {{ Auth::user()->level }}</p>
        <p><strong>Student Reg No:</strong> {{ Auth::user()->student_registration_number }}</p>
    </div>



   <div class="bg-white p-5 rounded shadow mb-6">
    <h2 class="text-xl font-bold mb-2">Academic Profile</h2>    
    @if($academicProfile)
        <div class="mb-4 p-4 rounded
            {{ $academicProfile->status === 'rejected' ? 'bg-red-100 text-red-700' :
               ($academicProfile->status === 'approved' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700') }}">

            <p><strong>Status:</strong> {{ ucfirst($academicProfile->status) }}</p>

            @if($academicProfile->status === 'approved')
                <p class="mt-2"> Your academic profile has been verified.</p>
            @elseif($academicProfile->status === 'rejected')
                <p class="mt-2"><strong>Reason:</strong> {{ $academicProfile->rejection_reason }}</p>
                <a href="{{ route('student.academic.edit') }}" class="inline-block mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Update Profile
                </a>
            @else
                <p class="mt-2">Your profile is currently under review.</p>
            @endif
        </div>

        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <p class="text-gray-600">Institution</p>
                <p class="font-semibold">{{ $academicProfile->institution_name }}</p>
            </div>
            <div>
                <p class="text-gray-600">Course</p>
                <p class="font-semibold">{{ $academicProfile->course }}</p>
            </div>
            <div>
                <p class="text-gray-600">Level of Study</p>
                <p class="font-semibold">{{ ucfirst($academicProfile->level_of_study) }}</p>
            </div>
            <div>
                <p class="text-gray-600">Year of Study</p>
                <p class="font-semibold">Year {{ $academicProfile->year_of_study }}</p>
            </div>
        </div>
    @else
        <p class="text-gray-600 mb-4">You haven't submitted your academic profile yet.</p>
        <a href="{{ route('student.academic.create') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Complete Academic Profile
        </a>
    @endif
</div>
<div class="bg-white p-5 rounded shadow mb-6">
    <h2 class="text-xl font-bold mb-2">Personal Profile</h2>    
    @if($personalProfile)
        <div class="mb-4 p-4 rounded
            {{ $personalProfile->status === 'rejected' ? 'bg-red-100 text-red-700' :
               ($personalProfile->status === 'approved' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700') }}">

            <p><strong>Status:</strong> {{ ucfirst($personalProfile->status) }}</p>

            @if($personalProfile->status === 'approved')
                <p class="mt-2">✓ Your personal profile has been verified.</p>
            @elseif($personalProfile->status === 'rejected')
                <p class="mt-2"><strong>Reason:</strong> {{ $personalProfile->rejection_reason }}</p>
                <a href="{{ route('student.profile.edit') }}" class="inline-block mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Update Profile
                </a>
            @else
                <p class="mt-2">Your profile is currently under review.</p>
            @endif
        </div>

        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <p class="text-gray-600">Gender</p>
                <p class="font-semibold">{{ ucfirst($personalProfile->gender) }}</p>
            </div>
            <div>
                <p class="text-gray-600">Nationality</p>
                <p class="font-semibold">{{ $personalProfile->nationality }}</p>
            </div>
            <div>
                <p class="text-gray-600">ID Type</p>
                <p class="font-semibold">{{ str_replace('_', ' ', ucfirst($personalProfile->government_id_type)) }}</p>
            </div>
            <div>
                <p class="text-gray-600">Date of Birth</p>
                <p class="font-semibold">{{ \Carbon\Carbon::parse($personalProfile->date_of_birth)->format('M d, Y') }}</p>
            </div>
        </div>
    @else
        <p class="text-gray-600 mb-4">You haven't submitted your personal profile yet.</p>
        <a href="{{ route('student.profile.edit') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Complete Personal Profile
        </a>
    @endif
</div>


<div class="bg-white p-5 rounded shadow mb-6">
    <h2 class="text-xl font-bold mb-3">Guarantors</h2>

    @foreach($guarantors as $guarantor)
        <div class="border p-3 rounded mb-3">
            <p><strong>Name:</strong> {{ $guarantor->name }}</p>
            <p><strong>Relationship:</strong> {{ ucfirst($guarantor->relationship) }}</p>

            <p>Status:
                <span class="
                    {{ $guarantor->status === 'approved' ? 'text-green-600' :
                       ($guarantor->status === 'rejected' ? 'text-red-600' : 'text-yellow-600') }}">
                    {{ ucfirst($guarantor->status) }}
                </span>
            </p>

            @if($guarantor->status === 'rejected')
                <p class="text-red-600 mt-1">
                    <strong>Reason:</strong> {{ $guarantor->rejection_reason }}
                </p>
            @endif
        </div>
    @endforeach

    @if($approvedGuarantorsCount < 2)
        <a href="{{ route('student.profile.guarantors.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded">
            Add / Replace Guarantor
        </a>
    @endif
</div>

@if($loanEligible)
    
       class="bg-green-600 text-white px-6 py-3 rounded text-lg">
        Apply for Loan
    </a>
@else
    <div class="bg-yellow-100 text-yellow-800 p-4 rounded">
        Complete and get approval for:
        <ul class="list-disc ml-5 mt-2">
            @if(optional($personalProfile)->status !== 'approved')
                <li>Personal Profile</li>
            @endif
            @if(optional($academicProfile)->status !== 'approved')
                <li>Academic Profile</li>
            @endif
            @if($approvedGuarantorsCount < 2)
                <li>Two Approved Guarantors</li>
            @endif
        </ul>
    </div>
@endif



    


    @if($loan)
        <div class="mb-6 p-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-2xl font-semibold mb-2">Latest Loan Summary</h2>

            <p>
                <strong>Product:</strong>
                {{ $loan->loanProduct->product_name ?? '-' }}
            </p>

            <p>
                <strong>Balance:</strong>
                KES {{ number_format($loan->balance ?? $loan->loan_amount, 2) }}
            </p>

            <p>
                <strong>Status:</strong>
                {{ ucfirst($loan->status) }}
            </p>

            <a href="{{ route('student.loans.index') }}"
               class="mt-4 inline-block bg-primary-700 hover:bg-primary-500 text-white px-6 py-2 rounded">
                View All Loans
            </a>
        </div>

    @else
        <div class="mb-6 p-6 bg-yellow-100 text-yellow-800 shadow-lg rounded-lg">
            You have no active loans. Apply for a loan to get started.
        </div>
    @endif




</div>
@if (session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif


@endsection
