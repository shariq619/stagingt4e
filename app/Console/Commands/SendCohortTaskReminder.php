<?php

namespace App\Console\Commands;

use App\Models\Cohort;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendCohortTaskReminder extends Command
{
    protected $signature = 'reminder:cohort-tasks';
    protected $description = 'Send reminder to learners to complete tasks before cohort start date';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $datesToCheck = [Carbon::now()->addDays(3)->startOfDay(), Carbon::now()->addDay()->startOfDay()];

        foreach ($datesToCheck as $date) {
            $cohorts = Cohort::with(['users', 'course.tasks'])
                ->whereDate('start_date_time', $date)
                ->get();

            foreach ($cohorts as $cohort) {
                foreach ($cohort->users as $learner) {
                    $incompleteTasks = 0;

                    foreach ($cohort->course->tasks as $task) {
                        $submission = $task->submissions()
                            ->where('user_id', $learner->id)
                            ->where('cohort_id', $cohort->id)
                            ->first();

                        if (!$submission || $submission->status !== 'Approved') {
                            $incompleteTasks++;
                        }
                    }

                    if ($incompleteTasks > 0) {
                        //Mail::to($learner->email)->send(new \App\Mail\TaskReminderMail($cohort, $learner, $incompleteTasks, $date));
                    }
                }
            }
        }
    }
}
