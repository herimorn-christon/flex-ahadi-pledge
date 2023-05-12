<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/login';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::prefix('api')
                ->middleware('api')
                ->group(base_path('routes/api.php'));
        });


        Route::group([
            'middleware' => ['api', 'cors'],
            'namespace' => $this->namespace,
            'prefix' => 'api',
        ], function ($router) {
             //Add you routes here, for example:
                Route::get('/jumuiya/search', [JumuiyaController::class, 'search']);

                Route::get('/member/search', [MemberController::class, 'search']);

                Route::get('/purpose/search', [PurposeController::class, 'search']);

                Route::get('/pledge-types/search', [TypeController::class, 'search']);


                Route::get('/pledges/search', [PledgeController::class, 'search']);

                Route::get('/methods/search', [MethodController::class, 'search']);
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60);
        });
    }
}
