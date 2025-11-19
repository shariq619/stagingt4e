<?php

namespace App\Providers;

use App\Events\LearnerStatusUpdated;
use App\Events\NewsletterCampaignSendRequested;
use App\Listeners\DispatchEmailTriggerListener;
use App\Listeners\DispatchNewsletterCampaignListener;
use App\Listeners\QueueContactCopyListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Mail\Events\MessageSent;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        LearnerStatusUpdated::class => [
            DispatchEmailTriggerListener::class,
        ],
        MessageSent::class => [
            QueueContactCopyListener::class,
        ],
        NewsletterCampaignSendRequested::class => [
            DispatchNewsletterCampaignListener::class,
        ],
    ];

    public function boot()
    {

    }
}
