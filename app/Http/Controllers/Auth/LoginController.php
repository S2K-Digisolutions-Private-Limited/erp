<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function login_page(Request $request)
    {
        // dump(Auth::guard('school')->user());
        if (Auth::guard('school')->check()) {
            return redirect()->route('home');
        }
        return Inertia::render("Login");
    }
    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('school')->attempt($credentials)) {

            if (Auth::guard('school')->check()) {
                $school = Auth::user();
                if ($school->role == 'Admin') {
                    Cookie::queue('school_id', $school->id ?? 0, 60);
                    if (!$school->school_name) {
                        Cookie::queue('pending_step', 2, 60);
                    } elseif (!$school->verify_status) {
                        Cookie::queue('pending_step', 3, 60);
                    } else {
                        Cookie::queue('pending_step', 0, 60);
                    }
                }
            }

            $request->session()->regenerate();
            return redirect()->route('home');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
