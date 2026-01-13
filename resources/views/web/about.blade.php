@extends('layouts.web')

@section('title', 'about ')

@section('content')


<section class="max-w-5xl mx-auto space-y-10 flex flex-col min-h-screen">
    <div class="text-center">
        <h1 class="text-4xl font-bold text-gray-800">About Us</h1>
        <p class="mt-4 max-w-2xl mx-auto text-gray-700">
            Learn more about our mission, vision, and commitment to students.
        </p>
    </div>

    <div>
        <h2 class="text-2xl font-bold mb-3">Who We Are</h2>
        <p class="leading-relaxed text-gray-700">
            StudentLoan is a student-centered financial platform dedicated to supporting
            learners in achieving their academic goals. We provide accessible, transparent,
            and affordable loan solutions designed specifically for students.
        </p>
    </div>

    <div>
        <h2 class="text-2xl font-bold mb-3">What We Do</h2>
        <ul class="list-disc list-inside text-gray-700 space-y-2">
            <li>Provide loans for tuition and academic expenses</li>
            <li>Offer flexible repayment options suitable for students</li>
            <li>Ensure transparency in loan terms and conditions</li>
            <li>Protect student data using secure systems</li>
        </ul>
    </div>
</section>
@endsection