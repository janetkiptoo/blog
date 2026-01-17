@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6 text-center">Repay Loan</h1>

    <div class="mb-6 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-semibold mb-4">Loan Details</h2>

        <p><strong>Product:</strong> {{ $loan->loanProduct->name ?? '-' }}</p>
        <p><strong>Amount Borrowed:</strong> KES {{ number_format($loan->loan_amount, 2) }}</p>
        <p><strong>Outstanding Balance:</strong> KES {{ number_format($loan->balance ?? $loan->loan_amount, 2) }}</p>
        <p><strong>Status:</strong> {{ $loan->status ?? 'Pending' }}</p>
        <p><strong>Applied On:</strong> {{ $loan->created_at->format('d M, Y') }}</p>
    </div>

    @if($loan->status !== 'paid')
    <div class="mb-6 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-semibold mb-4">Make a Repayment</h2>

        <form action="{{ route('student.loans.process_repayment', $loan->id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="amount" class="block font-medium mb-2">Amount (KES)</label>
                <input type="number" name="amount" id="amount"
                       max="{{ $loan->balance ?? $loan->loan_amount }}"
                       min="1"
                       value="{{ old('amount') }}"
                       class="w-full border border-gray-300 rounded px-3 py-2"
                       required>
                @error('amount')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                Pay Now
            </button>
        </form>
    </div>
    @else
    <div class="mb-6 p-6 bg-green-100 text-green-800 shadow-lg rounded-lg">
        This loan has been fully paid. Thank you!
    </div>
    @endif

    <a href="{{ route('student.dashboard') }}"class="inline-block mt-4 text-blue-600 underline">
       Back to Dashboard
    </a>
</div>
@endsection
