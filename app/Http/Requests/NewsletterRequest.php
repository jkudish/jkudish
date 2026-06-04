<?php

namespace App\Http\Requests;

use App\Integrations\BentoService;
use App\Rules\Turnstile;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class NewsletterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Optional: Check IP blacklist (low priority, disabled by default)
        if (config('bentonow.check_blacklist', false)) {
            $blacklistCheck = app(BentoService::class)->checkBlacklistStatus();
            if (! $blacklistCheck['clean']) {
                Log::warning('Newsletter signup blocked - IP blacklisted', [
                    'ip' => request()->ip(),
                    'details' => $blacklistCheck['details'],
                ]);
                abort(403, 'Your request cannot be processed at this time.');
            }
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email:rfc|max:255',
            'cf-turnstile-response' => ['required', new Turnstile],
        ];
    }

    /**
     * Get custom error messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'Email address is too long.',
            'cf-turnstile-response.required' => 'Please complete the security check.',
        ];
    }

    /**
     * Handle a passed validation attempt.
     * Perform additional Bento email validation after Laravel validation passes.
     */
    protected function passedValidation(): void
    {
        // Validate email with Bento API for quality checks
        $bentoService = app(BentoService::class);

        if (! $bentoService->validateEmail($this->email)) {
            throw ValidationException::withMessages([
                'email' => ['This email address appears to be invalid or temporary. Please use a valid email address.'],
            ]);
        }
    }
}
