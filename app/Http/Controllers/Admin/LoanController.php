<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoanApplication;
use App\Models\RepaymentSchedule;
use App\Models\LoanDisbursement;
use App\Services\MpesaServices;
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
        'approved_amount' => $loan->loan_amount,
        'approved_at' => now(),
    ]);

    return response()->json(['message' => 'Loan approved']);
}

public function disburse($id)
{
    $loan = LoanApplication::findOrFail($id);

    if ($loan->status !== LoanApplication::STATUS_APPROVED) {
        return back()->with('error', 'Only approved loans can be disbursed');
    }

    try {
        $mpesa = new MpesaServices();
        $phone = preg_replace('/^0/', '254', $loan->user->phone);
        $amount = $loan->approved_amount ?? $loan->loan_amount;

        $disbursement = LoanDisbursement::create([
            'loan_application_id' => $loan->id,
            'user_id' => $loan->user_id,
            'amount' => $amount,
            'phone_number' => $phone,
            'status' => 'pending',
            'transaction_id' => null,
            'result_type' => null,
            'disbursed_at' => now(),
        ]);

        $result = $mpesa->b2c($phone, $amount, $disbursement->id);

        // Update conversation IDs and check initial result
        $disbursement->update([
            'conversation_id' => $result['ConversationID'] ?? null,
            'originator_conversation_id' => $result['OriginatorConversationID'] ?? null,
        ]);

        if (($result['ResponseCode'] ?? 1) != 0) {
            $disbursement->update([
                'status' => 'failed',
                'result_desc' => $result['ResponseDescription'] ?? 'B2C request failed',
                'result_type' => $result['ResultType'] ?? null,
            ]);
            throw new \Exception($result['ResponseDescription'] ?? 'B2C request failed');
        }

        return back()->with('success', 'Disbursement initiated! Check callback for confirmation.');

    } catch (\Exception $e) {
        \Log::error('Disbursement Error', [
            'loan_id' => $loan->id,
            'error' => $e->getMessage(),
        ]);

        return back()->with('error', 'Disbursement failed. Check logs.');
    }
}



    
}

