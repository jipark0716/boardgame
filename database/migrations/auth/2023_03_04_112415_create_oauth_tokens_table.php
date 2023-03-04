<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * @var string $table
     */
    protected $table = 'oauth_tokens';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('provider_type');
            $table->string('provider_user_id');
            $table->string('access_token');
            $table->string('refresh_token');
            $table->string('scope');
            $table->datetime('expired_at');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->unique([
                'provider_user_id',
                'provider_type',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
};
