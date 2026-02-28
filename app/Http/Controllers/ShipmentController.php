<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateShipmentRequest;
use App\Models\Shipment;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class ShipmentController extends Controller
{
    public function store(CreateShipmentRequest $request)
    {
        try {
            DB::beginTransaction();

            $shipment = Shipment::create([
                ...$request->except('items'),
                'user_id' => Auth::id(),
            ]);

            $shipment->items()->createMany($request->input('items'));

            DB::commit();

            Log::info('Shipment created', [
                'shipment_id' => $shipment->id,
                'user_id'     => Auth::id(),
            ]);

            return $this->response(
                Response::HTTP_CREATED,
                'Shipment created successfully',
                $shipment->load('items', 'pickupType')
            );
        } catch (Exception $e) {
            DB::rollBack();

            Log::error('Shipment creation failed', [
                'user_id'   => Auth::id(),
                'exception' => $e->getMessage(),
            ]);

            return $this->response(Response::HTTP_INTERNAL_SERVER_ERROR, 'Shipment creation failed');
        }
    }
}
