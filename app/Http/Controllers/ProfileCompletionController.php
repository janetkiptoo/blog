<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PersonalProfile;


class ProfileCompletionController extends Controller
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
        return view('student.profile.complete', compact('user'));
        //
    }

    /**
     * Update the specified resource in storage.
     */

public function update(Request $request)
{
    $request->validate([
        'gender' => 'required|string',
        'nationality' => 'required|string|max:100',
        'government_id_type' => 'required|string|max:50',
        'government_id_number' => 'required|string|max:50',
        'address' => 'required|string|max:500',
        'date_of_birth' => 'required|date',
        'id_image' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
    ]);

    $user = Auth::user();

    $data = $request->only([
        'gender',
        'nationality',
        'government_id_type',
        'government_id_number',
        'address',
        'date_of_birth',
    ]);

    if ($request->hasFile('id_image')) {
        $data['id_image'] = $request->file('id_image')->store('ids', 'public');
    }

    
    PersonalProfile::updateOrCreate(
        ['user_id' => $user->id],
        array_merge($data, [
            'status' => 'pending',
            'rejection_reason' => null,
            'reviewed_at' => null,
        ])
    );

    return redirect()
        ->route('student.profile.academic')
        ->with('success', 'Personal information submitted for review.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
