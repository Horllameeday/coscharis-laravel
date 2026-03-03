<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Shipment;

class AdminShipmentController extends Controller
{
    public function sendInvoice(Request $request)
    {
        // try {
        //     DB::beginTransaction();

        //     $shipment = Shipment::find($request->shipment_id);

        //     $shipment->client_price_matrix_id = $request->client_price_matrix_id;



        //     DB::commit();

        //     $shipment->fresh();

        //     Log::info('Shipment created', [
        //         'shipment_id' => $shipment->id,
        //         'user_id'     => Auth::id(),
        //     ]);

        //     return $this->response(
        //         Response::HTTP_CREATED,
        //         'Shipment created successfully',
        //         $shipment->load('items', 'pickupType')
        //     );
        // } catch (Exception $e) {
        //     DB::rollBack();

        //     Log::error('Shipment creation failed', [
        //         'user_id'   => Auth::id(),
        //         'exception' => $e->getMessage(),
        //     ]);

        //     return $this->response(Response::HTTP_INTERNAL_SERVER_ERROR, 'Shipment creation failed');
        // }
    }
}
