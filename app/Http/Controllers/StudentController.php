<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Users;
use App\Models\LoanApplication;
use App\Models\AcademicProfile;
use App\Models\PersonalProfile;
use App\Models\guarantors;

class StudentController extends Controller
{

    public function dashboard()
    {
        $student = auth()->user()->student;
        $user = auth()->user();
        $loans = LoanApplication::with('loanProduct')->where('user_id', $user->id)->get();

     
        $loan = LoanApplication::where('user_id', auth()->id()) 
                               ->orderBy('created_at', 'desc')
                               ->first();

        
    return view('student.dashboard', [
        'personalProfile' => $user->personalProfile,
        'academicProfile' => $user->academicProfile,
        
        'loanEligible' =>
            optional($user->personalProfile)->status === 'approved'
            && optional($user->academicProfile)->status === 'approved'
           ,
        
    ]);
    }

 

    public function pay()
    {
        return view('student.pay');
    }

   
    public function create()
    {
        return view('students.create'); 
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

        $student = Student::create($request->only(['name','email','national_id','phone','institution','course','year_of_study','student_reg_no'
        ]));

        return redirect()->route('student.dashboard')->with('success', 'Student registered successfully.');
    }

   

     public function myLoans()
    {
        $loans = LoanApplication::with('loanProduct')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('students.loans.index', compact('loans'));
    }

   
   
}
