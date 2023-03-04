<?php

declare(strict_types=1);

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property ?string $nick_name
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 * @property \App\Models\Auth\OauthToken $tokens
 */
class User extends Model
{
    use HasFactory;

    /**
     * @var string $connection
     */
    protected $connection = 'auth';

    public function tokens(): HasMany
    {
        return $this->hasMany(OauthToken::class, 'user_id', 'id');
    }
}
