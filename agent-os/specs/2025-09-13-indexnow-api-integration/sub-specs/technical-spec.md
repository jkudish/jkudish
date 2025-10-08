# Technical Specification

This is the technical specification for the spec detailed in @.agent-os/specs/2025-09-13-indexnow-api-integration/spec.md

> Created: 2025-09-13
> Version: 1.0.0

## Technical Requirements

- Create a new artisan command class `App\Console\Commands\IndexNowSubmitCommand` with signature `indexnow:submit {url?} {--generate-key}`
- Implement secure random API key generation using Laravel's `Str::random(32)` method for 32-character alphanumeric keys
- Add configuration entry to `config/services.php` under `'indexnow' => ['key' => env('INDEXNOW_KEY')]` for environment-based configuration
- Use Laravel's HTTP client to POST to `https://www.bing.com/indexnow` with proper JSON payload structure
- Implement verification file creation at `public/{key}.txt` using Laravel's File facade with proper error handling
- Handle IndexNow API response codes: 200 (success), 403 (invalid key), 422 (URL mismatch), 429 (rate limit exceeded)
- Validate URL format before submission using Laravel's URL validation helpers
- Use Laravel's console output methods for clear success/error messaging with appropriate colors
- Default to `config('app.url')` when no URL argument is provided to the command
- Ensure idempotent key generation that overwrites existing verification files when regenerating keys
- Follow Laravel 11 command structure with proper dependency injection and service container usage

## Approach

### Command Structure
The IndexNow artisan command will be implemented as a Laravel console command with two primary functions:
1. Key generation and verification file creation (`--generate-key` flag)
2. URL submission to IndexNow API (default behavior)

### API Integration Flow
1. Validate environment configuration (API key exists)
2. Validate URL format and domain match
3. Construct JSON payload with required IndexNow fields
4. Submit HTTP POST request to Bing's IndexNow endpoint
5. Parse response and provide appropriate user feedback

### Error Handling Strategy
- Environment validation before API calls
- HTTP client timeout and connection error handling
- API response code interpretation with user-friendly messages
- File system operation error handling for verification file creation

### Security Considerations
- API key stored in environment variables only
- Verification file contains only the API key (no sensitive data)
- URL validation to prevent malicious submissions
- Rate limiting awareness with appropriate error messaging

## External Dependencies

### Laravel Framework Components
- `Illuminate\Console\Command` - Base command class
- `Illuminate\Http\Client\HttpClient` - HTTP requests to IndexNow API
- `Illuminate\Support\Facades\File` - Verification file management
- `Illuminate\Support\Str` - Secure random key generation
- `Illuminate\Validation\ValidationException` - URL validation

### IndexNow API Specification
- **Endpoint**: `https://www.bing.com/indexnow`
- **Method**: POST
- **Content-Type**: application/json
- **Required Fields**: `host`, `key`, `urlList`
- **Response Codes**: 200 (success), 403 (forbidden), 422 (unprocessable), 429 (rate limited)

### Environment Configuration
- `INDEXNOW_KEY` - 32-character alphanumeric API key
- `APP_URL` - Default URL for submission when none provided