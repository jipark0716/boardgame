<?php

declare(strict_types=1);

namespace App\Arguments;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

abstract class Argument
{
    /**
     * @var \Illuminate\Support\Carbon $requestAt
     */
    public readonly Carbon $requestAt;

    public function __construct()
    {
        $this->requestAt = now();
    }

    public static abstract function make(FormRequest $request): self;
}
