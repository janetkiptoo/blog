<x-guest-layout>
    <div class="text-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Academic & Verification Details</h1>
        <p class="text-gray-600 mt-2">
            Complete your academic profile and upload proof to verify your student status.
        </p>
    </div>

    <form method="POST" action="{{ route('student.profile.academic.update') }}" enctype="multipart/form-data" class="space-y-4 max-w-3xl mx-auto bg-gray-100 p-6 rounded-lg shadow">
        @csrf

        <div>
            <x-input-label for="institution_name" :value="__('Institution Name')" />
            <x-text-input id="institution_name" class="block mt-1 w-full" type="text" name="institution_name" value="{{ old('institution_name', $user->institution_name) }}" required />
            <x-input-error :messages="$errors->get('institution_name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="institution_type" :value="__('Institution Type')" />
            <select id="institution_type" name="institution_type" class="w-full border p-2 rounded" required>
                <option value="">Select type</option>
                <option value="University" {{ $user->institution_type == 'University' ? 'selected' : '' }}>University</option>
                <option value="College" {{ $user->institution_type == 'College' ? 'selected' : '' }}>College</option>
                <option value="Polytechnic" {{ $user->institution_type == 'Polytechnic' ? 'selected' : '' }}>Polytechnic</option>
            </select>
            <x-input-error :messages="$errors->get('institution_type')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="course_name" :value="__('Course Name')" />
            <x-text-input id="course_name" class="block mt-1 w-full" type="text" name="course_name" value="{{ old('course_name', $user->course_name) }}" required />
            <x-input-error :messages="$errors->get('course_name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="level" :value="__('Level / Year of Study')" />
            <select id="level" name="level" class="w-full border p-2 rounded" required>
                <option value="">Select year</option>
                <option value="1" {{ $user->level == '1' ? 'selected' : '' }}>1</option>
                <option value="2" {{ $user->level == '2' ? 'selected' : '' }}>2</option>
                <option value="3" {{ $user->level == '3' ? 'selected' : '' }}>3</option>
                <option value="4" {{ $user->level == '4' ? 'selected' : '' }}>4</option>
            </select>
            <x-input-error :messages="$errors->get('level')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="student_document" :value="__('Upload Student ID / Admission Letter')" />
            <input type="file" name="student_document" id="student_document" class="w-full border p-2 rounded" required />
            <x-input-error :messages="$errors->get('student_document')" class="mt-2" />
        </div>

        <div class="text-center">
            <x-primary-button class="px-6 py-3 rounded-full bg-primary-700 hover:bg-primary-500 text-white">
                Complete Academic Profile
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
