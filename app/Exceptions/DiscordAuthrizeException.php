<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Http\Client\Response;

class DiscordAuthrizeException extends \Exception
{
    public function __construct(
        public readonly string $grantType,
        public readonly Response $response,
    ) {
        parent::__construct(sprintf(
            'discord auth fail type: %s, code: %d, with: %s',
            $this->grantType,
            $this->response->status(),
            (string) $this->response->body(),
        ));
    }
}
