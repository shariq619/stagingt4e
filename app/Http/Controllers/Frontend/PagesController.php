<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\SEOHelper;
use App\Http\Controllers\Controller;
use App\Mail\ContactFormMail;
use App\Models\Contact;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PagesController extends Controller
{
    //    public function __construct()
    //    {
    //        $currentPage = request()->route()->getName() ?? 'default';
    //        $seo = SEOHelper::get($currentPage);
    //        view()->share('seo', $seo);
    //    }

    public function about()
    {
        return view('frontend.about-us.index');
    }

    public function contact()
    {
        return view('frontend.contact-us.index');
    }

    public function referFriend()
    {
        return view('frontend.refer-friend.index');
    }

    public function corporate()
    {
        return view('frontend.corporate-training.index');
    }

    public function helpCenter()
    {
        return view('frontend.help-center.index');
    }

    public function bookingConditions()
    {
        return view('frontend.booking-t-a-c.index');
    }

    public function faq()
    {
        return view('frontend.faqs.index');
    }

    function eLearning()
    {
        return view('frontend.e-learning.index');
    }

    function privacyPolicy()
    {
        return view('frontend.privacy-policy.index');
    }

    function examinationRequirements()
    {
        //$courses = Course::inRandomOrder()->limit(8)->get();


        $allowedIds = [1, 2, 3, 4, 14, 6, 11, 12];
        $courses = Course::whereIn('id', $allowedIds)->get();
        return view('frontend.examination.index', compact('courses'));
    }

    function expertResources()
    {
        return view('frontend.resources.index');
    }

    function thankYou()
    {
        return view('frontend.home.thank_you');
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name' => ['required', 'regex:/^[a-zA-Z\s]+$/', 'max:30'],
            'phone' => 'required|max:13',
            'email' => [
                'required',
                'email',
                'max:50',
                'regex:/^[a-zA-Z0-9._%+-]+@(gmail|yahoo|hotmail|outlook)\\.com$/'
            ],
            'subject' => 'required|string|max:100',
            'company' => 'required|string|max:100',
            'message' => 'nullable|string||max:255',
            'g-recaptcha-response' => 'required|captcha',
        ], [
            'name.required' => 'Please enter your name.',
            'name.regex' => 'Name must contain only letters.',
            'name.max' => 'Name must not be more than 30 characters.',
            'phone.required' => 'Please enter your phone number.',
            'phone.max' => 'Phone number must not be more than 13 characters.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email.',
            'email.regex' => 'Only Gmail, Yahoo, Hotmail, or Outlook email is allowed.',
            'email.unique' => 'This email has already been used.',
            'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
            'g-recaptcha-response.captcha' => 'Captcha verification failed. Please try again.',
        ]);

        Contact::create($request->except('g-recaptcha-response'));
        Mail::to(['outreach@deans-group.co.uk','outreach@deans-group.co.uk'])->send(new ContactFormMail($request->all()));
        return redirect()->route('thank.you')->with('success', 'Your message has been sent successfully!');
    }
}
