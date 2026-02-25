<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AcademicProfile;
use App\Models\EligibilityRequirement;


class AcademicProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
     public function edit()
    {
        $user = Auth::user();
         $academicProfile = AcademicProfile::where('user_id', $user->id)->first();
          $institutions = EligibilityRequirement::where('is_active', true)
        ->select('institution', 'institution_type')
        ->distinct()
        ->get();
        return view('student.profile.academic', compact('user','institutions','academicProfile'));
    }


    public function update(Request $request)
    {
        $request->validate([
            'institution_name' => 'required|string|max:255',
            'institution_type' => 'required|string|max:100',
            'course_name' => 'required|string|max:255',
            'level' => 'required|string|max:100',
            'student_registration_number' => 'required|string|max:100',
            'student_document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:4096',
        ]);

        $user = Auth::user();

        $data = $request->only([
            'institution_name',
            'institution_type',
            'course_name',
            'level',
            'student_registration_number',
        ]);

        if ($request->hasFile('student_document')) {
            $existingProfile = AcademicProfile::where('user_id', $user->id)->first();
            if ($existingProfile && $existingProfile->student_document) {
                \Storage::disk('public')->delete($existingProfile->student_document);
            }
            
            $data['student_document'] = $request->file('student_document')->store('academic_docs', 'public');
        }

        AcademicProfile::updateOrCreate(
            ['user_id' => $user->id],
            array_merge($data, [
                'status' => 'pending',
                'rejection_reason' => null,
                'reviewed_at' => null,
            ])
        );

        return redirect()
            ->route('student.dashboard')
            ->with('success', 'Academic details submitted for review.');
    }
}