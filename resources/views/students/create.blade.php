<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800  leading-tight">
            {{ __('Register Student') }}
        </h2>
    </x-slot>
<section class="flex justify-center items-center py-10 px-6 flex-col min-h-screen bg-white">
    <div class="bg-gray-100 rounded-lg shadow-lg p-8 max-w-2xl w-full">

        <h1 class="text-2xl font-bold text-gray-800 text-center mb-6">Register to apply</h1>
          <form action="/students" method="POST" class="space-y-2">
            @csrf
            <div>
                <label for="name" class="block text-gray-700 ">Name</label>
                <input type="text" id="name" name="name" required class="w-full border border-gray-300 rounded px-10 py-20">

                <label for="email" class="block text-gray-700 mb-1 mt-3">Email</label>
                <input type="email" id="email" name="email" required class="w-full border border-gray-300 rounded px-3 py-2">

                
                <label for="course" class="block text-gray-700 mb-1 mt-3">Course</label>
                <input type="text" id="course" name="course" required class="w-full border border-gray-300 rounded px-3 py-2">

            
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-40 py-2 rounded mt-4 w-full">
                Register
            </button>
            
 </form>

    </div>
</section>
</x-app-layout>