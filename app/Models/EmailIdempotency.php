<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailIdempotency extends Model
{
    protected $table = 'email_idempotency';
    protected $fillable = ['event_key', 'recipient_email', 'hash'];
}
