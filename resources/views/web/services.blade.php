@extends('layouts.web')

@section('title', 'Our Services')

@section('content')

<section class="max-w-6xl mx-auto py-16 px-6 space-y-20 min-h-screen">

    {{-- Header --}}
    <div class="text-center max-w-3xl mx-auto">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">
            Our Student Loan Services
        </h1>
        <p class="text-gray-600 leading-relaxed">
            We provide transparent, affordable, and student-friendly loan solutions
            designed to support your academic journey from enrollment to graduation.
        </p>
    </div>

    {{-- Services --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

        <div class="bg-gray-100 p-8 rounded-2xl text-center hover:shadow-lg transition">
            <div class="flex justify-center mb-5">
                <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold mb-3">Loan Options</h3>
            <p class="text-gray-700">
                Funding for tuition, accommodation, learning materials,
                and other academic-related expenses.
            </p>
        </div>

        <div class="bg-gray-100 p-8 rounded-2xl text-center hover:shadow-lg transition">
            <div class="flex justify-center mb-5">
                <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M8 7V3m8 4V3M3 11h18"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold mb-3">Flexible Repayment</h3>
            <p class="text-gray-700">
                Repayment plans structured around your financial capacity
                during and after your studies.
            </p>
        </div>

        <div class="bg-gray-100 p-8 rounded-2xl text-center hover:shadow-lg transition">
            <div class="flex justify-center mb-5">
                <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold mb-3">Simple Eligibility</h3>
            <p class="text-gray-700">
                Straightforward eligibility requirements for students
                enrolled in recognized institutions.
            </p>
        </div>

    </div>

    {{-- Pricing Overview --}}
    <section class="bg-white rounded-2xl shadow-sm p-12 space-y-12">

        <div class="text-center max-w-2xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">
                Transparent Loan Pricing
            </h2>
            <p class="text-gray-600">
                Our pricing is clear and student-friendly,
                with no hidden fees or surprise charges.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <div class="border rounded-xl p-8 text-center hover:shadow-md transition">
                <h4 class="text-lg font-semibold text-gray-700 mb-2">
                    Interest Rate
                </h4>
                <p class="text-4xl font-bold text-blue-600 mb-2">
                    5% – 8%
                </p>
                <p class="text-gray-500">
                    Annual rate based on loan type
                </p>
            </div>

            <div class="border rounded-xl p-8 text-center hover:shadow-md transition">
                <h4 class="text-lg font-semibold text-gray-700 mb-2">
                    Loan Amount
                </h4>
                <p class="text-4xl font-bold text-blue-600 mb-2">
                    KES 10K – 500K
                </p>
                <p class="text-gray-500">
                    Depending on eligibility
                </p>
            </div>

            <div class="border rounded-xl p-8 text-center hover:shadow-md transition">
                <h4 class="text-lg font-semibold text-gray-700 mb-2">
                    Repayment Period
                </h4>
                <p class="text-4xl font-bold text-blue-600 mb-2">
                    Up to 48 Months
                </p>
                <p class="text-gray-500">
                    Flexible duration
                </p>
            </div>

        </div>
    </section>

    {{-- Testimonials --}}
    <section class="space-y-12">

        <div class="text-center max-w-2xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">
                What Students Say
            </h2>
            <p class="text-gray-600">
                Real experiences from students who have benefited from our loans.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <div class="bg-gray-100 p-8 rounded-2xl">
                <p class="text-gray-700 mb-6">
                    “The loan process was fast and transparent.
                    I was able to focus on my studies without financial stress.”
                </p>
                <h4 class="font-semibold text-gray-800">
                    Janet K.
                </h4>
                <p class="text-sm text-gray-500">
                    Computer Science Student
                </p>
            </div>

            <div class="bg-gray-100 p-8 rounded-2xl">
                <p class="text-gray-700 mb-6">
                    “Flexible repayment terms made it easy to manage my finances
                    while still in school.”
                </p>
                <h4 class="font-semibold text-gray-800">
                    Brian M.
                </h4>
                <p class="text-sm text-gray-500">
                    Engineering Student
                </p>
            </div>

            <div class="bg-gray-100 p-8 rounded-2xl">
                <p class="text-gray-700 mb-6">
                    “The support team was responsive and helpful.
                    I felt confident throughout the process.”
                </p>
                <h4 class="font-semibold text-gray-800">
                    Amina S.
                </h4>
                <p class="text-sm text-gray-500">
                    Business Student
                </p>
            </div>

        </div>
    </section>

    {{-- CTA --}}
    <div class="text-center">
        <a href="{{ route('web.contact') }}"
           class="inline-block bg-blue-600 text-white px-10 py-4 rounded-full font-semibold hover:bg-blue-700 transition">
            Apply or Ask a Question
        </a>
    </div>

</section>

@endsection
