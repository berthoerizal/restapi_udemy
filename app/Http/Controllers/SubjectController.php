<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subject = DB::table('subjects')
            ->leftJoin('sclasses', 'subjects.class_id', '=', 'sclasses.id')
            ->select('subjects.*', 'sclasses.class_name')
            ->get();
        return response()->json([
            'data' => $subject,
            'message' => 'success',
            'status' => 200
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject_name' => 'required|unique:subjects|max:50',
            'subject_code' => 'required|unique:subjects|max:50',
            'class_id' => 'required'
        ]);

        $subject = Subject::create([
            'class_id' => $request->class_id,
            'subject_name' => $request->subject_name,
            'subject_code' => $request->subject_code
        ]);

        return response()->json([
            'data' => $subject,
            'message' => 'success',
            'status' => 200
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'class_id' => 'required',
            'subject_name' => 'required|unique:subjects|max:50',
            'subject_code' => 'required|max:50|unique:subjects,subject_code,' . $id
        ]);

        $subject = Subject::find($id);
        $subject->update([
            'class_id' => $request->class_id,
            'subject_name' => $request->subject_name,
            'subject_code' => $request->subject_code
        ]);

        return response()->json([
            'data' => $subject,
            'message' => 'success',
            'status' => 200
        ]);
    }

    public function show($id)
    {
        $subject = DB::table('subjects')
            ->leftJoin('sclasses', 'subjects.class_id', '=', 'sclasses.id')
            ->where('subjects.id', $id)
            ->select('subjects.*', 'sclasses.class_name')
            ->first();
        return response()->json([
            'data' => $subject,
            'message' => 'success',
            'status' => 200
        ]);
    }

    public function destroy($id)
    {
        $subject = Subject::findorfail($id);
        $subject->delete();
        return response()->json([
            'message' => 'succees',
            'status' => 200
        ]);
    }
}
