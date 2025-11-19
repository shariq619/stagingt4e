<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\LeadForm;
use Illuminate\Http\Request;

class LeadFormController extends Controller
{
    public function index()
    {
        $input = request()->input('search');
        if ($input) {
            $leadForms = LeadForm::where('name', 'LIKE', "%{$input}%")
                ->orWhere('email', 'LIKE', "%{$input}%")
                ->orWhere('phone', 'LIKE', "%{$input}%")
                ->orderBy('created_at', 'desc')  // Add this line
                ->paginate(25);
        } else {
            $leadForms = LeadForm::orderBy('created_at', 'desc')->paginate(25);
        }
        return view('backend.lead_forms.index', compact('leadForms'));
    }
}
