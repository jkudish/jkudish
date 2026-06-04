<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use RyanChandler\LaravelCloudflareTurnstile\Facades\Turnstile as TurnstileFacade;

class Turnstile implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (TurnstileFacade::siteverify((string) $value)->success) {
            return;
        }

        $fail('The security check failed. Please try again.');
    }
}
