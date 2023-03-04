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
            $table->bigInteger('user_id');
            $table->tinyInteger('provider_type');
            $table->string('provider_user_id');
            $table->string('access_token');
            $table->string('refresh_token');
            $table->string('scope');
            $table->datetime('expired_at');
            $table->timestamps();
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
