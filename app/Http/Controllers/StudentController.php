<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function create()
    {
        return view('students.create');
    }
   
    public function repay_loan()
    {
        return view('students.repay_loan');
    }
    //
    public function store(Request $request)
   {
        // Validate form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'national_id' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'institution' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'year_of_study' => 'required|string|max:50',
            'student_reg_no' => 'required|string|max:100',
            
            
          
        ]);
        // Save student
        Student::create($request->only(['name','email']));

        // Redirect back with success
        return redirect('home')->with('success', 'Student registered successfully.');
    }
}
