@extends('layouts.web')

@section('title', 'Home')

@section('content')

<section 
class="flex flex-col md:flex-row items-center  bg-center py-6 gap-2 ">
    
    

    <div class="flex-1">
        <img src="{{ asset('assets/students.jpg') }}" alt="Student Loan" class="rounded-xl shadow-lg   mx-auto">
    </div>

    
    <div class="flex-1 space-y-6">
        <h1 class="text-3xl md:text-5xl font-bold text-gray-800 leading-tight">
            Student Loans Made Simple
        </h1>

        <p class="text-gray-600 text-lg">
            Welcome to <span class="font-semibold text-gray-800">Student Loan</span>, a student-focused digital loan platform designed to support learners in achieving their academic goals. We offer accessible, affordable, and transparent financing solutions tailored specifically for students.
        </p>

        <p class="text-gray-600">
            Cover tuition fees, learning materials, accommodation, and other academic expenses easily with a simple and secure online application.
        </p>

</section>


<section class="bg-gray-50 px-6 md:px-16 py-16">
    <h2 class="text-3xl font-bold text-gray-800 text-center mb-12">Why Choose Us?</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <div class="p-6 border rounded-lg bg-primary-400 shadow hover:shadow-lg transition">
            <h3 class="font-semibold text-black text-xl mb-2">Easy Application</h3>
            <p class="text-gray-700 text-sm">
                Apply for a loan online in minutes with minimal paperwork.
            </p>
        </div>

        <div class="p-6 border rounded-lg bg-gradient-to-bl from-violet-500 to-fuchsia-500 shadow hover:shadow-lg transition">
            <h3 class="font-semibold text-black text-xl mb-2">Fast Approval</h3>
            <p class="text-gray-700 text-sm">
                Quick review and approval so you can focus on your studies.
            </p>
        </div>

        <div class="p-6 border rounded-lg bg-primary-500 shadow hover:shadow-lg transition">
            <h3 class="font-semibold text-black text-xl mb-2">Flexible Repayment</h3>
            <p class="text-gray-700 text-sm">
                Student-friendly repayment plans designed for your convenience.
            </p>
        </div>

        <div class="p-6 border rounded-lg bg-primary-600 shadow hover:shadow-lg transition">
            <h3 class="font-semibold text-black text-xl mb-2">Secure & Transparent</h3>
            <p class="text-gray-700 text-sm">
                No hidden charges. Track your loan and repayments anytime.
            </p>
        </div>
    </div>
</section>


<section
  class="px-6 md:px-16 py-16 bg-cover bg-center"
  
>

    <h2 class="text-3xl font-bold text-black text-center mb-12">How It Works</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-center">
        <div class="p-6 border rounded-lg shadow hover:shadow-lg transition">
            <div class="text-sky-600 mb-4">
                
                <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V6m0 12v-2"></path>
                </svg>
            </div>
            <h3 class="font-semibold text-gray-800 text-xl mb-2">Apply Online</h3>
            <p class="text-gray-700 text-sm">
                Fill out the simple online form and submit required documents.
            </p>
        </div>

        <div class="p-6 border rounded-lg shadow hover:shadow-lg transition">
            <div class="text-orange-500 mb-4">
                <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m-6-8h6"></path>
                </svg>
            </div>
            <h3 class="font-semibold text-gray-800 text-xl mb-2">Get Approval</h3>
            <p class="text-gray-700 text-sm">
                Your application is reviewed quickly and approved within days.
            </p>
        </div>

        <div class="p-6 border rounded-lg shadow hover:shadow-lg transition">
            <div class="text-yellow-500 mb-4">
                <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h3 class="font-semibold text-gray-800 text-xl mb-2">Receive Funds</h3>
            <p class="text-gray-700 text-sm">
                Once approved, funds are transferred safely to your account.
            </p>
        </div>
    </div>
</section>


<section class="bg-cover text-white px-6 md:px-16 py-16 text-center"
style="background-image: url('{{ asset('assets/bg.jpg') }}');">
    
    <h2 class="text-3xl md:text-4xl font-bold mb-6">Ready to start your student loan?</h2>
    <p class="text-lg mb-8">Apply today and take the first step toward achieving your academic goals with ease and confidence.</p> 
</section>

@endsection
