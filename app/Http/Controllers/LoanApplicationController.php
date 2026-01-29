<?php

namespace App\Http\Controllers;

use App\Models\LoanApplication;
use App\Models\LoanProduct;
use App\Models\LoanRepayment;
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
        ]);

        // Get the approved loan
        $loan = LoanApplication::where('id', $id)
            ->where('user_id', auth()->id())
            ->where('status', 'approved')
            ->firstOrFail();

        // Check grace period
        if ($loan->repayment_start_date && now()->lt($loan->repayment_start_date)) {
            return back()->withErrors('Loan is still in grace period.');
        }

        // Already fully paid?
        if ($loan->balance <= 0) {
            return back()->withErrors('Loan is already fully paid.');
        }

        $paymentAmount = $request->amount;
        $balanceBefore = $loan->balance;

        // Prevent overpayment
        if ($paymentAmount > $loan->balance) {
            $paymentAmount = $loan->balance;
        }

        // Reduce balance and increase total paid
        $loan->balance -= $paymentAmount;
        $loan->total_paid += $paymentAmount;

        // Update loan status if fully paid
        if ($loan->balance <= 0) {
            $loan->balance = 0;
            $loan->status = 'completed';
        }

        $loan->save();

        // Log repayment
        LoanRepayment::create([
            'loan_application_id' => $loan->id,
            'amount' => $paymentAmount,
            'principal' => $paymentAmount,         
            'interest' => $loan->total_interest,    
            'balance_before' => $balanceBefore,
            'balance_after' => $loan->balance,
            // 'payment_method' => $request->payment_method,
            // 'reference' => $request->reference ?? null,
            'paid_at' => now(),
            'late_penalty' => 0,                     // Optional
        ]);

        return back()->with('success', 'Payment recorded successfully.');
    }

    public function showRepayForm($id)
{
    $loan = LoanApplication::with('repayments')
        ->where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    
    $monthlyPayment = $loan->monthly_payment;
    $totalPayable = $loan->monthly_payment * $loan->term_months;
    $totalInterest = $loan->total_interest;

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
        $totalInterest = $loanAmount * ($interestRate / 100) * $repaymentMonths;
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
            'term_months' => $termMonths,
            'interest_rate' => $interestRate,
            'balance' => $loanAmount,
            'monthly_payment' => round($monthlyPayment, 2),
            'total_paid' => 0,
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
