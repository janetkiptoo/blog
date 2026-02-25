<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanApplication;
use App\Models\guarantors;
use App\Models\AcademicProfile;
use App\Models\PersonalProfile;

class DashboardController extends Controller
{
 
    public function index()
{
    $user = auth()->user();
    $loans = LoanApplication::with('loanProduct')->where('user_id', $user->id)->get();

    return view('student.dashboard', [
        'personalProfile' => $user->personalProfile,
        'academicProfile' => $user->academicProfile,

        'loanEligible' =>
            optional($user->personalProfile)->status === 'approved'
            && optional($user->academicProfile)->status === 'approved',
        'loan' => $user->loans()->latest()->first(),
    ]
);

}

    

     public function showLoan($id)
    {
        $user = auth()->user();
        $loan = LoanApplication::with('user', 'loanProduct')->findOrFail($id);

        return view('dashboard', compact('loan','user'));
    }
}