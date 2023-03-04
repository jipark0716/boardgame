<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthrizeRedirectRequest;
use App\Services\Auth\DiscordAuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;

class DiscordController extends Controller
{
    public function __construct(
        private readonly DiscordAuthService $discordAuthService,
    ) {
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authorizeRedirect(): RedirectResponse
    {
        return $this->discordAuthService->getAuthorizeRedirect();
    }

    public function redirect(AuthrizeRedirectRequest $request)
    {
        return $this->discordAuthService->registerByAuthorizationCode($request->createArgument());
    }
}
