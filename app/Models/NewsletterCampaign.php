<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterCampaign extends Model
{
    protected $fillable = [
        'newsletter_id', 'group_name', 'data_source', 'sender_name', 'sender_email', 'subject_snapshot', 'html_snapshot', 'text_snapshot', 'sent_at', 'recipients_count'
    ];

    protected $dates = ['sent_at'];

    public function newsletter()
    {
        return $this->belongsTo(Newsletter::class);
    }

    public function recipients()
    {
        return $this->hasMany(NewsletterCampaignRecipient::class, 'campaign_id');
    }
}
