<?php

namespace App\Http\Controllers\School\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Section;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::where('school_id', school_id())->get();
        foreach ($sections as $section) {
            $section['editUrl'] = route('section.edit', $section['id']);
            $section['deleteUrl'] = route('section.delete', $section['id']);
            $section['class_name'] = $section->class->name ?? '-';
            $section['student_count'] = $section->students()->count();
        }
        // dd($sections);
        return Inertia::render(
            'Admin/Section/Index',
            [
                'sections' => $sections->toArray(),
            ]
        );
    }
    public function create_page()
    {
        $classes = Classes::where('school_id', school_id())->select('name', 'id')->get();
        return Inertia::render('Admin/Section/Create', ['PortUrl' => route('section.insert'), 'classes' => $classes]);
    }
    public function edit_page($id)
    {
        $classes = Classes::where('school_id', school_id())->select('name', 'id')->get();
        $class = Section::where('id', $id)->with('class')->first();
        return Inertia::render('Admin/Section/Edit', ['PortUrl' => route('section.insert'), 'section' => $class, 'classes' => $classes]);
    }
    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'class_id' => 'required|exists:classes,id'
        ], [
            'class_id.*' => 'Class filed is Required'
        ]);
        // dd($request->all());
        $id = $request->id ?? 0;
        $input['name'] = $request->name;
        $input['class_id'] = $request->class_id;
        $input['school_id'] = school_id();
        // dd($input);
        Section::updateOrCreate(['id' => $id], $input);
        return redirect()->route('section.index')->with('success', 'Section Saved');

    }
    public function delete($id, Request $request)
    {
        Section::where("id", $id)->delete();
        $request->session()->flash('success', 'Section Deleted !');
    }
}
