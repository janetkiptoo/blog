<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanProduct;
use App\Models\User;
use App\Models\LoanApplication;
use App\Models\LoanRepayment;


class LoanApplicationController extends Controller
{
   public function index($productId)
    {
        $product = LoanProduct::findOrFail($productId);
        return view('loans.apply', compact('product'));
    }


public function process_repayment(Request $request, $id)
{
    $user = auth()->user();

    $loan = LoanApplication::where('id', $id)
                ->where('user_id', $user->id)
                ->where('status', 'approved')
                ->firstOrFail();

    $paymentAmount = $request->amount;
    $balanceBefore = $loan->balance;

    // interest calculation
    $interest = $loan->balance * ($loan->interest_rate / 100);

    // Check late payment
    $penalty = 0;
    $lastRepayment = $loan->repayments()->latest('paid_at')->first();

    if ($lastRepayment) {
        $nextDueDate = $lastRepayment->paid_at->addMonth();
        if (now()->gt($nextDueDate)) {
            $monthsLate = now()->diffInMonths($nextDueDate);
            $penalty = $loan->monthly_payment * 0.02 * $monthsLate; // 2% per late month
        }
    }

    $principalPaid = $paymentAmount - $interest - $penalty;

    if ($principalPaid <= 0) {
        return back()->withErrors('Payment is too low to cover interest and penalty.');
    }

    // Update loan
    $loan->balance -= $principalPaid;
    if ($loan->balance < 0) {
        $loan->balance = 0;
        $loan->status = 'completed';
    }
    $loan->total_paid += $paymentAmount;
    $loan->late_penalty += $penalty;
    $loan->save();

    // Record repayment
    LoanRepayment::create([
        'loan_application_id' => $loan->id,
        'amount' => $paymentAmount,
        'interest' => $interest,
        'principal' => $principalPaid,
        'balance_before' => $balanceBefore,
        'balance_after' => $loan->balance,
        'payment_method' => $request->payment_method,
        'reference' => $request->reference,
        'paid_at' => now(),
        'late_penalty' => $penalty,
    ]);

    return redirect()->route('student.loans.repay', $loan->id)
                     ->with('success', 'Repayment recorded successfully.');
}

public function showRepayForm($id)
{
    $loan = LoanApplication::with(['loanProduct', 'repayments'])->where('id', $id)->where('user_id', auth()->id())->firstOrFail();

    return view('students.loans.repay', compact('loan'));
}

public function store(Request $request, $productId)
{
    $user = auth()->user();
    $request->validate([
        'loan_amount' => 'required|numeric|min:1',
        'term_months' => 'required|integer|min:1',
    ]);

    $loanAmount = $request->loan_amount;
    $termMonths = $request->term_months;
    $interestRate =  $request->interest_rate;
    $gracePeriod = 1;      
        

    // Interest only during repayment period
    $totalInterest = $loanAmount * ($interestRate / 100) * $termMonths;
    $totalPayable = $loanAmount + $totalInterest;
    $monthlyPayment = $totalPayable / $termMonths;

    $repaymentStartDate = now()->addMonth(); 
   

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
        'loan_amount' => $request->loan_amount,
        'term_months' => $request->term_months,
        'interest_rate' => $request->interest_rate,
        'balance' => $request->loan_amount,
        'total_paid' => round($totalPayable, 2),
        'monthly_payment' => round($monthly_payment, 2),
        'repayment_start_date' => $repaymentStartDate,
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