@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8">

    <h1 class="text-2xl font-bold mb-4">Confirm Guarantors</h1>
    <p class="mb-4 text-gray-600">
        The following guarantors will be attached to this loan application.
    </p> 

    @foreach($guarantors as $guarantor)
        <div class="border p-4 rounded mb-3 flex justify-between items-center">
            <div>
                <p><strong>Name:</strong> {{ $guarantor->name }}</p>
                <p><strong>Relationship:</strong> {{ ucfirst($guarantor->relationship) }}</p>
                <p class="text-green-600 font-semibold">Approved</p>
            </div>
            @if($loan->status === 'draft')
                <form action="{{ route('student.loans.guarantors.replace', [$loan, $guarantor]) }}"
                      method="POST"
                      onsubmit="return confirm('Replace this guarantor?')">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-600 text-white px-4 py-2 rounded">Replace</button>
                </form>
            @endif
        </div>
    @endforeach

    <form method="GET" action="{{ route('student.loans.review', $loan) }}">
        <button class="mt-4 bg-primary-700 text-white px-6 py-2 rounded-full">
            Confirm & Continue
        </button>
    </form>

</div>
@endsection