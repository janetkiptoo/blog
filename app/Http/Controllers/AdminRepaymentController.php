<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanRepayment;
use App\Enums\PaymentChannel;
use App\Enums\PaymentStatus;

class AdminRepaymentController extends Controller
{
    public function index()
    {
        // Eager load relationships
        $repayments = LoanRepayment::with([
            'loan.user',
            'loan.loanProduct',
            'payment.mpesa'
        ])->latest()->paginate(10);

        foreach ($repayments as $repayment) {
            $payment = $repayment->payment;

           
            $repayment->channel_name = $payment?->channel instanceof PaymentChannel
                ? ucfirst(str_replace('_', ' ', $payment->channel->value))
                : ($payment?->channel ?? 'N/A');

            
            $repayment->status_name = $payment?->status instanceof PaymentStatus
                ? ucfirst($payment->status->value)
                : 'N/A';

            // MPESA receipt
            $repayment->mpesa_receipt = $payment?->mpesa?->mpesa_receipt_number ?? '-';
        }

        return view('admin.repayments.index', compact('repayments'));
    }

    public function show($loanId)
    {
        $loan = \App\Models\LoanApplication::with(['repayments.payment', 'user', 'loanProduct'])
            ->findOrFail($loanId);

        return view('admin.repayments.show', compact('loan'));
    }
}
