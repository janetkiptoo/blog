<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Term;

class TermController extends Controller
{
     public function show()
    {
        $term = Term::first();

        return view('student.terms', compact('term'));
    }
    //
    //
}
