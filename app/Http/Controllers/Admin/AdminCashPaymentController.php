<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CashPayment;
use App\Models\LoanApplication;
use App\Models\LoanRepayment;
use App\Enums\PaymentChannel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminCashPaymentController extends Controller
{
    public function index()
    {
        $cashPayments = CashPayment::with(['user', 'loanApplication.loan'])->where('status', 'pending')->latest()->get();
        return view('admin.cash-payments.index', compact('cashPayments'));
    }

    public function approve($loanId)
    {
         $loan = LoanApplication::findOrFail($loanId);
        DB::transaction(function () use ($loanId) {

            $cashPayment = CashPayment::with('loanApplication.loan')->lockForUpdate()->where('loan_application_id', $loanId)->firstOrFail();

            if ($cashPayment->status !== 'pending') {
                abort(400, 'Payment already processed.');
            }

            $loan = $cashPayment->loaapplication->loan;
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

            $cashPayment->application->update([
                'status' => 'completed',
            ]);
        });

        return back()->with('success', 'Cash payment approved and loan updated.');
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

        $cashPayment->application->update([
            'status' => 'rejected',
        ]);

        return back()->with('success', 'Cash payment rejected.');
    }
}

