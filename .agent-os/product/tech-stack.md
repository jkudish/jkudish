# Tech Stack

## Core Technologies

### Backend
- **App Framework**: Laravel 11.9
- **Language**: PHP 8.2+
- **Primary Database**: SQLite (current, may migrate to PostgreSQL for production)
- **ORM**: Laravel Eloquent

### Frontend
- **Template Engine**: Laravel Blade
- **JavaScript Framework**: None currently (evaluating Vue.js or Livewire for interactive features)
- **Build Tool**: Vite 5.0 with Laravel plugin
- **CSS Framework**: TailwindCSS 3.4.4
- **CSS Processing**: PostCSS with Autoprefixer

### Development Tools
- **Package Manager**: npm
- **Testing Framework**: Pest 2.34+ with Laravel plugin
- **Code Quality**: Laravel Pint
- **Local Development**: Laravel Herd

### Infrastructure
- **Web Server**: Nginx (via Herd locally)
- **Application Hosting**: TBD (considering Laravel Forge on Digital Ocean)
- **Asset Storage**: Local filesystem (may move to Cloudflare R2)
- **CDN**: TBD (likely Cloudflare)
- **Domain/DNS**: jkudish.com

### Third-Party Services (Planned)
- **Email Service**: TBD for newsletter functionality
- **Analytics**: TBD
- **Form Handling**: Native Laravel (considering Formspree as backup)
- **Newsletter Platform**: TBD (considering ConvertKit or custom solution)

## Architecture Decisions
- Server-side rendering with Blade for optimal SEO and performance
- SQLite for simplicity during development
- Minimal JavaScript dependencies for fast page loads
- Utility-first CSS with TailwindCSS for rapid styling