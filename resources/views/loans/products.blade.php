<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Available Loan Products
        </h2>
   
 </x-slot>
@foreach ($products as $product)
 <div class="p-4 border rounded">
    <h3 class="font-bold">{{ $product->product_name }}</h3>
    <p>{{ $product->description }}</p>
    <p>Amount: {{ $product->min_loan_amount }} - {{ $product->max_loan_amount }}</p>
    <p>Interest: {{ $product->interest_rate }}%</p>
    <p>Term: {{ $product->loan_term_months }} months</p>
    <a href="{{ route('loan.apply', $product->id) }}"
       class="bg-blue-600 text-white px-4 py-2 rounded">
        Apply
    </a>
 </div>
@endforeach

</x-app-layout>