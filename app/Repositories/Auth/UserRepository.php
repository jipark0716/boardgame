<?php

declare(strict_types=1);

namespace App\Repositories\Auth;

use App\Models\Auth\User;

class UserRepository
{
    public function __construct(
        private readonly User $user,
    ) {
    }

    public function create(): User
    {
        return $this->user->create();
    }
}
