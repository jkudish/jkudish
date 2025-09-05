# Tech Stack

## Context

Global tech stack defaults for Agent OS projects, overridable in project-specific `.agent-os/product/tech-stack.md`.

- App Framework: Laravel 12+
- Language: PHP 8.4+
- Primary Database: PostgreSQL 17+
- ORM: Laravel Eloquent
- JavaScript Framework: Vue.js latest or Livewire for simpler apps
- Build Tool: Vite (with laravel plugin)
- Import Strategy: Node.js modules
- Package Manager: npm and/or bun (project dependent)
- Node Version: 22 LTS
- CSS Framework: TailwindCSS 4.0+
- UI Components: Shadcn UI (Vue) or Flux (Livewire)
- UI Installation: Via package.json
- Font Provider: Google Fonts
- Font Loading: Self-hosted for performance
- Icons: Lucide Vue components or HeroIcons Blade components
- Application Hosting: Laravel Forge on Digital Ocean
- Hosting Region: Primary region based on user base
- Database Hosting: Digital Ocean Managed PostgreSQL
- Database Backups: Daily automated
- Asset Storage: Cloudflare R2
- CDN: Cloudflare
- Asset Access: Private with signed URLs
- CI/CD Platform: GitHub Actions
- CI/CD Trigger: Push to PR
- Tests: Run before deployment
- Production Environment: main branch
- Staging Environment: staging branch
