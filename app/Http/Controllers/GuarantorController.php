<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\LoanApplication;
use App\Models\Guarantor;

class GuarantorController extends Controller
{
    
    public function create(LoanApplication $loan)
    {
        return view('student.profile.guarantors', compact('loan'));
    }

    
    
public function store(Request $request)
{
     $user = auth()->user();

    if ($user->guarantors()->count() >= 2) {
        return back()->withErrors([
            'limit' => 'You can only add a maximum of 2 guarantors.'
        ]);
    }
    $request->validate([
        'name' => 'required|string|max:255',
        'relationship' => 'required|string|max:100',
        'national_id' => 'required|string|max:20',
        'phone' => 'required|string|max:15',
        'email' => 'nullable|email|max:255',
        'consent_given' => 'required|boolean',
        'image' => 'required|image|mimes:jpeg,png,jpg|max:4096',
        'employment_status' => 'required|in:employed,not employed',
        'physical_address' => 'nullable|string|max:255',
        'income_range' => 'required|string',
        'id_type' => 'required|string',
    ]);

    $path = $request->file('image')->store('guarantors', 'public');

    Auth::user()->guarantors()->create([
        'name' => $request->name,
        'relationship' => $request->relationship,
        'national_id' => $request->national_id,
        'phone' => $request->phone,
        'email' => $request->email,
        'consent_given' => $request->consent_given,
        'employment_status' => $request->employment_status,
        'physical_address' => $request->physical_address,
        'image' => $path,
        'income_range' => $request->income_range,
        'id_type' => $request->id_type,
        'status' => 'pending', 
    ]);

    return redirect()
        ->route('student.dashboard')
        ->with('success', 'Guarantor details submitted and awaiting approval.');
}

    /**
     * Final submission of loan
     */
    public function submit(LoanApplication $loan)
{
    if ($loan->user_id !== auth()->id()) {
        abort(403);
    }

    if ($loan->guarantors()->count() < 2) {
        return back()->withErrors('At least 2 guarantors are required.');
    }

    if ($loan->guarantors()->where('status', 'approved')->count() < 2) {
        return back()->withErrors('Guarantors must be approved before submission.');
    }

    $loan->update([
        'status' => 'submitted',
    ]);

    return redirect()
        ->route('student.dashboard')
        ->with('success', 'Loan application submitted for review.');
}

}
