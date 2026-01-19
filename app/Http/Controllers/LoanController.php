<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoanController extends Controller
{
 public function showRepay($id)
{
    $loan = LoanApplication::with(['loanProduct', 'repayments'])
        ->where('user_id', auth()->id())
        ->findOrFail($id);

    return view('students.loans.repay', compact('loan'));
}


public function repay(Request $request, $id)
{
    $loan = LoanApplication::where('user_id', auth()->id())
            ->where('status', 'approved')
            ->findOrFail($id);

    $maxAmount = $loan->balance ?? $loan->loan_amount;

    $request->validate([
        'amount' => "required|numeric|min:1|max:$maxAmount",
    ]);

    
    LoanRepayment::create([
        'loan_application_id' => $loan->id,
        'amount' => $request->amount,
        'paid_at' => now(),
    ]);

    
    $loan->balance = $maxAmount - $request->amount;

    if ($loan->balance <= 0) {
        $loan->balance = 0;
        $loan->status = 'paid'; 
    }

    $loan->save();

    return redirect()
        ->route('student.loans.repay', $loan->id)
        ->with('success', 'Repayment successful!');
}
    //
}
