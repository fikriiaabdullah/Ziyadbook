<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'stock', 'category_id', 'image', 'meta_pixel_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function landingPage()
    {
        return $this->hasOne(LandingProduct::class);
    }

    public function hasLandingPage()
    {
        return $this->landingPage()->exists();
    }
}
