<?php

declare(strict_types=1);

namespace App\Models\Auth\Passport;

use Laravel\Passport\Token as PassportToken;

class Token extends PassportToken
{
    /**
     * @var string $connection
     */
    protected $connection = 'auth';
}
