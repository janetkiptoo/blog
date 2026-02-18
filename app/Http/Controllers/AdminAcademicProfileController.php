<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AcademicProfile;

class AdminAcademicProfileController extends Controller
{
    
    public function approve(AcademicProfile $profile)
{
    $profile->update([
        'status' => 'approved',
        'reviewed_at' => now(),
    ]);

    return back()->with('success', 'Academic profile approved.');
}

public function reject(Request $request, AcademicProfile $profile)
{
    $request->validate([
        'rejection_reason' => 'required|string|max:1000',
    ]);

    $profile->update([
        'status' => 'rejected',
        'rejection_reason' => $request->rejection_reason,
        'reviewed_at' => now(),
    ]);

    return back()->with('error', 'Academic profile rejected.');
}

}

