<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoanApplication;
use App\Models\RepaymentSchedule;
use App\Models\LoanDisbursement;
use Carbon\Carbon;

class LoanController extends Controller
{
    
    public function approveLoan($loanId)
    {
        $loan = LoanApplication::findOrFail($loanId);

        if ($loan->status !== LoanApplication::STATUS_PENDING) {
            return response()->json(['error' => 'Loan not pending approval'], 400);
        }

        $loan->update([
            'status' => LoanApplication::STATUS_APPROVED,
            'approved_at' => now(),
        ]);

        return response()->json(['message' => 'Loan approved']);
    }

    
    public function disburseLoan($loanId)
    {
        $loan = LoanApplication::with('user')->findOrFail($loanId);

        if ($loan->status !== LoanApplication::STATUS_APPROVED) {
            return response()->json(['error' => 'Loan must be approved before disbursement'], 400);
        }

        $disbursement = LoanDisbursement::create([
            'loan_application_id' => $loan->id,
            'user_id' => $loan->user->id,
            'amount' => $loan->amount,
            'phone_number' => $loan->user->phone,
            'status' => 'pending', 
        ]);

        $loan->update([
            'status' => LoanApplication::STATUS_DISBURSED,
            'disbursed_at' => now(),
        ]);

        $this->generateRepaymentSchedule($loan);

        return response()->json([
            'message' => 'Loan disbursed and repayment schedule created',
            'disbursement_id' => $disbursement->id
        ]);
    }
    

    protected function generateRepaymentSchedule(LoanApplication $loan)
    {
        $monthlyPayment = $loan->amount / $loan->term_months; 
        $dueDate = Carbon::now()->addMonth();

        for ($i = 1; $i <= $loan->term_months; $i++) {
            RepaymentSchedule::create([
                'loan_application_id' => $loan->id,
                'amount_due' => $monthlyPayment,
                'due_date' => $dueDate->copy(),
                'status' => 'pending',
            ]);

            $dueDate->addMonth();
        }
    }
}

