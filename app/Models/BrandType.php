<?php

namespace App\Models;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Model;

class BrandType extends Model
{
    protected $table = 'brand_types';
    protected $fillable = [
        'name',
        'slug'
    ];

    public function brands()
    {
        return $this->hasMany(Brand::class);
    }
}