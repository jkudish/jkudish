# Bento Email Integration Spec

## Quick Start

This specification outlines the integration of Bento email service with the jkudish.com website.

## Files

- **spec.md** - Main specification with goals, requirements, and success criteria
- **sub-specs/technical-spec.md** - Detailed technical implementation guide
- **tasks.md** - Complete task breakdown organized by phases

## Key Features

1. **Automatic Pageview Tracking** - Track all visitor pageviews server-side
2. **Newsletter Management** - Capture subscribers with "Maker Notes" tagging
3. **Lead Generation** - All contact forms create leads with "Lead" tag
4. **Enhanced Contact Form** - Optional newsletter opt-in with dual tagging
5. **Email Notifications** - Automatic emails to joey@jkudish.com for all contacts
6. **Custom Field Storage** - All form data stored in Bento subscriber profiles
7. **Event Tracking** - Record detailed user interactions for analytics

## Implementation Phases

1. **Core Service Setup** - BentoService and request validation
2. **Newsletter Integration** - Dedicated newsletter form handling
3. **Contact Form Enhancement** - Add opt-in checkbox and conditional tagging
4. **Pageview Tracking** - Middleware for automatic tracking
5. **Testing** - Comprehensive test coverage
6. **Performance Optimization** - Optional queue jobs and caching
7. **Final Integration** - Configuration and monitoring

## Prerequisites

- Laravel Bento SDK installed (`bentonow/bento-laravel-sdk`)
- Bento API credentials configured in `.env`
- Laravel queue worker (for async processing)

## Success Metrics

- All pageviews tracked in Bento
- Newsletter signups properly tagged with "Maker Notes"
- Contact form submissions tagged with "Lead"
- Optional newsletter subscribers get both tags
- Email notifications delivered to joey@jkudish.com
- All form data captured in Bento custom fields
- Zero performance impact
- 100% test coverage

## Next Steps

1. Review the specifications
2. Confirm Bento credentials are in `.env`
3. Begin implementation with Phase 1
4. Test each phase before proceeding

---

Created: 2025-09-11
Status: Ready for Implementation