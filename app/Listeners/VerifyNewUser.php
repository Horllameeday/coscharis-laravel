<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use App\Jobs\Verification\SendEmailVerificationJob;
use App\Jobs\Verification\SendSMSVerificationJob;

class VerifyNewUser implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(Registered $event): void
    {
        $user = $event->user;

        Log::info('VerifyNewUser: Dispatching verification jobs', [
            'user_id' => $user->id,
        ]);

        // SendEmailVerificationJob::dispatch($user);
        SendSMSVerificationJob::dispatch($user);

        Log::info('VerifyNewUser: Verification jobs dispatched', [
            'user_id' => $user->id,
        ]);
    }

    public function failed(Registered $event, \Throwable $exception): void
    {
        Log::error('VerifyNewUser: Listener failed', [
            'user_id'   => $event->user->id,
            'exception' => $exception->getMessage(),
        ]);
    }
}
