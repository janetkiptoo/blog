@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10">
    <h2 class="text-2xl font-bold mb-6">Resume Loan Application</h2>

    <form method="POST" action="{{ route('student.loans.update', $loan->id) }}">
        @csrf
        @method('PUT')

        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Loan Amount</label>
            <input
                type="number"
                name="loan_amount"
                value="{{ old('loan_amount', $loan->loan_amount) }}"
                class="border rounded p-2 w-full"
                required
            >
        </div>

        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Loan Product</label>
            <select name="loan_product_id" class="border rounded p-2 w-full" required>
                @foreach ($loanProducts as $product)
                    <option
                        value="{{ $product->id }}"
                        {{ old('loan_product_id', $loan->loan_product_id) == $product->id ? 'selected' : '' }}
                    >
                        {{ $product->product_name }} 
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Term --}}
        <div class="mb-6">
            <label class="block text-sm font-medium mb-1">Loan Duration (Months)</label>
            <input
                type="number"
                name="term_months"
                value="{{ old('term_months', $loan->term_months) }}"
                class="border rounded p-2 w-full"
                required
            >
        </div>

        <button class="bg-blue-600 text-white px-6 py-2 rounded">
            Save & Continue
        </button>
    </form>
</div>
@endsection