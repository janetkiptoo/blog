<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
$user->gender = $request->gender;
$user->nationality = $request->nationality;
$user->government_id_type = $request->government_id_type;
$user->government_id_number = $request->government_id_number;
$user->address = $request->address;

$user->date_of_birth = $request->date_of_birth;

if ($request->hasFile('id_image')) {
    $user->id_image = $request->file('id_image')->store('ids', 'public');
}

$user->save();


        return redirect()->route('student.profile.academic')->with('success', 'Profile updated successfully!');
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
