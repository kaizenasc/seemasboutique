<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'city',
        'state',
        'pincode',
        'subtotal',
        'discount',
        'coupon_code',
        'total',
        'payment_method',
        'payment_status',
        'upi_utr',
        'order_status',
        'notes'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public static function generateOrderNumber()
    {
        return 'SM' . date('Ymd') . strtoupper(substr(uniqid(), -6));
    }
}