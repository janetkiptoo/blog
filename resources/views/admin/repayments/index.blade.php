@extends('layouts.adminn')

@section('title', 'Admin Dashboard')

@section('content')
<div class="py-8 px-4">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Repayment History</h1>

    <div class="overflow-x-auto bg-white shadow-lg rounded-sm   text-black font-medium">
        <table class="min-w-full border border-gray-200 text-xl text-black">
            <thead class="bg-gray-100 text-black uppercase text-xs tracking-wider">
                <tr>
                    <th class="px-4 py-4 border">Date</th>
                    <th class="px-4 py-4 border">Student</th>
                    <th class="px-4 py-4 border">Loan Product</th>
                    <th class="px-4 py-4 border text-right">Amount (KES)</th>
                    <th class="px-4 py-4 border">Channel</th>
                    <th class="px-4 py-4 border">MPESA Receipt</th>
                    <th class="px-4 py-4 border">Status</th>
                    <th class="px-4 py-4 border text-center">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 text-sm text-black font-medium" >
                @foreach($repayments as $repayment)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-4 whitespace-nowrap">
                            {{ $repayment->paid_at?->format('d M Y H:i') ?? '-' }}
                        </td>

                        <td class="px-4 py-4">
                            {{ $repayment->loan->user->name ?? '-' }}
                        </td>

                        <td class="px-4 py-4">
                            {{ $repayment->loan->loanProduct->product_name ?? '-' }}
                        </td>

                        <td class="px-4 py-4 text-right font-medium">
                            {{ number_format($repayment->amount, 2) }}
                        </td>

                        <td class="px-4 py-4">
                            {{ $repayment->channel_name }}
                        </td>

                        <td class="px-4 py-4">
                            {{ $repayment->mpesa_receipt }}
                        </td>

                        <td class="px-4 py-4">
                            <span class="px-3 py-1 rounded-full  font-semibold
                                @if($repayment->status_name === 'Completed') bg-green-100 text-green-700
                                @elseif($repayment->status_name === 'Pending') bg-yellow-100 text-yellow-700
                                @else bg-red-100 text-red-700 @endif">
                                {{ $repayment->status_name }}
                            </span>
                        </td>

                        <td class="px-4 py-4 text-center">
                            <a href="{{ route('admin.repayments.show', $repayment->loan->id) }}"
                               class="inline-block bg-primary-100 hover:bg-primary-200  text-white px-4 py-2 rounded-lg text-xs font-semibold transition">
                                View Loan Repayments
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
