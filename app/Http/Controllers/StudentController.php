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

     
        $loan = LoanApplication::where('user_id', auth()->id()) 
                               ->orderBy('created_at', 'desc')
                               ->first();

        return view('student.dashboard', compact('student', 'loan'));
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

   
    public function repayLoan($id)
    {
        
        $loan = LoanApplication::with('loanProduct')->where('id', $id)->where('user_id', auth()->id()) ->firstOrFail();
        return view('students.loans.repay', compact('loan'));
    }

   
    public function process_repayment(Request $request, $id)
    {
        $loan = LoanApplication::where('id', $id)
                ->where('user_id', auth()->id())
                ->firstOrFail();

        $maxAmount = $loan->balance ?? $loan->loan_amount;

        $request->validate(['amount' => "required|numeric|min:1|max:$maxAmount",
        ]);

        $payment = $request->amount;
        $loan->balance = ($loan->balance ?? $loan->loan_amount) - $payment;

        if ($loan->balance <= 0) {
            $loan->balance = 0;
            $loan->status = 'paid';
        }

        $loan->save();

        return redirect()->route('student.loans.repay', $loan->id)
                         ->with('success', "Payment of KES {$payment} successful.");
    }
}
