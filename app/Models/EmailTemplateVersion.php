<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplateVersion extends Model
{
    protected $fillable = [
        'template_id',
        'version',
        'is_current',
        'layout_html',
        'layout_text',
        'meta',
        'attachments',
    ];

    protected $casts = [
        'is_current' => 'boolean',
        'meta' => 'array',
        'attachments' => 'array',
    ];

    public function translations()
    {
        return $this->hasMany(EmailTemplateTranslation::class, 'template_version_id');
    }

    public function template()
    {
        return $this->belongsTo(EmailTemplate::class, 'template_id');
    }

    public function translationForLocale($locale)
    {
        return $this->translations()
            ->where('locale', $locale)
            ->first()
            ?: $this->translations()
                ->where('locale', 'en')
                ->first();
    }

}
