<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    protected $fillable = [
        'code',
        'category',
        'active',
        'is_draft',
        'created_by_id'
    ];

    protected $casts = [
        'active' => 'boolean',
        'is_draft' => 'boolean',
    ];

    public function versions()
    {
        return $this->hasMany(EmailTemplateVersion::class, 'template_id');
    }

    public function currentVersion()
    {
        return $this->hasOne(EmailTemplateVersion::class, 'template_id')
            ->where('is_current', 1);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
