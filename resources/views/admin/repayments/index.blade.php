@extends('layouts.adminn')

@section('title', 'Admin Dashboard')

@section('content')
<div class=" py-6">
<h1 class="text-2xl font-bold mb-4">Repayment History</h1>

 <table class="w-full border bg-white ">
        <thead class=" bg-gray-200" >
        <tr>
            <th class="p-2 border border-gray-300">Date</th>
            <th class="p-2 border border-gray-300">Student</th>
            <th class="p-2 border border-gray-300">Loan Product</th>
            <th class="p-2  border border-gray-300">Amount (KES)</th>
            <th class="p-2 border border-gray-300">Actions</th>
           
        </tr>
    </thead>
    <tbody>
        @foreach($repayments as $repayment)
      <tr class="border-t">
            <td class="p-2 border border-gray-300">{{ $repayment->paid_at}}</td>
            <td class="p-2 border border-gray-300">{{ $repayment->loan->user->name }}</td>
            <td class="p-2 border border-gray-300">{{ $repayment->loan->loanProduct->product_name }}</td>
            <td class="p-2 border border-gray-300 ">{{ number_format($repayment->amount, 2) }}</td>
             <td class="p-2"><a href="{{ route('admin.repayments.show', $repayment->loan->id) }}"class="bg-blue-500 text-white px-2 py-1 rounded">
   View Loan Repayments
</a></td>
           
        </tr>
        @endforeach
    </tbody>
</table>

</div>



@endsection
