<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CohortReassignment extends Model
{
    protected $fillable = [
        'user_id', 'from_cohort_id', 'to_cohort_id',
        'order_detail_id', 'invoice_id', 'invoice_line_id',
        'fee_net', 'vat_rate', 'fee_vat', 'fee_gross',
        'included_in_invoice', 'invoice_line_code', 'invoice_line_desc',
        'created_by', 'meta', 'notes',
    ];

    protected $casts = [
        'included_in_invoice' => 'bool',
        'fee_net' => 'decimal:2',
        'fee_vat' => 'decimal:2',
        'fee_gross' => 'decimal:2',
        'vat_rate' => 'decimal:2',
        'meta' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fromCohort()
    {
        return $this->belongsTo(Cohort::class, 'from_cohort_id');
    }

    public function toCohort()
    {
        return $this->belongsTo(Cohort::class, 'to_cohort_id');
    }

    public function orderDetail()
    {
        return $this->belongsTo(FrontOrderDetails::class, 'order_detail_id');
    }

    public function productInvoice()
    {
        return $this->belongsTo(ProductInvoice::class, 'invoice_id');
    }
}

