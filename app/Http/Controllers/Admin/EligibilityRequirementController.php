<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EligibilityRequirement;
use Illuminate\Http\Request;

class EligibilityRequirementController extends Controller
{
    public function index()
    {
        $requirements = EligibilityRequirement::latest()->get();
        return view('admin.eligibility.index', compact('requirements'));
    }

    public function create()
    {
        return view('admin.eligibility.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'country' => 'required|string',
            'institution' => 'required|string',
            'institution_type' => 'required|string',
            'course_type' => 'required|string',
            'loan_purpose' => 'required|string',
            'min_age' => 'required|integer|min:0',
            'max_age' => 'required|integer|gte:min_age',
        ]);

        EligibilityRequirement::create($request->all());

        return redirect()->route('admin.eligibility.index')
            ->with('success', 'Eligibility requirement added successfully.');
    }

    public function edit($id)
    { 
        $requirement = EligibilityRequirement::findOrFail($id);
        return view('admin.eligibility.edit', compact('requirement'));
    }

    public function update(Request $request, $id)
    {
        $requirement = EligibilityRequirement::findOrFail($id);

        $request->validate([
            'country' => 'required|string',
            'institution' => 'required|string',
            'institution_type' => 'required|string',
            'course_type' => 'required|string',
            'loan_purpose' => 'required|string',
            'min_age' => 'required|integer|min:0',
            'max_age' => 'required|integer|gte:min_age',
        ]);

        $requirement->update($request->all());

        $request->merge([
              'is_active' => $request->has('is_active')]);

$requirement->update($request->all());

        return redirect()->route('admin.eligibility.index')
            ->with('success', 'Eligibility requirement updated.');
    }

    public function destroy($id)
    {
        EligibilityRequirement::findOrFail($id)->delete();

        return back()->with('success', 'Deleted successfully.');
    }
}
