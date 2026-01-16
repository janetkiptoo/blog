@extends('layouts.adminn')

@section('title', 'Edit Loan Product')

@section('content')
<div class="max-w-3xl mx-auto py-6">
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-6">Edit Loan Product</h2>

        <form action="{{ route('admin.loan-products.update', $loan_product) }}" method="POST" class="grid grid-cols-3 gap-4">
            @csrf
            @method('PUT')

            <input type="text" name="product_name" value="{{ old('product_name', $loan_product->product_name) }}" placeholder="Product Name" class="border rounded p-2">
            <textarea name="description" placeholder="Description" class="border rounded p-2">{{ old('description', $loan_product->description) }}</textarea>
            <input type="number" name="min_loan_amount" value="{{ old('min_loan_amount', $loan_product->min_loan_amount) }}" placeholder="Min Amount" class="border rounded p-2">
            <input type="number" name="max_loan_amount" value="{{ old('max_loan_amount', $loan_product->max_loan_amount) }}" placeholder="Max Amount" class="border rounded p-2">
            <input type="number" step="0.01" name="interest_rate" value="{{ old('interest_rate', $loan_product->interest_rate) }}" placeholder="Interest Rate" class="border rounded p-2">
            <input type="number" name="loan_term_months" value="{{ old('loan_term_months', $loan_product->loan_term_months) }}" placeholder="Loan Term (months)" class="border rounded p-2">

            <div class="col-span-2">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Product</button>
            </div>
        </form>
    </div>
</div>
@endsection
