<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureProfileComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

    if (!$user->national_id || !$user->date_of_birth ) {
            return redirect()->route('profile.complete')
                ->with('warning', 'Please complete your profile before applying for a loan.');
        }
        return $next($request);
    }
}
