<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class CategoryAd extends Model
{
    protected $table = 'category_ads';
    protected $fillable = [
        'category_id',
        'image_path',
        'link_url',
        'position',
        'active',
        'starts_at',
        'ends_at',
    ];

    protected $casts = [
        'active' => 'boolean',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the full URL for the ad image
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image_path) {
            return asset('assets/imgs/template/logo_only.png');
        }

        // If it's already a full URL (external link), return as is
        if (filter_var($this->image_path, FILTER_VALIDATE_URL)) {
            return $this->image_path;
        }

        // If it's a local path, convert to full URL
        return asset($this->image_path);
    }

    /**
     * Check if the image is stored locally
     */
    public function isLocalImage()
    {
        return $this->image_path && !filter_var($this->image_path, FILTER_VALIDATE_URL);
    }
}
