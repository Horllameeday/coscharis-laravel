<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Exception;

class FaqController extends Controller
{
    public function getFaqs()
    {
        $faqs = Faq::all();

        try {
            Log::info('Faqs fetched', [
                'count' => $faqs->count(),
                'user_id'     => Auth::id(),
            ]);

            return $this->response(
                Response::HTTP_OK,
                'Faqs fetched successfully',
                $faqs
            );
        } catch (Exception $e) {
            Log::error('Faqs fetch failed', [
                'user_id'   => Auth::id(),
                'exception' => $e->getMessage(),
            ]);

            return $this->response(Response::HTTP_INTERNAL_SERVER_ERROR, 'Faqs fetch failed');
        }
    }
}
