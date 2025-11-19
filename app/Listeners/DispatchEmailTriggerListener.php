<?php

namespace App\Listeners;

use App\Events\LearnerStatusUpdated;
use App\Services\Email\EmailService;

class DispatchEmailTriggerListener
{
    protected EmailService $service;

    public function __construct(EmailService $service)
    {
        $this->service = $service;
    }

    public function handle(LearnerStatusUpdated $event)
    {
        $this->service->dispatchLearnerStatusUpdate(
            $event->orderDetail,
            $event->newStatus,
            []
        );
    }
}
