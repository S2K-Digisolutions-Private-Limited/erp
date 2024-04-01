<?php

namespace App\Http\Controllers\School\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Stream;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $counts = [];
        $counts['class'] = Classes::where('school_id', school_id())->count();
        $counts['section'] = Section::where('school_id', school_id())->count();
        $counts['stream'] = Stream::where('school_id', school_id())->count();
        $counts['subject'] = Subject::where('school_id', school_id())->count();
        $counts['student'] = Student::where('school_id', school_id())->count();
        return Inertia::render('Home', compact('counts'));
    }
}
