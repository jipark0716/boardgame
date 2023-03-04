<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\DiscordController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => 'oauth/discord',
        'controller' => DiscordController::class,
        'as' => 'auth.discord.'
    ],
    function (): void {
        Route::get('authorize', 'authorizeRedirect');
        Route::get('redirect', 'redirect')->name('redirect');
    },
);

Route::view('', 'pages.main');
