@extends('layouts.adminn')

@section('content')
<div class="max-w-xl mx-auto py-6 bg-white p-6 rounded shadow">

    <h2 class="text-xl font-semibold mb-4">Add Loan Product</h2>

    <form action="{{ route('admin.loan-products.store') }}" method="POST">
        @csrf

        <input name="product_name" placeholder="Product Name" class="w-full mb-3 border p-2">
        <textarea name="description" placeholder="Description" class="w-full mb-3 border p-2"></textarea>
        <input name="min_loan_amount" type="number" placeholder="Min Amount" class="w-full mb-3 border p-2">
        <input name="max_loan_amount" type="number" placeholder="Max Amount" class="w-full mb-3 border p-2">
        <input name="interest_rate" type="number" step="0.01" placeholder="Interest Rate" class="w-full mb-3 border p-2">
        <input name="loan_term_months" type="number" placeholder="Loan Term (Months)" class="w-full mb-3 border p-2">

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Save Product
        </button>
    </form>

</div>
@endsection
