@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">

    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>

    
    <div class="mb-6 p-4 bg-white shadow rounded">
        <h2 class="text-xl font-semibold">Welcome, {{ Auth::user()->name }}</h2>
        <p>Email: {{ Auth::user()->email }}</p>
    </div>

    
    <div class="p-4 bg-white shadow rounded">
        <h2 class="text-xl font-semibold mb-2">Your Loan Details</h2>

        @if($loan)
            <p><strong>Loan Amount:</strong> {{ $loan->loan_amount }}</p>
            <p><strong>Loan Product:</strong> {{ $loan->loanProduct->name ??'N/A'  }}</p>
            <p><strong>Status:</strong> {{($loan->status) }}</p>
            <p><strong>Applied On:</strong> {{ $loan->created_at }}</p>

          
            <a href="{{ route('loans.show', $loan->id) }}" class="text-blue-500 hover:underline">
                View Full Details
            </a>
        @else
            <p>You currently have no loans.</p>
        @endif
    </div>

</div>
@endsection
