@extends('layouts.web')

@section('title', 'Home')

@section('content')

{{-- Hero Section --}}
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
            <a href="#eligibility" class="bg-blue-600 text-white px-6 py-3 rounded font-semibold hover:bg-blue-700 transition">
                Check Eligibility
            </a>
            <a href="{{ route('register') }}" class="bg-green-600 text-white px-6 py-3 rounded font-semibold hover:bg-green-700 transition">
                Sign Up
            </a>
        </div>
    </div>
</section>


{{-- Eligibility Check --}}
<section id="eligibility" class="bg-gray-100 px-6 md:px-16 py-16">
    <h2 class="text-3xl font-bold text-gray-800 text-center mb-8">Check Your Eligibility</h2>

    <form class="max-w-3xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block font-semibold text-gray-700">Your Country</label>
            <select id="country" class="border rounded px-3 py-2 w-full">
                <option value="Kenya">Kenya</option>
            </select>
        </div>

        <div>
            <label class="block font-semibold text-gray-700">Your Institution</label>
            <select id="institution" class="border rounded px-3 py-2 w-full">
                <option value="University of Nairobi">University of Nairobi</option>
                <option value="BD Computing">BD Computing</option>
                <option value="Kabarak">Kabarak</option>
                <option value="Moi University">Moi University</option>
            </select>
        </div>

        <div>
            <label class="block font-semibold text-gray-700">Course Type</label>
            <select id="courseType" class="border rounded px-3 py-2 w-full">
                <option value="Undergraduate">Undergraduate</option>
                <option value="Postgraduate">Postgraduate</option>
                <option value="Vocational">Vocational</option>
            </select>
        </div>

        <div>
            <label class="block font-semibold text-gray-700">Loan Purpose</label>
            <select id="loanPurpose" class="border rounded px-3 py-2 w-full">
                <option value="Tuition Fees">Tuition Fees</option>
                <option value="Personal Loan">Personal Loan</option>
                <option value="Emergency / Other">Emergency / Other</option>
            </select>
        </div>

        <div>
            <label class="block font-semibold text-gray-700">Your Age</label>
            <input type="number" id="age" class="border rounded px-3 py-2 w-full" placeholder="20">
        </div>

        <div class="md:col-span-2 text-center">
            <button type="button" onclick="checkEligibility()" class="bg-blue-600 text-white px-6 py-3 rounded font-semibold hover:bg-blue-700 transition">
                Check Eligibility
            </button>
        </div>
    </form>

    <div id="eligibility_result" class="mt-6 text-center font-semibold text-lg"></div>
</section>

<script>
const eligibleCountries = ['Kenya'];
const eligibleInstitutions = ['University of Nairobi', 'BD Computing', 'Kabarak', 'Moi University'];
const minAge = 18;
const maxAge = 35;

function checkEligibility() {
    const country = document.getElementById('country').value;
    const institution = document.getElementById('institution').value;
    const courseType = document.getElementById('courseType').value;
    const loanPurpose = document.getElementById('loanPurpose').value;
    const age = parseInt(document.getElementById('age').value);
    const resultDiv = document.getElementById('eligibility_result');

    if (!country || !institution || !age) {
        resultDiv.innerHTML = '<span class="text-red-600">Please fill in all required fields.</span>';
        return;
    }

    if (!eligibleCountries.includes(country)) {
        resultDiv.innerHTML = '<span class="text-red-600"> Sorry, loans are not available in your country.</span>';
        return;
    }

    if (!eligibleInstitutions.includes(institution)) {
        resultDiv.innerHTML = '<span class="text-red-600"> Sorry, your institution is not eligible.</span>';
        return;
    }

    if (age < minAge || age > maxAge) {
        resultDiv.innerHTML = `<span class="text-red-600"> Age must be between ${minAge} and ${maxAge} to apply.</span>`;
        return;
    }

    if ((loanPurpose === 'Tuition Fees' || loanPurpose === 'Accommodation') &&
        (courseType === 'Undergraduate' || courseType === 'Postgraduate')) {
        resultDiv.innerHTML = '<span class="text-green-600">You are likely eligible for a loan! Sign up to apply.</span>';
    } else {
        resultDiv.innerHTML = '<span class="text-red-600">Based on the info provided, you may not be eligible. Sign up for full evaluation.</span>';
    }
}
</script>



{{-- Loan Products Section --}}
<section class="bg-gray-50 px-6 md:px-16 py-16">
    <h2 class="text-3xl font-bold text-gray-800 text-center mb-8">Available Loan Products</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full border rounded-lg text-left">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-6 py-3">Loan Purpose</th>
                    <th class="px-6 py-3">Interest Rate (%)</th>
                    <th class="px-6 py-3">Max Amount (KES)</th>
                    <th class="px-6 py-3">Grace Period (Months)</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <tr class="border-b hover:bg-gray-100">
                    <td class="px-6 py-3">Tuition Fees</td>
                    <td class="px-6 py-3">1.5</td>
                    <td class="px-6 py-3">500,000</td>
                    <td class="px-6 py-3">3</td>
                </tr>
                <tr class="border-b hover:bg-gray-100">
                    <td class="px-6 py-3">Personal Loan</td>
                    <td class="px-6 py-3">2</td>
                    <td class="px-6 py-3">300,000</td>
                    <td class="px-6 py-3">2</td>
                </tr>
               
                <tr class="border-b hover:bg-gray-100">
                    <td class="px-6 py-3">Emergency / Other</td>
                    <td class="px-6 py-3">1</td>
                    <td class="px-6 py-3">200,000</td>
                    <td class="px-6 py-3">0</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

