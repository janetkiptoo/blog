<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'national_id' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'institution' => ['required', 'string', 'max:255'],
            'course' => ['required', 'string', 'max:255'],
            'year_of_study' => ['required', 'string', 'max:255'],
            'student_reg_no' => ['required', 'string', 'max:255'],
            'image' => 'required|image|mimes:jpeg,png,jpg|max:4096',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $path = $request->file('image')->store('photos', 'public');
        $user = User::create([

            'name' => $request->name,
            'email' => $request->email,
            'national_id' => $request->national_id,
            'phone' => $request->phone,
            'institution' => $request->institution,
            'course' => $request->course,
            'year_of_study' => $request->year_of_study,
            'student_reg_no' => $request->student_reg_no,
            'image' => $path,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('student.dashboard', absolute: false));
    }
}
