<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class SellerAd extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'title',
        'description',
        'ad_slot',
        'headline',
        'sub_headline',
        'call_to_action_text',
        'call_to_action_url',
        'ad_image',
        'custom_colors',
        'pricing_type',
        'daily_rate',
        'per_view_rate',
        'total_budget',
        'start_date',
        'end_date',
        'duration_days',
        'max_views',
        'max_clicks',
        'current_views',
        'current_clicks',
        'current_cost',
        'status',
        'admin_notes',
        'approved_at',
        'approved_by',
        'auto_paused',
        'pause_reason',
    ];

    protected $casts = [
        'custom_colors' => 'array',
        'daily_rate' => 'decimal:2',
        'per_view_rate' => 'decimal:2',
        'total_budget' => 'decimal:2',
        'current_cost' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'approved_at' => 'datetime',
        'auto_paused' => 'boolean',
        'current_views' => 'integer',
        'current_clicks' => 'integer',
        'max_views' => 'integer',
        'max_clicks' => 'integer',
        'duration_days' => 'integer',
    ];

    // Ad slot configurations
    public const AD_SLOTS = [
        // Ads Space 1 - Top Banner Area
        'ads_space_1_main_banner' => 'Main Banner (Top Section)',
        'ads_space_1_weekly_deal' => 'Weekly Deal Banner',
        'ads_space_1_tech_products' => 'Tech Products Banner',

        // Ads Space 2 - Highlight Area
        'ads_space_2_power_bank' => 'Power Bank Ad Space',
        'ads_space_2_game_controller' => 'Game Controller Ad Space',
        'ads_space_2_iphone' => 'iPhone Ad Space',

        // Ads Space 3 - Mid Page Left Column
        'ads_space_3_latest_books' => 'Latest Books Ad Space',
        'ads_space_3_best_collection' => 'Best Collection Ad Space',
        'ads_space_3_professional_books' => 'Professional Books Ad Space',

        // Ads Space 4 - Mid Page Right Column
        'ads_space_4_teddy_bear' => 'Teddy Bear Ad Space',
        'ads_space_4_wooden_toys' => 'Wooden Toys Ad Space',
        'ads_space_4_baby_products' => 'Baby Products Ad Space',

        // Ads Space 5 - Center Section
        'ads_space_5_kitchen_appliances' => 'Kitchen Appliances Ad Space',

        // Ads Space 6 - Bottom Banner
        'ads_space_6_chairs' => 'Chairs Ad Space',

        // Ads Space 7 - Footer Banner
        'ads_space_7_left' => 'Footer Left Ad Space',
        'ads_space_7_right' => 'Footer Right Ad Space',

        // Legacy/Generic slots (for backward compatibility)
        'ads_space_1' => 'Top Banner (Generic)',
        'ads_space_2' => 'Highlight Area (Generic)',
        'ads_space_3' => 'Mid Page - Left Column (Generic)',
        'ads_space_4' => 'Mid Page - Right Column (Generic)',
        'ads_space_5' => 'Center Section (Generic)',
        'ads_space_6' => 'Bottom Banner (Generic)',
        'ads_space_7' => 'Footer Banner (Generic)',
    ];

    // Status constants
    public const STATUS_PENDING = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_ACTIVE = 'active';
    public const STATUS_PAUSED = 'paused';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_REJECTED = 'rejected';

    // Pricing type constants
    public const PRICING_DAILY = 'daily';
    public const PRICING_PER_VIEW = 'per_view';

    /**
     * Relationships
     */
    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'approved_by');
    }

    public function stats(): HasMany
    {
        return $this->hasMany(SellerAdStat::class);
    }

    public function views(): HasMany
    {
        return $this->stats()->where('event_type', 'view');
    }

    public function clicks(): HasMany
    {
        return $this->stats()->where('event_type', 'click');
    }

    /**
     * Scopes
     */
    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE)
            ->where('start_date', '<=', today())
            ->where(function ($q) {
                $q->whereNull('end_date')
                    ->orWhere('end_date', '>=', today());
            })
            ->where('auto_paused', false);
    }

    public function scopeForSlot($query, $slot)
    {
        return $query->where('ad_slot', $slot);
    }

    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', self::STATUS_APPROVED);
    }

    public function scopeRejected($query)
    {
        return $query->where('status', self::STATUS_REJECTED);
    }

    /**
     * Accessors & Mutators
     */
    public function getAdSlotDisplayNameAttribute(): string
    {
        return self::AD_SLOTS[$this->ad_slot] ?? $this->ad_slot;
    }

    public function getAdImageUrlAttribute(): ?string
    {
        return $this->ad_image ? Storage::url($this->ad_image) : null;
    }

    public function getIsActiveAttribute(): bool
    {
        return $this->status === self::STATUS_ACTIVE
            && $this->start_date <= today()
            && ($this->end_date === null || $this->end_date >= today())
            && !$this->auto_paused;
    }

    public function getIsExpiredAttribute(): bool
    {
        return $this->end_date && $this->end_date < today();
    }

    public function getClickThroughRateAttribute(): float
    {
        return $this->current_views > 0 ? ($this->current_clicks / $this->current_views) * 100 : 0;
    }

    public function getRemainingBudgetAttribute(): ?float
    {
        return $this->total_budget ? $this->total_budget - $this->current_cost : null;
    }

    public function getDaysRemainingAttribute(): ?int
    {
        if (!$this->end_date) {
            return null;
        }

        return max(0, today()->diffInDays($this->end_date, false));
    }

    /**
     * Methods
     */
    public function recordView(array $data = []): void
    {
        $this->recordEvent('view', $data);
    }

    public function recordClick(array $data = []): void
    {
        $this->recordEvent('click', $data);
    }

    protected function recordEvent(string $eventType, array $data = []): void
    {
        // Create stat record
        $this->stats()->create(array_merge([
            'event_type' => $eventType,
            'event_time' => now(),
            'user_ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'session_id' => session()->getId(),
            'buyer_id' => Auth::check() ? Auth::id() : null,
            'referer_url' => request()->header('referer'),
            'page_url' => request()->fullUrl(),
        ], $data));

        // Update cached counters
        if ($eventType === 'view') {
            $this->increment('current_views');
        } else {
            $this->increment('current_clicks');
        }

        // Update cost
        $this->updateCost();

        // Check limits and auto-pause if needed
        $this->checkLimitsAndPause();
    }

    public function updateCost(): void
    {
        if ($this->pricing_type === self::PRICING_PER_VIEW) {
            $this->current_cost = $this->current_views * $this->per_view_rate;
        } else {
            // Daily pricing - calculate based on active days
            $startDate = $this->start_date;
            $endDate = $this->end_date ?? today();
            $activeDays = $startDate->diffInDays(min($endDate, today())) + 1;
            $this->current_cost = $activeDays * $this->daily_rate;
        }

        $this->save();
    }

    public function checkLimitsAndPause(): void
    {
        $pauseReason = null;

        // Check view limit
        if ($this->max_views && $this->current_views >= $this->max_views) {
            $pauseReason = 'views_reached';
        }
        // Check click limit
        elseif ($this->max_clicks && $this->current_clicks >= $this->max_clicks) {
            $pauseReason = 'clicks_reached';
        }
        // Check budget limit
        elseif ($this->total_budget && $this->current_cost >= $this->total_budget) {
            $pauseReason = 'budget_reached';
        }
        // Check end date
        elseif ($this->end_date && $this->end_date < today()) {
            $pauseReason = 'end_date_reached';
        }

        if ($pauseReason) {
            $this->update([
                'auto_paused' => true,
                'pause_reason' => $pauseReason,
                'status' => self::STATUS_COMPLETED,
            ]);
        }
    }

    public function approve(Admin $admin, string $notes = null): bool
    {
        return $this->update([
            'status' => self::STATUS_APPROVED,
            'approved_by' => $admin->id,
            'approved_at' => now(),
            'admin_notes' => $notes,
        ]);
    }

    public function reject(Admin $admin, string $notes): bool
    {
        return $this->update([
            'status' => self::STATUS_REJECTED,
            'approved_by' => $admin->id,
            'admin_notes' => $notes,
        ]);
    }

    public function activate(): bool
    {
        if ($this->status !== self::STATUS_APPROVED) {
            return false;
        }

        return $this->update([
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    public function pause(string $reason = 'manually_paused'): bool
    {
        return $this->update([
            'status' => self::STATUS_PAUSED,
            'auto_paused' => $reason !== 'manually_paused',
            'pause_reason' => $reason,
        ]);
    }

    public function resume(): bool
    {
        if (!in_array($this->status, [self::STATUS_PAUSED, self::STATUS_APPROVED])) {
            return false;
        }

        return $this->update([
            'status' => self::STATUS_ACTIVE,
            'auto_paused' => false,
            'pause_reason' => null,
        ]);
    }

    /**
     * Get default custom colors
     */
    public static function getDefaultColors(): array
    {
        return [
            'background' => '#ffffff',
            'text' => '#000000',
            'heading' => '#333333',
            'button_bg' => '#007bff',
            'button_text' => '#ffffff',
        ];
    }

    /**
     * Boot method
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($ad) {
            // Set end date based on duration if provided
            if ($ad->duration_days && !$ad->end_date) {
                $ad->end_date = Carbon::parse($ad->start_date)->addDays($ad->duration_days);
            }

            // Set default custom colors if not provided
            if (!$ad->custom_colors) {
                $ad->custom_colors = self::getDefaultColors();
            }
        });

        static::deleting(function ($ad) {
            // Delete associated image file
            if ($ad->ad_image) {
                Storage::delete($ad->ad_image);
            }
        });
    }
}