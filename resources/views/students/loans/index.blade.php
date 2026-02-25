@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">

    <h1 class="text-2xl font-bold  text-center mb-6">My Loans</h1>

    @forelse($loans as $loan)
    <div class="bg-white shadow p-6 rounded mb-4">

        @foreach ($loans as $loan)
    <div class="border p-4 rounded mb-4">
        <p><strong>Product:</strong> {{ $loan->loanProduct->name }}</p>
        <p><strong>Loan Amount:</strong> KES {{ number_format($loan->amount, 2) }}</p>
        <p><strong>Balance:</strong> KES {{ number_format($loan->balance, 2) }}</p>
        <p><strong>Status:</strong> {{ ucfirst($loan->status) }}</p>

        @if($loan->status === 'draft')
            <a href="{{ route('loans.resume', $loan->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">
                Resume Application
            </a>
        @elseif($loan->status === 'disbursed')
            <a href="{{ route('loans.repay', $loan->id) }}" class="bg-green-600 text-white px-4 py-2 rounded">
                Repayment Available
            </a>
        @endif
    </div>
@endforeach
        

     
       @if($loan->status === \App\Models\LoanApplication::STATUS_DISBURSED)
    <a href="{{ route('student.loans.repay.form', $loan->id) }}"
       class="bg-green-600 text-white px-4 py-2 rounded">
        Make Repayment
    </a>
@else
    <span class="text-red-400 ">
        Repayment available after disbursement
    </span>
@endif
         @if($loan->status === 'paid')
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

