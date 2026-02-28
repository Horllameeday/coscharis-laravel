<?php

namespace App\Enums;

use App\Traits\ListsEnumValues;

enum TokenAbility: string
{
    use ListsEnumValues;

    case CLIENT_ACCESS = 'client-access';
    case DRIVER_ACCESS = 'driver-access';
    case ADMIN_ACCESS = 'admin-access';
}
