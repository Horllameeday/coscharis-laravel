<?php

namespace App\Enums;

use App\Traits\ListsEnumValues;

enum InvoicePaymentStatus: string
{
    use ListsEnumValues;

    case PENDING = 'pending';
    case SETTLED = 'settled';
}
