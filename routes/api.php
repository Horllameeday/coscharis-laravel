<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminManagementController;
use App\Enums\AdminRole;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {

    // Public routes
    Route::post('clients', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    // Authenticated routes
    Route::middleware('auth:sanctum', 'token.decrypt')->group(function () {

        // Email verification
        Route::get('email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])
            ->middleware('signed')
            ->name('verification.verify');

        Route::post('email/resend', function (\Illuminate\Http\Request $request) {
            $request->user()->sendEmailVerificationNotification();
            return response()->json(['message' => 'Verification email resent']);
        })->middleware('throttle:6,1')->name('verification.send');

        // OTP / Phone verification
        Route::post('otp/verify', [AuthController::class, 'verifyOtp']);
        Route::post('otp/resend', [AuthController::class, 'resendOtp'])->middleware('throttle:6,1');

        Route::middleware('phone.verified')->group(function () {
            Route::get('product/category', [ShipmentController::class, 'getProductCategory']);
            Route::post('shipments', [ShipmentController::class, 'store']);
            Route::get('shipments/history', [ShipmentController::class, 'history']);
        });

        Route::get('faqs', [FaqController::class, 'getFaqs']);

        // Shipments — requires verified phone number
        Route::middleware('phone.verified')->group(function () {
            Route::get('product/category', [ShipmentController::class, 'getProductCategory']);
            Route::post('shipments', [ShipmentController::class, 'store']);
            Route::get('shipments/history', [ShipmentController::class, 'history']);
        });
    });

    // ── Admin routes ─────────────────────────────────────────────────────────
    Route::prefix('admin')->group(function () {

        // Public — admin login (separate endpoint from client login)
        Route::post('login', [AdminAuthController::class, 'login']);

        // Protected — valid sanctum token + admin-access ability
        Route::middleware(['auth:sanctum', 'token.decrypt', 'admin.token'])->group(function () {

            Route::get('me', [AdminAuthController::class, 'me']);

            // Super-admin only — managing other admin accounts
            Route::middleware('role:' . AdminRole::SUPER_ADMIN->value)->group(function () {
                Route::get('admins', [AdminManagementController::class, 'index']);
                Route::post('admins', [AdminManagementController::class, 'store']);
                Route::patch('admins/{id}/role', [AdminManagementController::class, 'updateRole']);
                Route::patch('admins/{id}/disable', [AdminManagementController::class, 'disable']);
            });
        });
    });
});
