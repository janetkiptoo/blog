@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">

    <h1 class="text-3xl font-bold mb-6 text-center">Student Dashboard</h1>


    <div class="mb-6 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-semibold mb-4">
            Welcome, {{ Auth::user()->name }}
        </h2>

        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        <p><strong>Institution:</strong> {{ Auth::user()->institution_name}}</p>
        <p><strong>Course:</strong> {{ Auth::user()->course_name }}</p>
        <p><strong>Level:</strong> {{ Auth::user()->level }}</p>
        
       
        <p><strong>Student Reg No:</strong> {{ Auth::user()->student_registration_number }}</p>
    </div>

  

    <h2 class="text-xl font-bold mb-4">Guarantor Status</h2>

<table class="w-full border">
    <thead>
        <tr class="bg-gray-100">
            <th class="p-2">Name</th>
            <th class="p-2">Relationship</th>
            <th class="p-2">Status</th>
            <th class="p-2">Remarks</th>
        </tr>
    </thead>
    <tbody>
        @foreach(auth()->user()->guarantors as $guarantor)
        <tr>
            <td class="p-2">{{ $guarantor->name }}</td>
            <td class="p-2">{{ ucfirst($guarantor->relationship) }}</td>
            <td class="p-2">
                @if($guarantor->status === 'approved')
                    <span class="text-green-600 font-bold">Approved</span>
                @elseif($guarantor->status === 'rejected')
                    <span class="text-red-600 font-bold">Rejected</span>
                @else
                    <span class="text-yellow-600 font-bold">Pending</span>
                @endif
            </td>
            <td class="p-2">
                {{ $guarantor->rejection_reason ?? '—' }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

    


    @if($loan)
        <div class="mb-6 p-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-2xl font-semibold mb-2">Latest Loan Summary</h2>

            <p>
                <strong>Product:</strong>
                {{ $loan->loanProduct->product_name ?? '-' }}
            </p>

            <p>
                <strong>Balance:</strong>
                KES {{ number_format($loan->balance ?? $loan->loan_amount, 2) }}
            </p>

            <p>
                <strong>Status:</strong>
                {{ ucfirst($loan->status) }}
            </p>

            <a href="{{ route('student.loans.index') }}"
               class="mt-4 inline-block bg-primary-700 hover:bg-primary-500 text-white px-6 py-2 rounded">
                View All Loans
            </a>
        </div>

    @else
        <div class="mb-6 p-6 bg-yellow-100 text-yellow-800 shadow-lg rounded-lg">
            You have no active loans. Apply for a loan to get started.
        </div>
    @endif




</div>
@if (session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif


@endsection
