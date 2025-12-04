<?php

namespace App\Console\Commands\Crm;

use App\Models\FrontOrderDetails;
use App\Models\User;
use App\Services\Crm\Email\Context\ContextBuilder;
use App\Services\Crm\Email\EmailService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RunTimeEmailTriggers extends Command
{
    protected $signature = 'emails:run-time-triggers';
    protected $description = 'Send time-based emails: birthdays, course reminders, licence expiry.';

    public function handle(EmailService $emails, ContextBuilder $builder): int
    {
        $today = Carbon::today();

        $this->sendBirthdayEmails($emails, $today);
        $this->sendCourseReminders($emails, $builder, $today);
        $this->sendLicenseReminders($emails, $builder, $today);

        return Command::SUCCESS;
    }

    protected function sendBirthdayEmails(EmailService $emails, Carbon $today): void
    {
        $monthDay = $today->format('m-d');

        User::role('Learner')
            ->whereNotNull('birth_date')
            ->where(function ($q) use ($monthDay) {
                $q->whereRaw("DATE_FORMAT(STR_TO_DATE(birth_date, '%Y-%m-%d'), '%m-%d') = ?", [$monthDay])
                    ->orWhereRaw("DATE_FORMAT(STR_TO_DATE(birth_date, '%d-%m-%Y'), '%m-%d') = ?", [$monthDay]);
            })
            ->chunkById(100, function ($learners) use ($emails, $today) {
                foreach ($learners as $learner) {
                    if (!$learner->email) {
                        continue;
                    }

                    $payload = [
                        'locale'          => 'en',
                        'user'            => $learner->getAttributes(),
                        'course'          => [],
                        'enrollment'      => [],
                        'invoice'         => [],
                        'payment'         => [],
                        'payment_details' => '',
                        'extras'          => [
                            'birthday_date' => $today->toDateString(),
                        ],
                    ];

                    $eventKey = sprintf(
                        'time.learner.birthday.%s.%d',
                        $today->toDateString(),
                        $learner->id
                    );

                    $emails->dispatchTrigger('learner.birthday', $payload, $eventKey);
                }
            });
    }

    protected function sendCourseReminders(EmailService $emails, ContextBuilder $builder, Carbon $today): void
    {
        $startIn3 = $today->copy()->addDays(3);
        $this->sendCourseReminderForDate($emails, $builder, $startIn3, 'course.reminder.start.3d');

        $startIn1 = $today->copy()->addDay();
        $this->sendCourseReminderForDate($emails, $builder, $startIn1, 'course.reminder.start.1d');
    }

    protected function sendCourseReminderForDate(
        EmailService $emails,
        ContextBuilder $builder,
        Carbon $courseStartDate,
        string $triggerKey
    ): void {
        FrontOrderDetails::query()
            ->whereHas('cohort', function ($q) use ($courseStartDate) {
                $q->whereDate('start_date_time', $courseStartDate);
            })
            ->chunkById(100, function ($details) use ($emails, $builder, $courseStartDate, $triggerKey) {
                foreach ($details as $detail) {
                    $payload = $builder->build(
                        $detail,
                        (string) ($detail->course_status ?? ''),
                        [
                            'trigger'           => $triggerKey,
                            'course_start_date' => $courseStartDate->toDateString(),
                        ]
                    );

                    $eventKey = sprintf(
                        'time.%s.%d.%s',
                        $triggerKey,
                        $detail->id,
                        $courseStartDate->toDateString()
                    );

                    $emails->dispatchTrigger($triggerKey, $payload, $eventKey);
                }
            });
    }

    protected function sendLicenseReminders(EmailService $emails, ContextBuilder $builder, Carbon $today): void
    {
        $offsets = [
            90 => 'license.expiry.90d',
            60 => 'license.expiry.60d',
            30 => 'license.expiry.30d',
        ];

        foreach ($offsets as $daysBefore => $triggerKey) {
            $expiryDate     = $today->copy()->addDays($daysBefore);
            $completionDate = $expiryDate->copy()->subYears(3);

            FrontOrderDetails::query()
                ->whereHas('cohort', function ($q) use ($completionDate) {
                    $q->whereDate('end_date_time', $completionDate);
                })
                ->chunkById(100, function ($details) use (
                    $emails,
                    $builder,
                    $triggerKey,
                    $expiryDate,
                    $daysBefore
                ) {
                    foreach ($details as $detail) {
                        $payload = $builder->build(
                            $detail,
                            (string) ($detail->course_status ?? ''),
                            [
                                'license_expiry_date' => $expiryDate->toDateString(),
                                'license_days_before' => $daysBefore,
                            ]
                        );

                        $eventKey = sprintf(
                            'time.%s.%d.%s',
                            $triggerKey,
                            $detail->id,
                            $expiryDate->toDateString()
                        );

                        $emails->dispatchTrigger($triggerKey, $payload, $eventKey);
                    }
                });
        }
    }
}
