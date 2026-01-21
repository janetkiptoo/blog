<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Repayment;
use App\Models\LoanApplication;

class AdminRepaymentController extends Controller
{
      public function index()
    {
        $repayments = Repayment::with(['loan.user', 'loan.loanProduct'])
            ->orderBy('paid_at', 'desc')
            ->paginate(20);

        return view('admin.repayments.index', compact('repayments'));
    }
    //
    public function show(LoanApplication $loan)
    {
        $loan->load(['repayments', 'user', 'loanProduct']);

        return view('admin.repayments.show', compact('loan'));
    }
}
