<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $student = DB::table('students')
            ->leftJoin('sclasses', 'students.class_id', '=', 'sclasses.id')
            ->leftJoin('sections', 'students.section_id', '=', 'sections.id')
            ->select('students.*', 'sclasses.class_name', 'sections.section_name')
            ->get();
        return response()->json([
            'data' => $student,
            'message' => 'success',
            'status' => 200
        ]);
    }

    public function store(Request $request)
    {
        // ['class_id', 'section_id', 'name', 'phone', 'email', 'password', 'photo', 'address', 'gender'];
        $request->validate([
            'class_id' => 'required',
            'section_id' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|unique:students',
            'password' => 'required|min:6',
            'address' => 'required',
            'gender' => 'required'
        ]);

        $student = Student::create([
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo' => $request->photo,
            'address' => $request->address,
            'gender' => $request->gender
        ]);

        return response()->json([
            'data' => $student,
            'message' => 'success',
            'status' => 200
        ]);
    }

    public function show($id)
    {
        $student = DB::table('students')
            ->leftJoin('sclasses', 'students.class_id', '=', 'sclasses.id')
            ->leftJoin('sections', 'students.section_id', '=', 'sections.id')
            ->where('students.id', $id)
            ->select('students.*', 'sclasses.class_name', 'sections.section_name')
            ->first();

        return response()->json([
            'data' => $student,
            'message' => 'success',
            'status' => 200
        ]);
    }

    public function destroy($id)
    {
        $student = Student::findorfail($id);
        $student->delete();
        return response()->json([
            'message' => 'success',
            'status' => 200
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'class_id' => 'required',
            'section_id' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|unique:students,email,' . $id,
            'password' => 'required|min:6',
            'address' => 'required',
            'gender' => 'required'
        ]);

        $student = Student::find($id);
        $student->update([
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo' => $request->photo,
            'address' => $request->address,
            'gender' => $request->gender
        ]);

        return response()->json([
            'data' => $student,
            'message' => 'success',
            'status' => 200
        ]);
    }
}
