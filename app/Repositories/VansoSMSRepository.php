<?php

namespace App\Repositories;

use App\Repositories\Contracts\SMSRepositoryInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class VansoSMSRepository implements SMSRepositoryInterface
{
    public function sendSMS(string $phoneNumber, string $message): bool
    {
        // $systemId  = config('services.vanso.system_id');
        // $password  = config('services.vanso.password');
        // $url       = config('services.vanso.url');
        // $senderId  = config('services.vanso.sender_id');

        Log::info('VansoSMS: Sending SMS', [
            'phone_number' => $phoneNumber,
            'message' => $message
        ]);

        // $response = Http::withBasicAuth($systemId, $password)
        //     ->post($url . '/rest/sms/submit', [
        //         'src'     => $senderId,
        //         'dest'    => $phoneNumber,
        //         'text'    => $message,
        //         'unicode' => false,
        //     ]);

        // if ($response->failed()) {
        //     Log::error('VansoSMS: SMS sending failed', [
        //         'phone_number' => $phoneNumber,
        //         'status'       => $response->status(),
        //         'response'     => $response->body(),
        //     ]);

        //     return false;
        // }

        // Log::info('VansoSMS: SMS sent successfully', [
        //     'phone_number' => $phoneNumber,
        //     'response'     => $response->json(),
        // ]);

        return true;
    }
}
