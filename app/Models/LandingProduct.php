<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingProduct extends Model
{
    protected $fillable = [
        'product_id',
        'problem',
        'agitate',
        'solution',
        'headline',
        'subheadline',
        'call_to_action',
        'testimonials',
        'benefits',
        'youtube_video_url',
        'is_active'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
