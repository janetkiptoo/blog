@extends('layouts.adminn')

@section('content')
<h2 class="text-xl font-bold mb-4">Pending Cash Payments</h2>

<table class="w-full border">
    <thead>
        <tr>
            <th>User</th>
            <th>Loan ID</th>
            <th>Amount</th>
            <th>Submitted At</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cashPayments as $payment)
        <tr>
            <td>{{ $payment->user->name }}</td>
            <td>{{ $payment->loanApplication->id }}</td>  
            <td>{{ number_format($payment->amount, 2) }}</td>
            <td>{{ $payment->created_at }}</td>
            <td>{{ ucfirst($payment->status) }}</td>
            <td class="flex gap-2">
                <form method="POST" action="{{ url('/admin/cash-payments/'.$payment->id.'/approve') }}">
                    @csrf
                    <button class="bg-green-600 text-white px-2 py-1 rounded">Approve</button>
                </form>

                <form method="POST" action="{{ url('/admin/cash-payments/'.$payment->id.'/reject') }}">
                    @csrf
                    <button class="bg-red-600 text-white px-2 py-1 rounded">Reject</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
