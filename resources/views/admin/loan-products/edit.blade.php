@extends('layouts.adminn')

@section('title', 'Edit Loan Product')

@section('content')
<div class="  py-6">
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-6">Edit Loan Product</h2>

        <form action="{{ route('admin.loan-products.update', $loan_product) }}" method="POST" class="grid grid-cols-2 gap-4">
            @csrf
            @method('PUT')
           <div>
            <label for="product_name" class="block text-sm font-medium text-gray-700">Product Name</label>
            <input type="text" name="product_name" value="{{ old('product_name', $loan_product->product_name) }}" placeholder="Product Name" class="border rounded  px-8 py-2 ">
            </div>
            <div>
            <label for="Description" class="block text-sm font-medium text-gray-700">description</label>
            <textarea name="description" placeholder="Description" class="border rounded px-8 py-2">{{ old('description', $loan_product->description) }}</textarea>
            </div>
            <div>
             <label for="min_loan_amount" class="block text-sm font-medium text-gray-700">Min loan amount:KES</label>
            <input type="number" name="min_loan_amount" value="{{ old('min_loan_amount', $loan_product->min_loan_amount) }}" placeholder="Min Amount" class="border rounded px-8 py-2">
            </div>
            <div>
             <label for="max_loan_amount" class="block text-sm font-medium text-gray-700">max loan amount:KES</label>
            <input type="number" name="max_loan_amount" value="{{ old('max_loan_amount', $loan_product->max_loan_amount) }}" placeholder="Max Amount" class="border rounded px-8 py-2">
           </div>
           <div>
            <label for="interest value" class="block text-sm font-medium text-gray-700">interest rate(%)</label>
            <input type="number" step="0.01" name="interest_rate" value="{{ old('interest_rate', $loan_product->interest_rate) }}" placeholder="Interest Rate" class="border rounded px-8 py-2">
            </div>
            <div>
             <label for="loan_term_months" class="block text-sm font-medium text-gray-700">loan_term_amount</label>
            <input type="number" name="loan_term_months" value="{{ old('loan_term_months', $loan_product->loan_term_months) }}" placeholder="Loan Term (months)" class="border rounded px-8 py-2">
            </div>
            <div class="col-span-2">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Product</button>
            </div>
        </form>
    </div>
</div>
@endsection
