<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateShipmentRequest;
use App\Models\ProductCategory;
use App\Models\Shipment;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class ShipmentController extends Controller
{
    public function getProductCategory()
    {
        $productCategories = ProductCategory::all();

        try {
            Log::info('Product category fetched', [
                'count' => $productCategories->count(),
                'user_id'     => Auth::id(),
            ]);

            return $this->response(
                Response::HTTP_OK,
                'Product category fetched successfully',
                $productCategories
            );
        } catch (Exception $e) {
            Log::error('Product category fetch failed', [
                'user_id'   => Auth::id(),
                'exception' => $e->getMessage(),
            ]);

            return $this->response(Response::HTTP_INTERNAL_SERVER_ERROR, 'Product category fetch failed');
        }
    }

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

            $shipment->fresh();

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

    public function history()
    {
        $user = Auth::user();

        $shipment_history = $user->shipments->load('items', 'pickupType');

        try {
            Log::info('Shipment history fetched', [
                'user_id'     => Auth::id(),
                'count' => $shipment_history->count(),
            ]);

            return $this->response(
                Response::HTTP_OK,
                'Shipment history fetched successfully',
                $shipment_history
            );
        } catch (Exception $e) {
            Log::error('Shipment history fetch failed', [
                'user_id'   => Auth::id(),
                'exception' => $e->getMessage(),
            ]);

            return $this->response(Response::HTTP_INTERNAL_SERVER_ERROR, 'Shipment history fetch failed');
        }
    }
}
