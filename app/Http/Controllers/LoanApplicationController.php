<?php

namespace App\Http\Controllers;

use App\Models\LoanApplication;
use App\Models\LoanProduct;
use App\Models\LoanRepayment;
use App\Models\MpesaPayment;
use Illuminate\Support\Facades\Auth;
use App\Services\MpesaServices;
use App\Enums\PaymentChannel;
use Illuminate\Http\Request;

class LoanApplicationController extends Controller
{
    public function index($productId)
    {
        $product = LoanProduct::findOrFail($productId);

        return view('loans.apply', compact('product'));
    }

   public function process_repayment(Request $request, $id)
{
    $request->validate([
        'amount' => 'required|numeric|min:1',
        'payment_method' => 'required|string',
        'reference' => 'nullable|string',
    ]);

    $loan = LoanApplication::where('id', $id)
        ->where('user_id', auth()->id())
        ->where('status', 'approved')
        ->firstOrFail();

    if ($loan->repayment_start_date && now()->lt($loan->repayment_start_date)) {
        return back()->withErrors('Loan is still in grace period.');
    }

    if ($loan->balance <= 0) {
        return back()->withErrors('Loan is already fully paid.');
    }

    $paymentAmount = $request->amount;
    $reference = $request->reference;

    // Mpesa payment flow
    if ($request->payment_method === 'mpesa') {
        $phone = Auth::user()->phone;

        // Trigger STK push
        $result = (new MpesaServices())->stkPush($phone, $paymentAmount, $reference);

        // Save pending payment to mpesa_payments
        MpesaPayment::create([
            'payment_id' => $loan->id, // Or generate unique reference
            'phone' => preg_replace('/^0/', '254', $phone),
            'checkout_request_id' => $result['CheckoutRequestID'] ?? null,
            'merchant_request_id' => $result['MerchantRequestID'] ?? null,
            'amount' => $paymentAmount,
            'result_code' => null,
            'result_desc' => null,
            'paid_at' => null,

        ]);

        return back()->with('success', 'Mpesa STK Push initiated. Check your phone to complete payment.');
    }

    // Cash payment flow
    if ($paymentAmount > $loan->balance) {
        $paymentAmount = $loan->balance;
    }

    $balanceBefore = $loan->balance;
    $loan->balance -= $paymentAmount;
    $loan->total_paid += $paymentAmount;
    if ($loan->balance <= 0) {
        $loan->balance = 0;
        $loan->status = 'completed';
    }
    $loan->save();

    LoanRepayment::create([
        'loan_application_id' => $loan->id,
        'amount' => $paymentAmount,
        'principal' => $paymentAmount,
        'interest' => 0,
        'balance_before' => $balanceBefore,
        'balance_after' => $loan->balance,
        'paid_at' => now(),
        'late_penalty' => 0,
        'channel' => PaymentChannel::MPESA,
    ]);

    return back()->with('success', 'Payment recorded successfully.');
}

    public function showRepayForm($id)
{
    $loan = LoanApplication::with('repayments')->where('id', $id)->where('user_id', auth()->id())->firstOrFail();

    
    $repaymentMonths = $loan->term_months - $loan->loanProduct->grace_period_months;
    $monthlyPayment = $loan->monthly_payment;
    $totalPayable = $loan->monthly_payment * $repaymentMonths;
    $totalInterest = $totalPayable - $loan->loan_amount;

    return view('students.loans.repay', compact('loan', 'monthlyPayment', 'totalPayable', 'totalInterest'));
}


    public function store(Request $request, $productId)
    {
        $user = auth()->user();

        $request->validate([
            'loan_amount' => 'required|numeric|min:1',
            'term_months' => 'required|integer|min:2', // 1 grace + at least 1 payment
        ]);

        $product = LoanProduct::findOrFail($productId);

        $loanAmount = $request->loan_amount;
        $termMonths = $request->term_months;
        $interestRate = $product->interest_rate;
        $gracePeriod = $product->grace_period_months;
        $repaymentMonths = $termMonths - $gracePeriod;

        // Interest applied AFTER grace period
        $totalInterest = ($loanAmount * ($interestRate / 100)) * $repaymentMonths;
        $totalPayable = $loanAmount + $totalInterest;
        $monthlyPayment = $totalPayable / $repaymentMonths;

        $loan = LoanApplication::create([
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'national_id' => $user->national_id,
            'institution' => $user->institution,
            'course' => $user->course,
            'year_of_study' => $user->year_of_study,
            'student_reg_no' => $user->student_reg_no,
            'user_id' => $user->id,
            'loan_product_id' => $productId,
           'loan_amount' => $loanAmount,
           'term_months'  => $termMonths,
           'interest_rate' => $interestRate,
           'monthly_payment'=>$monthlyPayment,
           'total_interest'=>$totalInterest,
           'total_paid'=> 0,
           'balance' => $loanAmount,
           'repayment_start_date' => now()->addMonth(),
           'status' => 'pending',
        ]);

        return redirect()->route('student.guarantors.create', $loan->id);
    }

    public function destroy(LoanApplication $loan_application)
    {
        $user = auth()->user();

        if ($loan_application->user_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        if ($loan_application->status !== 'pending') {
            return redirect()->route('student.loans.index')->with('error', 'Only pending loan applications can be deleted.');
        }

        $loan_application->delete();

        return redirect()->route('student.loans.index')->with('success', 'Loan application deleted successfully.');
    }
}
