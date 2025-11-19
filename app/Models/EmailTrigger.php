<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTrigger extends Model
{
    protected $fillable = ['key', 'entity', 'type', 'definition', 'active'];
    protected $casts = ['definition' => 'array', 'active' => 'boolean'];

    public function mappings()
    {
        return $this->hasMany(EmailMapping::class, 'trigger_id');
    }
}
