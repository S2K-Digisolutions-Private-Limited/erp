<?php

namespace App\Http\Controllers\School\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StudentController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Student/Index');
    }
    public function create()
    {
        $classes = Classes::where('school_id', school_id())->with('sections', 'streams')->select('name', 'id')->get();
        // dd($classes->toArray());
        return Inertia::render('Admin/Student/Create', ['PortUrl' => route('student.insert', 0), 'classes' => $classes->toArray()]);
    }
    public function insert($id, Request $request)
    {
        dd($id, $request->all());
    }
}
