<?php

declare(strict_types=1);

namespace App\Models\Auth\Passport;

use Laravel\Passport\PersonalAccessClient as PassportPersonalAccessClient;

class PersonalAccessClient extends PassportPersonalAccessClient
{
    /**
     * @var string $connection
     */
    protected $connection = 'auth';
}
