@extends('layouts.adminn')

@section('content')
<div class="bg-white p-6 shadow rounded">

    <h1 class="text-2xl font-bold mb-6">Loan Applications</h1>

    
    <form method="GET" class="mb-4 flex gap-3">
        <select name="status" class="border rounded px-3 py-2">
            <option value="">All Statuses</option>
            @foreach(['submitted','under_review','approved','rejected','disbursed','closed'] as $status)
                <option value="{{ $status }}" @selected(request('status') === $status)>
                    {{ ucfirst(str_replace('_',' ', $status)) }}
                </option>
            @endforeach
        </select>
        <button class="bg-gray-800 text-white px-4 py-2 rounded">
            Filter
        </button>
    </form>

    {{-- Loans Table --}}
    <table class="w-full border-collapse">
        <thead>
            <tr class="border-b bg-gray-100 text-left">
                <th class="p-2">#</th>
                <th class="p-2">Student</th>
                <th class="p-2">Product</th>
                <th class="p-2">Amount</th>
                <th class="p-2">Term</th>
                <th class="p-2">Status</th>
                
                <th class="p-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($loans as $loan)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-2">{{ $loan->id }}</td>
                    <td class="p-2">{{ $loan->user?->name ?? '—' }}</td>
                    <td class="p-2">{{ $loan->loanProduct?->product_name ?? '—' }}</td>
                    <td class="p-2">KES {{ number_format($loan->loan_amount, 2) }}</td>
                    <td class="p-2">{{ $loan->term_months }} months</td>
                    <td class="p-2">
                        <span class="px-2 py-1 rounded text-sm
                            @class([
                                'bg-yellow-100 text-yellow-800' => $loan->status === 'submitted',
                                'bg-blue-100 text-blue-800' => $loan->status === 'under_review',
                                'bg-green-100 text-green-800' => $loan->status === 'approved',
                                'bg-red-100 text-red-800' => $loan->status === 'rejected',
                                'bg-purple-100 text-purple-800' => $loan->status === 'disbursed',
                            ])">
                            {{ ucfirst(str_replace('_',' ', $loan->status)) }}
                        </span>
                    </td>
                  
                    <td class="p-2">
                        <a href="{{ route('admin.loans.show', $loan) }}"
                           class="text-blue-600 hover:underline">
                            View
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="p-4 text-center text-gray-500">
                        No loan applications found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $loans->links() }}
    </div>
</div>
@endsection