<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['order_id', 'payment_method', 'status', 'proof'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
