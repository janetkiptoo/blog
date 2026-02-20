<x-guest-layout>
    <div class="max-w-3xl mx-auto bg-gray-100 p-6 rounded-lg shadow mt-10">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">
                {{ isset($academicProfile) ? 'Update Academic Profile' : 'Academic & Verification Details' }}
            </h1>
            <p class="text-gray-600 mt-2">
                Complete your academic profile and upload proof to verify your student status.
            </p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(isset($academicProfile) && $academicProfile->status === 'rejected')
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                <h3 class="text-red-800 font-semibold mb-2">Your academic profile was rejected</h3>
                <p class="text-red-700">Rejection reason:{{ $academicProfile->rejection_reason }}</p>
                <p class="text-sm text-gray-600 mt-2">Please update your information and resubmit.</p>
            </div>
        @endif

        @if(isset($academicProfile) && $academicProfile->status === 'pending')
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                <p class="text-yellow-800">Your academic profile is currently under review. You can still update your information if needed.</p>
            </div>
        @endif

        <form method="POST" action="{{ route('student.profile.academic.update') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('POST')

            <div>
                <x-input-label for="institution_name" :value="__('Institution Name')" />
                <x-text-input id="institution_name" class="block mt-1 w-full" type="text" name="institution_name" 
                              value="{{ old('institution_name', $academicProfile->institution_name ?? '') }}" required />
                <x-input-error :messages="$errors->get('institution_name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="institution_type" :value="__('Institution Type')" />
                <select id="institution_type" name="institution_type" class="w-full border p-2 rounded" required>
                    <option value="">Select type</option>
                    <option value="University" {{ old('institution_type', $academicProfile->institution_type ?? '') == 'University' ? 'selected' : '' }}>University</option>
                    <option value="College" {{ old('institution_type', $academicProfile->institution_type ?? '') == 'College' ? 'selected' : '' }}>College</option>
                    <option value="Polytechnic" {{ old('institution_type', $academicProfile->institution_type ?? '') == 'Polytechnic' ? 'selected' : '' }}>Polytechnic</option>
                </select>
                <x-input-error :messages="$errors->get('institution_type')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="course_name" :value="__('Course Name')" />
                <x-text-input id="course_name" class="block mt-1 w-full" type="text" name="course_name" 
                              value="{{ old('course_name', $academicProfile->course_name ?? '') }}" required />
                <x-input-error :messages="$errors->get('course_name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="level" :value="__('Level / Year of Study')" />
                <select id="level" name="level" class="w-full border p-2 rounded" required>
                    <option value="">Select year</option>
                    <option value="1" {{ old('level', $academicProfile->level ?? '') == '1' ? 'selected' : '' }}>Year 1</option>
                    <option value="2" {{ old('level', $academicProfile->level ?? '') == '2' ? 'selected' : '' }}>Year 2</option>
                    <option value="3" {{ old('level', $academicProfile->level ?? '') == '3' ? 'selected' : '' }}>Year 3</option>
                    <option value="4" {{ old('level', $academicProfile->level ?? '') == '4' ? 'selected' : '' }}>Year 4</option>
                </select>
                <x-input-error :messages="$errors->get('level')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="student_registration_number" :value="__('Student Registration Number')" />
                <x-text-input id="student_registration_number" class="block mt-1 w-full" type="text" name="student_registration_number" 
                              value="{{ old('student_registration_number', $academicProfile->student_registration_number ?? '') }}" required />
                <x-input-error :messages="$errors->get('student_registration_number')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="student_document">
                    Upload Student ID / Admission Letter
                    @if(!isset($academicProfile) || !$academicProfile->student_document)
                        <span class="text-red-500"></span>
                    @endif
                </x-input-label>
                <input type="file" name="student_document" id="student_document" accept="application/pdf,image/jpeg,image/png,image/jpg"
                       {{ (!isset($academicProfile) || !$academicProfile->student_document) ? 'required' : '' }}
                       class="w-full border px-3 p-2 rounded" />
                
                @if(isset($academicProfile) && $academicProfile->student_document)
                    <p class="text-sm text-gray-500 mt-1">Leave empty to keep current document, or upload a new one to replace it.</p>
                    <p class="text-sm text-green-600 font-medium mt-2">Current document uploaded</p>
                    <img src="{{ asset('storage/' . $academicProfile->student_document) }}" 
                             alt="Current ID" 
                             class="mt-2 max-w-xs border rounded">
                @else
                    <p class="text-sm text-gray-500 mt-1">Upload student ID or admission letter (PDF, JPG, PNG - Max 4MB)</p>
                @endif
                
                <x-input-error :messages="$errors->get('student_document')" class="mt-2" />
            </div>

            <div class="flex gap-4 justify-center">
                <x-primary-button class="px-6 py-3 rounded-full bg-primary-700 hover:bg-primary-500 text-white">
                    {{ isset($academicProfile) ? 'Resubmit Academic Profile' : 'Complete Academic Profile' }}
                </x-primary-button>
                
                @if(isset($academicProfile))
                    <a href="{{ route('student.dashboard') }}" class="px-6 py-3 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 inline-block">
                        Back to Dashboard
                    </a>
                @endif
            </div>
        </form>
    </div>
</x-guest-layout>