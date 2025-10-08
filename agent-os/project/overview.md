# Product Overview

## Product Name
Joey Kudish - Personal Portfolio & Services Website

## Main Idea
Professional landing page and portfolio website to showcase expertise, attract clients, and promote software development and AI automation services. The site serves as the primary digital presence for Joey's consulting and development services.

## Target Users
- **Primary**: Businesses and entrepreneurs seeking software development expertise
- **Secondary**: Companies looking for AI automation solutions
- **Tertiary**: Conference organizers and tech community members

## Key Features

### Currently Implemented
- Personal introduction and professional summary
- Speaking engagements showcase with downloadable presentations
- Clean, professional design with dark mode support
- Mobile-responsive layout
- Newsletter signup and archive
- Contact form with Bento email validation
- SEO optimization with meta tags and structured data
- Core Web Vitals optimization
- IndexNow API integration for search engines
- llms.txt implementation for AI discoverability

### Planned Features
- Service offerings page highlighting development and AI automation services
- Projects showcase/portfolio section
- Blog/insights section for thought leadership
- Client testimonials and case studies

## Value Proposition
Helps businesses turn ideas into scalable software and automate operations with AI, showcased through a professional, engaging web presence that builds trust and demonstrates expertise.

## Success Metrics
- Number of client inquiries generated
- Newsletter subscriber growth
- Speaking engagement bookings
- Service conversion rate

## Tech Stack

### Backend
- **App Framework**: Laravel 11
- **Language**: PHP 8.3+
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

### Third-Party Services
- **Email Validation**: Bento.so API
- **Spam Protection**: Cloudflare Turnstile
- **Search Engine Indexing**: IndexNow API
- **Newsletter Platform**: Bento.so
- **Analytics**: TBD

## Architecture Decisions
- Server-side rendering with Blade for optimal SEO and performance
- SQLite for simplicity during development
- Minimal JavaScript dependencies for fast page loads
- Utility-first CSS with TailwindCSS for rapid styling
