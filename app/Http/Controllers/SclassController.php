<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sclass;

class SclassController extends Controller
{
    public function index()
    {
        $sclass = Sclass::all();
        return response()->json($sclass);
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_name' => 'required|unique:sclasses|max:25'
        ]);

        $sclass = Sclass::create([
            'class_name' => $request->class_name
        ]);
        return response()->json([
            'data' => $sclass,
            'message' => 'success',
            'status' => 200
        ]);
    }

    public function show($id)
    {
        $sclass = Sclass::find($id);
        return response()->json([
            'data' => $sclass,
            'message' => 'success',
            'status' => 200
        ]);
    }

    public function destroy($id)
    {
        $sclass = Sclass::find($id);
        $sclass->delete();

        return response()->json([
            'message' => 'success',
            'status' => 200
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'class_name' => 'required'
        ]);

        $sclass = Sclass::find($id);
        $sclass->update([
            'class_name' => $request->class_name
        ]);

        return response()->json([
            'data' => $sclass,
            'message' => 'success',
            'status' => 200
        ]);
    }
}
