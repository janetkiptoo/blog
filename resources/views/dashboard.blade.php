@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">

    <!-- Dashboard Heading -->
    <h1 class="text-3xl font-bold mb-6 text-center">Dashboard</h1>

    <!-- User Info -->
    <div class="mb-6 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-semibold mb-2">Welcome, {{ Auth::user()->name }}</h2>
        <p class="text-gray-700"><strong>Email:</strong> {{ Auth::user()->email }}</p>
        <p class="text-gray-700"><strong>Role:</strong> {{ Auth::user()->role ?? 'Not Assigned' }}</p>
        <p class="text-gray-700"><strong>Phone:</strong> {{ Auth::user()->phone ?? '-' }}</p>
        <p class="text-gray-700"><strong>Student ID:</strong> {{ Auth::user()->student_id ?? '-' }}</p>
        <p class="text-gray-700"><strong>Course:</strong> {{ Auth::user()->course ?? '-' }}</p>
    </div>

    <!-- Loan Details -->
    <div class="p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-semibold mb-4">Your Loan Details</h2>

        @if($loans->count())
            <div class="space-y-3">
                @foreach($loans as $loan)
                    <div class="p-4 border rounded bg-gray-50">
                        <p><strong>Product:</strong> {{ $loan->loanProduct->name ?? '-' }}</p>
                        <p><strong>Amount:</strong> KES {{ number_format($loan->loan_amount, 2) }}</p>
                        <p><strong>Status:</strong> {{ $loan->status ?? 'Pending' }}</p>
                        <p><strong>Applied On:</strong> {{ $loan->created_at->format('d M, Y') }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-600">You currently have no loans.</p>
        @endif
    </div>

</div>
@endsection
