<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BusinessActivity extends Model
{
    use HasFactory;

    protected $table = 'business_activities';

    protected $fillable = [
        'name',
        'name_ar',
        'name_fr',
        'description',
        'slug',
        'parent_id'
    ];

    public function getRouteKeyName()
    {
        return 'slug'; // Use slug for route binding
    }

    /**
     * Get the sellers associated with this business activity.
     */
    public function sellers(): HasMany
    {
        return $this->hasMany(Seller::class);
    }
}
