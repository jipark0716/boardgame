<?php

declare(strict_types=1);

namespace App\Repositories\Auth;

use App\Enums\OauthProviderType;
use App\Models\Auth\OauthToken;
use App\Models\Auth\User;
use Illuminate\Http\Client\Response;

class OauthTokenRepository
{
    public function __construct(
        private readonly OauthToken $oauthToken
    ) {
    }

    public function getByDiscordUserId(string $providerUserId): ?OauthToken
    {
        return $this->oauthToken
            ->whereProviderType(OauthProviderType::DISCORD)
            ->whereProviderUserId($providerUserId)
            ->first();
    }

    public function createForDiscord(
        User $user,
        Response $response,
        string $providerUserId
    ): OauthToken {
        return $user->tokens()->create([
            'provider_type' => OauthProviderType::DISCORD,
            'access_token' => $response->json('access_token'),
            'refresh_token' => $response->json('refresh_token'),
            'scope' => $response->json('scope'),
            'expired_at' => now()->addSeconds($response->json('expires_in')),
            'provider_user_id' => $providerUserId,
        ]);
    }
}
