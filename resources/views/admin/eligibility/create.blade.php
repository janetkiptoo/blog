@extends('layouts.adminn')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Add Eligibility Requirement</h2>

    <form action="{{ route('admin.eligibility.store') }}" method="POST">
        @csrf

        <input type="text" name="country" placeholder="Country" class="w-full mb-3 border p-2" required>

        <input type="text" name="institution" placeholder="Institution" class="w-full mb-3 border p-2" required>

        <input type="text" name="institution_type" placeholder="Institution Type" class="w-full mb-3 border p-2" required>

        <input type="text" name="course_type" placeholder="Course Type" class="w-full mb-3 border p-2" required>

        <input type="text" name="loan_purpose" placeholder="Loan Purpose" class="w-full mb-3 border p-2" required>

        <input type="number" name="min_age" placeholder="Minimum Age" class="w-full mb-3 border p-2" required>

        <input type="number" name="max_age" placeholder="Maximum Age" class="w-full mb-3 border p-2" required>

        <label class="flex items-center gap-2 mb-3">
            <input type="checkbox" name="is_active" value="1" checked>
            Active
        </label>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Save
        </button>
    </form>
</div>
@endsection