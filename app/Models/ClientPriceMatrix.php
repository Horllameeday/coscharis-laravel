<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientPriceMatrix extends BaseModel
{
    protected $casts = [
        'default' => 'boolean',
        'status'  => 'boolean',
    ];
}
