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
        $loans = LoanApplication::with(['user', 'loanProduct'])->when($request->status, function ($q) use ($request) {
            $q->where('status', $request->status);
            })
            ->latest()
            ->paginate(15);

        return view('admin.loans.index', compact('loans'));
    }

public function show(LoanApplication $loan)
{
    return view('admin.loans.show', [
        'loan' => $loan->load([
            'user.personalProfile',
            'user.academicProfile',
            'guarantors',
            'loanProduct',
            'repayments'
        ])
    ]);
}


public function approve(LoanApplication $loan)
{
    abort_if(
        $loan->guarantors()->where('status', 'approved')->count() < 2,
        422,
        'Loan must have 2 approved guarantors.'
    );

    $loan->update([
        'status' => 'approved',
        'approved_at' => now(),
        'approved_by' => auth()->id(),
    ]);

    return back()->with('success', 'Loan approved.');
}

public function reject(Request $request, LoanApplication $loan)
{
    $request->validate([
        'reason' => 'required|string|min:5',
    ]);

    $loan->update([
        'status' => 'rejected',
        'rejection_reason' => $request->reason,
    ]);

    return back()->with('success', 'Loan rejected.');
}


 

    // public function loans()
    // {
    //     $loans = LoanApplication::with(['user', 'loanProduct'])->get();
    //     return view('admin.loans', compact('loans'));
    // }

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


//    public function approve($id)
// {
//     $loan = LoanApplication::findOrFail($id);

//     $loan->update([
//         'status' => LoanApplication::STATUS_APPROVED,
//         'approved_amount' => $loan->loan_amount,
//         'balance' => $loan->loan_amount + $loan->total_interest, 
//         'approved_at' => now(),
        
//     ]);

//     return redirect()->back()->with('success','Loan approved.');
// }






    // public function reject($id)
    // {
    //     $loan = LoanApplication::findOrFail($id);
    //     $loan->status = 'rejected';
    //     $loan->save();

    //     return redirect()->back()->with('success','Loan rejected.');
    // }

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
