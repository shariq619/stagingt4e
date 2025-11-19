<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\RequestForm;
use Illuminate\Http\Request;

class RequestFormController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');

        $requests = RequestForm::when($search, function($q, $search){
            return $q->where('name', 'like', "%{$search}%");
        })->orderBy('created_at', 'desc')->paginate(10);

        $requests->appends(['search' => $search]);

        return view('backend.request_forms.index', compact('requests'));
    }
}
