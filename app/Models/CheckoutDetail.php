<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckoutDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'first_name',
        'last_name',
        'company_name',
        'street_address',
        'unit',
        'city',
        'postcode',
        'phone',
        'email',
        'attendee_details',
        'hear_about',
        'declaration',
        'terms'
    ];

    public function frontOrder()
    {
        return $this->belongsTo(FrontOrder::class, 'order_id');
    }
    
    public function frontOrderDetail()
    {
        return $this->hasMany(FrontOrderDetails::class,'order_id');
    }
    public function cohort() {
        return $this->belongsTo(Cohort::class);
    }
    public function course() {
        return $this->belongsTo(Course::class);
    }
}
