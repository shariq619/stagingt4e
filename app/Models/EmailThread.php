<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailThread extends Model
{
    protected $fillable = [
        'subject',
        'root_message_id',
        'related_type',
        'related_id',
        'created_by_user_id',
    ];

    public function messages()
    {
        return $this->hasMany(EmailMessage::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function related()
    {
        return $this->morphTo(null, 'related_type', 'related_id');
    }
}
