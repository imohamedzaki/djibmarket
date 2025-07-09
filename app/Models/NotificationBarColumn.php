<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotificationBarColumn extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'notification_bar_id',
        'column_order',
        'text_content',
        'image_path',
        'link_url',
        'link_target',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'column_order' => 'integer',
    ];

    /**
     * Get the notification bar that owns the column.
     */
    public function notificationBar(): BelongsTo
    {
        return $this->belongsTo(NotificationBar::class);
    }

    /**
     * Scope a query to only include active columns.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get the full URL for the image if it exists.
     */
    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image_path) {
            return null;
        }

        // If it's already a full URL, return as is
        if (filter_var($this->image_path, FILTER_VALIDATE_URL)) {
            return $this->image_path;
        }

        // Otherwise, prepend the storage URL
        return asset('storage/' . $this->image_path);
    }

    /**
     * Check if the column has a clickable link.
     */
    public function hasLink(): bool
    {
        return !empty($this->link_url);
    }

    /**
     * Check if the column has an image.
     */
    public function hasImage(): bool
    {
        return !empty($this->image_path);
    }
}
