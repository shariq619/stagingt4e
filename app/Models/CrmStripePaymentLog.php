<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrmStripePaymentLog extends Model
{
    protected $table = 'crm_stripe_payment_logs';
    protected $fillable = [
        'context',
        'invoice_id',
        'payment_intent',
        'charge_id',
        'refund_id',
        'amount',
        'currency',
        'status',
        'payload'
    ];
    protected $casts = [
        'payload' => 'array',
        'amount' => 'float'
    ];
}
