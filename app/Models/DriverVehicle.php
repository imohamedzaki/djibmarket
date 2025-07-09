<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverVehicle extends Model
{
    use HasFactory;

    protected $table = 'driver_vehicles';

    protected $fillable = [
        'driver_id',
        'type',
        'model',
        'license_plate',
        'vehicle_image',
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}