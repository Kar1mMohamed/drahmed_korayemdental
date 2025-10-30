<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transformation extends Model
{
    protected $fillable = [
        'before_image',
        'after_image',
        'testimonial',
        'client_name',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('created_at', 'desc');
    }

    /**
     * Get the before image URL
     */
    public function getBeforeImageUrlAttribute()
    {
        return asset($this->before_image);
    }

    /**
     * Get the after image URL
     */
    public function getAfterImageUrlAttribute()
    {
        return asset($this->after_image);
    }
}
