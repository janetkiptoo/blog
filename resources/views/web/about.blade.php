@extends('layouts.web')

@section('title', 'About Us')

@section('content')

<section 
    x-data="{ show: false }"
    x-init="setTimeout(() => show = true, 100)"
    class="max-w-6xl mx-auto px-4 py-16 space-y-20 min-h-screen"
>

    {{-- HERO --}}
    <div
        x-show="show"
        x-transition:enter="transition ease-out duration-700"
        x-transition:enter-start="opacity-0 translate-y-6"
        x-transition:enter-end="opacity-100 translate-y-0"
        class="text-center space-y-4"
    >
        <h1 class="text-4xl md:text-5xl font-bold text-gray-800">
            About StudentLoan
        </h1>

        <p class="max-w-2xl mx-auto text-gray-600 text-lg">
            Empowering students through accessible, transparent, and secure financial support.
        </p>
    </div>

    {{-- WHO WE ARE --}}
    <div
        x-data="{ visible: false }"
        x-intersect.once="visible = true"
        x-show="visible"
        x-transition:enter="transition ease-out duration-700"
        x-transition:enter-start="opacity-0 translate-x-8"
        x-transition:enter-end="opacity-100 translate-x-0"
        class="grid md:grid-cols-2 gap-10 items-center"
    >
        <div>
            <h2 class="text-2xl font-bold mb-4">Who We Are</h2>
            <p class="text-gray-700 leading-relaxed">
                StudentLoan is a student-centered financial platform dedicated to helping
                learners pursue higher education without financial barriers. Our solutions
                are built with students in mind flexible, transparent, and reliable.
            </p>
        </div>

        <div class="bg-blue-50 p-8 rounded-xl shadow-sm">
            <p class="text-blue-800 text-lg font-semibold">
                Education should be a right, not a privilege.
            </p>
        </div>
    </div>

    {{-- MISSION & VISION --}}
    <div
        x-data="{ visible: false }"
        x-intersect.once="visible = true"
        x-show="visible"
        x-transition:enter="transition ease-out duration-700"
        x-transition:enter-start="opacity-0 translate-y-8"
        x-transition:enter-end="opacity-100 translate-y-0"
        class="bg-gray-50 rounded-2xl p-10 space-y-8"
    >
        <div>
            <h2 class="text-2xl font-bold mb-3">Our Mission</h2>
            <p class="text-gray-700 leading-relaxed">
                To remove financial obstacles to education by providing student-friendly loan
                solutions that allow learners to focus on what truly matters — their studies.
            </p>
        </div>

        <div>
            <h2 class="text-2xl font-bold mb-3">Our Vision</h2>
            <p class="text-gray-700 leading-relaxed">
                A future where every student has equal access to education regardless of
                financial background.
            </p>
        </div>
    </div>

    
    <div
        x-data="{ visible: false }"
        x-intersect.once="visible = true"
        x-show="visible"
        x-transition:enter="transition ease-out duration-700"
        x-transition:enter-start="opacity-0 translate-x-[-20px]"
        x-transition:enter-end="opacity-100 translate-x-0"
    >
        <h2 class="text-2xl font-bold mb-6 text-center">What We Do</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="p-6 border rounded-xl hover:shadow transition">
                Provide loans for tuition and academic expenses
            </div>
            <div class="p-6 border rounded-xl hover:shadow transition">
                Offer flexible repayment options suitable for students
            </div>
            <div class="p-6 border rounded-xl hover:shadow transition">
                Ensure transparency in all loan terms and conditions
            </div>
            <div class="p-6 border rounded-xl hover:shadow transition">
                Protect student data using secure systems
            </div>
        </div>
    </div>

   
    <div
        x-data="{ visible: false }"
        x-intersect.once="visible = true"
        x-show="visible"
        x-transition:enter="transition ease-out duration-700"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
    >
        <h2 class="text-2xl font-bold mb-8 text-center">Why Choose Us</h2>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 text-center">
            <div class="p-6 bg-white rounded-xl shadow-sm">
                <h3 class="font-semibold mb-2">Student-First</h3>
                <p class="text-gray-600 text-sm">
                    Designed specifically for student needs.
                </p>
            </div>

            <div class="p-6 bg-white rounded-xl shadow-sm">
                <h3 class="font-semibold mb-2">Transparent</h3>
                <p class="text-gray-600 text-sm">
                    No hidden fees or confusing clauses.
                </p>
            </div>

            <div class="p-6 bg-white rounded-xl shadow-sm">
                <h3 class="font-semibold mb-2">Flexible</h3>
                <p class="text-gray-600 text-sm">
                    Repayment plans that adapt to your journey.
                </p>
            </div>

            <div class="p-6 bg-white rounded-xl shadow-sm">
                <h3 class="font-semibold mb-2">Secure</h3>
                <p class="text-gray-600 text-sm">
                    Modern security standards protect your data.
                </p>
            </div>
        </div>
    </div>

    {{-- CALL TO ACTION --}}
    <div
        x-data="{ visible: false }"
        x-intersect.once="visible = true"
        x-show="visible"
        x-transition:enter="transition ease-out duration-700"
        x-transition:enter-start="opacity-0 translate-y-6"
        x-transition:enter-end="opacity-100 translate-y-0"
        class="text-center bg-blue-600 text-white rounded-2xl p-12"
    >
        <h2 class="text-3xl font-bold mb-4">
            Ready to Take the Next Step?
        </h2>

        <p class="mb-6 max-w-xl mx-auto">
            Apply for a student loan today or reach out to our support team for guidance.
        </p>

        <div class="flex justify-center gap-4">
            <a href="{{ route('register') }}"
               class="px-6 py-3 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-100">
                Apply Now
            </a>

            <a href="{{ route('web.contact') }}"
               class="px-6 py-3 border border-white rounded-lg hover:bg-blue-700">
                Contact Support
            </a>
        </div>
    </div>

</section>

@endsection
