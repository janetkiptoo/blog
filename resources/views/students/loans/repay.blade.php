@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 bg-white rounded-xl shadow-lg p-6">

    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Loan Repayment Dashboard</h2>

    {{-- Loan Details --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="p-4 border rounded-lg bg-gray-50">
            <h3 class="font-semibold text-gray-700 mb-2">Loan Details</h3>
            <p><strong>Loan Amount:</strong> KES {{ number_format($loan->loan_amount, 2) }}</p>
            <p><strong>Interest Rate:</strong> {{ $loan->interest_rate }}% per month</p>
            <p><strong>Monthly Payment:</strong> KES {{ number_format($monthlyPayment, 2) }}</p>
            <p> <strong>Total Payable: </strong>KES {{ number_format($totalPayable, 2) }}</p>
            <p><strong>Loan Term:</strong> {{ $loan->term_months }} months</p>
            <p><strong>Status:</strong> 
                <span class="px-2 py-1 rounded text-sm {{ $loan->status === 'completed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                    {{ ucfirst($loan->status) }}
                </span>
            </p>
            @if($loan->repayment_start_date && now()->lt($loan->repayment_start_date))
                <p class="mt-2 text-blue-700 text-sm">
                    Loan is in grace period. Repayments start on {{ $loan->repayment_start_date->format('d M Y') }}.
                </p>
            @endif
        </div>

        <div class="p-4 border rounded-lg bg-gray-50">
            <h3 class="font-semibold text-gray-700 mb-2">Financial Summary</h3>
            <p><strong>Current Balance:</strong> KES {{ number_format($loan->balance, 2) }}</p>
            <p><strong>Total Paid:</strong> KES {{ number_format($loan->total_paid, 2) }}</p>
            <p><strong>Total Interest:</strong> KES {{ number_format($totalInterest, 2) }}</p>
        </div>
    </div>

    {{-- Repayment Form --}}
    @if($loan->status !== 'completed' && (!$loan->repayment_start_date || now()->gte($loan->repayment_start_date)))
    <div class="mb-10 border rounded-lg p-6 bg-gray-50">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Make a Repayment</h3>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
                {{ $errors->first() }}
            </div>
        @endif

        

        <form method="POST" action="{{ route('student.loans.process_repayment', $loan->id) }}">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 mb-1">Payment Amount (KES)</label>
                <input type="number" name="amount" min="1" max="{{ $loan->balance }}" value="{{$monthlyPayment }}"required class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500" >
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-1">Payment Method</label>
                <select name="payment_method" required class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="">Select method</option>
                    <option value="mpesa">Mpesa</option>
                    <option value="cash">Cash</option>
                </select>

           

            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-1">Reference (optional)</label>
                <input type="text" name="reference" class="w-full border rounded-lg px-4 py-2">
            </div>

            {{-- Hidden fields for stored values --}}
            <input type="hidden" name="monthly_payment" value="{{$monthlyPayment}}">
            <input type="hidden" name="total_interest" value="{{$totalInterest}}">
            <input type="hidden" name="total_payable" value="{{$totalPayable}}">

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium">
                Submit Payment
            </button>
        </form>
    </div>
    @endif

    {{-- Repayment History --}}
    <div class="overflow-x-auto">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Repayment History</h3>
        @if($loan->repayments->isEmpty())
            <p class="text-gray-500">No repayments made yet.</p>
        @else
            <table class="min-w-full border rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Date</th>
                        <th class="px-4 py-2 text-left">Amount Paid</th>
                        <th class="px-4 py-2 text-left">Balance After</th>
            
                        <th class="px-4 py-2 text-left">Late Penalty</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($loan->repayments as $repayment)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $repayment->paid_at ? $repayment->paid_at->format('d M Y') : '-' }}</td>
                        <td class="px-4 py-2">KES {{ number_format($repayment->amount, 2) }}</td>
                        <td class="px-4 py-2">KES {{ number_format($repayment->balance_after, 2) }}</td>
                        
                        <td class="px-4 py-2">KES {{ number_format($repayment->late_penalty ?? 0, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

</div>
@endsection
