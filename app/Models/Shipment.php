<?php

namespace App\Models;

use App\Traits\UsesUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shipment extends BaseModel
{
    use HasFactory, UsesUUID;

    protected static function booted()
    {
        parent::booted();
        static::creating(function (self $shipment) {
            if (empty($shipment->client_price_matrix_id)) {
                $defaultCPM = ClientPriceMatrix::where('default', true)->first();
                if (!$defaultCPM) {
                    $defaultCPM = ClientPriceMatrix::first();
                }
                $shipment->client_price_matrix_id = $defaultCPM->id;
            }
        });
    }

    protected $casts = [
        'images' => 'array',
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }

    public function items()
    {
        return $this->hasMany(ShipmentItem::class, 'shipment_id');
    }

    public function pickupType()
    {
        return $this->belongsTo(PickupType::class, 'pickup_type_id');
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function clientPriceMatrix()
    {
        return $this->belongsTo(ClientPriceMatrix::class, 'client_price_matrix_id');
    }
}
