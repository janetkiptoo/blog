<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LoanApplication;
use App\Models\LoanProduct;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
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
    $loan->status = 'approved';
    $loan->approved_amount = $loan->loan_amount;
    $loan->balance = $loan->loan_amount;
    $loan->save();

    return redirect()->back()->with('success','Loan approved.');
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
            'loan_term_months' => 'required|integer'
        ]);

        LoanProduct::create($request->all());

        return redirect()->back()->with('success','Loan product added!');
    }
}
