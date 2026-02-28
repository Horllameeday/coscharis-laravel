<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShipmentController;
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

        // Shipments — requires verified phone number
        Route::middleware('phone.verified')->group(function () {
            Route::post('shipments', [ShipmentController::class, 'store']);
        });
    });
});
