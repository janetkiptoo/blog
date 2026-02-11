@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6 text-center">Student Dashboard</h1>

    <div class="mb-6 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-semibold mb-4">Welcome, {{ Auth::user()->name }}h2>
        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        <p><strong>Institution:</strong> {{ Auth::user()->institution }}</p>
        <p><strong>Course:</strong> {{ Auth::user()->course }}</p>
       <p><strong>Student Reg No:</strong> {{  Auth::user()->student_reg_no }}</p>
    </div>

    @if($loan)
    <div class="mb-6 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-semibold mb-2">Your Latest Loan</h2>
        <p><strong>Product:</strong> {{ $loan->loanProduct->name ?? '-' }}</p>
        <p><strong>Amount Borrowed:</strong> KES {{ number_format($loan->loan_amount, 2) }}</p>
        <p><strong>Outstanding Balance:</strong> KES {{ number_format($loan->balance ?? $loan->loan_amount, 2) }}</p>
        <p><strong>Status:</strong> {{ $loan->status ?? 'Pending' }}</p>
        <p><strong>Applied On:</strong> {{ $loan->created_at->format('d M, Y') }}</p>

        @if($loan->status !== 'paid')
        <a href="{{ route('student.loans.repay', $loan->id) }}"
           class="mt-4 inline-block bg-primary-700 text-white px-6 py-2 rounded hover:bg-primary-500">
            Repay Loan
        </a>
        @endif
    </div>
    @else
    <div class="mb-6 p-6 bg-yellow-100 text-yellow-800 shadow-lg rounded-lg">
        You have no active loans. Apply for a loan to get started.
    </div>
    @endif

    <img src="{{ asset('storage/'. $users->image) }}">

</div>
@endsection
