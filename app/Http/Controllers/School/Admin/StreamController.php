<?php

namespace App\Http\Controllers\School\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Stream;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StreamController extends Controller
{
    public function index()
    {
        $streams = Stream::where('school_id', school_id())->get();
        foreach ($streams as $stream) {
            $stream['editUrl'] = route('stream.edit', $stream['id']);
            $stream['deleteUrl'] = route('stream.delete', $stream['id']);
            $stream['class_name'] = $stream->class->name ?? '-';
        }
        // dd($streams);
        return Inertia::render(
            'Admin/Stream/Index',
            [
                'streams' => $streams->toArray(),
            ]
        );
    }
    public function create_page()
    {
        $classes = Classes::where('school_id', school_id())->where('has_stream', 1)->select('name', 'id')->get();
        return Inertia::render('Admin/Stream/Create', ['PortUrl' => route('stream.insert'), 'classes' => $classes]);
    }
    public function edit_page($id)
    {
        $classes = Classes::where('school_id', school_id())->where('has_stream', 1)->select('name', 'id')->get();
        $class = Stream::where('id', $id)->with('class')->first();
        return Inertia::render('Admin/Stream/Edit', ['PortUrl' => route('stream.insert'), 'stream' => $class, 'classes' => $classes]);
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
        Stream::updateOrCreate(['id' => $id], $input);
        return redirect()->route('stream.index')->with('success', 'Stream Saved');

    }
    public function delete($id, Request $request)
    {
        Stream::where("id", $id)->delete();
        $request->session()->flash('success', 'Stream Deleted !');
    }
}
