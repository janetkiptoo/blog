<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanApplication;


class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $loan=LoanApplication::where('user_id',$user->id)->latest()->first();
        
        
        return view('dashboard', compact('user','loan'));
    }
     public function showLoan($id)
    {
        $loan = LoanApplication::with('user', 'loanProduct')->findOrFail($id);

        return view('dashboard', compact('loan'));
    }
}