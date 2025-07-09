<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Cviebrock\EloquentSluggable\Sluggable; // If you want to use slugs

class Campaign extends Model
{
    use HasFactory, Sluggable; // Add Sluggable if you use it

    protected $fillable = [
        'admin_id',
        'name',
        'slug',
        'ref',
        'description',
        'banner_image',
        'start_date',
        'end_date',
        'is_active',
        // 'admin_id', // Uncomment if you add this foreign key
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Return the sluggable configuration array for this model.
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * Get the promotions associated with the campaign.
     */
    public function promotions(): HasMany
    {
        return $this->hasMany(Promotion::class);
    }

    /**
     * Get the admin that created this campaign.
     */
    public function admin(): BelongsTo
    {
        // Assuming your Admin model is named Admin and is in App\Models namespace
        return $this->belongsTo(Admin::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($campaign) {
            $campaign->ref = 'CAM-' . str_pad($campaign->id, 3, '0', STR_PAD_LEFT);
            $campaign->save();
        });
    }
}
