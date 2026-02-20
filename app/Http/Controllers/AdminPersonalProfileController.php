<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalProfile;
use App\Mail\PersonalProfileApprovedMail;
use App\Mail\PersonalProfileRejectedMail;
use Illuminate\Support\Facades\Mail;

class AdminPersonalProfileController extends Controller
{
public function show(PersonalProfile $personalProfile)
{
    return view('admin.personal-profiles.show', compact('personalProfile'));
}
    

    public function approve(PersonalProfile $personalProfile)
{
    $personalProfile->update([
        'status' => 'approved',
        'rejection_reason' => null,
        'reviewed_at' => now(),
    ]);

    Mail::to($personalProfile->user->email)
        ->send(new PersonalProfileApprovedMail($personalProfile));

    return back()->with('success', 'Personal profile approved and email sent.');
}


   public function reject(Request $request, PersonalProfile $personalProfile)
{
    $request->validate([
        'rejection_reason' => 'required|string|max:1000',
    ]);

    $personalProfile->update([
        'status' => 'rejected',
        'rejection_reason' => $request->rejection_reason,
        'reviewed_at' => now(),
    ]);

    Mail::to($personalProfile->user->email)
        ->send(new PersonalProfileRejectedMail($personalProfile));

    return back()->with('error', 'Profile rejected and email sent.');
}

}

