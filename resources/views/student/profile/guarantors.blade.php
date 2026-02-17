@extends('layouts.web')

@section('title', 'Guarantor Details')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md">

    <h2 class="text-2xl font-bold text-gray-800 mb-6">
        Guarantor / Guardian Information
    </h2>

    <form method="POST"
          action="{{ route('student.profile.guarantors.store') }}"
          enctype="multipart/form-data"
          class="space-y-5">
        @csrf

        
        <div>
            <label class="block text-sm font-semibold text-gray-700">Full Name</label>
            <input type="text" name="name"
                   class="w-full border rounded px-4 py-2"
                   required>
            @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        
        <div>
            <label class="block text-sm font-semibold text-gray-700">Relationship</label>
            <select name="relationship"
                    class="w-full border rounded px-4 py-2"
                    required>
                <option value="">Select Relationship</option>
                <option value="parent">Parent</option>
                <option value="guardian">Guardian</option>
                <option value="sponsor">Sponsor</option>
                <option value="relative">Relative</option>
            </select>
            @error('relationship') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700">National ID Number</label>
            <input type="text" name="national_id"
                   class="w-full border rounded px-4 py-2"
                   required>
            @error('national_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700">ID Type</label>
            <select name="id_type"
                    class="w-full border rounded px-4 py-2"
                    required>
                <option value="">Select ID Type</option>
                <option value="national_id">National ID</option>
                <option value="passport">Passport</option>
            </select>
            @error('id_type') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

       
        <div>
            <label class="block text-sm font-semibold text-gray-700">Phone Number</label>
            <input type="text" name="phone"
                   class="w-full border rounded px-4 py-2"
                   required>
            @error('phone') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700">Email (Optional)</label>
            <input type="email" name="email"
                   class="w-full border rounded px-4 py-2">
            @error('email') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

       
        <div>
            <label class="block text-sm font-semibold text-gray-700">Employment Status</label>
            <select name="employment_status"
                    class="w-full border rounded px-4 py-2"
                    required>
                <option value="">Select Status</option>
                <option value="employed">Employed</option>
                <option value="not employed">Not Employed</option>
            </select>
            @error('employment_status') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        
        <div>
            <label class="block text-sm font-semibold text-gray-700">Income Range</label>
            <select name="income_range"
                    class="w-full border rounded px-4 py-2"
                    required>
                <option value="">Select Income Range</option>
                <option value="below_20000">Below 20,000</option>
                <option value="20000_50000">20,000 – 50,000</option>
                <option value="50000_100000">50,000 – 100,000</option>
                <option value="above_100000">Above 100,000</option>
            </select>
            @error('income_range') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

       
        <div>
            <label class="block text-sm font-semibold text-gray-700">Physical Address</label>
            <input type="text" name="physical_address"
                   class="w-full border rounded px-4 py-2">
            @error('physical_address') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

       
        <div>
            <label class="block text-sm font-semibold text-gray-700">
                Upload ID Document (JPEG/PNG)
            </label>
            <input type="file" name="image"
                   class="w-full border rounded px-4 py-2"
                   required>
            @error('image') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        
        <div class="flex items-center space-x-2">
            <input type="checkbox" name="consent_given" value="1" required>
            <label class="text-sm text-gray-700">
                I confirm that the information provided is accurate and consent is given
            </label>
        </div>
        @error('consent_given') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror

        
        <div class="pt-4">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold">
                Submit for Review
            </button>
        </div>
    </form>
</div>
@endsection
