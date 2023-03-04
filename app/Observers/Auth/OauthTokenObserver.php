<?php

declare(strict_types=1);

namespace App\Observers\Auth;

use App\Enums\OauthProviderType;
use App\Models\Auth\OauthToken;
use App\Repositories\Discord\DiscordUserRepository;

class OauthTokenObserver
{
    public function __construct(
        private readonly DiscordUserRepository $discordUserRepository,
    ) {
    }

    /**
     * Handle the OauthToken "creating" event.
     */
    public function creating(OauthToken $token): void
    {
        if (! $token->provider_user_id) {
            $this->fillProviderUserId($token);
        }
    }

    private function fillProviderUserId(OauthToken $token): void
    {
        $token->provider_user_id = match ($token->provider_type) {
            OauthProviderType::DISCORD => $this->discordUserRepository->getUserIdByOauthToken($token),
        };
    }
}
