<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserContact extends Model
{
    use HasFactory;

    protected $table = 'user_contacts';

    protected $fillable = [
        'user_id',
        'name',
        'position',
        'direct_number',
        'direct_email',
        'mobile',
        'opt_out',
    ];

    protected $casts = [
        'opt_out' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
