@extends('layouts.adminn')

@section('content')
<div class="p-6">
    <div class="flex justify-between mb-4">
        <h2 class="text-xl font-bold">Eligibility Requirements</h2>
        <a href="{{ route('admin.eligibility.create') }}"
           class="bg-green-600 text-white px-4 py-2 rounded">
            Add New
        </a>
    </div>

    <table class="w-full border">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2 border">Institution</th>
                <th class="p-2 border">Course</th>
                <th class="p-2 border">Loan Purpose</th>
                <th class="p-2 border">Age Range</th>
                <th class="p-2 border">Status</th>
                <th class="p-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($requirements as $req)
            <tr>
                <td class="border p-2">{{ $req->institution }}</td>
                <td class="border p-2">{{ $req->course_type }}</td>
                <td class="border p-2">{{ $req->loan_purpose }}</td>
                <td class="border p-2">{{ $req->min_age }} - {{ $req->max_age }}</td>
                <td class="border p-2">
                    {{ $req->is_active ? 'Active' : 'Inactive' }}
                </td>
                <td class="border p-2">
                    <a href="{{ route('admin.eligibility.edit', $req->id) }}"
                       class="text-blue-600">Edit</a>

                    <form action="{{ route('admin.eligibility.destroy', $req->id) }}"
                          method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600 ml-2"
                            onclick="return confirm('Delete this?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection