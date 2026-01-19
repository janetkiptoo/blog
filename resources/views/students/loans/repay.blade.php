@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">

    <h1 class="text-3xl font-bold mb-6 text-center">Repay Loan</h1>

    
    <div class="mb-6 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-semibold mb-4">Loan Details</h2>

        <p><strong>Product:</strong> {{ $loan->loanProduct->product_name ?? '-' }}</p>
        <p><strong>Amount Borrowed:</strong> KES {{ number_format($loan->loan_amount, 2) }}</p>
        <p><strong>Outstanding Balance:</strong> KES {{ number_format($loan->balance ?? $loan->loan_amount, 2) }}</p>
        <p><strong>Status:</strong> {{ ucfirst($loan->status) }}</p>
        <p><strong>Applied On:</strong> {{ $loan->created_at->format('d M, Y') }}</p>
    </div>

    
    @if($loan->status === 'approved' && $loan->balance > 0)
    <div class="mb-6 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-semibold mb-4">Make a Repayment</h2>

        <form method="POST" action="{{ route('student.loans.repay', $loan->id) }}">
            @csrf

            <label class="block text-sm font-medium mb-2">Amount (KES)</label>
            <input type="number"name="amount" placeholder="Enter Amount in Ksh" required min="1" max="{{ $loan->balance }}" class="border rounded px-4 py-2 w-full mb-4 placeholder:text-gray-400">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded"> Repay Loan </button>
        </form>
    </div>
 

   
@if($loan->repayments)
<div class="mt-6 bg-white shadow rounded p-6">
    <h2 class="text-xl font-semibold mb-4">Repayment History</h2>

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 text-left">Date</th>
                <th class="p-2 text-right">Amount (KES)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loan->repayments as $repayment)
            <tr>
                <td class="p-2">{{ ($repayment->paid_at)->format('d M Y') }}</td>
                <td class="p-2 text-right">{{ number_format($repayment->amount, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
   @endif

    @if($loan->status === 'paid')
    <div class="mb-6 p-6 bg-green-100 text-green-800 shadow-lg rounded-lg"> This loan has been fully paid. Thank you.
    </div>
    @endif

    <a href="{{ route('student.dashboard') }}"class="inline-block mt-4 text-blue-600 underline"> Back to Dashboard
    </a>

</div>
@endsection
