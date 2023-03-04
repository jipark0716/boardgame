<?php

declare(strict_types=1);

namespace App\Arguments\Auth;

use App\Arguments\Argument;
use Illuminate\Foundation\Http\FormRequest;

class AuthrizeRedirectArgument extends Argument
{
    public function __construct(
        public readonly string $code,
    ) {
        parent::__construct();
    }

    public static function make(FormRequest $request): self
    {
        return new self(
            code: $request->input('code'),
        );
    }
}
