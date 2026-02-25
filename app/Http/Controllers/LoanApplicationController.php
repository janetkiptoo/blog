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
use App\Enums\PaymentStatus;
use Illuminate\Http\Request;
use App\Models\CashPayment;
use App\Models\Guarantor;



class LoanApplicationController extends Controller
{
    public function index($productId)
    {
        $product = LoanProduct::findOrFail($productId);
        return view('loans.apply', compact('product'));
    }
    



 private function ensureEligibility($user)
{
    abort_if(
        optional($user->personalProfile)->status !== 'approved' ||
        optional($user->academicProfile)->status !== 'approved',
        403,
        'Complete and approve your profile before applying.'
    );
}

public function process_repayment(Request $request, $id)
{
    $request->validate([
        'amount' => 'required|numeric|min:1',
        'channel' => 'required|in:mpesa,cash',
        'reference' => 'nullable|string',
    ]);

    $loanApplication = LoanApplication::where('id', $id)
        ->where('user_id', auth()->id())
        ->where('status', 'approved')
        ->firstOrFail();

    if ($loanApplication->repayment_start_date && now()->lt($loanApplication->repayment_start_date)) {
        return response()->json([
            'success' => false,
            'message' => 'Loan is still in grace period.'
        ], 400);
    }

    if ($loanApplication->balance <= 0) {
        return response()->json([
            'success' => false,
            'message' => 'Loan is already fully paid.'
        ], 400);
    }

    $amount = min($request->amount, $loanApplication->balance);

    if ($request->channel === 'mpesa') {
    $mpesaController = app(\App\Http\Controllers\MpesaController::class);

    $stkResponse = $mpesaController->stkPush(new \Illuminate\Http\Request([
        'amount' => $amount,
        'phonenumber' => auth()->user()->phone,
        'account_number' => $loanApplication->id
    ]));

    return $stkResponse;
}

    if ($request->channel === 'cash') {
        $payment = Payment::create([
            'user_id' => auth()->id(),
            'loan_id' => $loanApplication->id,
            'amount' => $amount,
            'channel' => 'cash',
            'status' => 'pending',
        ]);

        CashPayment::create([
            'payment_id' => $payment->id,
            'loan_application_id' => $loanApplication->id,
            'user_id' => auth()->id(),
            'amount' => $amount,
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Cash payment submitted. Awaiting admin approval.'
        ]);
    }
}


