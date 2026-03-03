<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AdminRole;
use App\Enums\TokenAbility;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\Admin\AdminLoginResponseResource;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminAuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {
            $admin = User::where('email', strtolower($request->username))->first();

            if (!$admin || !Hash::check($request->password, $admin->password)) {
                Log::warning('Admin login failed: wrong credentials', [
                    'username' => $request->username,
                ]);

                return $this->response(Response::HTTP_UNAUTHORIZED, 'Invalid credentials');
            }

            if (!$admin->isEnabled()) {
                Log::warning('Admin login failed: account disabled', [
                    'admin_id' => $admin->id,
                ]);

                return $this->response(Response::HTTP_FORBIDDEN, 'Account disabled');
            }

            if (!$admin->isAdmin()) {
                Log::warning('Admin login failed: no admin role assigned', [
                    'admin_id' => $admin->id,
                ]);

                return $this->response(Response::HTTP_FORBIDDEN, 'Not authorised as admin');
            }

            $expiresAt = Carbon::now()->addMinutes(config('sanctum.expiration'));

            $token = $admin->createToken(
                "{$admin->firstName}-{$admin->id}-admin-token",
                [TokenAbility::ADMIN_ACCESS->value],
                $expiresAt,
            );

            Log::info('Admin login successful', [
                'admin_id' => $admin->id,
                'roles'    => $admin->getRoleNames(),
            ]);

            $admin->last_login = now();
            $admin->save();

            return $this->response(Response::HTTP_OK, 'Login successful', [
                'user'       => AdminLoginResponseResource::make($admin),
                'token'      => $token->plainTextToken,
                'token_type' => 'bearer',
                'expiry'     => $expiresAt,
            ]);
        } catch (Exception $e) {
            Log::error('Admin login exception', ['exception' => $e->getMessage()]);

            return $this->response(Response::HTTP_INTERNAL_SERVER_ERROR, 'Login failed');
        }
    }

    public function me(\Illuminate\Http\Request $request)
    {
        $admin = $request->user();

        return $this->response(Response::HTTP_OK, 'Admin profile', [
            'id'        => $admin->id,
            'full_name' => $admin->fullName(),
            'email'     => $admin->email,
            'roles'     => $admin->getRoleNames(),
        ]);
    }
}
