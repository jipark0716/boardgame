<?php

declare(strict_types=1);

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\OauthProviderType;

/**
 * @property int $id
 * @property \App\Enums\OauthProviderType $provider_type
 * @property int $user_id
 * @property string $provider_user_id
 * @property string $access_token
 * @property string $refresh_token
 * @property string $scope
 * @property \Illuminate\Support\Carbon $expired_at
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 */
class OauthToken extends Model
{
    use HasFactory;

    /**
     * @var string $connection
     */
    protected $connection = 'auth';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'provider_type',
        'user_id',
        'provider_user_id',
        'access_token',
        'refresh_token',
        'scope',
        'expired_at',
    ];

    /**
     * @var array<string, mixed> $casts
     */
    protected $casts = [
        'provider_type' => OauthProviderType::class,
        'expired_at' => 'datetime',
    ];
}
