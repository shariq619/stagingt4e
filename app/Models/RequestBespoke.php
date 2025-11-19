<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestBespoke extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['is_read'];
    protected $guarded = [];

    protected $casts = [
        'courses' => 'array',
    ];
}
