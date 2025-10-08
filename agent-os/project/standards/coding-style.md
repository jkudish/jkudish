# Project Coding Style

This file contains project-specific coding style preferences that extend the global Agent OS standards.

## Laravel-Specific Conventions

### Code Organization
- Follow Laravel 11 conventions (streamlined structure)
- Organize code by feature/domain rather than technical layers
- Use `app/Services/` for business logic grouped by domain
- Keep controllers thin, move logic to service classes

### File Structure
```
app/
  Services/
    Newsletter/
    Contact/
    Projects/
  Http/
    Controllers/
      Web/
    Requests/
```

### Naming Conventions
- Follow Laravel naming conventions exactly
- Use lower camelCase for methods and variables
- Use upper CamelCase for classes
- Use UPPER_SNAKE_CASE for constants
- Route names: kebab-case (e.g., `newsletter.subscribe`)
- Database tables: plural snake_case (e.g., `newsletter_subscribers`)

### Blade Templates
- Use 4 spaces for indentation
- Place each HTML attribute on its own line for multi-attribute elements
- Keep closing `>` on the same line as the last attribute
- Use Blade components for reusable UI elements
- Prefer Blade components over partials

### Styling
- Use TailwindCSS utility classes exclusively
- Focus and hover classes should be last in class lists
- Custom CSS classes (if any) should be at the start
- Maintain dark mode support with `dark:` classes on all new components

### Comments
- Add comments for non-obvious business logic
- Explain "why" not "what"
- Keep comments concise and up-to-date
- Use PHPDoc blocks for methods when helpful

### Testing
- Use Pest for all tests
- Follow existing patterns in test files
- Write feature tests for user-facing functionality
- Write unit tests for complex business logic
- Use factories for model creation in tests

## Code Quality

### DRY Principle
- Extract repeated business logic to reusable service methods
- Extract repeated UI markup to Blade components
- Create helper functions for common operations

### Simplicity
- Implement code in the fewest lines possible
- Avoid over-engineering
- Prefer straightforward solutions over clever ones

### Performance
- Minimize JavaScript usage
- Optimize images (WebP with PNG fallback)
- Use lazy loading for below-fold images
- Leverage Laravel's caching when appropriate

## Security

### Best Practices
- Use Laravel's built-in CSRF protection
- Never commit `.env` files or credentials
- Use rate limiting on public forms
- Implement Cloudflare Turnstile for spam protection
- Use honeypot fields as additional spam prevention
- Validate all user inputs with Form Request classes
