<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NominalCode extends Model
{
    use SoftDeletes;

    protected $fillable = ['code', 'description'];
}
