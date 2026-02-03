@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-8 bg-white shadow rounded-lg p-6">

    <h2 class="text-2xl font-semibold text-gray-800 mb-6">
        Add Guarantor for Loan #{{ $loan->id }}
    </h2>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('student.guarantors.store', $loan->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700">Guarantor Name</label>
            <input type="text" name="name"
                   class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                   required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Relationship</label>
            <input type="text" name="relationship"
                   class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                   required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">National ID</label>
            <input type="text" name="national_id"
                   class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                   required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Phone Number</label>
            <input type="text" name="phone"
                   class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                   required>
        </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Physical Address</label>
            <input type="text" name="physical_address"
                   class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                   required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Email (Optional)</label>
            <input type="email" name="email"
                   class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

         <div>
            <label class="block text-sm font-medium text-gray-700">Employment Status</label>
            <select name="employment_status"  class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">>
                <option value="employed">Employed</option>
                <option value="not employed">Not employed</option>
            </select>
        </div>

        
        <div >
            <label for="image" class="block text-gray-700 font-semibold">Upload Guarantor  ID Image</label>
            <input type="file" name="image" id="image" class="w-full border rounded px-3 py-2"  required>
            
        </div>

        <div class="flex items-center">
            <input type="checkbox" name="consent_given" value="1"
                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                   required>
            <label class="ml-2 text-sm text-gray-700">
                Guarantor consent given
            </label>
        </div>

    


        <div class="flex justify-between items-center pt-4">
            <a href="{{ route('student.dashboard') }}"
               class="text-gray-600 hover:underline">
                Cancel
            </a>

            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded">
                Add Guarantor
            </button>
        </div>
    </form>
</div>
@endsection
