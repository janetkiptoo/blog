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
    
public function index()
{
    $loans = LoanApplication::whereIn('status', ['submitted', 'under_review'])
        ->latest()
        ->paginate(20);

    return view('admin.loans.index', compact('loans'));
}


public function show(LoanApplication $loan)
{
    return view('admin.loans.show', [
        'loan' => $loan->load([
            'user.personalProfile',
            'user.academicProfile',
            'guarantors',
            'loanProduct',
            'repayments'
        ])
    ]);
}

public function approve(LoanApplication $loan)
{
    abort_if(
        $loan->guarantors()->where('status', 'approved')->count() < 2,
        422,
        'Loan must have 2 approved guarantors.'
    );

    $loan->update([
        'status' => 'approved',
        'approved_at' => now(),
        'approved_by' => auth()->id(),
    ]);

    return back()->with('success', 'Loan approved.');
}

public function reject(Request $request, LoanApplication $loan)
{
    $request->validate([
        'reason' => 'required|string|min:5',
    ]);

    $loan->update([
        'status' => 'rejected',
        'rejection_reason' => $request->reason,
    ]);

    return back()->with('success', 'Loan rejected.');
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

