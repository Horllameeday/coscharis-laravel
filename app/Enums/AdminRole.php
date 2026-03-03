<?php

namespace App\Enums;

use App\Traits\ListsEnumValues;

enum AdminRole: string
{
    use ListsEnumValues;

    case SUPER_ADMIN  = 'super-admin';   // Full access — can manage everything including other admins
    case OPERATIONS   = 'operations';    // Manages shipments, assigns drivers, sends invoices
    case FINANCE      = 'finance';       // Views reports, price matrices, financial data
    case SUPPORT      = 'support';       // Handles FAQ, support tickets, customer queries
}
