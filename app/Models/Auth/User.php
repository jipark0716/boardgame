<?php

declare(strict_types=1);

namespace App\Models\Auth;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Passport\HasApiTokens;

/**
 * @property int $id
 * @property ?string $nick_name
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 * @property \App\Models\Auth\OauthToken $tokens
 */
class User extends Authenticatable
{
    use HasFactory, HasApiTokens;

    /**
     * @var string $connection
     */
    protected $connection = 'auth';

    /**
     * Find the user instance for the given username.
     *
     * @param  string  $username
     * @return ?self
     */
    public function findForPassport(string $username): ?self
    {
        return $this->whereId($username)->first();
    }

    public function tokens(): HasMany
    {
        return $this->hasMany(OauthToken::class, 'user_id', 'id');
    }
}
