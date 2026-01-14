<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanApplication;
use App\Models\LoanProduct;

class LoanProductController extends Controller
{
    public function index()
    {
        $products = LoanProduct::all();
        return view('loans.products', compact('products'));
    }
}
