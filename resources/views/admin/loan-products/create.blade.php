@extends('layouts.adminn')

@section('content')
<div class=" py-6 bg-white p-6 rounded shadow">

    <h2 class="text-xl font-semibold mb-4">Add Loan Product</h2>

    <form action="{{ route('admin.loan-products.store') }}" method="POST" class=' gap-3 max-w-5xl'>
        @csrf
        <div>
            <label for="product_name" class="block text-sm font-medium text-black-700">Product Name</label>
            <input name="product_name" class="w-full mb-3 border p-4 rounded-md">
        </div>
        <div>
            <label for="min_loan_amount" class="block text-sm font-medium text-black-700">Minimum Loan Amount</label>
            <input name="min_loan_amount" type="number" class="w-full mb-3 border p-4 rounded-md">
        </div>
        <div class="col-span-2">
            <label for="description" class="block text-sm font-medium text-black-700">Description</label>
            <textarea name="description" class="w-full mb-3 border p-4 rounded-md"></textarea>
        </div>
        <div>
            <label for="max_loan_amount" class="block text-sm font-medium text-black-700">Maximum Loan Amount</label>
            <input name="max_loan_amount" type="number" class="w-full mb-3 border p-4 rounded-md">
        </div>
        <div>
            <label for="interest_rate" class="block text-sm font-medium text-black-700">interest Rate</label>
            <input name="interest_rate" type="number" step="0.01" class="w-full mb-3 border p-4 rounded-md">
        </div>
        <div>
            <label for="Loan_term_months" class="block text-sm font-medium text-black-700">loan Term(months)</label>
            <input name="loan_term_months" type="number" class="w-full mb-3 border p-4 rounded-md">
        </div>

        <button class="bg-blue-600 text-white px-4 py-1 ">
            Save Product
        </button>
    </form>

</div>
@endsection