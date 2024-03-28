<?php

namespace App\Http\Controllers\School\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Student;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::where('school_id', school_id())->select('id', 'name', 'father_name', 'student_id', 'email', 'hidden_password', 'class_id', 'section_id', 'stream_id')->with('class', 'section', 'stream')->get();
        // dd($students->toArray());
        return Inertia::render('Admin/Student/Index', ['students' => $students->toArray()]);
    }
    public function create()
    {
        $classes = Classes::where('school_id', school_id())->with('sections', 'streams')->select('name', 'id')->get();
        // dd($classes->toArray());
        return Inertia::render('Admin/Student/Create', ['PortUrl' => route('student.insert', 0), 'classes' => $classes->toArray()]);
    }
    public function edit($slug, Request $request)
    {
        $student = Student::where('student_id', $slug)->with('class', 'section', 'stream')->first();
        if (!$student) {
            return redirect()->back()->with('error', 'Student Not Found!');
        }
        $classes = Classes::where('school_id', school_id())->with('sections', 'streams')->select('name', 'id')->get();
        // dd($classes->toArray());
        return Inertia::render('Admin/Student/Edit', ['PortUrl' => route('student.insert', $student->id), 'classes' => $classes->toArray(), 'student' => $student]);
    }
    public function insert($id, Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                'name' => 'required',
                'phone' => 'required|regex:/^[6-9]\d{9}$/',
                'father_number' => 'nullable|regex:/^[6-9]\d{9}$/',
                'mother_number' => 'nullable|regex:/^[6-9]\d{9}$/',
                'whatsapp_number' => 'nullable|regex:/^[6-9]\d{9}$/',
                'gender' => 'required',
                'class_id' => 'required|exists:classes,id',
                'hidden_password' => 'required|min:8',
                'profile_image' => 'nullable|image',
            ],
            [
                'class_id.*' => 'Please Select Class !',
                'hidden_password.*' => 'Password is Required & Min 8 Character',
            ]
        );
        if ($id == 0) {
            $request->validate([
                'email' => 'nullable|email|unique:students,email',
            ]);
        } else {
            $request->validate([
                'email' => 'required|email|unique:students,email,' . $id,
            ]);
        }
        $classes = Classes::where('id', $request->input('class_id'))->with('sections', 'streams')->select('name', 'id')->first();
        // dd($id, $request->all());
        if ($classes) {
            $section_count = $classes->sections()->count();
            $stream = $classes->streams()->count();
            if ($section_count) {
                $request->validate(
                    [
                        'section_id' => 'required|exists:sections,id'
                    ],
                    [
                        'section_id.*' => 'Please Select Section !'
                    ]
                );
            }
            if ($stream) {
                $request->validate(
                    [
                        'stream_id' => 'required|exists:streams,id'
                    ],
                    [
                        'stream_id.*' => 'Please Select Stream !'
                    ]
                );
            }
        }
        // dd($id, $request->all());
        $input = $request->all(
            [
                "id",
                "name",
                "status",
                "email",
                "phone",
                "gender",
                "hidden_password",
                "father_name",
                "mother_name",
                "father_number",
                "mother_number",
                "whatsapp_number",
                "primary_email",
                "full_address",
                "roll_number",
                "class_id",
                "section_id",
                "stream_id",
            ]
        );
        // dd($request->all(), $input);
        $input['school_id'] = school_id();
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = school_ref() . rand(0, 9999) . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName);
            $input['profile_image'] = 'images' . $imageName;
        }
        $student = Student::updateOrCreate(['id' => $id], $input);
        $student->student_id = school_ref() . $student->id;
        $student->email = school_ref() . $student->id . '@' . $request->getHttpHost();
        $student->save();
        return redirect()->route('student.index')->with('success', 'Student Saved');
    }
}
