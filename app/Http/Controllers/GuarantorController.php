<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanApplication;
use App\Models\Guarantor;

class GuarantorController extends Controller
{
    /**
     * Show form to create a guarantor for a loan
     */
    public function create(LoanApplication $loan)
    {
        return view('student.guarantors.create', compact('loan'));
    }

    /**
     * Store a new guarantor
     */
    public function store(Request $request, LoanApplication $loan)
    {
        // Validate input including image
        $request->validate([
            'name' => 'required|string|max:255',
            'relationship' => 'required|string|max:100',
            'national_id' => 'required|string|max:20',
            'phone' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'consent_given' => 'required|boolean',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:4096', // max 4MB
            'employment_status' => 'nullable|string|max:100',
            'physical_address' => 'nullable|string|max:255',
        ]);

        // Handle file upload first
        $path = $request->file('image')->store('guarantors', 'public');

        // Prepare data for insertion
        $requestData = [
            'name' => $request->name,
            'relationship' => $request->relationship,
            'national_id' => $request->national_id,
            'phone' => $request->phone,
            'email' => $request->email,
            'consent_given' => $request->consent_given,
            'employment_status' => $request->employment_status,
            'physical_address' => $request->physical_address,
            'image' => $path,
        ];

        // Create guarantor linked to this loan
        $loan->guarantors()->create($requestData);

        return redirect()
            ->route('student.guarantors.create', $loan->id)
            ->with('success', 'Guarantor added successfully.');
    }

    /**
     * Final submission of loan
     */
    public function submit(LoanApplication $loan)
    {
        if ($loan->guarantors()->count() < 2) {
            return back()->withErrors('At least 2 guarantors are required.');
        }

        $loan->status = 'pending';
        $loan->save();

        return redirect()->route('student.dashboard')
            ->with('success', 'Loan application submitted successfully.');
    }
}
