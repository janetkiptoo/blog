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
    //
    public function store(Request $request)
   {
        // Validate form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            
          
        ]);

        // Save student
        Student::create($request->only(['name','email', 'course']));

        // Redirect back with success
        return redirect('home')->with('success', 'Student registered successfully.');
    }
}
