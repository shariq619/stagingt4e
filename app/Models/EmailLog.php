<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'to',
        'subject',
        'body',
        'template_id',
        'trigger_id',
        'mailable_type',
        'mailable_id',
        'sent_at',
    ];
}
