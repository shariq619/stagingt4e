<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailSend extends Model
{
    protected $fillable = [
        'event_key', 'event_course_id', 'recipient_email', 'template_code', 'template_version_id',
        'locale', 'provider_key', 'status', 'attempts', 'subject',
        'html_body', 'text_body', 'context', 'meta', 'sent_at'
    ];

    protected $casts = [
        'context' => 'array',
        'meta' => 'array',
        'sent_at' => 'datetime',
    ];

    public function events()
    {
        return $this->hasMany(EmailSendEvent::class, 'email_send_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'event_course_id');
    }

    public function thread()
    {
        return $this->belongsTo(EmailThread::class, 'email_thread_id');
    }

    public function messages()
    {
        return $this->hasMany(EmailMessage::class, 'email_send_id');
    }

}
