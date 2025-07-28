<?php

namespace App\Models;

use App\Models\Category;
use App\Models\BrandType;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';
    protected $fillable = [
        'name',
        'slug',
        'logo',
        'brand_type_id',
        'description',
        'website'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'brand_category')
            ->withPivot(['is_top_brand', 'priority']);
    }

    public function type()
    {
        return $this->belongsTo(BrandType::class, 'brand_type_id');
    }

    /**
     * Get the logo URL - handles both local files and external URLs
     */
    public function getLogoUrlAttribute()
    {
        if (!$this->logo) {
            return asset('assets/imgs/template/logo_only.png');
        }

        // Check if it's an external URL
        if (filter_var($this->logo, FILTER_VALIDATE_URL)) {
            return $this->logo;
        }

        // It's a local file, generate the full URL
        return asset($this->logo);
    }

    /**
     * Check if logo is a local file
     */
    public function isLocalLogo()
    {
        return $this->logo && !filter_var($this->logo, FILTER_VALIDATE_URL);
    }
}
