@extends('layouts.app')

@section('content')

    <div class="max-w-4xl mx-auto py-8 space-y-4">

        @if($products->count())
            @foreach($products as $product)
                <div class="p-4 border rounded shadow bg-white">
                    <h3 class="font-bold text-lg">{{ $product->product_name }}</h3>
                    <p class="text-gray-700 mt-1">{{ $product->description }}</p>
                    <p class="mt-2"><strong>Amount:</strong> KES {{ $product->min_loan_amount }} - KES {{ $product->max_loan_amount }}</p>
                    <p><strong>Interest:</strong> {{ $product->interest_rate }}%</p>
                    <p><strong>Term:</strong> {{ $product->loan_term_months }} months</p>
                    <p><strong>Grace Period:</strong> {{ $product->grace_period_months }} months</p>
                    <a href="{{ route('student.loan.apply', $product->id) }}"
                       class="mt-2 inline-block bg-primary-700 hover:bg-primary-500 text-white px-4 py-2 rounded">
                        Apply
                    </a>
                </div>
            @endforeach
        @else
            <p class="text-center text-gray-500">No loan products available at the moment.</p>
        @endif

    </div>
    
@endsection
