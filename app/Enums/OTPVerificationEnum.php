<?php

namespace App\Enums;

use App\Traits\ListsEnumValues;

enum OTPVerificationEnum: string
{
    use ListsEnumValues;

    case VALIDATED = 'validated';
    case PENDING = 'pending';
}
