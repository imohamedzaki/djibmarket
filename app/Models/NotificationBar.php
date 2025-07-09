<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class NotificationBar extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'column_count',
        'start_date',
        'end_date',
        'is_active',
        'css_class',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
        'column_count' => 'integer',
    ];

    /**
     * Get the columns for the notification bar.
     */
    public function columns(): HasMany
    {
        return $this->hasMany(NotificationBarColumn::class)->orderBy('column_order');
    }

    /**
     * Get only active columns for the notification bar.
     */
    public function activeColumns(): HasMany
    {
        return $this->hasMany(NotificationBarColumn::class)
            ->where('is_active', true)
            ->orderBy('column_order');
    }

    /**
     * Scope a query to only include active notification bars.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include notification bars that are currently visible.
     */
    public function scopeCurrentlyVisible($query)
    {
        $today = Carbon::today();
        return $query->where('is_active', true)
            ->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today);
    }

    /**
     * Check if the notification bar is currently visible.
     */
    public function isCurrentlyVisible(): bool
    {
        if (!$this->is_active) {
            return false;
        }

        $today = Carbon::today();
        return $this->start_date <= $today && $this->end_date >= $today;
    }

    /**
     * Get the status of the notification bar.
     */
    public function getStatusAttribute(): string
    {
        if (!$this->is_active) {
            return 'inactive';
        }

        $today = Carbon::today();

        if ($this->start_date > $today) {
            return 'scheduled';
        }

        if ($this->end_date < $today) {
            return 'expired';
        }

        return 'active';
    }
}