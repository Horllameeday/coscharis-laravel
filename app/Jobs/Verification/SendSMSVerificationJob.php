<?php

namespace App\Jobs\Verification;

use App\Enums\OTPVerificationEnum;
use App\Models\OtpVerification;
use App\Models\User;
use App\Repositories\Contracts\SMSRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendSMSVerificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $backoff = 60;

    public function __construct(public User $user) {}

    public function handle(SMSRepositoryInterface $smsRepository): void
    {
        Log::info('SendSMSVerificationJob: Starting', [
            'user_id'      => $this->user->id,
            'phone_number' => $this->user->phone_number,
        ]);

        if (!$this->user->hasVerifiedPhoneNumber()) {
            $otp         = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $phoneNumber = $this->user->phone_number;
            $message     = "Hi {$this->user->fullName()},\nYour verification code is: {$otp}. It expires in 10 minutes.";

            $sent = $smsRepository->sendSMS($phoneNumber, $message);

            if (!$sent) {
                Log::error('SendSMSVerificationJob: SMS delivery failed, aborting OTP save', [
                    'user_id' => $this->user->id,
                ]);
                $this->fail(new \RuntimeException('SMS delivery failed'));
                return;
            }

            // Delete any existing pending OTPs for this number before creating a new one
            OtpVerification::where('phone_number', $phoneNumber)
                ->where('status', OTPVerificationEnum::PENDING)
                ->delete();

            $otpVerification = OtpVerification::create([
                'pin'          => $otp,
                'phone_number' => $phoneNumber,
                'status'       => OTPVerificationEnum::PENDING,
            ]);

            // Schedule auto-deletion after 10 minutes
            DeleteExpiredOtpJob::dispatch($otpVerification->id)->delay(now()->addMinutes(10));

            Log::info('SendSMSVerificationJob: OTP created and SMS sent', [
                'user_id'      => $this->user->id,
                'phone_number' => $phoneNumber,
            ]);
        }
    }

    public function failed(\Throwable $exception): void
    {
        Log::error('SendSMSVerificationJob: Failed', [
            'user_id'      => $this->user->id,
            'phone_number' => $this->user->phone_number,
            'exception'    => $exception->getMessage(),
            'trace'        => $exception->getTraceAsString(),
        ]);
    }
}
