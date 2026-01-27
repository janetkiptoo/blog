<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanApplication; 
use App\Models\Guarantor;

class AdminGuarantorController extends Controller
{
 
    public function index(LoanApplication $loan)
    {
        $guarantors = $loan->guarantors()->get();
        return view('admin.loans.guarantors', compact('loan', 'guarantors'));
    }

    //
}
