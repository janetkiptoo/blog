@extends('layouts.web')

@section('title', 'Home')

@section('content')


<section class="flex flex-col md:flex-row items-center bg-center py-12 gap-8 px-6 md:px-16">
    <div class="flex-1">
        <img src="{{ asset('assets/students.jpg') }}" alt="Student Loan" class="rounded-xl shadow-lg mx-auto">
    </div>

    <div class="flex-1 space-y-6">
        <h1 class="text-3xl md:text-5xl font-bold text-gray-800 leading-tight">
            Finance Your Education, Stress-Free
        </h1>

        <p class="text-gray-600 text-lg">
            Welcome to <span class="font-semibold text-gray-800">Student Loan</span>, a digital platform supporting students in funding tuition, accommodation, learning materials, devices, or emergencies. Simple, secure, and transparent.
        </p>

        <div class="space-x-4">
            <a href="#eligibility" class="bg-blue-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-blue-700 transition">
                Check Eligibility
            </a>
            <a href="{{ route('register') }}" class="bg-green-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-green-700 transition">
                Sign Up
            </a>
        </div>
    </div>
</section>


<section id="eligibility" class="bg-gray-100 px-6 md:px-16 py-16">
    <h2 class="text-3xl font-bold text-gray-800 text-center mb-8">Check Your Eligibility</h2>

    <form class="max-w-3xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block font-semibold text-gray-700">Your Country</label>
            <select id="country" class="border rounded px-3 py-2 w-full">
                <option value="">-- Select Country --</option>
                @foreach($eligibilityData['countries'] as $country)
                    <option value="{{ $country }}">{{ $country }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-semibold text-gray-700">Your Institution</label>
            <select id="institution" class="border rounded px-3 py-2 w-full">
                <option value="">-- Select Institution --</option>
                @foreach($eligibilityData['institutions'] as $institution)
                    <option value="{{ $institution }}">{{ $institution }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-semibold text-gray-700">Course Type</label>
            <select id="courseType" class="border rounded px-3 py-2 w-full">
                <option value="">-- Select Course Type --</option>
                @foreach($eligibilityData['courseTypes'] as $courseType)
                    <option value="{{ $courseType }}">{{ $courseType }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-semibold text-gray-700">Loan Purpose</label>
            <select id="loanPurpose" class="border rounded px-3 py-2 w-full">
                <option value="">-- Select Loan Purpose --</option>
                @foreach($eligibilityData['loanPurposes'] as $purpose)
                    <option value="{{ $purpose }}">{{ $purpose }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-semibold text-gray-700">Your Age</label>
            <input type="number" id="age" class="border rounded px-3 py-2 w-full" 
                   placeholder="e.g. 20"
                   min="{{ $eligibilityData['minAge'] }}" 
                   max="{{ $eligibilityData['maxAge'] }}">
            <p class="text-xs text-gray-500 mt-1">Age must be between {{ $eligibilityData['minAge'] }} and {{ $eligibilityData['maxAge'] }}</p>
        </div>

        <div class="md:col-span-2 text-center">
            <button type="button" onclick="checkEligibility()"
                class="bg-blue-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-blue-700 transition">
                Check Eligibility
            </button>
        </div>
    </form>

    <div id="eligibility_result" class="mt-6 text-center font-semibold text-lg"></div>
</section>

<script>
const eligibilityConfig = @json($eligibilityData);

function checkEligibility() {
    const country     = document.getElementById('country').value;
    const institution = document.getElementById('institution').value;
    const courseType  = document.getElementById('courseType').value;
    const loanPurpose = document.getElementById('loanPurpose').value;
    const age         = parseInt(document.getElementById('age').value);
    const resultDiv   = document.getElementById('eligibility_result');

    if (!country || !institution || !courseType || !loanPurpose || !age) {
        resultDiv.innerHTML = '<span class="text-red-600">Please fill in all required fields.</span>';
        return;
    }

    if (!eligibilityConfig.countries.includes(country)) {
        resultDiv.innerHTML = '<span class="text-red-600">Sorry, loans are not available in your country.</span>';
        return;
    }

    if (!eligibilityConfig.institutions.includes(institution)) {
        resultDiv.innerHTML = '<span class="text-red-600">Sorry, your institution is not eligible.</span>';
        return;
    }

    if (!eligibilityConfig.courseTypes.includes(courseType)) {
        resultDiv.innerHTML = '<span class="text-red-600">Sorry, your course type is not eligible.</span>';
        return;
    }

    if (!eligibilityConfig.loanPurposes.includes(loanPurpose)) {
        resultDiv.innerHTML = '<span class="text-red-600">Sorry, that loan purpose is not available.</span>';
        return;
    }

    if (age < eligibilityConfig.minAge || age > eligibilityConfig.maxAge) {
        resultDiv.innerHTML = `<span class="text-red-400">Age must be between ${eligibilityConfig.minAge} and ${eligibilityConfig.maxAge} to apply.</span>`;
        return;
    }

    resultDiv.innerHTML = '<span class="text-green-400">You are likely eligible for a loan! Sign up to apply.</span>';
}
</script>



<section class="bg-gray-50 px-6 md:px-16 py-16">
    <h2 class="text-3xl font-bold text-gray-800 text-center mb-8">Available Loan Products</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full border rounded-lg text-left">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-6 py-3">Loan Product</th>
                    <th class="px-6 py-3">Interest Rate per Month (%)</th>
                    <th class="px-6 py-3">Min Amount (KES)</th>
                    <th class="px-6 py-3">Max Amount (KES)</th>
                    <th class="px-6 py-3">Grace Period (Months)</th>
                    <th class="px-6 py-3">Loan Term (Months)</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($loanProducts as $product)
                <tr class="border-b hover:bg-gray-100">
                    <td class="px-6 py-3">{{ $product->product_name }}</td>
                    <td class="px-6 py-3">{{ $product->interest_rate }}</td>
                    <td class="px-6 py-3">{{ number_format($product->min_loan_amount) }}</td>
                    <td class="px-6 py-3">{{ number_format($product->max_loan_amount) }}</td>
                    <td class="px-6 py-3">{{ $product->grace_period_months }}</td>
                    <td class="px-6 py-3">{{ $product->loan_term_months }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>


<section class="bg-gray-50 px-6 md:px-16 py-16">
    <h2 class="text-3xl font-bold text-gray-800 text-center mb-8">Estimate Your EMI</h2>

    <form class="max-w-3xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block font-semibold text-gray-700">Loan Product</label>
            <select id="loanPurposeCalc" class="border rounded px-3 py-2 w-full" onchange="updateTermHint()">
                <option value="">-- Select Loan Product --</option>
                @foreach($loanProducts as $product)
                    <option value="{{ $product->product_name }}">{{ $product->product_name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-semibold text-gray-700">Loan Amount (KES)</label>
            <input type="number" id="loan_amount" class="border rounded px-3 py-2 w-full" placeholder="e.g. 100000">
            <p id="amount_hint" class="text-xs text-gray-500 mt-1"></p>
        </div>

        <div>
            <label class="block font-semibold text-gray-700">Loan Term (Months)</label>
            <input type="number" id="term_months" class="border rounded px-3 py-2 w-full" placeholder="e.g. 12">
            <p id="term_hint" class="text-xs text-gray-500 mt-1"></p>
        </div>

        <div class="md:col-span-2 text-center">
            <button type="button" onclick="calculateLoan()"
                class="bg-green-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-green-700 transition">
                Calculate EMI
            </button>
        </div>
    </form>

    <p id="error_message" class="text-center text-red-600 font-semibold mt-4 hidden"></p>

    <div id="emi_result" class="mt-4 text-center font-semibold text-lg space-y-1 hidden">
        <p>Monthly Payment: <span id="monthly_payment_display">KES 0</span></p>
        <p>Total Interest: <span id="total_interest_display">KES 0</span></p>
        <p>Total Payable: <span id="total_payable_display">KES 0</span></p>
    </div>
</section>

<script>
const loanProducts = @json($loanProductsData);


function showError(msg) {
    const err = document.getElementById('error_message');
    err.textContent = msg;
    err.classList.remove('hidden');
    document.getElementById('emi_result').classList.add('hidden');
}

function clearError() {
    const err = document.getElementById('error_message');
    err.textContent = '';
    err.classList.add('hidden');
}

function updateTermHint() {
    const selected = document.getElementById('loanPurposeCalc').value;
    const termHint = document.getElementById('term_hint');
    const amountHint = document.getElementById('amount_hint');

    if (!selected || !loanProducts[selected]) {
        termHint.textContent = '';
        amountHint.textContent = '';
        return;
    }

    const p = loanProducts[selected];
    termHint.textContent = `Max term: ${p.maxTermMonths} months`;
    amountHint.textContent = `Range: KES ${Number(p.minAmount).toLocaleString()} – KES ${Number(p.maxAmount).toLocaleString()}`;
}

function calculateLoan() {
    clearError();

    const selected = document.getElementById('loanPurposeCalc').value;
    const P = parseFloat(document.getElementById('loan_amount').value);
    const T = parseInt(document.getElementById('term_months').value);

    if (!selected) {
        showError('Please select a loan product.');
        return;
    }

    const product = loanProducts[selected];

    if (!product) {
        showError('Selected loan product not found.');
        return;
    }

    if (!P || isNaN(P)) {
        showError('Please enter a valid loan amount.');
        return;
    }

    if (P < product.minAmount) {
        showError(`Minimum loan amount for ${selected} is KES ${Number(product.minAmount).toLocaleString()}.`);
        return;
    }

    if (P > product.maxAmount) {
        showError(`Maximum loan amount for ${selected} is KES ${Number(product.maxAmount).toLocaleString()}.`);
        return;
    }

    if (!T || isNaN(T) || T <= 0) {
        showError('Please enter a valid loan term.');
        return;
    }

    if (T > product.maxTermMonths) {
        showError(`Maximum loan term for ${selected} is ${product.maxTermMonths} months.`);
        return;
    }

    if (T <= product.gracePeriod) {
        showError(`Loan term must be greater than the grace period (${product.gracePeriod} months).`);
        return;
    }

    const r = product.interestRate / 100;
    const repaymentMonths = T - product.gracePeriod;
    const totalInterest  = P * r * repaymentMonths;
    const totalPayable   = P + totalInterest;
    const monthlyPayment = totalPayable / repaymentMonths;

    document.getElementById('monthly_payment_display').innerText = 'KES ' + monthlyPayment.toFixed(2);
    document.getElementById('total_interest_display').innerText  = 'KES ' + totalInterest.toFixed(2);
    document.getElementById('total_payable_display').innerText   = 'KES ' + totalPayable.toFixed(2);
    document.getElementById('emi_result').classList.remove('hidden');
}
</script>



<section class="px-6 md:px-16 py-16 bg-cover bg-center">
    <h2 class="text-3xl font-bold text-black text-center mb-12">How It Works</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-center">
        <div class="p-6 border rounded-lg shadow hover:shadow-lg transition transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110 ">
            <div class="text-sky-600 mb-4">
                <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V6m0 12v-2"></path>
                </svg>
            </div>
            <h3 class="font-semibold text-gray-800 text-xl mb-2">Apply Online</h3>
            <p class="text-gray-700 text-sm">Fill out the form, upload documents, and submit your application.</p>
        </div>

        <div class="p-6 border rounded-lg shadow hover:shadow-lg transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110 ">
            <div class="text-orange-500 mb-4">
                <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m-6-8h6"></path>
                </svg>
            </div>
            <h3 class="font-semibold text-gray-800 text-xl mb-2">Get Approval</h3>
            <p class="text-gray-700 text-sm">Application is reviewed quickly, and approval is granted within days.</p>
        </div>

        <div class="p-6 border rounded-lg shadow hover:shadow-lg transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110 ">
            <div class="text-yellow-500 mb-4">
                <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h3 class="font-semibold text-gray-800 text-xl mb-2">Receive Funds</h3>
            <p class="text-gray-700 text-sm">Once approved, funds are transferred safely to your account.</p>
        </div>
    </div>
</section>

{{-- Why Choose Us --}}
<section class="bg-gray-50 px-6 md:px-16 py-16">
    <h2 class="text-3xl font-bold text-gray-800 text-center mb-12">Why Choose Us?</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <div class="p-6 border rounded-lg bg-primary-400 shadow hover:shadow-lg transition">
            <h3 class="font-semibold text-black text-xl mb-2">Flexible Loan Purposes</h3>
            <p class="text-black text-sm">Use the funds for tuition, accommodation, books, devices, or emergencies.</p>
        </div>
        <div class="p-6 border rounded-lg bg-gradient-to-bl from-violet-500 to-fuchsia-500 shadow hover:shadow-lg transition">
            <h3 class="font-semibold text-black text-xl mb-2">Fast Approval</h3>
            <p class="text-black text-sm">Quick review ensures you get funds when you need them.</p>
        </div>
        <div class="p-6 border rounded-lg bg-primary-500 shadow hover:shadow-lg transition">
            <h3 class="font-semibold text-black text-xl mb-2">Flexible Repayment</h3>
            <p class="text-black text-sm">Student-friendly repayment plans tailored to your financial situation.</p>
        </div>
        <div class="p-6 border rounded-lg bg-primary-600 shadow hover:shadow-lg transition">
            <h3 class="font-semibold text-black text-xl mb-2">Transparent & Secure</h3>
            <p class="text-black text-sm">Track your loan and repayments anytime with no hidden charges.</p>
        </div>
    </div>
</section>

{{-- FAQs Accordion --}}
<section class="px-6 md:px-16 py-16">
    <h2 class="text-3xl font-bold text-gray-800 text-center mb-12">Frequently Asked Questions</h2>

    <div class="max-w-4xl mx-auto space-y-4">
        <div x-data="{ open: false }" class="border rounded-lg">
            <button @click="open = !open" class="w-full flex justify-between items-center px-4 py-3 text-left font-semibold text-gray-800">
                Who can apply for a student loan?
                <span x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" class="px-4 py-3 text-gray-700 border-t">
                Any student enrolled in an accredited institution with a valid ID and proof of admission can apply.
            </div>
        </div>

        <div x-data="{ open: false }" class="border rounded-lg">
            <button @click="open = !open" class="w-full flex justify-between items-center px-4 py-3 text-left font-semibold text-gray-800">
                Do I need a co-applicant?
                <span x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" class="px-4 py-3 text-gray-700 border-t">
                Some loans may require a guarantor depending on the loan amount and risk assessment.
            </div>
        </div>

        <div x-data="{ open: false }" class="border rounded-lg">
            <button @click="open = !open" class="w-full flex justify-between items-center px-4 py-3 text-left font-semibold text-gray-800">
                Does checking eligibility affect my credit score?
                <span x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" class="px-4 py-3 text-gray-700 border-t">
                No, our eligibility check is soft and does not impact your credit score.
            </div>
        </div>

        <div x-data="{ open: false }" class="border rounded-lg">
            <button @click="open = !open" class="w-full flex justify-between items-center px-4 py-3 text-left font-semibold text-gray-800">
                When do I start repaying?
                <span x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" class="px-4 py-3 text-gray-700 border-t">
                Repayment typically starts after course completion or after a grace period defined in the loan product.
            </div>
        </div>
    </div>
</section>

{{-- Final CTA --}}
<section class="bg-cover text-white px-6 md:px-16 py-16 text-center" style="background-image: url('{{ asset('assets/bg.jpg') }}');">
    <h2 class="text-3xl md:text-4xl font-bold mb-6">Ready to start your student loan?</h2>
    <p class="text-lg mb-8">Apply today and take the first step toward achieving your academic goals with ease and confidence.</p>
    <a href="{{ route('register') }}" class="bg-green-600 text-white px-8 py-4 rounded-full font-semibold hover:bg-green-700 transition">
        Sign Up Now
    </a>
</section>

@endsection
