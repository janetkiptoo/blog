@extends('layouts.web')

@section('title', 'Contact ')

@section('content')
<section class="flex justify-center items-center py-10 px-6 flex-col min-h-screen bg-white">
    <div class="bg-gray-100 rounded-lg shadow-lg p-8 max-w-2xl w-full">

        <h1 class="text-2xl font-bold text-gray-800 text-center mb-6">Register as a Student</h1>
          <form action="{{ route('students.store') }}" method="POST" class="space-y-2">
            @csrf
            <div>
                <label for="national_id" class="block text-gray-700 mb-1 mt-3">National ID</label>
                <input type="text" id="national_id" name="national_id" required class="w-full border border-gray-300 rounded px-3 py-2">

                <label for="phone" class="block text-gray-700 mb-1 mt-3">Phone</label>
                <input type="text" id="phone" name="phone" required class="w-full border border-gray-300 rounded px-3 py-2">

                
                <label for="institution" class="block text-gray-700 mb-1 mt-3">Institution</label>
                <input type="text" id="institution" name="institution" required class="w-full border border-gray-300 rounded px-3 py-2">

                <label for="course" class="block text-gray-700 mb-1 mt-3">Course</label>    
                <input type="text" id="course" name="course" required class="w-full border border-gray-300 rounded px-3 py-2">

                <label for="year_of_study" class="block text-gray-700 mb-1 mt-3">Year of Study</label>
                <input type="text" id="year_of_study" name="year_of_study" required class="w-full border border-gray-300 rounded px-3 py-2">
                
                <label for="student_reg_no" class="block text-gray-700 mb-1 mt-3">Student Registration Number</label>
                <input type="text" id="student_reg_no" name="student_reg_no" required class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-40 py-2 rounded mt-4 w-full">
                Register
            </button>
            
 </form>

    </div>
</section>
@endsection