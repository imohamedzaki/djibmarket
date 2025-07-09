<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seller extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The guard that should be used for authentication.
     *
     * @var string
     */
    protected $guard = 'seller';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'password',
        'business_activity_id',
        'avatar',
        'cover_image',
        'status',
        'activation_token',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'activation_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the documents associated with the seller.
     */
    public function documents(): HasMany
    {
        return $this->hasMany(SellerDocument::class);
    }

    /**
     * Get the products associated with the seller.
     */
    public function products(): HasMany
    {
        // Assumes 'seller_id' is the foreign key in the 'products' table
        return $this->hasMany(Product::class, 'seller_id');
    }

    /**
     * The promotions created by this seller.
     */
    public function promotions(): HasMany // A seller has many promotions
    {
        return $this->hasMany(Promotion::class);
    }

    /**
     * Get the ads companies associated with the seller.
     */
    public function adsCompanies(): HasMany
    {
        return $this->hasMany(AdsCompany::class);
    }

    /**
     * Get the ads associated with the seller.
     */
    public function ads(): HasMany
    {
        return $this->hasMany(SellerAd::class);
    }

    /**
     * Get the business activity associated with the seller.
     */
    public function businessActivity()
    {
        return $this->belongsTo(BusinessActivity::class);
    }
}
