# Bento Email Service Integration

## Overview

Integrate Bento email service throughout the jkudish.com website to track pageviews, manage newsletter subscriptions, and capture contact form submissions with proper subscriber tagging.

## Goals

1. **Analytics**: Track all pageviews automatically in Bento for visitor analytics
2. **Newsletter Growth**: Capture newsletter subscribers with "Maker Notes" tag
3. **Lead Generation**: Record contact form submissions with optional newsletter opt-in
4. **Data Consistency**: Ensure all user interactions are properly tracked and tagged

## User Experience

### Pageview Tracking
- Visitors automatically tracked on every page load
- No visible impact on user experience
- Tracking happens server-side for reliability

### Newsletter Subscription
- Single email field on dedicated newsletter page
- Clear value proposition (The Maker Notes)
- Automatic tagging with "Maker Notes"
- Immediate feedback on submission

### Contact Form Enhancement
- New checkbox: "Receive the Maker Notes newsletter"
- Checkbox checked by default
- Clear opt-in/opt-out choice
- Form submission creates/updates subscriber
- Apply "Lead" tag to all contact form submissions
- Conditional "Maker Notes" tag based on newsletter preference
- Send email notification to joey@jkudish.com with all form data
- Store all form fields as custom fields in Bento

## Technical Requirements

### Dependencies
- Laravel Bento SDK (already installed: `bentonow/bento-laravel-sdk`)
- Environment variables (already configured in .env)
- No additional packages required

### Implementation Areas

#### 1. Global Pageview Tracking
- Middleware to track all pageviews
- Pass visitor email if authenticated/known
- Include page URL and metadata

#### 2. Newsletter Form Integration
- Controller to handle newsletter submissions
- Create/update subscriber with email
- Apply "Maker Notes" tag
- Return success/error feedback

#### 3. Contact Form Updates
- Add newsletter opt-in checkbox to form
- Update ContactController to integrate Bento
- Create subscriber on form submission with "Lead" tag
- Conditionally apply "Maker Notes" tag based on opt-in
- Track contact form submission event with all fields
- Send email notification to joey@jkudish.com
- Store form data as custom fields in Bento subscriber profile

#### 4. Service Layer
- Create BentoService for centralized logic
- Handle subscriber creation/updates
- Manage tag operations
- Track custom events

## Non-Functional Requirements

### Performance
- Async processing where possible
- Queue jobs for non-critical tracking
- Minimal impact on page load times

### Error Handling
- Graceful degradation if Bento is unavailable
- Log failures for monitoring
- Don't block user actions on API failures

### Security
- Validate all email inputs
- Rate limiting on form submissions
- Honeypot protection (already exists)

### Testing
- Unit tests for BentoService
- Feature tests for form submissions
- Test tag application logic
- Verify event tracking

## Success Criteria

1. All pageviews tracked in Bento dashboard
2. Newsletter signups create subscribers with "Maker Notes" tag
3. Contact form submissions create leads with "Lead" tag
4. Newsletter opt-ins from contact form also get "Maker Notes" tag
5. Email notifications sent to joey@jkudish.com for all contact submissions
6. All form fields stored as custom fields in Bento
7. No degradation in site performance
8. All tests passing

## Out of Scope

- Email campaign creation
- Advanced segmentation
- Custom email templates
- Bento webhook handling
- User authentication integration

## Risk Mitigation

| Risk | Mitigation |
|------|------------|
| Bento API downtime | Queue jobs, retry logic, graceful failures |
| Rate limiting | Implement local rate limiting, batch operations |
| Data privacy | Only track necessary data, follow GDPR guidelines |
| Performance impact | Use queues, optimize API calls |

## Dependencies

- Bento API credentials in .env
- Laravel queue worker running (for async processing)
- Existing form validation and honeypot protection