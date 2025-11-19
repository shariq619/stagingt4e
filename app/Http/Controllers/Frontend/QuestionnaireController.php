<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\QuestionnaireResultMail;
use App\Models\Questionnaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Arr;

class QuestionnaireController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->toArray());
        // $request->merge([
        //     'question_1' => is_array($request->question_1) ? implode(', ', $request->question_1) : $request->question_1,
        //     'question_2' => is_array($request->question_2) ? implode(', ', $request->question_2) : $request->question_2,
        //     'question_3' => is_array($request->question_3) ? implode(', ', $request->question_3) : $request->question_3,
        //     'question_4' => is_array($request->question_4) ? implode(', ', $request->question_4) : $request->question_4,
        //     'question_5' => is_array($request->question_5) ? implode(', ', $request->question_5) : $request->question_5,
        //     'question_6' => is_array($request->question_6) ? implode(', ', $request->question_6) : $request->question_6,
        // ]);

        $validatedData = $request->validate([
            'g-recaptcha-response' => 'required|captcha',
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:50',
                'unique:questionnaires,email',
                'regex:/^[a-zA-Z0-9._%+-]+@(gmail|yahoo|hotmail|outlook)\.com$/'
            ],
            'phone' => 'required|string|max:20',
            'question_1' => 'required|string|max:255',
            'question_2' => 'required|string|max:255',
            'question_3' => 'required|string|max:255',
            'question_4' => 'required|string|max:255',
            'question_5' => 'required|string|max:255',
            'question_6' => 'required|string|max:255',
        ], [
            'email.unique' => 'You cannot use the same email twice. Please use a different one.',
            'email.regex' => 'Only Gmail, Yahoo, Hotmail, or Outlook addresses are allowed.',
            'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
            'g-recaptcha-response.captcha' => 'Captcha verification failed, please try again.',
        ]);

        //$questionnaire = Questionnaire::create($validatedData);

        $questionnaire = Questionnaire::create(Arr::except($validatedData, ['g-recaptcha-response']));

        // send email (example to static address, replace with user email if available)
       //Mail::to(['web@deans-group.co.uk','outreach@deans-group.co.uk'])->send(new QuestionnaireResultMail($questionnaire));
       //Mail::to(['riz.dean@deans-group.co.uk','outreach@deans-group.co.uk','control@deans-group.co.uk'])->send(new QuestionnaireResultMail($questionnaire));
       Mail::to(['info@training4employment.co.uk'])->send(new QuestionnaireResultMail($questionnaire));

        return response()->json(['message' => 'Your request has been submitted successfully!'], 200)->cookie('questionnaire_form', 'true', 60 * 24 * 30);

    }
}
