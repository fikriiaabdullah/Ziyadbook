<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingProductImage extends Model
{
    protected $fillable = [
        'landing_product_id',
        'image_path',
        'caption',
        'sort_order'
    ];

    public function landingProduct()
    {
        return $this->belongsTo(LandingProduct::class);
    }
}
