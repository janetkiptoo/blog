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

        <a href="{{ route('student.loans.repay', $loan->id)}}"class="inline-block mt-4 text-white rounded bg-primary-100 hover:bg-primary-200"> Repay Loan
    </a>
       
        @else
            <p class="text-green-600 mt-3 font-semibold">Loan fully paid</p>
        @endif
        @if ($loan->status === 'pending')
        <form action="{{ route('student.loans.destroy', $loan) }}" method="POST" class="inline" onsubmit="return confirm('Cancel this loan application?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class=" inline-block mt-4 text-white rounded bg-red-600">Cancel </button>
                                </form>
                        @else
                        @endif

    </div>
    @empty
        <p>You have not applied for any loans yet.</p>
    @endforelse

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


</div>
@endsection

