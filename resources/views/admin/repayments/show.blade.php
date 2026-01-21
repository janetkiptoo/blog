@extends('layouts.adminn')

@section('title', 'Admin Dashboard')

@section('content')
<div class="max-w-7xl mx-auto py-6">
<h1 class="text-2xl font-bold mb-4">Loan Repayment Details</h1>

<p><strong>Student:</strong> {{ $loan->user->name }}</p>
<p><strong>Loan Product:</strong> {{ $loan->loanProduct->product_name }}</p>
<p><strong>Total Loan:</strong> KES {{ number_format($loan->loan_amount, 2) }}</p>
<p><strong>Balance:</strong> KES {{ number_format($loan->balance, 2) }}</p>

 <table class="w-full border bg-white">
        <thead class="bg-gray-200">
        <tr>
            <th class="p-2 border border-gray-3002">Date</th>
            <th class="p-2  border border-gray-300text-right">Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach($loan->repayments as $repayment)
       <tr class="border-t">
            <td class="p-2 border border-gray-300">{{$repayment->paid_at }}</td>
            <td class="p-2 border border-gray-300 text-right">{{ number_format($repayment->amount, 2) }}</td>
           
        </tr>
        @endforeach
    </tbody>
</table>
</div>
<a href="{{ route('admin.repayments.index') }}"class="bg-blue-500 text-white px-10 py-2 rounded">
   Back
</a>
@endsection
