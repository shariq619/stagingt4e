<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailMapping extends Model
{
    protected $fillable = [
        'trigger_id', 'template_id', 'scope', 'course_category', 'course_id',
        'recipients', 'enabled', 'priority'
    ];
    protected $casts = ['recipients' => 'array', 'enabled' => 'boolean'];

    public function trigger()
    {
        return $this->belongsTo(EmailTrigger::class, 'trigger_id');
    }

    public function template()
    {
        return $this->belongsTo(EmailTemplate::class, 'template_id');
    }

    public function conditions()
    {
        return $this->hasMany(EmailMappingCondition::class, 'mapping_id');
    }
}
