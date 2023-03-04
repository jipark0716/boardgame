<?php

declare(strict_types=1);

namespace App\Repositories\Discord;

use Illuminate\Http\Client\PendingRequest;

abstract class DiscordRepository
{
    /**
     * @param \Illuminate\Http\Client\PendingRequest $request
     */
    public function __construct(
        protected readonly PendingRequest $request,
    ) {
        $this->request->baseUrl(config('services.discord.endpoint'));
    }
}
