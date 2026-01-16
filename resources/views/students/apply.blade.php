<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Apply for Student Loan
        </h2>
    </x-slot>

    <section class="min-h-screen bg-gray-100 flex justify-center items-center py-10 px-4">
        <form action="{{ route('students.apply') }}"  method="POST"class="bg-white  p-8 w-full max-w-3xl space-y-6">
            @csrf
           <h3 class="text-lg font-semibold text-gray-700">Personal information: {{ Auth::user()->name }}</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
               

                <div>
                    <label class="block text-sm font-medium">National id</label>
                    <input type="text" id="national_id" name="national_id" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium">Phone Number</label>
                    <input type="text" id="phone" name="phone" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                </div>
            </div>


            <h3 class="text-lg font-semibold text-gray-700">Academic information</h3>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">Institution</label>
                    <input type="text" id="institution" name="institution"class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium">Course</label>
                    <input type="text" id="course" name="course"class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium">Year of Study</label>
                    <input type="number" id="year_of_study" name="year_of_study" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                  
                </div>

                <div>
                    <label class="block text-sm font-medium">Student Registration Number</label>
                    <input type="text" id="student_reg_no" name="student_reg_no" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                </div>
            </div>

     <h3 class="text-lg font-semibold text-gray-700">Loan Details</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">Loan Amount Requested</label>
                    <input type="number" id="loan_amount" name="loan_amount" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium">Purpose of Loan</label>
                    <input type="text" id="loan_purpose" name="loan_purpose" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                </div>
</div>
        

            
            <div class="text-center">
                 <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-40 py-2 rounded mt-4 w-full">
                Submit Application
            </button>
            </div>
        </form>
    </section>
@endsection
