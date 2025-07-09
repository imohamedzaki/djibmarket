<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
