<?php

namespace App\Enums;

use App\Traits\ListsEnumValues;

enum ShipmentStateEnum: string
{
    use ListsEnumValues;

    case NEW = 'new';
    case PAID = 'paid';
    case AWAITING_PICKUP = 'awaiting-pickup';
    case INVOICE_SENT = 'invoice-sent';
    case CANCELLED = 'cancelled';
    case IN_TRANSIT_PICKUP = 'in-transit-pickup';
    case ARRIVED_PICKUP_LOCATION = 'arrived-pickup-location';
    case IN_TRANSIT_DELIVERY = 'in-transit-delivery';
    case ARRIVED_DELIVERY_DESTINATION = 'arrived-delivery-destination';
    case DELIVERED = 'delivered';
    case RETURNED = 'returned';
}
