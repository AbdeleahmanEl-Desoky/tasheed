<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            $locale = $this->getLocaleFromHeader();

            LaravelLocalization::setLocale($locale); // Set the locale dynamically

            Route::middleware('api')
                ->prefix("api") // Include locale in API prefix
                ->group(base_path('routes/api.php'));

            Route::middleware(['web', 'localization'])
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Retrieve the locale from the `lang` header and filter it using Mcamara.
     *
     * @return string
     */
    protected function getLocaleFromHeader(): string
    {
        // Get the `lang` header from the request
        $headerLocale = request()->header('lang', config('app.locale'));

        // Validate the locale against the supported locales
        $supportedLocales = array_keys(LaravelLocalization::getSupportedLocales());

        return in_array($headerLocale, $supportedLocales) ? $headerLocale : config('app.locale');
    }
}
