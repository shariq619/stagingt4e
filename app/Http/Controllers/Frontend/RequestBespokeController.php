<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\BespokeRequestMail;
use App\Models\RequestBespoke;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;

class RequestBespokeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.bespoke_form.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'first_name' => ['required', 'regex:/^[a-zA-Z]+$/', 'max:30'],
            'last_name' => ['required', 'regex:/^[a-zA-Z]+$/', 'max:30'],
            'email' => [
                'required',
                'email',
                'max:50',
                'unique:request_bespokes,email',
                'regex:/^[a-zA-Z0-9._%+-]+@(gmail|yahoo|hotmail|outlook)\\.com$/'
            ],
            'phone' => 'required|max:13',
            'company_name' => 'required',
            'participant' => 'required',
            'company_address' => 'required',
            'courses' => 'required|array',
            'message' => 'nullable',
            'promotions_allowed_email' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ], [
            'first_name.required' => 'Please enter your first name.',
            'first_name.regex' => 'First name must contain only letters.',
            'first_name.max' => 'First name must not be more than 30 characters.',
            'last_name.required' => 'Please enter your last name.',
            'last_name.regex' => 'Last name must contain only letters.',
            'last_name.max' => 'Last name must not be more than 30 characters.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email.',
            'email.regex' => 'Only Gmail, Yahoo, Hotmail, or Outlook email is allowed.',
            'email.unique' => 'This email has already been used.',
            'phone.required' => 'Please enter your phone number.',
            'phone.max' => 'Phone number must not be more than 13 characters.',
            'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
            'g-recaptcha-response.captcha' => 'Captcha verification failed. Please try again.',
        ]);

        $validateData['courses'] = json_encode($request->courses);

        $requestBespoke = RequestBespoke::create(Arr::except($validateData, ['g-recaptcha-response']));

        Mail::to(['web@deans-group.co.uk','outreach@deans-group.co.uk'])->send(new BespokeRequestMail($requestBespoke));

        return response()->json(['message' => 'form submit'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($bespokeId)
    {
        return view('components.bespoke-form', compact('bespokeId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
