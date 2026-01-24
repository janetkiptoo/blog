<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\LoanApplication;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalusers = User::count();

        $totalstudents = User::where('role', 'student')->count();

        $totaladmins = User::where('role', 'admin')->count();

        $totalapplications = LoanApplication::count();

        $pendingapplications = LoanApplication::where('status', 'pending')->count();

        $approvedapplications = LoanApplication::where('status', 'approved')->count();

        $rejectedapplications = LoanApplication::where('status', 'rejected')->count();

        $totalappliedAmount = LoanApplication::sum('loan_amount');

        $totalapprovedAmount = LoanApplication::where('status', 'approved')
         ->sum('loan_amount');

        return view('admin.dashboard', compact(
            'totalusers',
            'totalstudents',
            'totaladmins',
            'totalapplications',
            'pendingapplications',
            'approvedapplications',
            'rejectedapplications',
            'totalappliedAmount',
            'totalapprovedAmount'
        ));
    }
}

