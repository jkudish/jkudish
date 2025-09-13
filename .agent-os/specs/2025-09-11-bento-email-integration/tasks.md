# Bento Email Integration - Task Breakdown

## Phase 1: Core Service Setup

### 1.1 Create BentoService
- [x] Create `app/Services/BentoService.php`
- [x] Implement `trackPageView()` method with error handling
- [x] Implement `createOrUpdateSubscriber()` method with tag support
- [x] Implement `trackEvent()` method for custom events
- [x] Add logging for all API failures

### 1.2 Create Form Request Classes
- [x] Create `app/Http/Requests/NewsletterRequest.php` with email validation
- [x] Create `app/Http/Requests/ContactRequest.php` with newsletter opt-in field
- [x] Add DNS validation for email fields
- [x] Include honeypot field handling

## Phase 2: Newsletter Integration

### 2.1 Create NewsletterController
- [x] Create `app/Http/Controllers/NewsletterController.php`
- [x] Implement `store()` method to handle submissions
- [x] Integrate BentoService for subscriber creation
- [x] Apply "Maker Notes" tag automatically
- [x] Add success/error flash messages

### 2.2 Update Newsletter Form
- [x] Update form action to POST to NewsletterController
- [x] Add CSRF token to form
- [x] Add form method spoofing if needed
- [x] Ensure proper error display

### 2.3 Add Newsletter Route
- [x] Add POST route for newsletter submission
- [x] Point to NewsletterController@store
- [x] Name route as 'newsletter.store'

## Phase 3: Contact Form Enhancement

### 3.1 Update Contact Form View
- [x] Add newsletter opt-in checkbox field
- [x] Set checkbox as checked by default
- [x] Add label: "Receive the Maker Notes newsletter"
- [x] Style consistently with existing form

### 3.2 Enhance ContactController
- [x] Inject BentoService dependency
- [x] Update validation to include newsletter_opt_in
- [x] Create/update subscriber on form submission
- [x] Apply "Lead" tag to all contact form submissions
- [x] Apply "Maker Notes" tag conditionally based on opt-in
- [x] Store all form fields as custom fields in Bento
- [x] Track contact form submission event with all details
- [x] Send email notification to joey@jkudish.com with all form data

### 3.3 Create Email Notification
- [x] Create `app/Mail/ContactFormNotification.php` mailable
- [x] Include all form fields in email
- [x] Set reply-to as the submitter's email
- [x] Create email template at `resources/views/emails/contact-form-notification.blade.php`
- [x] Use Laravel's markdown mail format for better formatting

## Phase 4: Pageview Tracking

### 4.1 Create Pageview Middleware
- [x] Create `app/Http/Middleware/TrackPageViewMiddleware.php`
- [x] Implement pageview tracking via BentoService
- [x] Use `afterResponse()` for async processing
- [x] Only track GET requests, exclude AJAX

### 4.2 Register Middleware
- [x] Add middleware to `bootstrap/app.php`
- [x] Apply to web middleware group
- [x] Ensure proper ordering in middleware stack

## Phase 5: Testing

### 5.1 Unit Tests for BentoService
- [x] Test `trackPageView()` with various inputs
- [x] Test `createOrUpdateSubscriber()` with tags
- [x] Test `trackEvent()` functionality
- [x] Test error handling and logging

### 5.2 Feature Tests for Newsletter
- [x] Test successful newsletter signup
- [x] Test validation errors
- [x] Test tag application
- [x] Test flash messages

### 5.3 Feature Tests for Contact Form
- [x] Test form submission with opt-in checked
- [x] Test form submission with opt-in unchecked
- [x] Test "Lead" tag always applied
- [x] Test "Maker Notes" tag conditionally applied
- [x] Test all form fields stored as custom fields
- [x] Test email notification sent to joey@jkudish.com
- [x] Test subscriber creation/update
- [x] Test event tracking with all details
- [x] Test honeypot spam protection

### 5.4 Integration Tests
- [x] Test middleware pageview tracking
- [x] Test Bento API integration (with mocks)
- [ ] Test queue job processing (if implemented)
- [ ] Test rate limiting behavior

## Phase 6: Performance Optimization

### 6.1 Implement Queue Jobs (Optional)
- [ ] Create `TrackPageViewJob` for async processing
- [ ] Create `TrackEventJob` for async event tracking
- [ ] Update service to dispatch jobs
- [ ] Configure queue workers

### 6.2 Add Caching (Optional)
- [ ] Cache subscriber status to reduce API calls
- [ ] Implement cache invalidation strategy
- [ ] Add cache warming for known subscribers

## Phase 7: Final Integration

### 7.1 Environment Configuration
- [x] Verify BENTO_PUBLISHABLE_KEY is set
- [x] Verify BENTO_SECRET_KEY is set
- [x] Verify BENTO_SITE_UUID is set
- [x] Test configuration in development

### 7.2 Error Handling & Monitoring
- [ ] Implement graceful degradation for API failures
- [ ] Set up logging for all Bento interactions
- [ ] Create monitoring alerts for failures
- [ ] Document rollback procedure

### 7.3 Documentation
- [ ] Update README with Bento integration details
- [ ] Document environment variables needed
- [ ] Add troubleshooting guide
- [ ] Create testing checklist

## Acceptance Criteria

- [ ] All pageviews tracked in Bento dashboard
- [ ] Newsletter signups create subscribers with "Maker Notes" tag
- [ ] Contact form creates subscribers with "Lead" tag
- [ ] Contact form opt-ins also get "Maker Notes" tag
- [ ] All contact form fields stored as custom fields in Bento
- [ ] Email notifications sent to joey@jkudish.com for all contact submissions
- [ ] Contact form submissions tracked as events with full details
- [ ] No performance degradation on page loads
- [ ] All tests passing
- [ ] Graceful handling of API failures
- [ ] Documentation complete