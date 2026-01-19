@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">

    <h1 class="text-2xl font-bold mb-6">My Loans</h1>

    @forelse($loans as $loan)
    <div class="bg-white shadow p-6 rounded mb-4">

        <p><strong>Product:</strong> {{ $loan->loanProduct->product_name }}</p>
        <p><strong>Loan Amount:</strong> KES {{ number_format($loan->loan_amount, 2) }}</p>
        <p><strong>Balance:</strong> KES {{ number_format($loan->balance, 2) }}</p>
        <p><strong>Status:</strong> {{ ucfirst($loan->status) }}</p>

        @if($loan->status !== 'paid')

        <a href="{{ route('student.loans.repay', $loan->id)}}"class="inline-block mt-4 text-white rounded bg-blue-600"> Repay Loan
    </a>
       
        @else
            <p class="text-green-600 mt-3 font-semibold">Loan fully paid</p>
        @endif

    </div>
    @empty
        <p>You have not applied for any loans yet.</p>
    @endforelse

</div>
@endsection
