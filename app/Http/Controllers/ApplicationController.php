<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;

class ApplicationController extends Controller
{
public function create()
    {
        return view('students.apply');
    }

    public function store(Request $request) 
    {
        // Validate form data
        $request->validate([
            'full_name' => 'required|string|max:255',
            'national_id' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'institution' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'year_of_study' => 'required|integer|min:1|max:10',
            'student_reg_no' => 'required|string|max:50',
            'loan_amount' => 'required|numeric|min:0',
            'loan_purpose' => 'required|string|max:500',
        ]);

        // Save application data to the database
        Application::create($request->only([
            'full_name',
            'national_id',
            'email',
            'phone',
            'institution',
            'course',
            'year_of_study',
            'student_reg_no',
            'loan_amount',
            'loan_purpose'
        ]));

        return redirect()->back()->with('success', 'Application submitted successfully.');
    }
    //
}