  public function showRepayForm($id)
{
    $loan = LoanApplication::with('repayments')
        ->where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    
    if ($loan->status !== LoanApplication::STATUS_DISBURSED) {
        abort(403, 'Repayment is only allowed after loan disbursement.');
    }

    $repaymentMonths = $loan->term_months - $loan->loanProduct->grace_period_months;
    $monthlyPayment  = $loan->monthly_payment;
    $totalPayable    = $monthlyPayment * $repaymentMonths;
    $totalInterest   = $totalPayable - $loan->loan_amount;

    return view('students.loans.repay', compact(
        'loan',
        'monthlyPayment',
        'totalPayable',
        'totalInterest'
    ));
}

public function store(Request $request, $productId)
{
    $user = auth()->user();

    
    $this->ensureEligibility($user);


    $product = LoanProduct::findOrFail($productId);

    $request->validate([
        'loan_amount' => ['required','numeric','min:' . $product->min_loan_amount,'max:' . $product->max_loan_amount,],
        'term_months' => ['required','integer','min:1', 'max:' . $product->loan_term_months,],
    ], [
        'term_months.max' => 'The loan duration cannot exceed ' . $product->loan_term_months . ' months.',
    ]);

    $product = LoanProduct::findOrFail($productId);

    
    $loanAmount   = $request->loan_amount;
    $termMonths   = $request->term_months;
    $interestRate = $product->interest_rate;
    $gracePeriod  = $product->grace_period_months;

    $repaymentMonths = max(1, $termMonths - $gracePeriod);

    $totalInterest  = ($loanAmount * ($interestRate / 100)) * $repaymentMonths;
    $totalPayable   = $loanAmount + $totalInterest;
    $monthlyPayment = $totalPayable / $repaymentMonths;

    
    $loan = LoanApplication::create([
        'user_id'         => $user->id,
        'loan_product_id' => $product->id,
        'loan_amount'     => $loanAmount,
        'term_months'     => $termMonths,
        'interest_rate'   => $interestRate,
        'monthly_payment' => $monthlyPayment,
        'total_interest'  => $totalInterest,
        'total_paid'      => 0,
        'balance'         => $totalPayable,
        'status'          => 'draft',
    ]);

   return redirect()->route(
    'student.loans.guarantors.create',
    $loan->id
);
}

public function confirm(LoanApplication $loan)
{
    abort_if($loan->user_id !== auth()->id(), 403);
    abort_if($loan->status !== 'draft', 403);
    

    return view('student.loans.confirm-guarantors', [
        'loan' => $loan,
        'guarantors' => $loan->guarantors
    ]);
}


public function submit(Request $request, LoanApplication $loan)
{
    abort_if($loan->user_id !== auth()->id(), 403);
    abort_if($loan->status !== 'draft', 403);
    
    abort_if(
    empty($loan->disbursement_method) ||
    (
        $loan->disbursement_method === 'mpesa' &&
        empty($loan->disbursement_phone)
    ) ||
    (
        $loan->disbursement_method === 'bank' &&
        (empty($loan->bank_name) || empty($loan->bank_account_number))
    ),
    403,
    'Please provide disbursement details before submitting.'
);
    

    $request->validate([
        'accept_terms' => 'accepted',
    ]);

    abort_if(
    $loan->guarantors()->count() < 2,
    403,
    'You must add 2 guarantors before submitting the loan.'
);

    $loan->update([
        'status' => 'submitted',
        'submitted_at' => now(),
    ]);

    return redirect()
        ->route('student.dashboard')
        ->with('success', 'Loan application submitted successfully.');
}

public function review(LoanApplication $loan)
{
    $user = auth()->user();

    abort_if($loan->user_id !== $user->id, 403);
    abort_if($loan->status !== 'draft', 403);

   
    

    return view('student.loans.review', [
        'loan' => $loan->load('loanProduct'),
        'personalProfile' => $user->personalProfile,
        'academicProfile' => $user->academicProfile,
        'guarantors' => $loan->guarantors,
    ]);
}




    public function destroy(LoanApplication $loan_application)
    {
        $user = auth()->user();

        if ($loan_application->user_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        if ($loan_application->status !== 'draft') {
            return redirect()->route('student.loans.index')->with('error', 'Only pending loan applications can be deleted.');
        }

        $loan_application->delete();

        return redirect()->route('student.loans.index')->with('success', 'Loan application deleted successfully.');
    }


public function replaceGuarantor(LoanApplication $loan, Guarantor $guarantor)
{
    abort_if($loan->user_id !== auth()->id(), 403);
    abort_if($loan->status !== 'draft', 403);
    abort_if($guarantor->loan_application_id !== $loan->id, 403);

    $guarantor->update(['status' => 'replaced']);
    $guarantor->delete();

    return redirect()
        ->route('student.loans.guarantors.create', $loan->id)
        ->with('info', 'Guarantor replaced. Please add a new guarantor.');
}
public function disbursementForm(LoanApplication $loan)
{
    abort_if($loan->user_id !== auth()->id(), 403);
    abort_if($loan->status !== 'draft', 403);

    return view('student.loans.disbursement', compact('loan'));
}

public function saveDisbursement(Request $request, LoanApplication $loan)
{
    abort_if($loan->user_id !== auth()->id(), 403);
    abort_if($loan->status !== 'draft', 403);

    $request->validate([
        'disbursement_method' => 'required|in:mpesa,bank',
        'disbursement_phone' => 'required_if:disbursement_method,mpesa|digits:10',
        'bank_name' => 'required_if:disbursement_method,bank',
        'bank_account_number' => 'required_if:disbursement_method,bank',
    ]);

    $loan->update($request->only([
        'disbursement_method',
        'disbursement_phone',
        'bank_name',
        'bank_account_number',
    ]));

    return redirect()
        ->route('student.loans.review', $loan)
        ->with('success', 'Disbursement details saved.');
}

    
}
