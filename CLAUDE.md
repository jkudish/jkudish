# CLAUDE.md

> Project-Specific Instructions for Joey's Portfolio Website
> Last Updated: 2025-01-05

## Project Overview

This is Joey Kudish's personal portfolio and services website, built with Laravel 11. The site serves as the primary digital presence for showcasing expertise, attracting clients, and promoting software development and AI automation services.

## Current Implementation Status

### ✅ Completed Features
- **Home Page**: Personal introduction with professional headline
- **Speaking Page**: Conference presentation history with downloadable slides
- **Responsive Design**: Mobile-first, dark mode support
- **Core Infrastructure**: Laravel 11, TailwindCSS, Vite build pipeline

### 🚧 In Progress
- Service offerings page
- Contact form implementation
- Newsletter signup functionality

### 📋 Upcoming Priorities
1. **Services Section**: Detail software development and AI automation offerings
2. **Lead Generation**: Contact form with email notifications
3. **Newsletter**: Email capture and management system
4. **Projects Showcase**: Portfolio of work and case studies

## Development Guidelines

### Code Organization
```
resources/views/
  components/      # Reusable Blade components
  home.blade.php  # Homepage
  speaking.blade.php # Speaking engagements
  
app/
  Http/Controllers/ # Route controllers
  Services/        # Business logic (to be created)
    Newsletter/
    Contact/
    Projects/
```

### Styling Conventions
- Use TailwindCSS utilities exclusively (no custom CSS unless absolutely necessary)
- Follow existing component patterns in `resources/views/components/`
- Maintain consistent spacing using Tailwind's spacing scale
- Dark mode classes should always be included

### Content Management
- Content is currently hardcoded in Blade templates
- Conference data in `speaking.blade.php` uses PHP array
- Future content will move to database when volume increases

### URL Structure
- Keep URLs short and SEO-friendly
- Current routes:
  - `/` - Homepage
  - `/speaking` - Speaking engagements
  - `/projects` (planned)
  - `/services` (planned)
  - `/contact` (planned)

### Testing Requirements
- Write Pest tests for all new features
- Test contact form thoroughly (validation, spam protection, email delivery)
- Ensure all pages load correctly and are mobile-responsive
- Check dark mode compatibility for new components

### Performance Considerations
- Images should be optimized before upload
- Use WebP format with PNG fallback (see existing pattern in home.blade.php)
- Implement lazy loading for images below the fold
- Keep JavaScript minimal - prefer server-side solutions

### SEO Requirements
- All pages must have unique meta titles and descriptions
- Use semantic HTML structure
- Implement structured data for speaking engagements
- Ensure all content is crawlable (no critical content in JavaScript)

### Security Notes
- Never commit `.env` file or sensitive credentials
- Use Laravel's built-in CSRF protection for all forms
- Implement rate limiting on contact and newsletter forms
- Add honeypot fields for spam prevention

## Local Development

### Setup
```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
```

### Running Locally
```bash
npm run dev
php artisan serve
```

### Building for Production
```bash
npm run build
php artisan optimize
```

## Deployment Notes

- Currently running locally with Laravel Herd
- Production deployment planned for Laravel Forge on Digital Ocean
- Ensure `.env` production values are properly configured
- Run migrations carefully in production
- Clear caches after deployment:
  ```bash
  php artisan cache:clear
  php artisan config:cache
  php artisan route:cache
  php artisan view:cache
  ```

## Common Tasks

### Adding a New Speaking Engagement
1. Edit `resources/views/speaking.blade.php`
2. Add to the `$conferences` array
3. Upload PDF to `public/slides/` if available
4. Test the link works correctly

### Creating a New Page
1. Create Blade template in `resources/views/`
2. Add route in `routes/web.php`
3. Include in navigation if needed (`resources/views/components/navigation.blade.php`)
4. Add meta tags in layout component
5. Write Pest test for the route

### Updating Content
- Homepage bio: Edit `resources/views/home.blade.php`
- Navigation: Edit `resources/views/components/navigation.blade.php`
- Footer: Edit `resources/views/components/footer.blade.php`

## AI Assistant Notes

When working on this project:
1. Always check existing component patterns before creating new ones
2. Maintain consistent TailwindCSS utility usage
3. Ensure all new features are mobile-responsive
4. Test dark mode compatibility
5. Keep SEO best practices in mind
6. Write Pest tests for new functionality
7. Follow Laravel conventions and best practices
8. Optimize for performance (minimal JavaScript, optimized images)

## Next Steps Reference

See `.agent-os/product/roadmap.md` for detailed feature planning and priorities.

---

*This project uses Agent OS for structured development. See `.agent-os/` directory for detailed documentation.*