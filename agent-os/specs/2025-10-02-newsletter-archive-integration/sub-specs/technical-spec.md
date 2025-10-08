# Technical Specification

This is the technical specification for the spec detailed in @.agent-os/specs/2025-10-02-newsletter-archive-integration/spec.md

## Technical Requirements

### Database Schema
- Create `broadcasts` table with fields for Bento broadcast data (id, bento_id, name, subject, html_content, share_url, sent_at, stats JSON, timestamps)
- Add unique constraint on `bento_id` to prevent duplicate imports
- Index on `sent_at` for efficient chronological queries

### Bento API Integration
- Extend `App\Integrations\BentoService` with `getBroadcasts()` method using existing Bento facade
- Parse API response and extract broadcast data (id, name, subject, template.html, sent_final_batch_at, stats)
- Filter for only sent broadcasts (where sent_final_batch_at is not null)

### Artisan Command
- Create command `app:sync-newsletters` that:
  - Calls BentoService::getBroadcasts()
  - Iterates through broadcasts and creates/updates Broadcast model records
  - Uses `firstOrCreate` or `updateOrCreate` with bento_id to prevent duplicates
  - Logs sync activity (new broadcasts imported, total count)

### Scheduled Tasks
- Register command in `routes/console.php` or `bootstrap/app.php` to run hourly
- Use Laravel's `->hourly()` scheduler method

### Routes
- Add GET `/newsletter/{broadcast}` route for individual newsletter viewing
- Use route model binding with Broadcast model
- Add middleware for handling not found broadcasts (redirect to /newsletter)

### Views & Components
- Update `resources/views/newsletter.blade.php`:
  - Replace "launching soon" section with archive list
  - Display broadcasts as list items with title and send date
  - Link to individual newsletter pages
  - Keep existing newsletter signup form

- Create `resources/views/newsletter/show.blade.php`:
  - Extend main layout with header and footer
  - Include simplified newsletter signup CTA at top
  - Render broadcast HTML content in a container
  - Include detailed newsletter signup CTA at bottom
  - Ensure dark mode compatibility with proper CSS classes

### Newsletter Signup CTAs
- **Top CTA**: Simple inline form with email input and "Subscribe" button
- **Bottom CTA**: Full featured section matching the main newsletter page design with benefits list

### Copy Updates
Required changes across files:
1. `app/Http/Controllers/NewsletterController.php` (lines 40, 46): "You'll receive my next newsletter soon" → "You'll receive the first issue right away"
2. `resources/views/components/footer.blade.php` (line 53): "You'll receive my next AI development insights soon" → "You'll receive the first issue right away"
3. `resources/views/newsletter.blade.php` (lines 154-156): Remove "launching soon" badge, replace with archive list
4. `resources/views/components/home/newsletter-signup.blade.php` (line 18): "Subscribe now to get the first issues:" → "Subscribe now:"
5. `resources/views/projects.blade.php` (lines 173-174): status 'coming_soon' → 'live', status_label 'First issue coming this month' → 'New issues every 2 weeks'
6. `resources/views/components/home/current-projects.blade.php` (lines 34-35): Same as projects.blade.php

### Error Handling
- Broadcast not found: Redirect to /newsletter with optional flash message
- API failures: Log errors, don't crash the command, allow retry on next scheduled run
- HTML content sanitization: Render Bento HTML as-is initially (can adjust if needed)

### Performance Considerations
- Eager load broadcasts on archive page to avoid N+1 queries
- Limit archive page to reasonable number or implement pagination if needed
- Cache broadcast list for 10 minutes to reduce database queries

## External Dependencies

No new external dependencies required. The project already has:
- `bentonow/bento-laravel-sdk` - Provides Bento API integration
- Laravel 11 - Provides scheduling, migrations, and all required framework features
