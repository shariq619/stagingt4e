<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterCampaignRecipient extends Model
{
    protected $fillable = ['campaign_id','name','email','status','sent_at','error'];

    protected $dates = ['sent_at'];

    public function campaign()
    {
        return $this->belongsTo(NewsletterCampaign::class, 'campaign_id');
    }
}
