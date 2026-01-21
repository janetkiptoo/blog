@extends('layouts.adminn')

@section('title', 'Admin Dashboard')

@section('content')
<div class="max-w-7xl mx-auto py-6">

    <h1 class="text-2xl font-bold mb-6">Welcome Admin</h1>

    <div id="loans" class="mb-8 bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Loan Applications</h2>
        <table class="w-full border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 ">Student</th>
                    <th class="p-2">Email</th>
                    <th class="p-2">Product</th>
                    <th class="p-2">Amount</th>
                    <th class="p-2">Status</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loans as $loan)
                <tr class="border-t">
                    <td class="p-2">{{ $loan->user->name }}</td>
                    <td class="p-2">{{ $loan->user->email }}</td>
                    <td class="p-2">{{ $loan->loanProduct->product_name }}</td>
                    <td class="p-2">{{($loan->loan_amount) }}</td>
                    <td class="p-2">{{($loan->status) }}</td>
                    <td class="p-2 flex gap-2">
                        @if($loan->status == 'pending')
                        <form action="{{ route('admin.loan.approve', $loan->id) }}" method="POST">
                            @csrf
                            <button class="bg-green-500 text-white px-2 py-1 rounded">Approve</button>
                        </form>
                        <form action="{{ route('admin.loan.reject', $loan->id) }}" method="POST">
                            @csrf
                             <button class="bg-blue-500 text-white px-2 py-1 rounded">Reject</button>
                           
                        </form>
                        @else
                        <p>no action</p>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center p-4">No loan applications found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>


    <div id="users" class="mb-8 bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Users</h2>
        <table class="w-full border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2">Name</th>
                    <th class="p-2">Email</th>
                    <th class="p-2">Student ID</th>
                    <th class="p-2">phone</th>
                    <th class="p-2">Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="border-t">
                    <td class="p-2">{{ $user->name }}</td>
                    <td class="p-2">{{ $user->email }}</td>
                    <td class="p-2">{{ $user->student_id}}</td>
                    <td class="p-2">{{ $user->phone }}</td>
                    <td class="p-2">{{ ($user->role) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div id="products" class="mb-8 bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Loan Products</h2>

       
        <form action="{{ route('admin.loan-products.store') }}" method="POST" class="mb-6 grid grid-cols-3 md:grid-cols-3 gap-4">
            @csrf
            <input type="text" name="product_name" placeholder="Product Name" class="border rounded p-2">
            <textarea name="description" placeholder="Description" class="border rounded p-2"></textarea>
            <input type="number" name="min_loan_amount" placeholder="Min Amount" class="border rounded p-2">
            <input type="number" name="max_loan_amount" placeholder="Max Amount" class="border rounded p-2">
            <input type="number" step="0.01" name="interest_rate" placeholder="Interest Rate"class="border rounded p-2">
            <input type="number" name="loan_term_months" placeholder="Loan Term (months)"  class="border rounded p-2">
            <div class="col-span-2">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Product</button>
            </div>
        </form>

      <table class="w-full border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2">Product Name</th>
                    <th class="p-2">Description</th>
                    <th class="p-2">Min Amount</th>
                    <th class="p-2">Max Amount</th>
                    <th class="p-2">Interest Rate</th>
                    <th class="p-2">Term (Months)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr class="border-t">
                    <td class="p-2">{{ $product->product_name }}</td>
                    <td class="p-2">{{ $product->description }}</td>
                    <td class="p-2">KES {{($product->min_loan_amount) }}</td>
                    <td class="p-2">KES {{ ($product->max_loan_amount) }}</td>
                    <td class="p-2">{{ $product->interest_rate }}%</td>
                    <td class="p-2">{{ $product->loan_term_months }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection
