<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\LoanApplication;

class StudentController extends Controller
{
    public function dashboard()
    {
        $student = auth()->user()->student;

        if (!$student) {
            return redirect()->route('students.create')->with('error', 'Please register as a student first.');
        }

        $loan = LoanApplication::where('student_id', $student->id)
            ->orderBy('created_at', 'desc')
            ->first();

        return view('dashboard', compact('student', 'loan'));
    }

    public function create()
    {
        return view('students.create'); // Blade file for student registration
    }

    public function repay_loan()
    {
        return view('students.repay_loan');
    }

    public function store(Request $request)
    {
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

        Student::create($request->only([
            'name','email','national_id','phone','institution','course','year_of_study','student_reg_no'
        ]));

        return redirect()->route('student.dashboard')->with('success', 'Student registered successfully.');
    }
}
