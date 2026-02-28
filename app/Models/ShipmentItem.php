<?php

namespace App\Models;

use App\Traits\UsesUUID;

class ShipmentItem extends BaseModel
{
    use UsesUUID;

    protected $casts = [
        'images' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }
}
