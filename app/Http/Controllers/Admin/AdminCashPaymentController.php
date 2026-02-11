<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CashPayment;
use App\Models\Payment;
use App\Models\LoanApplication;
use App\Models\LoanRepayment;
use App\Enums\PaymentChannel;
use App\Enums\PaymentStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminCashPaymentController extends Controller
{
    public function index()
    {
       $cashPayments = CashPayment::with(['user', 'loanApplication'])->where('status', 'pending')->latest()->get();
        return view('admin.cash-payments.index', compact('cashPayments'));
    }
public function approve(Request $request, $id)
{
    DB::transaction(function () use ($id) {

        $cashPayment = CashPayment::with(['loanApplication', 'payment'])
            ->lockForUpdate()
            ->findOrFail($id);

        if ($cashPayment->status !== 'pending') {
            abort(400, 'Payment already processed.');
        }

        $loan = $cashPayment->loanApplication;
        $payment = $cashPayment->payment;
        $amount = min($cashPayment->amount, $loan->balance); 
        $balanceBefore = $loan->balance;
        $loan->total_paid += $amount;
        $interestRemaining = max(0, $loan->total_interest - max(0, $loan->total_paid - $loan->loan_amount));
        $interestPaid = min($amount, $interestRemaining);
        $principalPaid = $amount - $interestPaid;
        $loan->balance = max(0, ($loan->loan_amount + $loan->total_interest) - $loan->total_paid);

        if ($loan->balance == 0) {
            $loan->status = 'paid';
        }

        $loan->save();
        $payment->update([
            'status' => PaymentStatus::SUCCESS,
        ]);
        $cashPayment->update([
            'status' => 'approved',
            'paid_at' => now(),
        ]);

        LoanRepayment::create([
            'loan_application_id' => $loan->id,
            'payment_id' => $payment->id,
            'amount' => $amount,
            'principal' => $principalPaid,
            'interest' => $interestPaid,
            'balance_before' => $balanceBefore,
            'balance_after' => $loan->balance,
            'paid_at' => now(),
            'late_penalty' => 0,
            'channel' => PaymentChannel::CASH,
            'status' => 'completed',
            'payment_method' => 'cash',
            'reference' => 'CASH-'.$cashPayment->id,
        ]);
    });

    return redirect()->back()->with('success', 'Cash payment approved successfully.');
}

public function reject(Request $request, $id) 
{
    $request->validate([
        'reason' => 'nullable|string|max:255',
    ]);

    $cashPayment = CashPayment::findOrFail($id); 

    if ($cashPayment->status !== 'pending') {
        abort(400, 'Payment already processed.');
    }

    $cashPayment->update([
        'status' => 'rejected',
        'processed_by' => auth()->id(),
        'processed_at' => now(),
        'rejected_reason' => $request->reason,
    ]);

    return back()->with('success', 'Cash payment rejected.');
}
}

