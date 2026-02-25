<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanProduct;
use App\Models\EligibilityRequirement;

class WebController extends Controller
{
 

public function home()
{
    $loanProducts = LoanProduct::all();

    $loanProductsData = $loanProducts->mapWithKeys(function($product) {
        return [$product->product_name => [
            'interestRate'  => $product->interest_rate,
            'gracePeriod'   => $product->grace_period_months,
            'minAmount'     => $product->min_loan_amount,
            'maxAmount'     => $product->max_loan_amount,
            'maxTermMonths' => $product->loan_term_months,
        ]];
    });

    $requirements = EligibilityRequirement::where('is_active', true)->get();

    $eligibilityData = [
        'countries'    => $requirements->pluck('country')->unique()->values(),
        'institutions' => $requirements->pluck('institution')->unique()->values(),
        'courseTypes'  => $requirements->pluck('course_type')->unique()->values(),
        'loanPurposes' => $requirements->pluck('loan_purpose')->unique()->values(),
        'minAge'       => $requirements->min('min_age'),
        'maxAge'       => $requirements->max('max_age'),
    ];

    return view('web.home', compact('loanProducts', 'loanProductsData', 'eligibilityData'));
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
