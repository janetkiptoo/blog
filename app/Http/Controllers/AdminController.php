<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanApplication; 

class AdminController extends Controller
{
    public function index()
    {
        $loans = LoanApplication::with('user', 'loanProduct')->get();

        return view('admin.dashboard', compact('loans'));
    }
    public function showLoan($id)
    {
        $loan = LoanApplication::with('user', 'loanProduct')->findOrFail($id);

        return view('admin.loan_detail', compact('loan'));
    }
    public function approve($id){
     $loan = LoanApplication::findOrFail($id);
        $loan->update(['status' => 'approved']);

        return back()->with('success', 'Loan approved successfully.');
    }  
    
    public function reject($id){
        $loan=LoanApplication::findOrFail($id);
        $loan->update(['status' => 'rejected']);
        return back()->with('failed','loan rejected.');
    }     
}
