<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-center leading-tight">Student Dashboard </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">



            <p class="mb-4">Welcome, {{ Auth::user()->name }}</p>

            <!-- Loan Status -->
            <div class="bg-gray-100 p-6 rounded mb-4">
                <h3 class="text-lg font-semibold mb-2">Loan Status</h3>

                
                <p>Amount:</p>
                    <p>Status:</p>
                    
               
            </div>
            <p>You have not applied for any loan yet</p>
                    
               
                 
        </div>
    </div>
</x-app-layout>
