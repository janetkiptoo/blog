<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Guarantor;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Mail\GuarantorApprovedMail;
use App\Mail\GuarantorRejectedMail;
use Illuminate\Support\Facades\Mail;


class AdminGuarantorController extends Controller
{
    public function index(User $user)
    {
        $guarantors = $user->guarantors()->latest()->get();

        return view('admin.guarantors.index', compact('user', 'guarantors'));
    }
 

   
   public function approve(Guarantor $guarantor)
   {
    $guarantor->update([
        'status' => 'approved',
        'rejection_reason' => null,
        'reviewed_at' => now(),
    ]);

    Mail::to($guarantor->user->email)
        ->send(new GuarantorApprovedMail($guarantor));

    return back()->with('success', 'Guarantor approved and student notified.');
    }


   public function reject(Request $request, Guarantor $guarantor)
{
    $request->validate([
        'rejection_reason' => 'required|string|min:5',
    ]);

    $guarantor->update([
        'status' => 'rejected',
        'rejection_reason' => $request->rejection_reason,
        'reviewed_at' => now(),
    ]);

    Mail::to($guarantor->user->email)
        ->send(new GuarantorRejectedMail($guarantor));

    return back()->with('success', 'Guarantor rejected and student notified.');
}



    public function show($id)
    {
        $guarantor = Guarantor::findOrFail($id);
        return view('admin.guarantors.show', compact('guarantor'));
    }

    

    protected function checkUserEligibility($user)
    {
        $approvedGuarantors = $user->guarantors()
            ->where('status', 'approved')
            ->count();

        if (
            $approvedGuarantors >= 2 &&
            $user->personalProfile?->status === 'approved' &&
            $user->academicProfile?->status === 'approved'
        ) {
            $user->update(['verification_status' => 'approved']);
        } else {
            $user->update(['verification_status' => 'pending']);
        }
    }
}
