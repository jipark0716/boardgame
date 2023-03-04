<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Arguments\Auth\AuthrizeRedirectArgument;
use App\Repositories\Auth\OauthTokenRepository;
use App\Repositories\Discord\DiscordAuthRepository;
use Illuminate\Http\RedirectResponse;

class DiscordAuthService
{
    public function __construct(
        private readonly DiscordAuthRepository $discordAuthRepository,
        private readonly OauthTokenRepository $oauthTokenRepository,
    ) {
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getAuthorizeRedirect(): RedirectResponse
    {
        return redirect(config('services.discord.endpoint') . '/oauth2/authorize?' . http_build_query([
            'response_type' => 'code',
            'client_id' => config('services.discord.key'),
            'scope' => 'guilds.join email identify',
            'redirect_uri' => route('auth.discord.redirect'),
        ]));
    }

    public function registerByAuthorizationCode(AuthrizeRedirectArgument $argument)
    {
        $response = $this->discordAuthRepository->registerByAuthorizationCode($argument->code);

        return $this->oauthTokenRepository->createTokenForDiscord($response);
    }
}
