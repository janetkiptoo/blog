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
        $product = LoanProduct::findOrFail($productId);
        return view('loans.apply', compact('product'));  
        $user = auth()->user();
         $loan=LoanApplication::where('user_id',$user->id)->first();
    }

public function store(Request $request, $productId)
    {
        $user = auth()->user();
        
         $application = LoanApplication::create([
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'national_id' => $user->national_id,
                'institution' => $user->institution,
                'course' => $user->course,
                'year_of_study' => $user->year_of_study,
                'student_reg_no' => $user->student_id,  
                'user_id' => auth()->id(),
                'loan_product_id' => $productId,
                'loan_amount' => $request->loan_amount,
                'status' => 'pending',
                'approved_amount' => null,
        ]);

        return redirect()->route('student.dashboard')->with('success', 'Loan application submitted successfully.');
    }
}