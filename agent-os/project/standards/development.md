# Project Development Standards

This file contains project-specific development standards and best practices.

## Project Context

This is Joey Kudish's personal portfolio and services website. The site serves as:
- Professional digital presence
- Lead generation tool for consulting services
- Portfolio showcase
- Speaking engagement platform
- Newsletter distribution

## Development Priorities

### SEO-First Development
- Prioritize SEO in all technical decisions
- Use semantic HTML structure
- Maintain clean URL patterns
- Include meta tags on all pages
- Implement structured data markup
- Ensure all content is crawlable

### Performance Optimization
- Target excellent Core Web Vitals scores
- Minimize JavaScript usage (prefer server-side solutions)
- Optimize images before upload (WebP with fallbacks)
- Implement lazy loading for below-fold images
- Keep CSS bundle minimal with Tailwind purging
- Leverage browser caching

### Mobile-First Design
- All features must be mobile-responsive
- Test on multiple screen sizes
- Use Tailwind's responsive utilities
- Ensure touch targets are appropriately sized

### Dark Mode Support
- All new components must support dark mode
- Use Tailwind's `dark:` utilities consistently
- Test both light and dark themes

## Content Management

### Current Approach
- Content is hardcoded in Blade templates
- Conference data uses PHP arrays
- Version control for all content changes
- No CMS or admin panel currently

### Future Considerations
- May implement CMS when content volume increases
- Considering headless CMS or Laravel Nova

## Form Handling

### Spam Protection
- Implement Cloudflare Turnstile on all forms
- Use honeypot fields as additional layer
- Consider rate limiting on high-traffic forms

### Validation
- Use Form Request classes for all validation
- Include both validation rules and custom error messages
- Use Bento.so API for email validation when applicable

## Testing Requirements

### Test Coverage
- Write Pest tests for all new features
- Ensure no test regressions
- Test edge cases and error conditions

### Critical Paths to Test
1. Contact form (validation, spam protection, email delivery)
2. Newsletter signup (validation, API integration)
3. SEO-related functionality (meta tags, structured data)
4. All page routes load correctly
5. Mobile responsiveness
6. Dark mode compatibility

## Common Patterns

### Adding a New Page
1. Create Blade template in `resources/views/`
2. Add route in `routes/web.php`
3. Include in navigation if needed
4. Add meta tags for SEO
5. Write Pest test for the route
6. Test mobile and dark mode

### Adding a Form
1. Create Form Request class for validation
2. Implement Cloudflare Turnstile
3. Add honeypot field
4. Create service class for business logic
5. Write comprehensive Pest tests
6. Test spam protection

### Updating Content
- Homepage bio: Edit `resources/views/home.blade.php`
- Navigation: Edit `resources/views/components/navigation.blade.php`
- Footer: Edit `resources/views/components/footer.blade.php`

## Deployment Workflow

### Git Strategy
- `main` branch: Production-ready code
- `feature/*`: New features
- `fix/*`: Bug fixes
- Direct commits to main for content updates

### Before Deployment
```bash
npm run build
php artisan optimize
php artisan test
```

### Production Deployment (Planned)
- Deploy via Laravel Forge to Digital Ocean
- Run migrations carefully
- Clear caches after deployment
- Verify SSL and DNS configuration
