<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Auth\OauthToken;
use App\Observers\Auth\OauthTokenObserver;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->initBlade();
        $this->initObserver();
    }

    private function initBlade(): void
    {
        Blade::directive('viteAssets', function (): string {
            if (App::isProduction()) {

            } else {
                return '<script type="module" src="' . asset('/resources/js/app.js') . '"></script>'.
                '<link rel="stylesheet" href="' . asset('/resources/sass/app.scss') . '">';
            }
        });
    }

    private function initObserver(): void
    {
        OauthToken::observe(OauthTokenObserver::class);
    }
}
