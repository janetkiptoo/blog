<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CashPayment;
use App\Models\Payment;
use App\Models\LoanApplication;
use App\Models\LoanRepayment;
use App\Enums\PaymentChannel;
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
        
        $cashPayment = CashPayment::with('loanApplication')
            ->lockForUpdate()
            ->findOrFail($id); 

        if ($cashPayment->status !== 'pending') {
            abort(400, 'Payment already processed.');
        }
        
        $loan = $cashPayment->loanApplication;
        $amount = min($cashPayment->amount, $loan->balance);
        $balanceBefore = $loan->balance;

        $loan->balance -= $amount;
        $loan->total_paid += $amount;

        if ($loan->balance <= 0) {
            $loan->balance = 0;
            $loan->status = 'completed'; 
        }

        $loan->save();

       
        LoanRepayment::create([
            'loan_application_id' => $loan->id,
            'amount' => $amount,
            'principal' => $amount,
            'interest' => 0,
            'balance_before' => $balanceBefore,
            'balance_after' => $loan->balance,
            'paid_at' => now(),
            'late_penalty' => 0,
            'channel' => PaymentChannel::CASH,
        ]);

        
        $cashPayment->update([
            'status' => 'approved',
            'processed_by' => auth()->id(),
            'processed_at' => now(),
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
    ]);

    return back()->with('success', 'Cash payment rejected.');
}
}

