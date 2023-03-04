<?php

declare(strict_types=1);

namespace App\Repositories\Discord;

use App\Exceptions\DiscordAuthrizeException;
use App\Models\Auth\OauthToken;

class DiscordUserRepository extends DiscordRepository
{
    public function getUserIdByOauthToken(OauthToken $token): string
    {
        $response = (clone $this->request)->withHeaders([
            'Authorization' => 'Bearer ' . $token->access_token,
        ])->get('/users/@me');

        return $response->json('id') ?? throw new DiscordAuthrizeException(
            grantType: 'get users',
            response: $response,
        );
    }
}
