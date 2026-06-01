<?php

namespace App\Http\Requests;

use App\Integrations\BentoService;
use App\Rules\Turnstile;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ContactRequest extends FormRequest
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
                Log::warning('Contact form blocked - IP blacklisted', [
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email:rfc|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'newsletter_opt_in' => 'boolean',
            'website' => 'nullable|string', // honeypot field
            'cf-turnstile-response' => ['required', new Turnstile],
        ];
    }

    /**
     * Get custom error messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'first_name.required' => 'Please enter your first name.',
            'last_name.required' => 'Please enter your last name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'subject.required' => 'Please select a subject.',
            'message.required' => 'Please enter a message.',
            'cf-turnstile-response.required' => 'Please complete the security check.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'newsletter_opt_in' => $this->boolean('newsletter_opt_in'),
        ]);
    }

    /**
     * Handle a passed validation attempt.
     * Perform additional Bento email validation after Laravel validation passes.
     */
    protected function passedValidation(): void
    {
        // Validate email with Bento API for quality checks
        $bentoService = app(BentoService::class);
        $fullName = trim($this->first_name.' '.$this->last_name);

        if (! $bentoService->validateEmail($this->email, $fullName)) {
            throw ValidationException::withMessages([
                'email' => ['This email address appears to be invalid. Please check for typos and try again.'],
            ]);
        }
    }
}
