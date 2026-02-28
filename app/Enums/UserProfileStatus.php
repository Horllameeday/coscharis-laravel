<?php

namespace App\Enums;

use App\Traits\ListsEnumValues;

enum UserProfileStatus: string
{
    use ListsEnumValues;

    case ENABLED = 'enabled';
    case DISABLED = 'disabled';
}
