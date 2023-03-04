<?php

declare(strict_types=1);

namespace App\Repositories\Auth;

use App\Enums\OauthProviderType;
use App\Exceptions\DiscordAuthrizeException;
use App\Models\Auth\OauthToken;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Validator;

class OauthTokenRepository
{
    public function __construct(
        private readonly OauthToken $oauthToken
    ) {
    }

    public function createTokenForDiscord(Response $response): OauthToken
    {
        throw_unless(
            condition: Validator::make($response->json(), [
                'access_token' => 'required|string',
                'expires_in' => 'required|int',
                'refresh_token' => 'required|string',
                'scope' => 'required|string',
            ])->passes(),
            exception: new DiscordAuthrizeException(
                grantType: 'unknown',
                response: $response,
            ),
        );

        return $this->oauthToken->create([
            'provider_type' => OauthProviderType::DISCORD,
            /**
             * @todo passport 연동
             */
            'user_id' => 1,
            'access_token' => $response->json('access_token'),
            'refresh_token' => $response->json('refresh_token'),
            'scope' => $response->json('scope'),
            'expired_at' => now()->addSeconds($response->json('expires_in')),
        ]);
    }
}
