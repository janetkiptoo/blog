@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-white rounded-xl shadow-lg p-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">
        Apply for Loan
    </h2>

    <form method="POST" action="{{ route('student.loan.store', $product->id) }}">
        @csrf

        {{-- Loan Amount --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Loan Amount (KES)</label>
            <input type="number" name="loan_amount" id="loan_amount" min="{{ $product->min_loan_amount }}" max="{{ $product->max_loan_amount }}" required oninput="calculateLoan()"
                class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
        </div>

        {{-- Term Months --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Repayment Period (Months)</label>
            <input
                type="number"
                name="term_months"
                id="term_months"
                min="{{ $product->min_term_months }}"
                max="{{ $product->max_term_months }}"
                required
                oninput="calculateLoan()"
                class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Monthly Interest Rate (%)</label>
            <input type="number" value="{{ $product->interest_rate }}" readonly class="w-full bg-gray-100 border rounded-lg px-4 py-2 cursor-not-allowed">
            <input type="hidden" name="interest_rate" value="{{ $product->interest_rate }}">

        </div>

        {{-- Grace Period Info --}}
        <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
            <p class="text-blue-800 text-sm">
                This loan has a <strong>{{ $product->grace_period_months }}-month interest-free grace period</strong>.
            </p>
        </div>

        {{-- Calculator Summary --}}
        <div class="mb-6 border rounded-lg bg-gray-50 p-4">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Estimated Repayment Summary</h3>
            <p class="text-gray-700">Monthly Payment: <strong id="monthly_payment_display">KES 0.00</strong></p>
            <p class="text-gray-700">Total Payable: <strong id="total_payable_display">KES 0.00</strong></p>
            <p class="text-gray-700">Interest Charged: <strong id="total_interest_display">KES 0.00</strong></p>
        </div>

        {{-- Hidden fields to send calculated values --}}
        <input type="hidden" name="monthly_payment" id="monthly_payment">
        <input type="hidden" name="total_interest" id="total_interest">
        <input type="hidden" name="total_payable" id="total_payable">

        {{-- Terms --}}
        <div class="mb-6">
            <label class="flex items-center">
                <input type="checkbox" name="terms_accepted" required class="mr-2">
                <span class="text-gray-700">
                    I accept the
                    <a href="{{ route('student.terms') }}" target="_blank" class="text-blue-600 underline">Terms & Conditions</a>
                </span>
            </label>
        </div>

        {{-- Submit --}}
        <div class="flex justify-end">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-medium">
                Continue to Apply
            </button>
        </div>
    </form>
</div>

<script>
function calculateLoan() {
    const P = parseFloat(document.getElementById('loan_amount').value);
    const T = parseInt(document.getElementById('term_months').value);
    const r = {{ $product->interest_rate }} / 100;
    const grace = {{ $product->grace_period_months }} || 0;

    if (!P || !T || T <= grace) return;

    const repaymentMonths = T - grace;

    const totalInterest = P * r * repaymentMonths;
    const totalPayable  = P + totalInterest;
    const monthlyPayment = totalPayable / repaymentMonths;

    
    document.getElementById('monthly_payment_display').innerText =
        'KES ' + monthlyPayment.toFixed(2);

    document.getElementById('total_interest_display').innerText =
        'KES ' + totalInterest.toFixed(2);

    document.getElementById('total_payable_display').innerText =
        'KES ' + totalPayable.toFixed(2);

    document.getElementById('monthly_payment').value = monthlyPayment.toFixed(2);
    document.getElementById('total_interest').value = totalInterest.toFixed(2);
    document.getElementById('total_payable').value = totalPayable.toFixed(2);
}
</script>


@endsection
