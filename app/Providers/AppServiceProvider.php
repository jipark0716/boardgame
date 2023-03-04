<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use App\Models\Auth\Passport\{
    Token,
    Client,
    AuthCode,
    PersonalAccessClient,
};

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->initPassport();
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
    }

    private function initPassport(): void
    {
        Passport::useTokenModel(Token::class);
        Passport::useClientModel(Client::class);
        Passport::useAuthCodeModel(AuthCode::class);
        Passport::usePersonalAccessClientModel(PersonalAccessClient::class);

        Passport::tokensExpireIn(now()->addHours(2));
        Passport::refreshTokensExpireIn(now()->addMonth());
        // Passport::ignoreRoutes();
    }
}
