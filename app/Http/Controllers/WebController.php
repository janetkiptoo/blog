<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanProduct;

class WebController extends Controller
{
    public function home()
    {
    $loanProducts = LoanProduct::all(); // fetch all products
    return view('web.home', compact('loanProducts'));

    }

    public function about()
    {
        return view('web.about');
    }

    public function services()
    {
        return view('web.services');
    }

    public function contact()
    {
        return view('web.contact');
    }  

    
}
