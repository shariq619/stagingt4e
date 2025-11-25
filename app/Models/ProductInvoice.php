<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductInvoice extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'invoice_no',
        'order_no',
        'cohort_id',
        'user_id',
        'front_order_id',
        'order_detail_id',
        'invoice_date',
        'invoice_status',
        'additional_invoice_details',
        'carriage',
        'discount_amount',
        'discount_percent',
        'discount_vat_rate',
        'misc_cost',
        'total_net',
        'total_vat',
        'total_gross',
        'pdf_url',
        'nominal_code_id', 'project_code_id', 'source_id', 'department_id',
    ];

    protected $casts = [
        'invoice_date' => 'datetime',
        'carriage' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'discount_percent' => 'decimal:2',
        'discount_vat_rate' => 'decimal:2',
        'misc_cost' => 'decimal:2',
    ];

    public function lines()
    {
        return $this->hasMany(ProductInvoiceLine::class, 'invoice_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cohort()
    {
        return $this->belongsTo(Cohort::class);
    }

    public function frontOrder()
    {
        return $this->belongsTo(FrontOrder::class);
    }

    public function orderDetail()
    {
        return $this->belongsTo(FrontOrderDetails::class, 'order_detail_id');
    }

    public function logs()
    {
        return $this->morphMany(PaymentAuditLog::class, 'auditable')->latest();
    }

    public function nominalCode()
    {
        return $this->belongsTo(NominalCode::class);
    }

    public function projectCode()
    {
        return $this->belongsTo(ProjectCode::class);
    }

    public function source()
    {
        return $this->belongsTo(Source::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function activePayments()
    {
        return $this->hasMany(ProductInvoicePayment::class, 'invoice_id')
            ->where('is_refunded', '!=', 1);
    }
}
