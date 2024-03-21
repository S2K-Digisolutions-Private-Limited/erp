<?php

namespace App\Http\Controllers\School\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SectionController extends Controller
{
    public function index()
    {
        $classes = Section::where('school_id', school_id())->get();
        foreach ($classes as $class) {
            $class['editUrl'] = route('section.edit', $class['id']);
            $class['deleteUrl'] = route('section.delete', $class['id']);
        }
        // dd($classes);
        return Inertia::render(
            'Admin/Section/Index',
            [
                'sections' => $classes->toArray(),
                'createUrl' => route('section.create'),
            ]
        );
    }
    public function create_page()
    {
        return Inertia::render('Admin/Section/Create', ['PortUrl' => route('section.insert')]);
    }
    public function edit_page($id)
    {
        $class = Section::where('id', $id)->first();
        return Inertia::render('Admin/Section/Edit', ['PortUrl' => route('section.insert'), 'section' => $class]);
    }
    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'class_id' => 'required'
        ]);
        $id = $request->id ?? 0;
        $input['name'] = $request->name;
        $input['class_id'] = $request->class_id;
        $input['school_id'] = school_id();
        Section::updateOrCreate(['id' => $id], $input);
        return redirect()->route('section.index')->with('success', 'Section Saved');

    }
    public function delete($id, Request $request)
    {
        Section::where("id", $id)->delete();
        $request->session()->flash('success', 'Section Deleted !');
    }
}
