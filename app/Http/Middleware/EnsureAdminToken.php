<?php

namespace App\Http\Middleware;

use App\Enums\TokenAbility;
use Closure;
use Illuminate\Http\Request;

class EnsureAdminToken
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user()?->tokenCan(TokenAbility::ADMIN_ACCESS->value)) {
            return response()->json(['message' => 'Forbidden — admin token required'], 403);
        }

        return $next($request);
    }
}
