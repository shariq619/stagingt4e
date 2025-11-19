<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailSendEvent extends Model
{
    protected $fillable = ['email_send_id', 'type', 'payload', 'user_id'];
    protected $casts = ['payload' => 'array'];

    public function send()
    {
        return $this->belongsTo(EmailSend::class, 'email_send_id');
    }
}
