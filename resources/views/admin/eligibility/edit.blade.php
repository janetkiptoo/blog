@extends('layouts.adminn')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    
    <h2 class="text-xl font-bold mb-6">Edit Eligibility Requirement</h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.eligibility.update', $requirement->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold mb-1">Country</label>
            <input type="text" name="country"
                value="{{ old('country', $requirement->country) }}"
                class="w-full border rounded p-2"
                required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Institution</label>
            <input type="text" name="institution"
                value="{{ old('institution', $requirement->institution) }}"
                class="w-full border rounded p-2"
                required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Institution Type</label>
            <input type="text" name="institution_type"
                value="{{ old('institution_type', $requirement->institution_type) }}"
                class="w-full border rounded p-2"
                required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Course Type</label>
            <input type="text" name="course_type"
                value="{{ old('course_type', $requirement->course_type) }}"
                class="w-full border rounded p-2"
                required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Loan Purpose</label>
            <input type="text" name="loan_purpose"
                value="{{ old('loan_purpose', $requirement->loan_purpose) }}"
                class="w-full border rounded p-2"
                required>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block font-semibold mb-1">Minimum Age</label>
                <input type="number" name="min_age"
                    value="{{ old('min_age', $requirement->min_age) }}"
                    class="w-full border rounded p-2"
                    required>
            </div>

            <div>
                <label class="block font-semibold mb-1">Maximum Age</label>
                <input type="number" name="max_age"
                    value="{{ old('max_age', $requirement->max_age) }}"
                    class="w-full border rounded p-2"
                    required>
            </div>
        </div>

        <div class="mb-6">
            <label class="flex items-center gap-2">
                <input type="checkbox" name="is_active" value="1"
                    {{ old('is_active', $requirement->is_active) ? 'checked' : '' }}>
                <span class="font-semibold">Active</span>
            </label>
        </div>

        <div class="flex justify-between">
            <a href="{{ route('admin.eligibility.index') }}"
               class="bg-gray-500 text-white px-4 py-2 rounded">
                Cancel
            </a>

            <button type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded">
                Update Requirement
            </button>
        </div>
    </form>

</div>
@endsection