<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductInvoiceLine extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'invoice_id',
        'qty',
        'product_code',
        'product_description',
        'unit_cost',
        'vat_rate',
        'discount',
        'net_amount',
        'vat_amount',
        'gross_amount',
        'assembly',
        'weight',
        'is_reassigned'
    ];

    protected $casts = [
        'assembly' => 'boolean',
    ];



    public function invoice()
    {
        return $this->belongsTo(ProductInvoice::class, 'invoice_id');
    }

    public function logs()
    {
        return $this->morphMany(PaymentAuditLog::class, 'auditable')->latest();
    }
}
