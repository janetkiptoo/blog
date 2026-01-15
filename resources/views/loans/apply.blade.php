<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Apply for {{ $product->product_name }} Loan
        </h2>
    </x-slot>
    <div class="max-w-2xl mx-auto p-6 bg-white rounded shadow">
        
        <form method="POST" action="{{ route('student.loan.store', $product->id) }}">
            @csrf
            <div class="mb-4">
                <label for=" loan_amount" class="block text-gray-700">Loan Amount</label>
                <input type="number" name="loan_amount" id="loan_amount" class="w-full border rounded px-3 py-2" min="{{ $product->min_loan_amount }}" max="{{ $product->max_loan_amount }}" required>
            </div>
            <div class="mb-4">
                <label for="term_months" class="block text-gray-700">Loan Term (months)</label>
                <input type="number" name="term_months" id="term_months"   class="w-full border rounded px-3 py-2"  value="{{ $product->loan_term_months }}" readonly>            
                    </div>            
                 
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                    Submit Application
                </button>           
            </div>
        </form>
    </div>
</x-app-layout>