{{-- EMI Calculator --}}
<section class="bg-gray-50 px-6 md:px-16 py-16">
    <h2 class="text-3xl font-bold text-gray-800 text-center mb-8">Estimate Your EMI</h2>

    <form class="max-w-3xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block font-semibold text-gray-700">Loan Purpose</label>
            <select id="loanPurposeCalc" class="border rounded px-3 py-2 w-full">
                <option>Tuition Fees</option>
                <option>Personal loan</option>
                <option>Emergency / Other</option>
            </select>
        </div>

        <div>
            <label class="block font-semibold text-gray-700">Loan Amount (KES)</label>
            <input type="number" id="loan_amount" class="border rounded px-3 py-2 w-full" placeholder="100000">
        </div>

        <div>
            <label class="block font-semibold text-gray-700">Loan Term (Months)</label>
            <input type="number" id="term_months" class="border rounded px-3 py-2 w-full" placeholder="12">
        </div>

        <div class="md:col-span-2 text-center">
            <button type="button" onclick="calculateLoan()" class="bg-green-600 text-white px-6 py-3 rounded font-semibold hover:bg-green-700 transition">
                Calculate EMI
            </button>
        </div>
    </form>

    <div id="emi_result" class="mt-4 text-center font-semibold text-lg space-y-1">
        <p>Monthly Payment: <span id="monthly_payment_display">KES 0</span></p>
        <p>Total Interest: <span id="total_interest_display">KES 0</span></p>
        <p>Total Payable: <span id="total_payable_display">KES 0</span></p>
    </div>
</section>

<script>
const loanProducts = {
    'Tuition Fees': { interestRate: 1.5, gracePeriod: 3, maxAmount: 500000 },
    'Personal loan': { interestRate: 2, gracePeriod: 2, maxAmount: 300000 },
    'Emergency / Other': { interestRate: 1, gracePeriod: 0, maxAmount: 200000 }
};

function calculateLoan() {
    const loanPurpose = document.getElementById('loanPurposeCalc').value;
    const P = parseFloat(document.getElementById('loan_amount').value);
    const T = parseInt(document.getElementById('term_months').value);

    const resultDiv = document.getElementById('emi_result');

    if (!loanProducts[loanPurpose]) return;

    const r = loanProducts[loanPurpose].interestRate / 100;
    const grace = loanProducts[loanPurpose].gracePeriod;
    const maxAmount = loanProducts[loanPurpose].maxAmount;

    if (!P || !T || T <= grace) {
        resultDiv.innerText = 'Please enter a valid loan amount and term.';
        return;
    }

    if (P > maxAmount) {
        resultDiv.innerText = `Maximum loan amount for ${loanPurpose} is KES ${maxAmount.toLocaleString()}.`;
        return;
    }

    const repaymentMonths = T - grace;
    const totalInterest = P * r * repaymentMonths;
    const totalPayable  = P + totalInterest;
    const monthlyPayment = totalPayable / repaymentMonths;

    document.getElementById('monthly_payment_display').innerText = 'KES ' + monthlyPayment.toFixed(2);
    document.getElementById('total_interest_display').innerText = 'KES ' + totalInterest.toFixed(2);
    document.getElementById('total_payable_display').innerText = 'KES ' + totalPayable.toFixed(2);
}
</script>

{{-- How It Works --}}
<section class="px-6 md:px-16 py-16 bg-cover bg-center">
    <h2 class="text-3xl font-bold text-black text-center mb-12">How It Works</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-center">
        <div class="p-6 border rounded-lg shadow hover:shadow-lg transition">
            <div class="text-sky-600 mb-4">
                <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V6m0 12v-2"></path>
                </svg>
            </div>
            <h3 class="font-semibold text-gray-800 text-xl mb-2">Apply Online</h3>
            <p class="text-gray-700 text-sm">Fill out the form, upload documents, and submit your application.</p>
        </div>

        <div class="p-6 border rounded-lg shadow hover:shadow-lg transition">
            <div class="text-orange-500 mb-4">
                <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m-6-8h6"></path>
                </svg>
            </div>
            <h3 class="font-semibold text-gray-800 text-xl mb-2">Get Approval</h3>
            <p class="text-gray-700 text-sm">Application is reviewed quickly, and approval is granted within days.</p>
        </div>

        <div class="p-6 border rounded-lg shadow hover:shadow-lg transition">
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
    <a href="{{ route('register') }}" class="bg-green-600 text-white px-8 py-4 rounded font-semibold hover:bg-green-700 transition">
        Sign Up Now
    </a>
</section>

@endsection
