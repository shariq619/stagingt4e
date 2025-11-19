<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplateTranslation extends Model
{
    protected $fillable = ['template_version_id', 'locale', 'subject', 'html_body', 'text_body'];

    public function version()
    {
        return $this->belongsTo(EmailTemplateVersion::class, 'template_version_id');
    }
}
