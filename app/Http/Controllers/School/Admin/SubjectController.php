<?php

namespace App\Http\Controllers\School\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Subject;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::where('school_id', school_id())->get();
        foreach ($subjects as $subject) {
            $subject['editUrl'] = route('subject.edit', $subject['id']);
            $subject['deleteUrl'] = route('subject.delete', $subject['id']);
        }
        // dd($subjects);
        return Inertia::render(
            'Admin/Subject/Index',
            [
                'subjects' => $subjects->toArray(),
            ]
        );
    }
    public function create_page()
    {
        return Inertia::render('Admin/Subject/Create', ['PortUrl' => route('subject.insert')]);
    }
    public function edit_page($id)
    {
        $subject = Subject::where('id', $id)->first();
        return Inertia::render('Admin/Subject/Edit', ['PortUrl' => route('subject.insert'), 'subject' => $subject]);
    }
    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        // dd($request->all());
        $id = $request->id ?? 0;
        $input['name'] = $request->name;
        $input['code'] = $request->code;
        $input['school_id'] = school_id();
        // dd($input);
        Subject::updateOrCreate(['id' => $id], $input);
        return redirect()->route('subject.index')->with('success', 'Subject Saved');

    }
    public function delete($id, Request $request)
    {
        Subject::where("id", $id)->delete();
        $request->session()->flash('success', 'Subject Deleted !');
    }
}
