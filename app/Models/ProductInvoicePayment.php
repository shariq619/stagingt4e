<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductInvoicePayment extends Model
{
    protected $guarded = [];
    protected $casts = ['payment_date' => 'datetime', 'meta' => 'array',  'is_refunded' => 'boolean'];

    public function invoice()
    {
        return $this->belongsTo(ProductInvoice::class, 'invoice_id');
    }
}
