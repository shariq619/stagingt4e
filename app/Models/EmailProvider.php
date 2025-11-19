<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailProvider extends Model
{
    protected $fillable = ['key', 'name', 'config'];
    protected $casts = ['config' => 'array'];
}
