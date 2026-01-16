<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoanProduct;

class LoanProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $products = LoanProduct::all();
        return view('admin.loan-products.index', compact('products'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('admin.loan-products');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'min_loan_amount' => 'required|numeric',
            'max_loan_amount' => 'required|numeric',
            'interest_rate' => 'required|numeric',
            'loan_term_months' => 'required|integer',
        ]);

        LoanProduct::create($request->all());

        return redirect()->route('admin.loan-products')
                         ->with('success', 'Loan product added successfully');
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
     public function edit(LoanProduct $loan_product)
    {
         return view('admin.loan-products.edit', compact('loan_product'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LoanProduct $loan_product)
    {
         $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'min_loan_amount' => 'required|numeric',
            'max_loan_amount' => 'required|numeric',
            'interest_rate' => 'required|numeric',
            'loan_term_months' => 'required|integer',
        ]);

        $loan_product->update($request->all());

        return redirect()->route('admin.loan-products')
                         ->with('success', 'Loan product updated successfully');
        //
    }

    /**
     * Remove the specified resource from storage.
     */
     public function destroy(LoanProduct $loan_product)
    {
        $loan_product->delete();

        return redirect()->route('admin.loan-products')
                         ->with('success', 'Loan product deleted successfully');
    }
}
