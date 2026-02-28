<?php

namespace App\Providers;

use App\Listeners\VerifyNewUser;
use App\Repositories\Contracts\SMSRepositoryInterface;
use App\Repositories\VansoSMSRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->bindRepositoryInterfaces();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        JsonResource::withoutWrapping();

        $this->configureRateLimiting();
        $this->registerEventListeners();
    }

    private function bindRepositoryInterfaces()
    {
        $this->app->singleton(SMSRepositoryInterface::class, VansoSMSRepository::class);
    }

    protected function registerEventListeners(): void
    {
        Event::listen(Registered::class, VerifyNewUser::class);
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            if (App::environment('testing', 'local')) {
                return Limit::none();
            }

            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
