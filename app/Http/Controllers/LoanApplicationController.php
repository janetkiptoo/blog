<?php

namespace App\Http\Controllers;

use App\Models\LoanApplication;
use App\Models\LoanProduct;
use App\Models\LoanRepayment;
use App\Models\MpesaPayment;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use App\Services\MpesaServices;
use App\Enums\PaymentChannel;
use Illuminate\Http\Request;
use App\Models\CashPayment;



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
        'channel' => 'required|in:mpesa,cash',
        'reference' => 'nullable|string',
    ]);

    $loanApplication = LoanApplication::where('id', $id)->where('user_id', auth()->id())->where('status', 'approved')->firstOrFail();
        
    if ($loanApplication->repayment_start_date && now()->lt($loanApplication->repayment_start_date)) {
        return response()->json(['success' => false, 'message' => 'Loan is still in grace period.'], 400);
    }

    if ($loanApplication->balance <= 0) {
        return response()->json(['success' => false, 'message' => 'Loan is already fully paid.'], 400);
    }

    $amount = min($request->amount, $loanApplication->balance);

    if ($request->channel === 'mpesa') {
        $phone = Auth::user()->phone;
        $result = (new MpesaServices())->stkPush($phone, $amount, $request->reference);

        MpesaPayment::create([
            'payment_id' => $loanApplication->id,
            'phone' => preg_replace('/^0/', '254', $phone),
            'checkout_request_id' => $result['CheckoutRequestID'] ?? null,
            'merchant_request_id' => $result['MerchantRequestID'] ?? null,
            'amount' => $amount,
        ]);

        return response()->json(['success' => true, 'message' => 'Mpesa STK Push initiated.']);
    }

    if ($request->channel === 'cash') {
        // Create Payment record
        $payment = Payment::create([
            'user_id' => auth()->id(),
            'loan_application_id' => $loanApplication->id,
            'amount' => $amount,
            'channel' => 'cash',
            'status' => 'pending',
        ]);

        // Create CashPayment record
        CashPayment::create([
            'payment_id' => $payment->id,
            'loan_application_id' => $loanApplication->id,
            'user_id' => auth()->id(),
            'amount' => $amount,
            'status' => 'pending',
        ]);

        return response()->json(['success' => true, 'message' => 'Cash payment submitted. Awaiting admin approval.']);
    }
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
