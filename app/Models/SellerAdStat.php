<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SellerAdStat extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_ad_id',
        'event_type',
        'event_time',
        'user_ip',
        'user_agent',
        'session_id',
        'buyer_id',
        'referer_url',
        'page_url',
        'country',
        'city',
        'device_type',
        'browser',
        'os',
    ];

    protected $casts = [
        'event_time' => 'datetime',
    ];

    // Event type constants
    public const EVENT_VIEW = 'view';
    public const EVENT_CLICK = 'click';

    /**
     * Relationships
     */
    public function sellerAd(): BelongsTo
    {
        return $this->belongsTo(SellerAd::class);
    }

    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    /**
     * Scopes
     */
    public function scopeViews($query)
    {
        return $query->where('event_type', self::EVENT_VIEW);
    }

    public function scopeClicks($query)
    {
        return $query->where('event_type', self::EVENT_CLICK);
    }

    public function scopeToday($query)
    {
        return $query->whereDate('event_time', today());
    }

    public function scopeThisWeek($query)
    {
        return $query->whereBetween('event_time', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ]);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('event_time', now()->month)
            ->whereYear('event_time', now()->year);
    }

    public function scopeForPeriod($query, $startDate, $endDate)
    {
        return $query->whereBetween('event_time', [$startDate, $endDate]);
    }

    public function scopeByCountry($query, $country)
    {
        return $query->where('country', $country);
    }

    public function scopeByDevice($query, $deviceType)
    {
        return $query->where('device_type', $deviceType);
    }

    /**
     * Boot method
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($stat) {
            // Parse user agent to extract device info if not provided
            if (!$stat->device_type && $stat->user_agent) {
                $stat->device_type = self::detectDeviceType($stat->user_agent);
            }

            if (!$stat->browser && $stat->user_agent) {
                $stat->browser = self::detectBrowser($stat->user_agent);
            }

            if (!$stat->os && $stat->user_agent) {
                $stat->os = self::detectOS($stat->user_agent);
            }
        });
    }

    /**
     * Detect device type from user agent
     */
    protected static function detectDeviceType(string $userAgent): string
    {
        $userAgent = strtolower($userAgent);

        if (strpos($userAgent, 'mobile') !== false || strpos($userAgent, 'android') !== false || strpos($userAgent, 'iphone') !== false) {
            return 'mobile';
        } elseif (strpos($userAgent, 'tablet') !== false || strpos($userAgent, 'ipad') !== false) {
            return 'tablet';
        }

        return 'desktop';
    }

    /**
     * Detect browser from user agent
     */
    protected static function detectBrowser(string $userAgent): string
    {
        $userAgent = strtolower($userAgent);

        if (strpos($userAgent, 'chrome') !== false) {
            return 'Chrome';
        } elseif (strpos($userAgent, 'firefox') !== false) {
            return 'Firefox';
        } elseif (strpos($userAgent, 'safari') !== false && strpos($userAgent, 'chrome') === false) {
            return 'Safari';
        } elseif (strpos($userAgent, 'edge') !== false) {
            return 'Edge';
        } elseif (strpos($userAgent, 'opera') !== false) {
            return 'Opera';
        }

        return 'Other';
    }

    /**
     * Detect OS from user agent
     */
    protected static function detectOS(string $userAgent): string
    {
        $userAgent = strtolower($userAgent);

        if (strpos($userAgent, 'windows') !== false) {
            return 'Windows';
        } elseif (strpos($userAgent, 'macintosh') !== false || strpos($userAgent, 'mac os') !== false) {
            return 'macOS';
        } elseif (strpos($userAgent, 'linux') !== false) {
            return 'Linux';
        } elseif (strpos($userAgent, 'android') !== false) {
            return 'Android';
        } elseif (strpos($userAgent, 'iphone') !== false || strpos($userAgent, 'ipad') !== false) {
            return 'iOS';
        }

        return 'Other';
    }
}