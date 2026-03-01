<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateShipmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Sender
            'sender_person'                 => 'required|string|max:255',
            'sender_number'                 => 'required',

            // Pickup
            'pickup_type_id'                => 'required|integer|exists:pickup_types,id',
            'pickup_place_id'               => 'required|string',
            'pickup_place_name'             => 'required|string',
            'pickup_place_longitude'        => 'required|numeric|between:-180,180',
            'pickup_place_latitude'         => 'required|numeric|between:-90,90',

            // Receiver
            'receiver_person'               => 'required|string|max:255',
            'receiver_number'               => 'required',

            // Destination
            'destination_place_id'          => 'required|string',
            'destination_place_name'        => 'required|string',
            'destination_place_longitude'   => 'required|numeric|between:-180,180',
            'destination_place_latitude'    => 'required|numeric|between:-90,90',

            // Schedule
            'preferred_pickup_date'         => 'nullable|date|after_or_equal:today',
            'preferred_delivery_date'       => 'nullable|date|after_or_equal:preferred_pickup_date',

            // Route info
            'distance'                      => 'required|numeric|min:0',
            'duration'                      => 'required|string',

            // Items — must have at least one
            'items'                         => 'required|array|min:1',
            'items.*.name'                  => 'required|string|max:255',
            'items.*.note'                  => 'nullable|string',
            'items.*.item_value'            => 'required|numeric|min:0',
            'items.*.quantity'              => 'required|integer|min:1',
            'items.*.weight'                => 'required|numeric|min:0',
            'items.*.category_id'           => 'required|integer|exists:product_categories,id',
            'items.*.images'                => 'nullable|array',
            'items.*.images.*'              => 'string',
        ];
    }
}
