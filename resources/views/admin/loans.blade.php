@extends('layouts.adminn')

@section('title', 'Loan Applications')

@section('content')
<div class="py-6">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Loan Applications</h1>
        <p class="text-gray-500">Manage and review student loan applications</p>
    </div>

    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <input type="text" name="student" value="{{ request('student') }}" placeholder="Student name or Reg No" class="border border-gray-300 p-2 rounded focus:ring focus:ring-blue-200">

            <div class="md:col-span-4 flex items-end gap-3">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded"> Filter </button>
                <a href="{{ route('admin.loans') }}" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded">Reset </a>
            </div>
        </form>
    </div>

   
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-100 text-gray-700  text-xl">
                <tr>
                    <th class="px-4 py-3 border">Student</th>
                    <th class="px-4 py-3 border">Reg No</th>
                    <th class="px-4 py-3 border">Loan Product</th>
                    <th class="px-4 py-3 border ">Loan Amount</th>
                    <th class="px-4 py-3 border ">Amount Paid</th>
                    <th class="px-4 py-3 border ">Balance</th>
                    <th class="px-4 py-3 border ">Status</th>
                    <th class="px-4 py-3 border ">Actions</th>
                </tr>
            </thead>

            <tbody class="text-gray-700">
                @forelse ($applications as $loan)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 border">{{ $loan->user->name }} </td>
                        <td class="px-4 py-3 border">{{ $loan->user->student_reg_no }} </td>
                        <td class="px-4 py-3 border">{{ $loan->loanProduct->product_name }}</td>
                        <td class="px-4 py-3 border text-right"> KES {{ number_format($loan->loan_amount, 2) }} </td>
                        <td class="px-4 py-3 border text-right text-green-600"> KES {{ number_format($loan->loan_amount - ($loan->balance ?? $loan->loan_amount), 2) }} </td>
                        <td class="px-4 py-3 border text-right text-red-600">KES {{ number_format($loan->balance ?? $loan->loan_amount, 2) }}</td>

                        <td class="px-4 py-3 border text-center">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                {{ $loan->status === 'paid' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $loan->status === 'approved' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                {{ $loan->status === 'pending' ? 'bg-orange-100 text-orange-700' : '' }}
                                {{ $loan->status === 'rejected' ? 'bg-red-100 text-red-700' : '' }}">
                                {{ ucfirst($loan->status) }}
                            </span>
                        </td>

                        <td class="px-4 py-3 border text-center">
                            @if ($loan->status === 'pending')
                                <div class="flex justify-center gap-2">
                                    <form action="{{ route('admin.loan.approve', $loan->id) }}" method="POST">
                                        @csrf
                                        <button
                                            class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">
                                            Approve
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.loan.reject', $loan->id) }}" method="POST">
                                        @csrf
                                        <button
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                            Reject
                                        </button>
                                    </form>
                                </div>
                            @else
                                <span class="text-gray-400 text-sm">No action</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-6 text-center text-gray-500"> No loan applications found </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


    <div class="mt-6">
        {{ $applications->links() }}
    </div>

</div>
@endsection
