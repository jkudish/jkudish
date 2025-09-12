# Technical Specification: Bento Email Integration

## Architecture Overview

```
┌─────────────┐     ┌──────────────┐     ┌─────────────┐
│   Browser   │────▶│  Middleware  │────▶│   Bento     │
└─────────────┘     └──────────────┘     │   Service   │
                           │              └─────────────┘
                           │                     │
                           ▼                     ▼
                    ┌──────────────┐     ┌─────────────┐
                    │ Controllers  │────▶│  Bento API  │
                    └──────────────┘     └─────────────┘
```

## Component Design

### 1. BentoService (app/Services/BentoService.php)

```php
namespace App\Services;

use Bentonow\BentoLaravel\Facades\Bento;
use Bentonow\BentoLaravel\DataTransferObjects\EventData;
use Bentonow\BentoLaravel\DataTransferObjects\ImportSubscribersData;
use Illuminate\Support\Facades\Log;

class BentoService
{
    public function trackPageView(string $url, ?string $email = null): void
    {
        // Track pageview event
        // Handle failures gracefully
    }
    
    public function createOrUpdateSubscriber(
        string $email, 
        ?string $firstName = null,
        ?string $lastName = null,
        array $tags = [],
        array $fields = []
    ): bool
    {
        // Create or update subscriber
        // Return success status
    }
    
    public function trackEvent(
        string $type,
        string $email,
        array $details = []
    ): void
    {
        // Track custom events
    }
}
```

### 2. TrackPageViewMiddleware (app/Http/Middleware/TrackPageViewMiddleware.php)

```php
namespace App\Http\Middleware;

use App\Services\BentoService;
use Closure;
use Illuminate\Http\Request;

class TrackPageViewMiddleware
{
    public function __construct(
        private BentoService $bentoService
    ) {}
    
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        
        // Track pageview after response
        if ($request->isMethod('GET') && !$request->ajax()) {
            dispatch(function () use ($request) {
                $this->bentoService->trackPageView(
                    $request->fullUrl(),
                    session('visitor_email')
                );
            })->afterResponse();
        }
        
        return $response;
    }
}
```

### 3. NewsletterController (app/Http/Controllers/NewsletterController.php)

```php
namespace App\Http\Controllers;

use App\Http\Requests\NewsletterRequest;
use App\Services\BentoService;
use Illuminate\Http\RedirectResponse;

class NewsletterController extends Controller
{
    public function __construct(
        private BentoService $bentoService
    ) {}
    
    public function store(NewsletterRequest $request): RedirectResponse
    {
        $success = $this->bentoService->createOrUpdateSubscriber(
            email: $request->validated('email'),
            tags: ['Maker Notes']
        );
        
        if ($success) {
            session(['visitor_email' => $request->email]);
            return redirect()->route('newsletter')
                ->with('success', 'Welcome to The Maker Notes!');
        }
        
        return redirect()->route('newsletter')
            ->with('error', 'Something went wrong. Please try again.');
    }
}
```

### 4. Enhanced ContactController

```php
namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactFormNotification;
use App\Services\BentoService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function __construct(
        private BentoService $bentoService
    ) {}
    
    public function store(ContactRequest $request): RedirectResponse
    {
        // Check honeypot
        if ($request->filled('website')) {
            return redirect()->route('contact');
        }
        
        $validated = $request->validated();
        
        // Build tags array - always include "Lead" tag
        $tags = ['Lead'];
        if ($validated['newsletter_opt_in']) {
            $tags[] = 'Maker Notes';
        }
        
        // Create/update subscriber with all form data as custom fields
        $this->bentoService->createOrUpdateSubscriber(
            email: $validated['email'],
            firstName: $validated['first_name'],
            lastName: $validated['last_name'],
            tags: $tags,
            fields: [
                'source' => 'contact_form',
                'subject' => $validated['subject'],
                'message' => $validated['message'],
                'newsletter_opt_in' => $validated['newsletter_opt_in'] ? 'yes' : 'no',
                'submitted_at' => now()->toDateTimeString()
            ]
        );
        
        // Track contact form event with all details
        $this->bentoService->trackEvent(
            type: '$contact_form_submitted',
            email: $validated['email'],
            details: [
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'subject' => $validated['subject'],
                'message' => $validated['message'],
                'newsletter_opt_in' => $validated['newsletter_opt_in']
            ]
        );
        
        // Send email notification to joey@jkudish.com
        Mail::to('joey@jkudish.com')->send(
            new ContactFormNotification($validated)
        );
        
        return redirect()->route('contact')
            ->with('success', 'Thank you for your message! I\'ll get back to you within 24-48 hours.');
    }
}
```

