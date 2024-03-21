<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OptCodeMail;
use App\Models\School;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RegisterController extends Controller
{
    public function register_page_1()
    {
        if (Auth::guard('school')->check()) {
            return redirect()->route('home');
        }
        return Inertia::render("Register1");
    }
    public function register_page_2(Request $request)
    {
        $schoolId = $request->cookie('school_id');
        // dd($schoolId);
        if ($schoolId != null) {
            return Inertia::render("Register2", [
                'school_id' => $schoolId,
            ]);
        } else {
            return redirect()->route('login');
        }
    }
    public function register_page_3(Request $request)
    {
        $schoolId = $request->cookie('school_id');

        // dd($schoolId);
        if ($schoolId != null) {
            $school = School::find($schoolId);
            if ($request->resend == 1) {
                Mail::to($school->email)->send(new OptCodeMail($school->opt_code));
            }
            $email = $school->email;
            $username = substr($email, 0, strpos($email, '@'));
            $domain = substr($email, strpos($email, '@') + 1);
            $maskedUsername = substr_replace($username, '*****', 4);
            $formattedEmail = $maskedUsername . '@' . $domain;
            return Inertia::render("Register3", [
                'school_id' => $schoolId,
                'email' => $formattedEmail,
            ]);
        } else {
            return redirect()->route('login');
        }
    }


    public function register(Request $request)
    {
        $schoolId = $request->cookie('school_id');
        if ($request->step == 1) {
            $request->validate([
                'email' => 'required|email|unique:schools,email',
                'name' => 'required',
                'password' => 'required|min:8|max:30'
            ]);
            $school = new School();
            $school->name = $request->name;
            $school->email = $request->email;
            $school->password = bcrypt($request->password);
            $school->school_id = Str::uuid();
            $school->save();
            Cookie::queue('school_id', $school->id ?? 0, 60);
            Cookie::queue('pending_step', 2, 60);
            return redirect()->route('register.2');
        } elseif ($request->step == 2) {
            // dd($request->all());
            $request->validate([
                "school_name" => 'required',
                "address" => 'required',
                "city" => 'required',
                "pin_code" => 'required',
                "mobile_number" => 'required',
                "whatsapp_number" => 'required',
            ]);
            $input['school_name'] = $request->school_name;
            $input['address'] = $request->address;
            $input['city'] = $request->city;
            $input['pin_code'] = $request->pin_code;
            $input['whatsapp_number'] = $request->whatsapp_number;
            $input['mobile_number'] = $request->mobile_number;
            $input['opt_code'] = rand(11111, 99999);
            School::where('id', $schoolId)->first()->update($input);
            $school = School::find($schoolId);
            Cookie::queue('pending_step', 3, 60);
            Mail::to($school->email)->send(new OptCodeMail($school->opt_code));
            return redirect()->route('register.3');
        } else {
            return redirect()->route('login');
        }
    }


    public function verify(Request $request)
    {

        $schoolId = $request->cookie('school_id');
        $school = School::find($schoolId);
        $request->validate([
            'otp' => 'required|min:5'
        ]);
        if ($school->opt_code == $request->otp) {
            Cookie::queue('pending_step', 0, 60);
            $school->update(['verify_status' => true]);
            return redirect()->route('login');
        } else {
            $request->validate([
                'otp' => 'uuid'
            ], ['otp.uuid' => 'Your OTP is Invalid !']);
        }
        Cookie::queue('pending_step', 0, 60);
        // dd($request->all(), $school);
    }
}
