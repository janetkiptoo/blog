@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg mt-10">
    <h2 class="text-2xl font-semibold mb-6 text-gray-800">Apply for Loan</h2>

    <form method="POST" action="{{ route('student.loan.store', $product->id) }}">
        @csrf

        
        <div class="mb-4">
            <label for="loan_amount" class="block text-gray-700 font-medium mb-1">Loan Amount</label>
            <input type="number" name="loan_amount" id="loan_amount" 
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                   min="{{ $product->min_loan_amount }}" 
                   max="{{ $product->max_loan_amount }}" required>
        </div>

        
        <div class="mb-4">
            <label for="term_months" class="block text-gray-700 font-medium mb-1">Loan Term (months)</label>
            <input type="number" name="term_months" id="term_months" 
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-100 cursor-not-allowed"
                   value="{{ $product->loan_term_months }}" readonly>
        </div>

      
        <div class="mb-6">
            <label class="flex items-center">
                <input type="checkbox" name="terms_accepted" value="1" required
                       class="mr-2 w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <span class="text-gray-700">I accept the 
                    <a href="{{ route('student.terms') }}" target="_blank" class="text-blue-600 underline">
                        Terms & Conditions
                    </a>
                </span>
            </label>
        </div>

    
        <div class="mb-6 p-4 border border-gray-200 rounded-lg bg-gray-50">
            <h3 class="text-xl font-semibold mb-4 text-gray-800">Loan Repayment Calculator</h3>

            <div class="mb-3">
                <input type="number" id="principal" placeholder="Principal Amount" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-3">
                <input type="number" id="rate"value="{{ $product->interest_rate }}" readonly class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-3">
                <input type="number" id="monthlyPayment" placeholder="Monthly Payment" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="button" onclick="calculatePayoff()" 
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded-lg mb-4">
                Calculate
            </button>

            <p id="monthsNeeded" class="text-gray-800 font-medium"></p>
            <p id="totalPaid" class="text-gray-800 font-medium"></p>
            <p id="totalInterest" class="text-gray-800 font-medium"></p>
        </div>

       
        <div class="flex justify-end">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-medium">
                Continue
            </button>
        </div>
    </form>
</div>

<script>
function calculatePayoff() {
    let principal = parseFloat(document.getElementById('principal').value);
    let rate = parseFloat(document.getElementById('rate').value);
    let monthlyPayment = parseFloat(document.getElementById('monthlyPayment').value);

    if(isNaN(principal) || isNaN(rate) || isNaN(monthlyPayment) || monthlyPayment <= 0){
        alert('Please enter valid numbers greater than 0');
        return;
    }

    let balance = principal;
    let months = 0;
    let totalPaid = 0;

    while(balance > 0){
        let interest = balance * rate / 100;
        balance = balance + interest - monthlyPayment;
        totalPaid += monthlyPayment;
        months++;
        if(months > 1000){
            alert('Monthly payment too low to ever repay the loan.');
            return;
        }
    }

    let totalInterest = totalPaid - principal;

    document.getElementById('monthsNeeded').innerText = "Months Needed to Repay: " + months;
    document.getElementById('totalPaid').innerText = "Total Paid: " + totalPaid.toFixed(2);
    document.getElementById('totalInterest').innerText = "Total Interest: " + totalInterest.toFixed(2);
}
</script>
@endsection
