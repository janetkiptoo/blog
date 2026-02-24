@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8 space-y-6">

    <div class="bg-white shadow rounded p-6">
        <h2 class="text-xl font-bold mb-4">Loan Summary</h2>
        <p><span class="font-semibold">Product:</span> {{ $loan->loanProduct->product_name }}</p>
        <p><span class="font-semibold">Amount:</span> KES {{ number_format($loan->loan_amount, 2) }}</p>
        <p><span class="font-semibold">Interest Rate:</span> {{ $loan->interest_rate }}%</p>
        <p><span class="font-semibold">Term:</span> {{ $loan->term_months }} months</p>
        <p><span class="font-semibold">Monthly Payment:</span> KES {{ number_format($loan->monthly_payment, 2) }}</p>
    </div>

    <div class="bg-white shadow rounded p-6">
        <h2 class="text-xl font-bold mb-4">Personal Details</h2>
        <p><span class="font-semibold">Name:</span> {{ auth()->user()->name }}</p>
        <p><span class="font-semibold">Nationality:</span> {{ $personalProfile->nationality }}</p>
        <p><span class="font-semibold">ID Type:</span> {{ $personalProfile->government_id_type }}</p>
       <p><span class="font-semibold">ID Number:</span> {{ $personalProfile->government_id_number }}</p>
        <p><span class="font-semibold">Address:</span> {{ $personalProfile->address }}</p>
    </div>

    <div class="bg-white shadow rounded p-6">
        <h2 class="text-xl font-bold mb-4">Academic Details</h2>
        <p><span class="font-semibold">Institution:</span> {{ $academicProfile->institution_name }}</p>
        <p><span class="font-semibold">Course:</span> {{ $academicProfile->course_name }}</p>
        <p><span class="font-semibold">Level:</span> {{ $academicProfile->level }}</p>
         <p><span class="font-semibold">Student Registration Number:</span> {{ $academicProfile->student_registration_number }}</p>
    </div>

    <div class="bg-white shadow rounded p-6">
        <h2 class="text-xl font-bold mb-4">Guarantors</h2>
        @foreach($guarantors as $g)
            <p>{{ $g->name }} :{{ ucfirst($g->relationship) }}</p>
        @endforeach

        @if($guarantors->count() < 2)
            <p class="text-red-600 mt-2 font-semibold">
                You need at least 2 approved guarantors to submit this loan.
            </p>
        @endif
    </div>

    <form method="POST" action="{{ route('student.loans.submit', $loan) }}" class="bg-white shadow rounded p-6 space-y-4">
        @csrf

        <label class="flex items-center">
            <input type="checkbox" name="accept_terms" required class="mr-2" 
                @if($guarantors->count() < 2) disabled @endif
            >
            <span class="text-gray-700">
                I accept the
                <a href="{{ route('student.terms') }}" target="_blank" class="text-blue-600 underline">Terms & Conditions</a>
            </span>
        </label>

        <button type="submit" 
            class="w-full bg-primary-700 text-white px-6 py-2 rounded hover:bg-primary-800"
            @if($guarantors->count() < 2) disabled @endif
        >
            Submit Loan Application
        </button>
    </form>

</div>
@endsection