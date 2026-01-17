@extends('layouts.adminn')

@section('title', 'loans')

@section('content')
<div class="max-w-3xl mx-auto py-6">

    
  <div id="loans" class="mb-8 bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Loan Applications</h2>
        <table class="w-full border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2">Student</th>
                    <th class="p-2">Email</th>
                    <th class="p-2">Product</th>
                    <th class="p-2">Amount</th>
                    <th class="p-2">Status</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loans as $loan)
                <tr class="border-t">
                    <td class="p-2">{{ $loan->user->name }}</td>
                    <td class="p-2">{{ $loan->user->email }}</td>
                    <td class="p-2">{{ $loan->loanProduct->product_name }}</td>
                    <td class="p-2">{{($loan->loan_amount) }}</td>
                    <td class="p-2">{{($loan->status) }}</td>
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
                @empty
                <tr>
                    <td colspan="6" class="text-center p-4">No loan applications found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>







        @endsection