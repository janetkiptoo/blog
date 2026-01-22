@extends('layouts.adminn')

@section('content')
<div class=" py-6">

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Loan Products Available</h2>

        <a href="{{ route('admin.loan-products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Add Product
        </a>
    </div>

    <table class="w-full border bg-white">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2">Name</th>
                <th class="p-2">Min</th>
                <th class="p-2">Max</th>
                <th class="p-2">Interest</th>
                <th class="p-2">Term</th>
                <th class="p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr class="border-t">
                    <td class="p-2">{{ $product->product_name }}</td>
                    <td class="p-2">{{ $product->min_loan_amount }}</td>
                    <td class="p-2">{{ $product->max_loan_amount }}</td>
                    <td class="p-2">{{ $product->interest_rate }}%</td>
                    <td class="p-2">{{ $product->loan_term_months }}</td>
                    <td class="p-2 space-x-2">
                <a href="{{ route('admin.loan-products.edit', $product) }}" class="bg-blue-600 text-white px-4 py-2 rounded">Edit</a>

                        <form action="{{ route('admin.loan-products.destroy', $product) }}"method="POST"class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-600 text-white px-4 py-2 rounded" onclick="return confirm('Delete this product?')"> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
