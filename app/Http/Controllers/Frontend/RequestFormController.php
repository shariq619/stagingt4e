<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\RequestForm;
use Illuminate\Http\Request;

class RequestFormController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $validator = validator($request->all(), [
            'name' => ['required', 'regex:/^[a-zA-Z\s]+$/', 'max:30'],
            'company_name' => 'required|max:30', 
            'email' => [
                'required',
                'email',
                'max:50',
                'email',
                'regex:/^[a-zA-Z0-9._%+-]+@(gmail|yahoo|hotmail|outlook)\\.com$/'
            ],
            'training_needs' => 'required|max:255',
        ], [
            'name.required' => 'Please enter your name.',
            'name.regex' => 'Name must contain only letters.',
            'name.max' => 'Name must not be more than 30 characters.',
            'company_name.required' => 'Please enter your company name.',
            'company_name.max' => 'Company name must not be more than 20 characters.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email.',
            'email.regex' => 'Only Gmail, Yahoo, Hotmail, or Outlook email is allowed.',
            'training_needs.required' => 'Please enter your training needs.',
        ]);

        if ($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $validatedData = $validator->validated();
        RequestForm::create($validatedData);

        return response()->json(['message' => 'Your request has been submitted successfully!'], 200);
    }
}
