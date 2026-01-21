<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="national_id" :value="__('National ID')" />
            <x-text-input id="national_id" class="block mt-1 w-full" type="number" name="national_id" :value="old('national_id')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('national_id')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="number" name="phone" :value="old('phone')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="institution" :value="__('Institution')" />
            <x-text-input id="institution" class="block mt-1 w-full" type="text" name="institution" :value="old('institution')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('institution')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="course" :value="__('Course')" />
            <x-text-input id="course" class="block mt-1 w-full" type="text" name="course" :value="old('course')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('course')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="year_of_study" :value="__('Year of Study')" />
            <x-text-input id="year_of_study" class="block mt-1 w-full" type="number" name="year_of_study" :value="old('year_of_study')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('year_of_study')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="student_reg_no" :value="__('student_reg_no')" />
            <x-text-input id="student_reg_no" class="block mt-1 w-full" type="text" name="student_reg_no" :value="old('student_reg_no')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('student_reg_no')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 " href="{{ route('login') }}">
                Already registered?
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
