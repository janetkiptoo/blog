<x-guest-layout>
    <div class="max-w-2xl mx-auto p-6 bg-gray-100 rounded-lg shadow mt-10">
        <h1 class="text-2xl font-bold mb-4">Complete Your Profile</h1>
        <p class="text-gray-700 mb-6">
            Please fill out your personal identity information to be eligible for loan applications.
        </p>

        @if(session('warning'))
            <div class="bg-yellow-100 text-yellow-800 p-3 rounded mb-4">
                {{ session('warning') }}
            </div>
        @endif

        <form method="POST" action="{{ route('student.profile.complete.update') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <!-- Gender -->
            <div>
                <label class="block font-semibold text-gray-700">Gender</label>
                <select name="gender" class="w-full border rounded px-3 py-2" required>
                    <option value="">Select Gender</option>
                    <option value="Male" {{ old('gender', $user->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender', $user->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                    <option value="Other" {{ old('gender', $user->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
                <x-input-error :messages="$errors->get('gender')" class="mt-1" />
            </div>

            
            <div>
                <label class="block font-semibold text-gray-700">Nationality</label>
                <input type="text" name="nationality" value="{{ old('nationality', $user->nationality) }}"
                       class="w-full border rounded px-3 py-2" required>
                <x-input-error :messages="$errors->get('nationality')" class="mt-1" />
            </div>

           
            <div>
                <label class="block font-semibold text-gray-700">Government ID Type</label>
                <select name="government_id_type" class="w-full border rounded px-3 py-2" required>
                    <option value="">Select ID Type</option>
                    <option value="National ID" {{ old('government_id_type', $user->government_id_type) == 'National ID' ? 'selected' : '' }}>National ID</option>
                    <option value="Passport" {{ old('government_id_type', $user->government_id_type) == 'Passport' ? 'selected' : '' }}>Passport</option>
                </select>
                <x-input-error :messages="$errors->get('government_id_type')" class="mt-1" />
            </div>

            
            <div>
                <label class="block font-semibold text-gray-700">Government ID Number</label>
                <input type="text" name="government_id_number" value="{{ old('government_id_number', $user->government_id_number) }}"
                       class="w-full border rounded px-3 py-2" required>
                <x-input-error :messages="$errors->get('government_id_number')" class="mt-1" />
            </div>

            <div>
                <label class="block font-semibold text-gray-700">Address</label>
                <textarea name="address" rows="3" class="w-full border rounded px-3 py-2" required>{{ old('address', $user->address) }}</textarea>
                <x-input-error :messages="$errors->get('address')" class="mt-1" />
            </div>

            
            <div>
                <label class="block font-semibold text-gray-700">Date of Birth</label>
                <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth) }}"
                       class="w-full border rounded px-3 py-2" required>
                <x-input-error :messages="$errors->get('date_of_birth')" class="mt-1" />
            </div>

            
            <div>
                <label class="block font-semibold text-gray-700">Upload ID Image (optional)</label>
                <input type="file" name="id_image" class="w-full border rounded px-3 py-2">
                <x-input-error :messages="$errors->get('id_image')" class="mt-1" />
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Save Profile
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
