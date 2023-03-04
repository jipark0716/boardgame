<?php

declare(strict_types=1);

namespace App\Repositories\Discord;

use App\Exceptions\DiscordAuthrizeException;
use Illuminate\Http\Client\Response;

class DiscordAuthRepository extends DiscordRepository
{
    /**
     * authorization_code로 user 조회
     *
     * @param string $code
     * @param string $grantType
     * @return \Illuminate\Http\Client\Response
     * @throws \App\Exceptions\DiscordAuthrizeException
     */
    public function registerByAuthorizationCode(
        string $code,
        string $grantType = 'authorization_code',
    ): Response {
        $response = (clone $this->request)
            ->withBody(
                http_build_query([
                    'client_id' => config('services.discord.key'),
                    'client_secret' => config('services.discord.secret'),
                    'grant_type' => $grantType,
                    'code' => $code,
                    'redirect_uri' => route('auth.discord.redirect'),
                ]),
                'application/x-www-form-urlencoded'
            )->post('/oauth2/token');

        throw_unless(
            condition: $response->successful(),
            exception: new DiscordAuthrizeException(
                grantType: $grantType,
                response: $response,
            ),
        );

        return $response;
    }
}
