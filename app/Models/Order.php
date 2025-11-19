<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'user_id', 'course_id', 'cohort_id',
        'total_amount', 'amount_paid',
        'payment_type', 'status'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function cohort() {
        return $this->belongsTo(Cohort::class);
    }

    public function front_payments() {
        return $this->hasMany(FrontPayment::class);
    }

    public function checkoutDetail() {
        return $this->hasOne(CheckoutDetail::class);
    }
}
