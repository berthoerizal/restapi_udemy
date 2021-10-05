<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        $section = DB::table('sections')
            ->leftJoin('sclasses', 'sections.class_id', '=', 'sclasses.id')
            ->select('sections.*', 'sclasses.class_name')
            ->get();
        return response()->json([
            'data' => $section,
            'message' => 'success',
            'status' => 200
        ]);
    }

    public function show($id)
    {
        $section = Section::findorfail($id);
        return response()->json([
            'data' => $section,
            'message' => 'success',
            'status' => 200
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'section_name' => 'required'
        ]);

        $section = Section::create([
            'class_id' => $request->class_id,
            'section_name' => $request->section_name
        ]);

        return response()->json([
            'data' => $section,
            'message' => 'success',
            'status' => 200
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'class_id' => 'required',
            'section_name' => 'required'
        ]);

        $section = Section::find($id);
        $section->update([
            'class_id' => $request->class_id,
            'section_name' => $request->section_name
        ]);

        return response()->json([
            'data' => $section,
            'message' => 'success',
            'status' => 200
        ]);
    }

    public function destroy($id)
    {
        $section = Section::findorfail($id);
        $section->delete();

        return response()->json([
            'message' => 'success',
            'status' => 200
        ]);
    }
}
