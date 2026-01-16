<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanApplication;


class DashboardController extends Controller
{
   public function index()
{
    $user = auth()->user();

    // Get all loans of this user
    $loans = LoanApplication::with('loanProduct')
                ->where('user_id', $user->id)
                ->get();

    return view('dashboard', compact('user', 'loans'));
}

     public function showLoan($id)
    {
        $user = auth()->user();
        $loan = LoanApplication::with('user', 'loanProduct')->findOrFail($id);

        return view('dashboard', compact('loan','user'));
    }
}