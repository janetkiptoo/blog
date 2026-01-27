<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Term;

class AdminTermsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $term = Term::first(); 
    return view('admin.terms.index', compact('term'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('admin.terms.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        Term::create([
            'content' => $request->content,
        ]);

        return redirect()->route('admin.terms.index')
            ->with('success', 'Terms & Conditions created successfully.');
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
  public function edit(Term $term)
    {
        return view('admin.terms.edit', compact('term'));
    }

    public function update(Request $request, Term $term)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $term->update([
            'content' => $request->content,
        ]);

        return redirect()->route('admin.terms.index')
            ->with('success', 'Terms & Conditions updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}


    

   




