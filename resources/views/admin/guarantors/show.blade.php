@extends('layouts.adminn')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">

    <h2 class="text-xl font-bold mb-4">Guarantor Review</h2>

    <div class="grid grid-cols-2 gap-4 mb-6">
        <p><strong>Name:</strong> {{ $guarantor->name }}</p>
        <p><strong>Relationship:</strong> {{ ucfirst($guarantor->relationship) }}</p>
        <p><strong>Phone:</strong> {{ $guarantor->phone }}</p>
        <p><strong>Email:</strong> {{ $guarantor->email ?? 'N/A' }}</p>
        <p><strong>Employment:</strong> {{ ucfirst($guarantor->employment_status) }}</p>
        <p><strong>Income Range:</strong> {{ $guarantor->income_range }}</p>
        <p><strong>ID Number/Passport Number:</strong> {{ $guarantor->national_id }}</p>

        <p><strong>Status:</strong>
            <span class="px-2 py-1 rounded text-sm
                {{ $guarantor->status === 'approved' ? 'bg-green-100 text-green-700' :
                   ($guarantor->status === 'rejected' ? 'bg-red-100 text-red-700' :
                   'bg-yellow-100 text-yellow-700') }}">
                {{ ucfirst($guarantor->status) }}
            </span>

        </p>
        @if ($guarantor->status ==='rejected')
        <p><strong>Rejected reason:</strong> {{ $guarantor->rejection_reason }}</p>
        @endif
    </div>

    <img src="{{ asset('storage/'.$guarantor->image) }}"
         class="w-64 border rounded mb-6">

    @if($guarantor->status === 'pending')
    <div class="flex gap-4">
        <form method="POST" 
      action="{{ route('admin.guarantors.approve', $guarantor) }}" 
      class="inline">
    @csrf
    <button type="submit"
        class="bg-green-600 text-white px-3 py-1 rounded-full text-sm">
        Approve
    </button>
</form>


    <form method="POST" action="{{ route('admin.guarantors.reject', $guarantor) }}">
    @csrf

    <textarea name="rejection_reason"
        class="w-full border rounded p-2 mb-2"
        placeholder="Reason for rejection" required></textarea>

    <button class="bg-red-600 text-white px-4 py-2 rounded-full">
        Reject Guarantor
    </button>
</form>
 </div>
    @endif

</div>
@endsection
