<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailMappingCondition extends Model
{
    protected $fillable = ['mapping_id', 'key', 'operator', 'value'];

    public function mapping()
    {
        return $this->belongsTo(EmailMapping::class, 'mapping_id');
    }
}
