<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
        return view('student.profile.academic', compact('user'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'institution_name' => 'required|string|max:255',
            'institution_type' => 'required|string|max:100',
            'course_name' => 'required|string|max:255',
            'level' => 'required|string|max:50',
            'student_document' => 'required|file|mimes:pdf,jpeg,png,jpg|max:4096',
        ]);

        $user->update([
            'institution_name' => $request->institution_name,
            'institution_type' => $request->institution_type,
            'course_name' => $request->course_name,
            'level' => $request->level,
            'student_document' => $request->file('student_document')->store('student_docs', 'public'),
        ]);

        return redirect()->route('student.dashboard')->with('success', 'Academic profile completed successfully!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
