<?php

namespace App\Jobs\Verification;

use App\Models\OtpVerification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class DeleteExpiredOtpJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public string $otpVerificationId) {}

    public function handle(): void
    {
        $deleted = OtpVerification::where('id', $this->otpVerificationId)->delete();

        Log::info('DeleteExpiredOtpJob: OTP deleted', [
            'otp_id'  => $this->otpVerificationId,
            'deleted' => $deleted,
        ]);
    }

    public function failed(\Throwable $exception): void
    {
        Log::error('DeleteExpiredOtpJob: Failed to delete OTP', [
            'otp_id'    => $this->otpVerificationId,
            'exception' => $exception->getMessage(),
        ]);
    }
}
