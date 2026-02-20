<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AcademicProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AcademicProfileApprovedMail;
use App\Mail\AcademicProfileRejectedMail;

class AdminAcademicProfileController extends Controller
{
    public function show(AcademicProfile $academicProfile)
    {
        return view('admin.academic-profiles.show', compact('academicProfile'));
    }

    public function approve(AcademicProfile $academicProfile)
    {
        $academicProfile->update([
            'status' => 'approved',
            'rejection_reason' => null,
            'reviewed_at' => now(),
        ]);

        Mail::to($academicProfile->user->email)
            ->send(new AcademicProfileApprovedMail($academicProfile));

        return back()->with('success', 'Academic profile approved.');
    }

    public function reject(Request $request, AcademicProfile $academicProfile)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);

        $academicProfile->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
            'reviewed_at' => now(),
        ]);

        Mail::to($academicProfile->user->email)
            ->send(new AcademicProfileRejectedMail($academicProfile));

        return back()->with('error', 'Academic profile rejected.');
    }
}
