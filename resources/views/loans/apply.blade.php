@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto p-6 py-6 bg-white rounded shadow">
       
        
     
            
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
                    
                        <div class="form-check mb-4">
    <input type="checkbox" name="terms_accepted" value="1" class="form-check-input" id="terms_accepted" required>
    <label class="form-check-label" for="terms_accepted">
        I accept the 
        <a href="{{ route('terms') }}" target="_blank" class="text-blue-600 underline">
            Terms & Conditions
        </a>
    </label>
</div>
                 
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                    Continue
                </button>           
            </div>    
        </form>

       
    </div>
@endsection