@extends('layouts.web')

@section('title', 'about ')

@section('content')

<section class="max-w-5xl mx-auto py-10 px-6  flex flex-col min-h-screen space-y-10">

    <div class="text-center">
        <h1 class="text-4xl font-bold text-gray-800 mb-6">Our Services</h1>
        <p class="text-gray-700">We provide flexible and transparent student loan solutions to help learners succeed academically.</p>
    </div>

    <div class="grid md:grid-cols-2 gap-9">
        <div class="bg-gray-300 p-2 rounded-lg ">
            <h2 class="text-2xl font-bold mb-2">Loan Options</h2>
            <p class="text-gray-700">Tuition, textbooks, accommodation  we provide loans for all your academic needs.</p>
        </div>
        <div class="bg-gray-300 p-6 rounded-lg ">
            <h2 class="text-2xl font-bold mb-2">Repayment Plans</h2>
            <p class="text-gray-700">Flexible repayment schedules with low-interest rates to make it easier for students.</p>
        </div>
        <div class="bg-gray-300 p-6 rounded-lg shadow">
            <h2 class="text-2xl font-bold mb-2">Eligibility & Application</h2>
            <p class="text-gray-700">Easy online application for eligible students enrolled in recognized institutions.</p>
        </div>
        </section>
        @endsection