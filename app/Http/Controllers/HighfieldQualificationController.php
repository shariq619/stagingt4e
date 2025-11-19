<?php

namespace App\Http\Controllers;

use App\Models\HighfieldQualification;
use Illuminate\Http\Request;

class HighfieldQualificationController extends Controller
{
    public function index()
    {
        $qualifications = HighfieldQualification::all();
        return view('admin.highfield.index', compact('qualifications'));
    }

    public function update(Request $request)
    {
        $qualification = HighfieldQualification::findOrFail($request->pk);
        $qualification->update([
            $request->name => $request->value
        ]);

        return response()->json(['success' => true]);
    }
}
