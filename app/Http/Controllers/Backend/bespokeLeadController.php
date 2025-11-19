<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\RequestBespoke;
use Illuminate\Http\Request;

class bespokeLeadController extends Controller
{
    public function index()
    {
        $bespokeLeads = RequestBespoke::paginate(10);
        return view('backend.bespoke_form.index', compact('bespokeLeads'));
    }
    public function markAsRead(Request $request)
    {
        $bespoke = RequestBespoke::find($request->id);

        if ($bespoke) {
            $bespoke->is_read = $bespoke->is_read ? 0 : 1;
            $bespoke->save();

            return response()->json(['success' => true, 'message' => 'Marked as read']);
        }

        return response()->json(['success' => false, 'message' => 'Record not found']);
    }
}
