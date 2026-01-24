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

    $loan = LoanApplication::where('id', $id)->where('user_id', $user->id)->where('status', 'approved')->firstOrFail();

    $maxAmount = $loan->balance ?? $loan->loan_amount;

    $request->validate([
        'amount' => "required|numeric|min:1|max:$maxAmount",
    ]);


    LoanRepayment::create([
        'loan_application_id' => $loan->id,
        'amount' => $request->amount,
        'paid_at' => now(), 
    ]);
    
    $loan->balance = $maxAmount - $request->amount;
    if ($loan->balance <= 0) {
        $loan->balance = 0;
        $loan->status = 'paid';
    }
    $loan->save();

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
    ]);

   
    $exists = LoanApplication::where('user_id', $user->id)->where('loan_product_id', $productId)->whereIn('status', [ 'approved'])
        ->exists();

    if ($exists) {
         return redirect()->route('student.loans.index') 
                         ->with('error','you have an existing loan product application');
    }

    
    LoanApplication::create([
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
        'status' => 'pending',
        'approved_amount' => null,
    ]);

    return redirect()->route('student.dashboard') ->with('success', 'Loan application submitted successfully.');
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