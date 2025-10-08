# Project Tech Stack

This file contains project-specific tech stack details that complement the global Agent OS standards.

## Framework & Runtime
- **Application Framework:** Laravel 11
- **Language/Runtime:** PHP 8.3+
- **Package Manager:** Composer (backend), npm (frontend)

## Frontend
- **JavaScript Framework:** Vanilla JS (minimal JavaScript, evaluating Vue.js or Livewire for future features)
- **CSS Framework:** TailwindCSS 3.4.4
- **UI Components:** Custom Blade components
- **Build Tool:** Vite 5.0 with Laravel plugin
- **Template Engine:** Laravel Blade

## Database & Storage
- **Database:** SQLite (development), PostgreSQL planned for production
- **ORM/Query Builder:** Laravel Eloquent
- **Caching:** Laravel cache (file-based currently)
- **Asset Storage:** Local filesystem (considering Cloudflare R2 for production)

## Testing & Quality
- **Test Framework:** Pest 2.34+ with Laravel plugin
- **Linting/Formatting:** Laravel Pint
- **E2E Testing:** Playwright (via MCP)

## Deployment & Infrastructure
- **Hosting:** Laravel Forge on Digital Ocean (planned)
- **CI/CD:** GitHub Actions
- **CDN:** Cloudflare (planned)
- **Local Development:** Laravel Herd
- **Domain/DNS:** jkudish.com

## Third-Party Services
- **Spam Protection:** Cloudflare Turnstile
- **Email Validation:** Bento.so API
- **Newsletter Platform:** Bento.so
- **Search Engine Indexing:** IndexNow API
- **Error Tracking:** Flare
- **Analytics:** TBD (considering privacy-focused options)
- **Monitoring:** TBD
