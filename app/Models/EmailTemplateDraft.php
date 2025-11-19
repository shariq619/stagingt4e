<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplateDraft extends Model
{
    protected $table = 'email_template_drafts';

    protected $fillable = [
        'template_id',
        'newsletter_name',
        'subject',
        'data_source',
        'from_name',
        'from_email',
        'created_by_name',
        'created_by_email',
        'merge_field',
        'footer_variant',
        'to_recipients',
        'cc_recipients',
        'bcc_recipients',
        'attachments',
        'html_body',
        'text_body',
    ];

    protected $casts = [
        'to_recipients' => 'array',
        'cc_recipients' => 'array',
        'bcc_recipients' => 'array',
        'attachments'   => 'array',
    ];

    public function template()
    {
        return $this->belongsTo(EmailTemplate::class, 'template_id');
    }
}
