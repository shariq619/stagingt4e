<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $fillable = [
        'title', 'subject', 'data_source', 'from_name', 'from_email', 'created_by_name', 'created_by_email', 'merge_field', 'active',
        'to_recipients', 'cc_recipients', 'bcc_recipients', 'attachments', 'html_body', 'text_body', 'layout_html', 'layout_text'
    ];

    protected $casts = [
        'to_recipients'  => 'array',
        'cc_recipients'  => 'array',
        'bcc_recipients' => 'array',
        'attachments'    => 'array',
        'active'         => 'boolean',
    ];


    public function campaigns()
    {
        return $this->hasMany(NewsletterCampaign::class);
    }
}
