@extends('layouts.adminn')

@section('title', 'Admin Dashboard')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Welcome Admin!</h1>
      <div class="p-6 max-w-7xl ">
        <div class="bg-white rounded shadow p-6">
             <h3 class="text-lg font-semibold mb-4">Loan Applications</h3>

            <table class="w-full border">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-3">Student</th>
                        <th class="p-3">Email</th>
                        <th class="p-3">Product</th>
                        <th class="p-3">Amount</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($loans as $loan)
                       <tr class="border-t">
                            <td class="p-2">

                            </td>
                            <td class="p-2">{{ $loan->user->name }}</td>
                            <td class="p-2">{{$loan->email}}</td>
                            <td class="p-2">{{$loan->LoanProduct->product_name}}</td>
                            <td class="p-2">{{$loan->loan_amount}}</</td>
                            <td class="p-2"></td>
                        </tr>  
                    @empty
                     <div>

                        <p>No loan applications</p>
                     </div>
                        
                    @endforelse
                          
                </tbody>
            </table>

        </div>
    </div>
@endsection
