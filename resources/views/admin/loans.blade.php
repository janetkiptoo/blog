@extends('layouts.adminn')

@section('title', 'loans')

@section('content')
<div class=" py-6">

    
  <div id="loans" class="mb-8 bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Loan Applications</h2>
      
         
<table class="min-w-full bg-white border">
    <thead>
        <tr class="bg-gray-100">
            <th class="p-3 border">Student</th>
            <th class="p-3 border">Loan Product</th>
            <th class="p-3 border">Loan Amount</th>
            <th class="p-3 border">Amount Paid</th>
            <th class="p-3 border">Balance</th>
            <th class="p-3 border">Status</th>
            <th class="p-3 border">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($loans as $loan)
        <tr>
            <td class="p-3 border">{{ $loan->user->name }}</td>
            <td class="p-3 border">{{ $loan->loanProduct->product_name }}</td>
            <td class="p-3 border">KES {{ number_format($loan->loan_amount, 2) }}</td>
            <td class="p-3 border text-green-700">KES {{ number_format( $loan->loan_amount - ($loan->balance ?? $loan->loan_amount),  2) }}</td>
            <td class="p-3 border text-red-600"> KES {{ number_format($loan->balance ?? $loan->loan_amount, 2) }}</td>
            <td class="p-3 border"><span class="px-2 py-1 rounded text-sm {{ $loan->status === 'paid' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }}">{{ ucfirst($loan->status) }}
                </span>
            </td>
           <td class="p-2 flex gap-2">
                        @if($loan->status == 'pending')
                        <form action="{{ route('admin.loan.approve', $loan->id) }}" method="POST">
                            @csrf
                            <button class="bg-green-500 text-white px-2 py-1 rounded">Approve</button>
                        </form>
                        <form action="{{ route('admin.loan.reject', $loan->id) }}" method="POST">
                            @csrf
                            <button class="bg-red-500 text-white px-2 py-1 rounded">Reject</button>
                        </form>
                        @else
                        <p>no action</p>
                        @endif
                    </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection