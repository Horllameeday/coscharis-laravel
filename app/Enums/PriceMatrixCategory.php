<?php

namespace App\Enums;

use App\Traits\ListsEnumValues;

enum PriceMatrixCategory: string
{
    use ListsEnumValues;

    case DISTANCE = 'distance';
    case WEIGHT = 'weight';
    case INSURANCE = 'insurance';
    case ADMINISTRATIVE = 'administrative';
}
