<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerDocument extends Model
{
    use HasFactory;

    protected $table = 'seller_documents';

    protected $fillable = [
        'seller_id',
        'document_type',
        'document_path',
        'expiry_date',
        'additional_info',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'additional_info' => 'array',
            'expiry_date' => 'date',
        ];
    }

    // Optionally, define the relationship to Seller
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
}
