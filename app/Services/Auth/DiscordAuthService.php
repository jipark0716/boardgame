<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Arguments\Auth\AuthrizeRedirectArgument;
use App\Repositories\Auth\OauthTokenRepository;
use App\Repositories\Auth\UserRepository;
use App\Repositories\Discord\DiscordAuthRepository;
use App\Repositories\Discord\DiscordUserRepository;
use Illuminate\Http\RedirectResponse;

class DiscordAuthService
{
    public function __construct(
        private readonly DiscordAuthRepository $discordAuthRepository,
        private readonly DiscordUserRepository $discordUserRepository,
        private readonly OauthTokenRepository $oauthTokenRepository,
        private readonly UserRepository $userRepository,
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

        $providerUserId = $this->discordUserRepository->getUserIdByOauthToken($response->json('access_token'));

        if ($token = $this->oauthTokenRepository->getByDiscordUserId($providerUserId)) {
            return $token->user;
        }

        $user = $this->userRepository->create();

        $this->oauthTokenRepository->createForDiscord(
            user: $user,
            response: $response,
            providerUserId: $providerUserId,
        );

        return $user;
    }
}
