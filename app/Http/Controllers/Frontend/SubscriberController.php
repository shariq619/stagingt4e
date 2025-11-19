<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\SubscriberConfirmationMail;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {

        if (app()->isProduction()){
            $request->validate([
                'full_name' => [
                    'required',
                    'string',
                    'max:50',
                    'regex:/^[a-zA-Z\s\'-]+$/'
                ],
                'email' => [
                    'required',
                    'email',
                    'max:50',
                    'unique:subscribers,email',
                    //'regex:/^[a-zA-Z0-9._%+-]+@(gmail|yahoo|hotmail|outlook)\.com$/'
                ],
                'phone' => [
                    'required',
                ],
                'g-recaptcha-response' => 'required|captcha',
            ], [
                 'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
                 'g-recaptcha-response.captcha' => 'Captcha verification failed. Please try again.',
            ]);
        } else {
            $request->validate([
                'full_name' => [
                    'required',
                    'string',
                    'max:50',
                    'regex:/^[a-zA-Z\s\'-]+$/'
                ],
                'email' => [
                    'required',
                    'email',
                    'max:50',
                    'unique:subscribers,email',
                    'regex:/^[a-zA-Z0-9._%+-]+@(gmail|yahoo|hotmail|outlook)\.com$/'
                ],
                'phone' => [
                    'required'
                ]
            ]);
        }


        $coupon = $this->generateCouponCode();

        $subscriber = Subscriber::create([
            'full_name' => $request->full_name,
            'coupon_code' => $coupon,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        Mail::to($subscriber->email)->send(new SubscriberConfirmationMail($subscriber));

        return response()->json([
            'success' => true,
            'message' => 'Subscription successful!',
            'coupon_code' => $coupon,
        ])->cookie('form_submitted', 'true', 60 * 24 * 30);
    }

    protected function generateCouponCode()
    {
        do {
            $code = 'T4E' . strtoupper(dechex(time())) . strtoupper(Str::random(1));
        } while (Subscriber::where('coupon_code', $code)->exists());

        return $code;
    }
}
