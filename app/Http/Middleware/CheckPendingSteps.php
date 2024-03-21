<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class CheckPendingSteps
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('school')->check()) {
            $school = Auth::user();
            if ($school->role == 'Admin') {
                if ($school->school_name == null) {
                    Cookie::queue('school_id', $school->id ?? 0, 60);
                    Cookie::queue('pending_step', 2, 60);
                } elseif ($school->verify_status != 1) {
                    Cookie::queue('school_id', $school->id ?? 0, 60);
                    Cookie::queue('pending_step', 3, 60);
                } else {
                    Cookie::queue(Cookie::forget('pending_step'));
                    Cookie::queue(Cookie::forget('school_id'));
                }
            }
        } else {
            return redirect()->route('login');
        }

        $step = $request->cookie('pending_step');

        if ($step == 2) {
            // dd('Redirecting to register.2');
            return redirect()->route('register.2');
        } elseif ($step == 3) {
            // dd('Redirecting to register.3');
            return redirect()->route('register.3');
        } elseif ($step == 0 && $step != null) {
            // dd('Redirecting to home');
            return redirect()->route('home');
        } else {
            // dd('Continuing to next middleware');

            return $next($request);
        }
    }
}
