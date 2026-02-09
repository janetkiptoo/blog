@extends('layouts.adminn')

@section('title', 'Admin Dashboard')

@section('content')
<div class="py-6">
    <h1 class="text-2xl font-bold mb-4">Repayment History</h1>

    <table class="w-full border bg-white">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2 border border-gray-300">Date</th>
                <th class="p-2 border border-gray-300">Student</th>
                <th class="p-2 border border-gray-300">Loan Product</th>
                <th class="p-2 border border-gray-300">Amount (KES)</th>
                <th class="p-2 border border-gray-300">Channel</th>
                <th class="p-2 border border-gray-300">MPESA Receipt</th>
                <th class="p-2 border border-gray-300">Status</th>
                <th class="p-2 border border-gray-300">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($repayments as $repayment)
                <tr class="border-t">
                    <td>{{ $repayment->paid_at?->format('d M Y H:i') ?? '-' }}</td>
                    <td>{{ $repayment->loan->user->name ?? '-' }}</td>
                    <td>{{ $repayment->loan->loanProduct->product_name ?? '-' }}</td>
                    <td>{{ number_format($repayment->amount, 2) }}</td>
                    <td>{{ $repayment->channel_name }}</td>
                    <td>{{ $repayment->mpesa_receipt }}</td>
                    <td>{{ $repayment->status_name }}</td>
                   <td><a href="{{ route('admin.repayments.show', $repayment->loan->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded">View Loan Repayments</a>
</td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection




