<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoanApplication;
use App\Models\RepaymentSchedule;
use App\Models\LoanDisbursement;
use App\Services\MpesaServices;
use Carbon\Carbon;;
use App\Models\LoanProduct;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

   public function index(Request $request)
{
    $query = LoanApplication::with(['user', 'loanProduct']);

    if ($request->filled('student')) {
        $query->whereHas('user', function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->student . '%')
              ->orWhere('student_reg_no', 'like', '%' . $request->student . '%');
        });
    }

    $applications = $query->latest()->paginate(10)->withQueryString();
    $loanProducts = LoanProduct::all();
    $loans = LoanApplication::with(['user', 'loanProduct'])->get();

    return view('admin.loans', compact('applications', 'loanProducts','loans'));
}

 

    public function loans()
    {
        $loans = LoanApplication::with(['user', 'loanProduct'])->get();
        return view('admin.loans', compact('loans'));
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users.user-profile', compact('users'));
    }

    public function products()
    {
        $products = LoanProduct::all();
        return view('admin.loan-products', compact('products'));
    }


   public function approve($id)
{
    $loan = LoanApplication::findOrFail($id);

    if ($loan->status !== LoanApplication::STATUS_PENDING) {
        return response()->json(['error' => 'Loan not pending approval'], 400);
    }

    $loan->update([
        'status' => LoanApplication::STATUS_APPROVED,
        'approved_amount' => $loan->loan_amount,
        'balance' => $loan->loan_amount + $loan->total_interest, 
        'approved_at' => now(),
    ]);

    return response()->json(['message' => 'Loan approved']);
}






    public function reject($id)
    {
        $loan = LoanApplication::findOrFail($id);
        $loan->status = 'rejected';
        $loan->save();

        return redirect()->back()->with('success','Loan rejected.');
    }

    public function storeLoanProduct(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'min_loan_amount' => 'required|numeric',
            'max_loan_amount' => 'required|numeric',
            'interest_rate' => 'required|numeric',
            'loan_term_months' => 'required|integer',
            'grace_period_months' => 'required|integer'
        ]);

        LoanProduct::create($request->all());

        return redirect()->back()->with('success','Loan product added!');
    }
}