## Database Schema

No database changes required - Bento handles all data storage.

## API Integration

### Bento API Endpoints Used

1. **Track Event**: POST /fetch/v1/events
2. **Import Subscribers**: POST /fetch/v1/subscribers
3. **Update Tags**: POST /fetch/v1/subscribers/{email}/tags

### Error Handling Strategy

```php
try {
    // Bento API call
} catch (\Exception $e) {
    Log::error('Bento API Error', [
        'error' => $e->getMessage(),
        'context' => $context
    ]);
    // Continue execution - don't block user
}
```

## Configuration

### Environment Variables
```env
BENTO_PUBLISHABLE_KEY=pk_...
BENTO_SECRET_KEY=sk_...
BENTO_SITE_UUID=...
```

### Middleware Registration (bootstrap/app.php)
```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->web(append: [
        \App\Http\Middleware\TrackPageViewMiddleware::class,
    ]);
})
```

## Queue Jobs

### TrackPageViewJob (optional for better performance)
```php
namespace App\Jobs;

use App\Services\BentoService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TrackPageViewJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;
    
    public function __construct(
        private string $url,
        private ?string $email
    ) {}
    
    public function handle(BentoService $bentoService): void
    {
        $bentoService->trackPageView($this->url, $this->email);
    }
}
```

## Form Validation

### NewsletterRequest
```php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsletterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email:rfc,dns|max:255',
        ];
    }
}
```

### ContactRequest (Enhanced)
```php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
            'newsletter_opt_in' => 'boolean',
            'website' => 'nullable|string', // honeypot
        ];
    }
}
```

## Email Notification

### ContactFormNotification Mailable (app/Mail/ContactFormNotification.php)
```php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public array $formData
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "New Contact Form: {$this->formData['subject']}",
            replyTo: [
                [
                    'email' => $this->formData['email'],
                    'name' => "{$this->formData['first_name']} {$this->formData['last_name']}"
                ]
            ]
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.contact-form-notification',
        );
    }
}
```

### Email Template (resources/views/emails/contact-form-notification.blade.php)
```blade
<x-mail::message>
# New Contact Form Submission

You have received a new contact form submission.

## Contact Details

**Name:** {{ $formData['first_name'] }} {{ $formData['last_name'] }}  
**Email:** {{ $formData['email'] }}  
**Subject:** {{ $formData['subject'] }}  
**Newsletter Opt-in:** {{ $formData['newsletter_opt_in'] ? 'Yes' : 'No' }}

## Message

{{ $formData['message'] }}

---

*This lead has been automatically added to Bento with the "Lead" tag.*  
@if($formData['newsletter_opt_in'])
*They have also been tagged with "Maker Notes" for the newsletter.*
@endif

<x-mail::button :url="'mailto:' . $formData['email']">
Reply to {{ $formData['first_name'] }}
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
```

## Testing Strategy

### Unit Tests
- BentoService methods
- Validation rules
- Tag application logic

### Feature Tests
- Newsletter submission flow
- Contact form with opt-in variations
- Pageview tracking middleware
- Error handling scenarios

### Integration Tests
- Bento API connectivity (with mocks)
- Queue job processing
- Rate limiting behavior

## Performance Considerations

1. **Async Processing**: Use `dispatch()->afterResponse()` for pageview tracking
2. **Queue Jobs**: Optional queuing for high-traffic scenarios
3. **Caching**: Cache subscriber status to reduce API calls
4. **Batching**: Batch multiple events when possible
5. **Rate Limiting**: Implement local rate limiting before API limits

## Security Measures

1. **Input Validation**: Strict email validation with DNS checks
2. **Rate Limiting**: Throttle form submissions
3. **Honeypot**: Already implemented for spam protection
4. **CSRF**: Laravel's built-in CSRF protection
5. **Data Minimization**: Only collect necessary information

## Monitoring

1. **Logging**: All API failures logged to Laravel logs
2. **Metrics**: Track success/failure rates
3. **Alerts**: Set up alerts for repeated failures
4. **Dashboard**: Monitor in Bento dashboard

## Rollback Plan

1. Feature flag for Bento integration
2. Graceful degradation if API unavailable
3. Keep existing form functionality intact
4. Easy disable via environment variable