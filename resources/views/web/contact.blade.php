@extends('layouts.web')

@section('title', 'Contact Us')

@section('content')
<section class="max-w-6xl mx-auto py-16 px-6 space-y-14 min-h-screen">

    <div class="text-center space-y-3">
        <h1 class="text-4xl font-bold text-gray-800">Contact Us</h1>
        <p class="text-gray-600 max-w-2xl mx-auto">
            Need help with your loan application, eligibility, or repayments?
            Our support team is here to assist you.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
        <div class="p-6 border rounded-lg shadow-sm">
            <h3 class=" text-lg text-black mb-2">Phone Support</h3>
            <p class="text-gray-700">0711 111 111</p>
            <p class="text-sm text-gray-500">Mon – Fri, 9:00 AM – 5:00 PM</p>
        </div>

        <div class="p-6 border rounded-lg shadow-sm">
            <h3 class=" text-lg text-black mb-2">Email Support</h3>
            <p class="text-gray-700">support@studentloan.com</p>
            <p class="text-sm text-gray-500">We respond within 24–48 hours</p>
        </div>

        <div class="p-6 border rounded-lg shadow-sm">
            <h3 class="text-lg text-black mb-2">Location</h3>
            <p class="text-gray-700">Kenya</p>
            <p class="text-sm text-gray-500">Serving eligible institutions nationwide</p>
        </div>
    </div>

    
    <div class="max-w-3xl mx-auto">
        <h2 class="text-2xl font-bold text-black mb-6 text-center">
            Send Us a Message
        </h2>

       <form method="POST" action="{{ route('contact.store') }}"
      class="space-y-6 bg-gray-50 p-8 rounded-lg shadow">
    @csrf

    <div>
        <label class="block font-semibold text-gray-700">Full Name</label>
        <input type="text" name="name"class="w-full border rounded px-4 py-2 value="{{ old('name') }}">
    </div>

    <div>
        <label class="block font-semibold text-gray-700">Email Address</label>
        <input type="email" name="email" class="w-full border rounded px-4 py-2" value="{{ old('email') }}">
    </div>

    <div>
        <label class="block font-semibold text-gray-700">Inquiry Type</label>
        <select name="category" class="w-full border rounded px-4 py-2">
            <option value="">-- Select --</option>
            <option value="Loan Application">Loan Application</option>
            <option value="Eligibility">Eligibility</option>
            <option value="Repayment">Repayment</option>
            <option value="Technical Issue">Technical Issue</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div>
        <label class="block font-semibold text-gray-700">Message</label>
        <textarea name="message" rows="4"class="w-full border rounded px-4 py-2">{{ old('message') }}</textarea>
    </div>

    <div class="text-center">
        <button type="submit"class="bg-blue-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-blue-700">
            Submit Message
        </button>
    </div>
</form>

        @if(session('success'))
    <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
        {{ session('success') }}
    </div>
@endif
    </div>
    {{-- Disclaimer --}}
    <div class="text-center text-sm text-gray-500 max-w-3xl mx-auto">
        <p>
            Please do not share sensitive personal or financial information through this form.
            Contacting support does not guarantee loan approval.
        </p>
    </div>

</section>
@endsection
