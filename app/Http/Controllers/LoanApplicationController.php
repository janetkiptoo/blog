<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanProduct;
use App\Models\User;
use App\Models\LoanApplication;

class LoanApplicationController extends Controller
{
    public function index($productId)
    {
$user = auth()->user();
if (!$user->student) {
            return redirect()->route('students.create')->with('error', 'You must register to apply for a loan.');
        }

        $product = LoanProduct::findOrFail($productId);
        return view('loans.apply', compact('product'));


    }
   public function store(Request $request, $productId)
    {
        LoanApplication::create([
            'user_id' => auth()->id(),
            'loan_product_id' => $productId,
            'loan_amount' => $request->loan_amount,
            'status' => 'pending',
            'approved_amount' => null,
        ]);

        return redirect()->route('dashboard')->with('success', 'Loan application submitted successfully.');
    }
}