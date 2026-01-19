@extends('layouts.adminn')

@section('content')
<div class="max-w-xl mx-auto py-6 bg-white p-6 rounded shadow">

    <h2 class="text-xl font-semibold mb-4">Add Loan Product</h2>

    <form action="{{ route('admin.loan-products.store') }}" method="POST">
        @csrf
        <div>
        <label for="product_name" class="block text-sm font-medium text-gray-700">Product Name</label>
        <input name="product_name"  class="w-full mb-3 border p-2">
        </div>
         <div>
        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
        <textarea name="description" class="w-full mb-3 border p-2"></textarea>
         </div>
         <div>
        <label for="min_loan_amount" class="block text-sm font-medium text-gray-700">Minimum Loan Amount</label>
        <input name="min_loan_amount" type="number" class="w-full mb-3 border p-2">
         </div>
         <div>
        <label for="max_loan_amount" class="block text-sm font-medium text-gray-700">Maximu Loan Amount</label>
        <input name="max_loan_amount" type="number"  class="w-full mb-3 border p-2">
         </div>
         <div>
        <label for="interest_rate" class="block text-sm font-medium text-gray-700">interest Rate</label>
        <input name="interest_rate" type="number" step="0.01" class="w-full mb-3 border p-2">
         </div>
         <div>
        <label for="Loan_term_months" class="block text-sm font-medium text-gray-700">loan Term(months)</label>
        <input name="loan_term_months" type="number" class="w-full mb-3 border p-2">
         </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Save Product
        </button>
    </form>

</div>
@endsection
