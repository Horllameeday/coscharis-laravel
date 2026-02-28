<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class EnsurePhoneNumberIsVerified
{
    public function handle(Request $request, Closure $next): SymfonyResponse
    {
        $user = $request->user();

        if (!$user->hasVerifiedPhoneNumber()) {
            Log::warning('EnsurePhoneNumberIsVerified: Unverified phone number attempted access', [
                'user_id'      => $user->id,
                'phone_number' => $user->phone_number,
                'route'        => $request->path(),
            ]);

            return response()->json([
                'message' => 'Your phone number is not verified. Please verify your phone number to continue.',
            ], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
