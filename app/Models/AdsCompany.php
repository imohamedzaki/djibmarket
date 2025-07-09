<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdsCompany extends Model
{
    use HasFactory;

    protected $table = 'ads_companies';

    protected $fillable = [
        'name',
        'logo',
        'link',
        'start_date',
        'end_date',
        'seller_id',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Get the seller associated with this ad company.
     */
    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }

    /**
     * Get the full URL for the logo image.
     */
    public function getLogoUrlAttribute(): ?string
    {
        if ($this->logo) {
            return asset('storage/' . $this->logo);
        }
        return null;
    }

    /**
     * Check if the ad is currently active (within date range and is_active).
     */
    public function getIsCurrentlyActiveAttribute(): bool
    {
        if (!$this->is_active) {
            return false;
        }

        $today = now()->toDateString();
        return $today >= $this->start_date->toDateString() && $today <= $this->end_date->toDateString();
    }

    /**
     * Scope to get only active ads.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get ads that are currently running (within date range).
     */
    public function scopeCurrent($query)
    {
        $today = now()->toDateString();
        return $query->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today);
    }

    /**
     * Scope to get ads that are both active and current.
     */
    public function scopeActiveAndCurrent($query)
    {
        return $query->active()->current();
    }
}
