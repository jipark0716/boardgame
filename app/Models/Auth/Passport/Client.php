<?php

declare(strict_types=1);

namespace App\Models\Auth\Passport;

use Laravel\Passport\Client as PassportClient;

class Client extends PassportClient
{
    /**
     * @var string $connection
     */
    protected $connection = 'auth';
}
