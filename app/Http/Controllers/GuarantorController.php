<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\LoanApplication;
use App\Models\Guarantor;
// use App\Mail\GuarantorRemovedMail;
// use Illuminate\Support\Facades\Mail;

class GuarantorController extends Controller
{
    
  public function create(LoanApplication $loan)
{
    abort_if($loan->user_id !== auth()->id(), 403);
    abort_if($loan->status !== 'draft', 403);

    return view('student.loans.guarantors.create', compact('loan'));
}

    
public function store(Request $request, LoanApplication $loan)
{
    abort_if($loan->user_id !== auth()->id(), 403);
    abort_if($loan->status !== 'draft', 403);

    if ($loan->guarantors()->count() >= 2) {
        return back()->withErrors([
            'limit' => 'You can only add 2 guarantors per loan.'
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
        'income_range' => [
            'nullable','string',
            function ($attr, $value, $fail) use ($request) {
                if ($request->employment_status === 'employed' && empty($value)) {
                    $fail('Income range is required for employed guarantors.');
                }
            }
        ],
        'id_type' => 'required|string',
    ]);

    $path = $request->file('image')->store('guarantors', 'public');
    
    $loan->guarantors()->create([
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
      if ($loan->guarantors()->count() < 2) {
        return redirect()
            ->route('student.loans.guarantors.create', $loan)
            ->with('info', 'Please add one more guarantor.');
    }

   
    

    return redirect()
        ->route('student.loans.guarantors.confirm', $loan->id)
        ->with('success', 'Guarantor added successfully.');
}

public function destroy(Guarantor $guarantor)
{
    if ($guarantor->user_id !== auth()->id()) {
        abort(403);
    }

    if ($guarantor->status === 'approved') {
        return back()->with('error', 'Approved guarantors cannot be removed.');
    }

    $guarantor->update([
        'status' => 'replaced',
    ]);

    $guarantor->delete(); 

    //  Mail::to(config('mail.admin_email'))
    //     ->send(new GuarantorRemovedMail($guarantor));

   
    return redirect()->route('student.profile.guarantors.create')->with('info', 'Please add a replacement guarantor.');
}

    /**
     * Final submission of loan
     */
    

}
