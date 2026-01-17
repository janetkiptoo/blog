
@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">

    <h1 class="text-3xl font-bold mb-6 text-center">Repay Loan</h1>

    <!-- Loan Info -->
    <div class="mb-6 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-semibold mb-2">Loan Details</h2>
        <p><strong>Product:</strong> {{ $loan->loanProduct->name ?? '-' }}</p>
        <p><strong>Amount Borrowed:</strong> KES {{ number_format($loan->loan_amount, 2) }}</p>
        <p><strong>Outstanding Balance:</strong> KES {{ number_format($loan->balance ?? $loan->loan_amount, 2) }}</p>
        <p><strong>Status:</strong> {{ $loan->status ?? 'Pending' }}</p>
        <p><strong>Applied On:</strong> {{ $loan->created_at->format('d M, Y') }}</p>
    </div>

    <div class="p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-semibold mb-4">Make a Repayment</h2>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('loans.repay', $loan->id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="amount" class="block font-semibold mb-2">Repayment Amount (KES)</label>
                <input type="number" step="0.01" min="1" name="amount" id="amount" 
                       class="w-full border rounded px-3 py-2" required>
            </div>

            <button type="submit" 
                    class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                Pay Now
            </button>
        </form>
    </div>

</div>
@endsection

