<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanProduct;
use App\Models\User;

class LoanApplicationController extends Controller
{
   public function store(Request $request, $productId)
    {
        LoanApplication::create([
            'user_id' => auth()->id(),
            'loan_product_id' => $productId,
            'loan_amount' => $request->input('loan_amount'),
            'status' => 'pending',
            'approved_amount' => null,
        ]);

        return view()->route('dashboard')->with('success', 'Loan application submitted successfully.');
    }
}