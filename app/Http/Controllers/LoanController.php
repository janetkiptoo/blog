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



    //
}
