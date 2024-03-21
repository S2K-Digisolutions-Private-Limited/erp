<?php

namespace App\Http\Controllers\School\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classes as ClassModel;
use Inertia\Inertia;

class Classes extends Controller
{
    public function index()
    {
        $classes = ClassModel::where('school_id', school_id())->get();
        foreach ($classes as $class) {
            $class['editUrl'] = route('class.edit', $class['id']);
            $class['deleteUrl'] = route('class.delete', $class['id']);
        }
        // dd($classes);
        return Inertia::render(
            'Admin/Class/Index',
            [
                'classes' => $classes->toArray(),
                'createUrl' => route('class.create'),
            ]
        );
    }
    public function create_page()
    {
        return Inertia::render('Admin/Class/Create', ['PortUrl' => route('class.insert')]);
    }
    public function edit_page($id)
    {
        $class = ClassModel::where('id', $id)->first();
        return Inertia::render('Admin/Class/Edit', ['PortUrl' => route('class.insert'), 'class' => $class]);
    }
    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $id = $request->id ?? 0;
        $input['name'] = $request->name;
        $input['has_stream'] = $request->has_stream;
        $input['school_id'] = school_id();
        if ($id == 0) {
            // dd(1);
            $request->validate([
                'name' => 'unique:classes,name'
            ]);
        }
        ClassModel::updateOrCreate(['id' => $id], $input);
        return redirect()->route('class.index')->with('success', 'Class Saved');

    }
    public function delete($id, Request $request)
    {
        ClassModel::where("id", $id)->delete();
        $request->session()->flash('success', 'Class Deleted !');
    }
}
