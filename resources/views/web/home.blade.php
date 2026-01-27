@extends('layouts.web')

@section('title', 'home ')

@section('content')


 <section class="flex bg-white px-6 md:px-10 py-10 gap-6  min-h-screen">
    
    <div><img src="{{ asset('assets/students.jpg') }}" alt="Application Logo "class="px-50 py-50"></div>
      <div class="space-y-6">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 leading-tight">Student loans made simple </h1>

            <p class="text-gray-600 text-lg">
                Welcome to <span class="font-semibold text-gray-800">Student Loan</span>, a student-focused
                digital loan platform designed to support learners in achieving their academic goals.
                We offer accessible, affordable, and transparent financing solutions tailored
                specifically for students.
            </p>

            <p class="text-gray-600">
                Our platform helps students cover essential academic expenses such as tuition fees,
                learning materials, accommodation, and other study-related costs all through a
                simple and secure online application process.
            </p>


            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6 ">
                <div class="p-8 border rounded-lg bg-sky-400">
                    <h3 class="font-semibold text-gray-800">Easy Application</h3>
                    <p class="text-sm text-gray-600">
                        Apply for a loan online in minutes with minimal paperwork.
                    </p>
                </div>

                <div class="p-8 border rounded-lg bg-orange-300">
                    <h3 class="font-semibold text-gray-800 ">Fast Approval</h3>
                    <p class="text-sm text-gray-600">
                        Quick review and approval so you can focus on your studies.
                    </p>
                </div>

                <div class="p-8 border rounded-lg bg-yellow-300">
                    <h3 class="font-semibold text-gray-800">Flexible Repayment</h3>
                    <p class="text-sm text-gray-600">
                        Student-friendly repayment plans.
                    </p>
                </div>

                <div class="p-8 border rounded-lg bg-pink-300">
                    <h3 class="font-semibold text-gray-800">Secure & Transparent</h3>
                    <p class="text-sm text-gray-600">
                        No hidden charges. Track your loan and repayments anytime.
                    </p>
                </div>
            </div>

   
</section>

@endsection