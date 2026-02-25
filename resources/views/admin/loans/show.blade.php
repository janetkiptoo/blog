@extends('layouts.adminn')

@section('content')

<div class="bg-white p-6 shadow rounded">
    <h2 class="text-xl font-bold">Loan Summary</h2>

    <p><strong>Student:</strong> {{ $loan->user->name }}</p>
    <p><strong>Product:</strong> {{ $loan->loanProduct->product_name }}</p>
    <p><strong>Amount:</strong> KES {{ number_format($loan->loan_amount, 2) }}</p>
    <p><strong>Term:</strong> {{ $loan->term_months }} months</p>
    <p><strong>Status:</strong> {{ strtoupper($loan->status) }}</p>
</div>

<div class="grid grid-cols-2 gap-6 mt-6">
    <div class="bg-white p-4 shadow rounded">
        <h3 class="font-bold mb-2">Personal Profile</h3>
        <p>Nationality: {{ $loan->user->personalProfile->nationality }}</p>
        <p>ID: {{ $loan->user->personalProfile->government_id_number }}</p>
    </div>

    <div class="bg-white p-4 shadow rounded">
        <h3 class="font-bold mb-2">Academic Profile</h3>
        <p>Institution: {{ $loan->user->academicProfile->institution_name }}</p>
        <p>Course: {{ $loan->user->academicProfile->course_name }}</p>
    </div>
</div>

<div class="bg-white p-6 shadow rounded mt-6">
    <h3 class="text-lg font-bold mb-4">Guarantors</h3>

    @foreach($loan->guarantors as $g)
        <div class="border p-3 rounded mb-2">
            <p><strong>{{ $g->name }}</strong> ({{ $g->relationship }})</p>
            <p>Phone: {{ $g->phone }}</p>
            <p>Status: 
                <span class="font-semibold {{ $g->status === 'approved' ? 'text-green-600' : 'text-yellow-600' }}">
                    {{ strtoupper($g->status) }}
                </span>
            </p>

            <a href="{{ route('admin.guarantors.show', $g) }}"
               class="inline-block text-white bg-primary-600 py-2 px-6 rounded-full mt-3">
                Review
            </a>
        </div>
    @endforeach
</div>

@if(in_array($loan->status, ['submitted', 'under_review']))
<div class="bg-gray-50 p-6 rounded mt-6 space-y-4">

    <form method="POST" action="{{ route('admin.loans.approve', $loan) }}">
        @csrf
        <button class="bg-green-600 text-white px-4 py-2 rounded-full">
            Approve Loan
        </button>
    </form>

    <form method="POST" action="{{ route('admin.loans.reject', $loan) }}">
        @csrf
        <textarea name="reason" required
            class="w-full border rounded p-2"
            placeholder="Reason for rejection"></textarea>

        <button class="bg-red-600 text-white px-4 py-2 rounded-full mt-2">
            Reject Loan
        </button>
    </form>

</div>

<div class="bg-white p-6 shadow rounded mt-6">
    <h3 class="text-lg font-bold mb-4">Repayments</h3>

    @forelse($loan->repayments as $repayment)
        <p>
            KES {{ number_format($repayment->amount, 2) }}
            — {{ $repayment->created_at->toDateString() }}
        </p>
    @empty
        <p class="text-gray-500">No repayments yet.</p>
    @endforelse
</div>
@endif
@endsection 