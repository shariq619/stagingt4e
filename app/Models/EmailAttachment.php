<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'email_template_id',
        'file_path',
        'file_name',
        'mime_type',
    ];
    public function template()
    {
        return $this->belongsTo(EmailTemplate::class);
    }
}
