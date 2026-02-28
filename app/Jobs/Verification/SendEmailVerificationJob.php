<?php

namespace App\Jobs\Verification;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendEmailVerificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $backoff = 60;

    public function __construct(public User $user) {}

    public function handle(): void
    {
        Log::info('SendEmailVerificationJob: Starting', [
            'user_id' => $this->user->id,
            'email'   => $this->user->email,
        ]);

        if ($this->user->hasVerifiedEmail()) {
            Log::info('SendEmailVerificationJob: Email already verified, skipping', [
                'user_id' => $this->user->id,
            ]);
            return;
        }

        $this->user->sendEmailVerificationNotification();

        Log::info('SendEmailVerificationJob: Verification email sent', [
            'user_id' => $this->user->id,
            'email'   => $this->user->email,
        ]);
    }

    public function failed(\Throwable $exception): void
    {
        Log::error('SendEmailVerificationJob: Failed', [
            'user_id'   => $this->user->id,
            'email'     => $this->user->email,
            'exception' => $exception->getMessage(),
            'trace'     => $exception->getTraceAsString(),
        ]);
    }
}
