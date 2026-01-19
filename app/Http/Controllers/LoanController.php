<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function showRepay($id)
{
    $loan = LoanApplication::with('loanProduct')
            ->where('user_id', auth()->id()) 
            ->findOrFail($id);

    return view('students.loans.repay', compact('loan'));
}

public function repay(Request $request, $id)
{
    $loan = LoanApplication::where('user_id', auth()->id())->findOrFail($id);

    $request->validate([
        'amount' => 'required|numeric|min:1|max:' . $loan->balance ?? $loan->loan_amount,
    ]);

    
    $repaymentAmount = $request->amount;
    $loan->balance = ($loan->balance ?? $loan->loan_amount) - $repaymentAmount;

    
    if ($loan->balance <= 0) {
        $loan->status = 'Paid';
        $loan->balance = 0;
    }

    $loan->save();

    return redirect()->back()->with('success', 'Repayment successful!');
}
    //
}
