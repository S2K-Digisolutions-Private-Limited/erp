<?php

namespace App\Http\Controllers\School\Admin;

use App\Http\Controllers\Controller;
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
        return Inertia::render('Admin/Student/Create', ['PortUrl' => route('student.insert', 0)]);
    }
    public function insert($id, Request $request)
    {
        dd($id, $request->all());
    }
}
