<?php

namespace App\Enums;

use App\Traits\ListsEnumValues;

enum UserType: string
{
    use ListsEnumValues;

    case ADMIN = 'admin';
    case CLIENT = 'client';
    case DRIVER = 'driver';
}
