@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">

    <h1 class="text-3xl font-bold mb-6 text-center">Student Dashboard</h1>


    <div class="mb-6 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-semibold mb-4">
            Welcome, {{ Auth::user()->name }}
        </h2>

        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        <p><strong>Institution:</strong> {{ Auth::user()->institution }}</p>
        <p><strong>Course:</strong> {{ Auth::user()->course }}</p>
        <p><strong>Year of Study:</strong> {{ Auth::user()->year_of_study }}</p>
        <p><strong>Student Reg No:</strong> {{ Auth::user()->student_reg_no }}</p>
    </div>


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
               class="mt-4 inline-block bg-blue-600 text-white px-6 py-2 rounded">
                View All Loans
            </a>
        </div>

     


    @else
        <div class="mb-6 p-6 bg-yellow-100 text-yellow-800 shadow-lg rounded-lg">
            You have no active loans. Apply for a loan to get started.
        </div>
    @endif


 <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Uploaded Image" style="max-width: 300px;">

</div>

@endsection
