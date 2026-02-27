@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">

    <h1 class="text-3xl font-bold mb-6 text-center">Student Dashboard</h1>


    <div class="mb-6 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-semibold mb-4">
            Welcome, {{ Auth::user()->name }}
        </h2>

        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        <p><strong>Institution:</strong> {{Auth::user()->academicProfile->institution_name}}</p>
        <p><strong>Course:</strong> {{ Auth::user()->academicProfile->course_name }}</p>
        <p><strong>Level:</strong> {{ Auth::user()->academicProfile->level }}</p>
        <p><strong>Student Reg No:</strong> {{ Auth::user()->academicProfile->student_registration_number }}</p>
    </div>

    


   <div class="bg-white p-5 rounded shadow mb-6">
    <h2 class="text-xl font-bold mb-2">Academic Profile</h2>    
@if($academicProfile)
 <p>Status:

     <span class="
        {{ $academicProfile->status === 'rejected' ? ' text-red-700' :
           ($academicProfile->status === 'approved' ? ' text-green-700' : 'bg-yellow-100 text-yellow-700') }}">

        {{ ucfirst($academicProfile->status) }}
           </span>
        </p>

        @if($academicProfile->status === 'rejected')
            <p class="mt-2">
                <strong>Reason:</strong> {{ $academicProfile->rejection_reason }}
            </p>
        @endif
    
@endif

@if(!$academicProfile || $academicProfile->status === 'rejected')
    <a href="{{ route('student.profile.academic') }}" class=" inline-block mt-3 text-white bg-primary-700 px-4 py-2 rounded-full">
        {{ $academicProfile ? 'Edit & Resubmit' : 'Submit Academic Profile' }}
    </a>
@endif

@if(!$academicProfile || $academicProfile->status === 'pending')
    <a href="{{ route('student.profile.academic') }}" class=" inline-block mt-3 text-white bg-primary-700 px-4 py-2 rounded-full">
        {{ $academicProfile ? 'Edit & Resubmit' : 'Submit Academic Profile' }}
    </a>
@endif

</div>

<div class="bg-white p-5 rounded shadow mb-6">
    <h2 class="text-xl font-bold mb-2">Personal Profile</h2>

    @if($personalProfile)
        <p>Status:
            <span class="
                {{ $personalProfile->status === 'approved' ? 'text-green-600' :
                   ($personalProfile->status === 'rejected' ? 'text-red-600' : 'text-yellow-600') }}">
                {{ ucfirst($personalProfile->status) }}
            </span>
        </p>

        @if($personalProfile->status === 'rejected')
            <p class="mt-2 text-red-600">
                <strong>Reason:</strong> {{ $personalProfile->rejection_reason }}
            </p>

            <a href="{{ route('student.profile.complete') }}"
               class="inline-block mt-3  bg-primary-700 text-white px-4 py-2 rounded-full">
                Edit & Resubmit
            </a>
        @endif

    @else
        <p class="text-yellow-700">Not submitted</p>
        <a href="{{ route('student.profile.complete') }}"
           class="mt-3 inline-block  bg-primary-700 text-white px-4 py-2 rounded-full">
            Complete Personal Profile
        </a>
    @endif

     @if($personalProfile->status === 'pending')

            <a href="{{ route('student.profile.complete') }}"
               class="inline-block mt-3  bg-primary-700 text-white px-4 py-2 rounded-full">
                Edit & Resubmit
            </a>
        @endif
</div>



@if($loanEligible)
    
       <div class="bg-green-600 text-white px-6 py-3 rounded ">
         You can now Apply for Loan
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
           
        </ul>
    </div>
@endif

<div>
    <p> You are required to have a two guarantors  before making an application.</p>
</div>




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
