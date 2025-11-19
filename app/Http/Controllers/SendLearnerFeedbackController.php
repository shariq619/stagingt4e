<?php

namespace App\Http\Controllers;

use App\Mail\LearnerFeedbackRequest;
use App\Models\Subscriber;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendLearnerFeedbackController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        //$learners = User::whereHas('roles', fn($q) => $q->where('name', 'Learner'))->get();
        //$learners = User::where('email', 'web@deans-group.co.uk')->get();
        $subscribers = Subscriber::all();
        //$subscribers = Subscriber::where('email', 'web@deans-group.co.uk')->get();

        $batchSize = 30;
        $delayPerBatchInMinutes = 10;
        $batches = $subscribers->chunk($batchSize);


        foreach ($batches as $index => $batch) {
            $delay = now()->addMinutes($index * $delayPerBatchInMinutes);

            foreach ($batch as $learner) {
                if ($learner->email) {
                    Mail::to($learner->email)
                        ->later($delay, new LearnerFeedbackRequest($learner->full_name));

                    Log::info('Email scheduled', [
                        'email' => $learner->email,
                        'send_at' => $delay->toDateTimeString(),
                    ]);

                }
            }
        }
    }
}
