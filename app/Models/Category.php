<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\CategoryAd;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'name_ar',
        'name_fr',
        'description',
        'slug'
    ];

    // Self-referencing relationship for parent category
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Self-referencing relationship for child categories
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Relationship to Products
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // New relationship
    public function coupons()
    {
        return $this->belongsToMany(Coupon::class, 'coupon_category');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug'; // Use slug for route binding
    }

    public function topBrands()
    {
        return $this->belongsToMany(Brand::class, 'brand_category')
            ->wherePivot('is_top_brand', true)
            ->withPivot('priority')
            ->orderBy('priority');
    }

    public function ads()
    {
        return $this->hasMany(CategoryAd::class);
    }
}