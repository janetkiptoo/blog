@extends('layouts.web')

@section('title', 'Contact Us')

@section('content')
<section class="max-w-6xl mx-auto py-16 px-6 space-y-14 min-h-screen">

    {{-- Header --}}
    <div class="text-center space-y-3">
        <h1 class="text-4xl font-bold text-gray-800">Contact Us</h1>
        <p class="text-gray-600 max-w-2xl mx-auto">
            Need help with your loan application, eligibility, or repayments?
            Our support team is here to assist you.
        </p>
    </div>

    {{-- Contact Info --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
        <div class="p-6 border rounded-lg shadow-sm">
            <h3 class="font-semibold text-lg text-gray-800 mb-2">Phone Support</h3>
            <p class="text-gray-700">0711 111 111</p>
            <p class="text-sm text-gray-500">Mon – Fri, 9:00 AM – 5:00 PM</p>
        </div>

        <div class="p-6 border rounded-lg shadow-sm">
            <h3 class="font-semibold text-lg text-gray-800 mb-2">Email Support</h3>
            <p class="text-gray-700">support@studentloan.com</p>
            <p class="text-sm text-gray-500">We respond within 24–48 hours</p>
        </div>

        <div class="p-6 border rounded-lg shadow-sm">
            <h3 class="font-semibold text-lg text-gray-800 mb-2">Location</h3>
            <p class="text-gray-700">Kenya</p>
            <p class="text-sm text-gray-500">Serving eligible institutions nationwide</p>
        </div>
    </div>

    {{-- Contact Form --}}
    <div class="max-w-3xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">
            Send Us a Message
        </h2>

        <form method="POST" action="{{ route('contact.store') }}" class="space-y-6 bg-gray-50 p-8 rounded-lg shadow">
    @csrf

            <div>
                <label class="block font-semibold text-gray-700">Full Name</label>
                <input type="text" class="w-full border rounded px-4 py-2" placeholder="Your name">
            </div>

            <div>
                <label class="block font-semibold text-gray-700">Email Address</label>
                <input type="email" class="w-full border rounded px-4 py-2" placeholder="you@example.com">
            </div>

            <div>
                <label class="block font-semibold text-gray-700">Inquiry Type</label>
                <select class="w-full border rounded px-4 py-2">
                    <option>Loan Application</option>
                    <option>Eligibility</option>
                    <option>Repayment</option>
                    <option>Technical Issue</option>
                    <option>Other</option>
                </select>
            </div>

            <div>
                <label class="block font-semibold text-gray-700">Message</label>
                <textarea rows="4" class="w-full border rounded px-4 py-2"
                    placeholder="Describe your issue or question"></textarea>
            </div>

            <div class="text-center">
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-blue-700 transition">
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
