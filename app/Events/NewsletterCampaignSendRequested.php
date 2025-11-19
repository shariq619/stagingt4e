<?php

namespace App\Events;

use App\Models\NewsletterCampaign;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewsletterCampaignSendRequested
{
    use Dispatchable, SerializesModels;

    public NewsletterCampaign $campaign;

    public function __construct(NewsletterCampaign $campaign)
    {
        $this->campaign = $campaign;
    }
}
