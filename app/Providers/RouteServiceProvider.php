<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

use Illuminate\Support\Facades\Route;class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting(); // Este método é chamado aqui

        $this->routes(function () {

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

     protected function configureRateLimiting(): void
    {

        // RateLimiter::for('user', function (Request $request) {
        //     return Limit::perMinute(maxAttempts: 25)->by($request->user()?->id ?: $request->ip());
        // });

    }

}
