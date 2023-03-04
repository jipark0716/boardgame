<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Arguments\Auth\AuthrizeRedirectArgument;
use App\Http\Requests\CreateArgumentable;
use Illuminate\Foundation\Http\FormRequest;

class AuthrizeRedirectRequest extends FormRequest
{
    use CreateArgumentable;

    /**
     * @var string $argumentClass
     */
    public string $argumentClass = AuthrizeRedirectArgument::class;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'code' => 'required|string'
        ];
    }
}
