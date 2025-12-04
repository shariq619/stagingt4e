<?php

namespace App\Services\Crm\Newsletter\Context;

use App\Models\NewsletterCampaign;
use App\Models\NewsletterCampaignRecipient;
use App\Models\User;
use Carbon\CarbonInterface;

class ContextBuilder
{
    public function build(NewsletterCampaign $campaign, NewsletterCampaignRecipient $recipient, ?User $user = null, string $locale = 'en'): array
    {
        return [
            'locale' => $locale,
            'newsletter' => [
                'id' => $campaign->newsletter_id,
                'campaign_id' => $campaign->id,
                'title' => optional($campaign->newsletter)->title,
                'data_source' => $campaign->data_source,
                'group_name' => $campaign->group_name,
            ],
            'recipient' => [
                'id' => $recipient->id,
                'name' => $recipient->name,
                'email' => $recipient->email,
            ],
            'user' => $this->exportModel($user),
        ];
    }

    protected function exportModel(?User $user): array
    {
        if (!$user) {
            return [];
        }

        $raw = $user->getAttributes();

        foreach ($raw as $key => $value) {
            if ($value instanceof CarbonInterface) {
                $raw[$key] = $value->toDateTimeString();
            }
        }

        return $raw;
    }
}
