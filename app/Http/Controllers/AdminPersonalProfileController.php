<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalProfile;
class AdminPersonalProfileController extends Controller
{
public function show(PersonalProfile $personalProfile)
{
    return view('admin.personal-profiles.show', compact('personalProfile'));
}
    

    public function approve(PersonalProfile $profile)
    {
        $profile->update([
            'status' => 'approved',
            'reviewed_at' => now(),
            'rejection_reason' => null,
        ]);

        return back()->with('success', 'Personal profile approved.');
    }

    public function reject(Request $request, PersonalProfile $profile)
    {
        $request->validate([
            'rejection_reason' => 'required|string|min:10',
        ]);

        $profile->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
            'reviewed_at' => now(),
        ]);

        return back()->with('error', 'Personal profile rejected.');
    }
}

