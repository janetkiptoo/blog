<x-guest-layout>
    <div class="max-w-2xl mx-auto p-6 bg-gray-100 rounded-lg shadow mt-10">
        <h1 class="text-2xl font-bold mb-4">
            {{ isset($profile) ? 'Update Your Profile' : 'Complete Your Profile' }}
        </h1>
        <p class="text-gray-700 mb-6">
            Please fill out your personal identity information to be eligible for loan applications.
        </p>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('warning'))
            <div class="bg-yellow-100 text-yellow-800 p-3 rounded mb-4">
                {{ session('warning') }}
            </div>
        @endif

        @if(isset($profile) && $profile->status === 'rejected')
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                <h3 class="text-red-800 font-semibold mb-2">Your profile was rejected</h3>
                <p class="text-red-700">Rejection reason:{{ $profile->rejection_reason }}</p>
                <p class="text-sm text-gray-600 mt-2">Please update your information and resubmit.</p>
            </div>
        @endif

        @if(isset($profile) && $profile->status === 'pending')
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                <p class="text-yellow-800">Your profile is currently under review. You can still update your information if needed.</p>
            </div>
        @endif

        <form method="POST" action="{{ route('student.profile.complete.update') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('POST')

           
            <div>
                <label class="block font-semibold text-gray-700">Gender <span class="text-red-500"></span>*</label>
                <select name="gender" class="w-full border rounded px-3 py-2" required>
                    <option value="">Select Gender</option>
                    <option value="male" {{ old('gender', $profile->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender', $profile->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ old('gender', $profile->gender ?? '') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
                <x-input-error :messages="$errors->get('gender')" class="mt-1" />
            </div>

            
            <div>
                <label class="block font-semibold text-gray-700">Nationality <span class="text-red-500"></span>*</label>
                <input type="text" name="nationality" value="{{ old('nationality', $profile->nationality ?? '') }}"
                       class="w-full border rounded px-3 py-2" placeholder="e.g., Kenyan" required>
                <x-input-error :messages="$errors->get('nationality')" class="mt-1" />
            </div>

            
            <div>
                <label class="block font-semibold text-gray-700">Government ID Type <span class="text-red-500"></span>*</label>
                <select name="government_id_type" class="w-full border rounded px-3 py-2" required>
                    <option value="">Select ID Type</option>
                    <option value="national_id" {{ old('government_id_type', $profile->government_id_type ?? '') == 'national_id' ? 'selected' : '' }}>National ID</option>
                    <option value="passport" {{ old('government_id_type', $profile->government_id_type ?? '') == 'passport' ? 'selected' : '' }}>Passport</option>
                    <option value="drivers_license" {{ old('government_id_type', $profile->government_id_type ?? '') == 'drivers_license' ? 'selected' : '' }}>Driver's License</option>
                    <option value="birth_certificate" {{ old('government_id_type', $profile->government_id_type ?? '') == 'birth_certificate' ? 'selected' : '' }}>Birth Certificate</option>
                </select>
                <x-input-error :messages="$errors->get('government_id_type')" class="mt-1" />
            </div>

            <div>
                <label class="block font-semibold text-gray-700">Government ID Number <span class="text-red-500"></span>*</label>
                <input type="text" name="government_id_number" value="{{ old('government_id_number', $profile->government_id_number ?? '') }}"
                       class="w-full border rounded px-3 py-2" required>
                <x-input-error :messages="$errors->get('government_id_number')" class="mt-1" />
            </div>

           
            <div>
                <label class="block font-semibold text-gray-700">Physical Address <span class="text-red-500"></span>*</label>
                <textarea name="address" rows="3" class="w-full border rounded px-3 py-2" required>{{ old('address', $profile->address ?? '') }}</textarea>
                <x-input-error :messages="$errors->get('address')" class="mt-1" />
            </div>

            
            <div>
                <label class="block font-semibold text-gray-700">Date of Birth <span class="text-red-500"></span>*</label>
                <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $profile->date_of_birth ?? '') }}" max="{{ date('Y-m-d', strtotime('-15 years')) }}"
                       class="w-full border rounded px-3 py-2" required>
                <p class="text-sm text-gray-500 mt-1">You must be at least 15 years old</p>
                <x-input-error :messages="$errors->get('date_of_birth')" class="mt-1" />
            </div>

          
            <div>
                <label class="block font-semibold text-gray-700">
                    Upload ID Document 
                    @if(!isset($profile) || !$profile->id_image)
                        <span class="text-red-500"></span>
                    @endif
                </label>
                <input type="file" name="id_image" id="id_image" accept="image/jpeg,image/png,image/jpg"
                       {{ (!isset($profile) || !$profile->id_image) ? 'required' : '' }}
                       class="w-full border rounded px-3 py-2">
                
                @if(isset($profile) && $profile->id_image)
                    <p class="text-sm text-gray-500 mt-1">Leave empty to keep current document, or upload a new one to replace it.</p>
                    <div class="mt-2">
                        <p class="text-sm text-green-600 font-medium"> Current document uploaded</p>
                        <img src="{{ asset('storage/' . $profile->id_image) }}" 
                             alt="Current ID" 
                             class="mt-2 max-w-xs border rounded">
                    </div>
                @else
                    <p class="text-sm text-gray-500 mt-1">Upload a clear photo of your ID document (JPEG, PNG, JPG - Max 4MB)</p>
                @endif
                
                <x-input-error :messages="$errors->get('id_image')" class="mt-1" />
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    {{ isset($profile) ? 'Resubmit Profile' : 'Save Profile' }}
                </button>
                
                @if(isset($profile))
                    <a href="{{ route('student.dashboard') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 inline-block">
                        Back to Dashboard
                    </a>
                @endif
            </div>
        </form>
    </div>
</x-guest-layout>