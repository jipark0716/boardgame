<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Arguments\Argument;

trait CreateArgumentable
{
    public function createArgument(): Argument
    {
        return call_user_func(
            $this->getArgumentMakeMethod(),
            $this,
        );
    }

    public function getArgumentMakeMethod(): string
    {
        return sprintf(
            '\%s::%s',
            $this->argumentClass,
            'make',
        );
    }
}
