<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_name', 'email', 'address', 'total_price',
        'payment_method', 'payment_status', 'shipping_status',
        'province_id', 'city_id', 'courier', 'courier_service', 'shipping_cost'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
