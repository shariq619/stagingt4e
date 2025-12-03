<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailMessage extends Model
{
    protected $fillable = [
        'email_thread_id',
        'email_send_id',
        'direction',
        'from_email',
        'to_email',
        'cc',
        'bcc',
        'subject',
        'body_html',
        'body_text',
        'message_id',
        'in_reply_to',
        'sent_at',
        'received_at',
        'provider',
        'raw_headers',
    ];

    protected $casts = [
        'cc'          => 'array',
        'bcc'         => 'array',
        'raw_headers' => 'array',
        'sent_at'     => 'datetime',
        'received_at' => 'datetime',
    ];

    public function thread()
    {
        return $this->belongsTo(EmailThread::class, 'email_thread_id');
    }

    public function send()
    {
        return $this->belongsTo(EmailSend::class, 'email_send_id');
    }
}
