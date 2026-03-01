<?php

namespace App\Enums;

use App\Traits\ListsEnumValues;

enum PriceMatrixType: string
{
    use ListsEnumValues;

    case FLAT = 'flat';
    case PERCENTAGE = 'percentage';
}
