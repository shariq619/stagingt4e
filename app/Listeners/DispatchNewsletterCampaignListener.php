<?php

namespace App\Listeners;

use App\Events\NewsletterCampaignSendRequested;
use App\Services\Newsletter\NewsletterCampaignService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DispatchNewsletterCampaignListener implements ShouldQueue
{
    use InteractsWithQueue;

    protected NewsletterCampaignService $service;

    public function __construct(NewsletterCampaignService $service)
    {
        $this->service = $service;
    }

    public function handle(NewsletterCampaignSendRequested $event): void
    {
        $this->service->queueCampaign($event->campaign, 'en');
    }
}
