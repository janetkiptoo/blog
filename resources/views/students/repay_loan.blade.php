@extends('layouts.app')

@section('content')
<section class="flex justify-center items-center py-10 px-6 flex-col min-h-screen bg-white">
    <div >
    <div class="mb-2 ">
    <h1 class="text-2xl font-bold mb-4">loan information</h1>
    <p>loan loan_amount:</p>
    
    </div>     
    <div class="flex  py-10 px-6 flex-col min-h-screen bg-white rounded-lg shadow-lg p-8 max-w-2xl w-full">

    <h2 class="text-2xl font-bold mb-6">Repay Your Loan</h2>        
        <form action="{{ route('students.repay_loan') }}"method="POST"class="bg-white  p-8 w-full max-w-3xl space-y-6">
            @csrf

            <div class="mb-4">
                <label for="loan_amount" >Repayment Amount:</label>
                <input type="number" name="loan amount" id="loan_amount"  class="w-full border border-gray-300 rounded px-10 py-20">
                </div>
                <div>
                   <label for="payment_method" class="block text-gray-700 mb-2">Payment Method</label>
                   <input type="text"  name ="payment_method" id="payment_method" class="w-full border border-gray-300 rounded px-10 py-20">


</div>
            <div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-6 py-2 rounded">Submit Repayment</button>
            </div>
    </div>

    </div>

</section>

















</x-app-layout>
    
