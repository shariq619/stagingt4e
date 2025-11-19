<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrontOrder extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function cohort() {
        return $this->belongsTo(Cohort::class);
    }

    public function front_payment() {
        return $this->hasOne(FrontPayment::class,'order_id');
    }

    public function checkoutDetail() {
        return $this->hasOne(CheckoutDetail::class,'order_id');
    }

    public function frontOrderDetail()
    {
        return $this->hasMany(FrontOrderDetails::class,'order_id');
    }

}
