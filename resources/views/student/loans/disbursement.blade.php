@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-8">
    <h2 class="text-xl font-bold mb-4">Disbursement Details</h2>

    <form method="POST" action="{{ route('student.loans.disbursement.save', $loan) }}">
        @csrf

        <label class="block mb-2 font-semibold">Disbursement Method</label>
        <select name="disbursement_method" class="w-full border rounded p-2 mb-4" required>
            <option value="">-- Select --</option>
            <option value="mpesa" {{ old('disbursement_method', $loan->disbursement_method) === 'mpesa' ? 'selected' : '' }}>
                M-Pesa
            </option>
            <option value="bank" {{ old('disbursement_method', $loan->disbursement_method) === 'bank' ? 'selected' : '' }}>
                Bank
            </option>
        </select>

        <div class="mb-4">
            <label class="block mb-1">M-Pesa Phone</label>
            <input
                type="text"
                name="disbursement_phone"
                class="w-full border rounded p-2"
                value="{{ old('disbursement_phone', $loan->disbursement_phone) }}"
            >
        </div>

        <div class="mb-4">
            <label class="block mb-1">Bank Name</label>
            <input
                type="text"
                name="bank_name"
                class="w-full border rounded p-2"
                value="{{ old('bank_name', $loan->bank_name) }}"
            >
        </div>

        <div class="mb-4">
            <label class="block mb-1">Bank Account Number</label>
            <input
                type="text"
                name="bank_account_number"
                class="w-full border rounded p-2"
                value="{{ old('bank_account_number', $loan->bank_account_number) }}"
            >
        </div>

        <button class="bg-primary-700 text-white px-6 py-2 rounded">
            Save & Continue
        </button>
    </form>
</div>
@endsection