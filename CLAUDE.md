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
- Cloudflare Turnstile implemented for spam protection on all forms
- Honeypot fields retained as additional spam prevention layer
- Implement rate limiting on contact and newsletter forms as needed

## Cloudflare Turnstile Configuration

### Overview
Cloudflare Turnstile is implemented on both the contact form and newsletter signup forms to prevent spam submissions. It uses the "interaction-only" appearance mode, which only shows a challenge to suspicious traffic.

### Environment Variables
```
CLOUDFLARE_TURNSTILE_SITEKEY=your_site_key_here
CLOUDFLARE_TURNSTILE_SECRETKEY=your_secret_key_here
```

### Implementation Details
- Package: `ryangjchandler/laravel-cloudflare-turnstile`
- Widget appears only for suspicious traffic (managed mode)
- Automatically adapts to dark/light theme
- Validation integrated into Laravel form requests
- Works with both traditional form submissions and AJAX

### Testing
- Use Cloudflare's test keys for local development
- Always pass: `1x00000000000000000000AA` (site key)
- Always fail: `2x00000000000000000000AB` (site key)
- Both use secret: `1x0000000000000000000000000000000AA`

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

===

<laravel-boost-guidelines>
=== foundation rules ===

# Laravel Boost Guidelines

The Laravel Boost guidelines are specifically curated by Laravel maintainers for this application. These guidelines should be followed closely to enhance the user's satisfaction building Laravel applications.

## Foundational Context
This application is a Laravel application and its main Laravel ecosystems package & versions are below. You are an expert with them all. Ensure you abide by these specific packages & versions.

- php - 8.3.24
- laravel/framework (LARAVEL) - v11
- laravel/prompts (PROMPTS) - v0
- laravel/pint (PINT) - v1
- laravel/sail (SAIL) - v1
- pestphp/pest (PEST) - v2
- phpunit/phpunit (PHPUNIT) - v10
- tailwindcss (TAILWINDCSS) - v3


## Conventions
- You must follow all existing code conventions used in this application. When creating or editing a file, check sibling files for the correct structure, approach, naming.
- Use descriptive names for variables and methods. For example, `isRegisteredForDiscounts`, not `discount()`.
- Check for existing components to reuse before writing a new one.

## Verification Scripts
- Do not create verification scripts or tinker when tests cover that functionality and prove it works. Unit and feature tests are more important.

## Application Structure & Architecture
- Stick to existing directory structure - don't create new base folders without approval.
- Do not change the application's dependencies without approval.

## Frontend Bundling
- If the user doesn't see a frontend change reflected in the UI, it could mean they need to run `npm run build`, `npm run dev`, or `composer run dev`. Ask them.

## Replies
- Be concise in your explanations - focus on what's important rather than explaining obvious details.

## Documentation Files
- You must only create documentation files if explicitly requested by the user.


=== boost rules ===

## Laravel Boost
- Laravel Boost is an MCP server that comes with powerful tools designed specifically for this application. Use them.

## Artisan
- Use the `list-artisan-commands` tool when you need to call an Artisan command to double check the available parameters.

## URLs
- Whenever you share a project URL with the user you should use the `get-absolute-url` tool to ensure you're using the correct scheme, domain / IP, and port.

## Tinker / Debugging
- You should use the `tinker` tool when you need to execute PHP to debug code or query Eloquent models directly.
- Use the `database-query` tool when you only need to read from the database.

## Reading Browser Logs With the `browser-logs` Tool
- You can read browser logs, errors, and exceptions using the `browser-logs` tool from Boost.
- Only recent browser logs will be useful - ignore old logs.

## Searching Documentation (Critically Important)
- Boost comes with a powerful `search-docs` tool you should use before any other approaches. This tool automatically passes a list of installed packages and their versions to the remote Boost API, so it returns only version-specific documentation specific for the user's circumstance. You should pass an array of packages to filter on if you know you need docs for particular packages.
- The 'search-docs' tool is perfect for all Laravel related packages, including Laravel, Inertia, Livewire, Filament, Tailwind, Pest, Nova, Nightwatch, etc.
- You must use this tool to search for Laravel-ecosystem documentation before falling back to other approaches.
- Search the documentation before making code changes to ensure we are taking the correct approach.
- Use multiple, broad, simple, topic based queries to start. For example: `['rate limiting', 'routing rate limiting', 'routing']`.
- Do not add package names to queries - package information is already shared. For example, use `test resource table`, not `filament 4 test resource table`.

### Available Search Syntax
- You can and should pass multiple queries at once. The most relevant results will be returned first.

1. Simple Word Searches with auto-stemming - query=authentication - finds 'authenticate' and 'auth'
2. Multiple Words (AND Logic) - query=rate limit - finds knowledge containing both "rate" AND "limit"
3. Quoted Phrases (Exact Position) - query="infinite scroll" - Words must be adjacent and in that order
4. Mixed Queries - query=middleware "rate limit" - "middleware" AND exact phrase "rate limit"
5. Multiple Queries - queries=["authentication", "middleware"] - ANY of these terms


=== php rules ===

## PHP

- Always use curly braces for control structures, even if it has one line.

### Constructors
- Use PHP 8 constructor property promotion in `__construct()`.
    - <code-snippet>public function __construct(public GitHub $github) { }</code-snippet>
- Do not allow empty `__construct()` methods with zero parameters.

### Type Declarations
- Always use explicit return type declarations for methods and functions.
- Use appropriate PHP type hints for method parameters.

<code-snippet name="Explicit Return Types and Method Params" lang="php">
protected function isAccessible(User $user, ?string $path = null): bool
{
    ...
}
</code-snippet>

## Comments
- Prefer PHPDoc blocks over comments. Never use comments within the code itself unless there is something _very_ complex going on.

## PHPDoc Blocks
- Add useful array shape type definitions for arrays when appropriate.

## Enums
- Typically, keys in an Enum should be TitleCase. For example: `FavoritePerson`, `BestLake`, `Monthly`.


=== herd rules ===

## Laravel Herd

- The application is served by Laravel Herd and will be available at: https?://[kebab-case-project-dir].test. Use the `get-absolute-url` tool to generate URLs for the user to ensure valid URLs.
- You must not run any commands to make the site available via HTTP(s). It is _always_ available through Laravel Herd.


=== laravel/core rules ===

## Do Things the Laravel Way

- Use `php artisan make:` commands to create new files (i.e. migrations, controllers, models, etc.). You can list available Artisan commands using the `list-artisan-commands` tool.
- If you're creating a generic PHP class, use `artisan make:class`.
- Pass `--no-interaction` to all Artisan commands to ensure they work without user input. You should also pass the correct `--options` to ensure correct behavior.

### Database
- Always use proper Eloquent relationship methods with return type hints. Prefer relationship methods over raw queries or manual joins.
- Use Eloquent models and relationships before suggesting raw database queries
- Avoid `DB::`; prefer `Model::query()`. Generate code that leverages Laravel's ORM capabilities rather than bypassing them.
- Generate code that prevents N+1 query problems by using eager loading.
- Use Laravel's query builder for very complex database operations.

### Model Creation
- When creating new models, create useful factories and seeders for them too. Ask the user if they need any other things, using `list-artisan-commands` to check the available options to `php artisan make:model`.

### APIs & Eloquent Resources
- For APIs, default to using Eloquent API Resources and API versioning unless existing API routes do not, then you should follow existing application convention.

### Controllers & Validation
- Always create Form Request classes for validation rather than inline validation in controllers. Include both validation rules and custom error messages.
- Check sibling Form Requests to see if the application uses array or string based validation rules.

### Queues
- Use queued jobs for time-consuming operations with the `ShouldQueue` interface.

### Authentication & Authorization
- Use Laravel's built-in authentication and authorization features (gates, policies, Sanctum, etc.).

### URL Generation
- When generating links to other pages, prefer named routes and the `route()` function.

### Configuration
- Use environment variables only in configuration files - never use the `env()` function directly outside of config files. Always use `config('app.name')`, not `env('APP_NAME')`.

### Testing
- When creating models for tests, use the factories for the models. Check if the factory has custom states that can be used before manually setting up the model.
- Faker: Use methods such as `$this->faker->word()` or `fake()->randomDigit()`. Follow existing conventions whether to use `$this->faker` or `fake()`.
- When creating tests, make use of `php artisan make:test [options] <name>` to create a feature test, and pass `--unit` to create a unit test. Most tests should be feature tests.

### Vite Error
- If you receive an "Illuminate\Foundation\ViteException: Unable to locate file in Vite manifest" error, you can run `npm run build` or ask the user to run `npm run dev` or `composer run dev`.


=== laravel/v11 rules ===

## Laravel 11

- Use the `search-docs` tool to get version specific documentation.
- Laravel 11 brought a new streamlined file structure which this project now uses.

### Laravel 11 Structure
- No middleware files in `app/Http/Middleware/`.
- `bootstrap/app.php` is the file to register middleware, exceptions, and routing files.
- `bootstrap/providers.php` contains application specific service providers.
- **No app\Console\Kernel.php** - use `bootstrap/app.php` or `routes/console.php` for console configuration.
- **Commands auto-register** - files in `app/Console/Commands/` are automatically available and do not require manual registration.

### Database
- When modifying a column, the migration must include all of the attributes that were previously defined on the column. Otherwise, they will be dropped and lost.
- Laravel 11 allows limiting eagerly loaded records natively, without external packages: `$query->latest()->limit(10);`.

### Models
- Casts can and likely should be set in a `casts()` method on a model rather than the `$casts` property. Follow existing conventions from other models.

### New Artisan Commands
- List Artisan commands using Boost's MCP tool, if available. New commands available in Laravel 11:
    - `php artisan make:enum`
    - `php artisan make:class`
    - `php artisan make:interface`


=== pint/core rules ===

## Laravel Pint Code Formatter

- You must run `vendor/bin/pint --dirty` before finalizing changes to ensure your code matches the project's expected style.
- Do not run `vendor/bin/pint --test`, simply run `vendor/bin/pint` to fix any formatting issues.


=== pest/core rules ===

## Pest

### Testing
- If you need to verify a feature is working, write or update a Unit / Feature test.

### Pest Tests
- All tests must be written using Pest. Use `php artisan make:test --pest <name>`.
- You must not remove any tests or test files from the tests directory without approval. These are not temporary or helper files - these are core to the application.
- Tests should test all of the happy paths, failure paths, and weird paths.
- Tests live in the `tests/Feature` and `tests/Unit` directories.
- Pest tests look and behave like this:
<code-snippet name="Basic Pest Test Example" lang="php">
it('is true', function () {
    expect(true)->toBeTrue();
});
</code-snippet>

### Running Tests
- Run the minimal number of tests using an appropriate filter before finalizing code edits.
- To run all tests: `php artisan test`.
- To run all tests in a file: `php artisan test tests/Feature/ExampleTest.php`.
- To filter on a particular test name: `php artisan test --filter=testName` (recommended after making a change to a related file).
- When the tests relating to your changes are passing, ask the user if they would like to run the entire test suite to ensure everything is still passing.

### Pest Assertions
- When asserting status codes on a response, use the specific method like `assertForbidden` and `assertNotFound` instead of using `assertStatus(403)` or similar, e.g.:
<code-snippet name="Pest Example Asserting postJson Response" lang="php">
it('returns all', function () {
    $response = $this->postJson('/api/docs', []);

    $response->assertSuccessful();
});
</code-snippet>

### Mocking
- Mocking can be very helpful when appropriate.
- When mocking, you can use the `Pest\Laravel\mock` Pest function, but always import it via `use function Pest\Laravel\mock;` before using it. Alternatively, you can use `$this->mock()` if existing tests do.
- You can also create partial mocks using the same import or self method.

### Datasets
- Use datasets in Pest to simplify tests which have a lot of duplicated data. This is often the case when testing validation rules, so consider going with this solution when writing tests for validation rules.

<code-snippet name="Pest Dataset Example" lang="php">
it('has emails', function (string $email) {
    expect($email)->not->toBeEmpty();
})->with([
    'james' => 'james@laravel.com',
    'taylor' => 'taylor@laravel.com',
]);
</code-snippet>


=== tailwindcss/core rules ===

## Tailwind Core

- Use Tailwind CSS classes to style HTML, check and use existing tailwind conventions within the project before writing your own.
- Offer to extract repeated patterns into components that match the project's conventions (i.e. Blade, JSX, Vue, etc..)
- Think through class placement, order, priority, and defaults - remove redundant classes, add classes to parent or child carefully to limit repetition, group elements logically
- You can use the `search-docs` tool to get exact examples from the official documentation when needed.

### Spacing
- When listing items, use gap utilities for spacing, don't use margins.

    <code-snippet name="Valid Flex Gap Spacing Example" lang="html">
        <div class="flex gap-8">
            <div>Superior</div>
            <div>Michigan</div>
            <div>Erie</div>
        </div>
    </code-snippet>


### Dark Mode
- If existing pages and components support dark mode, new pages and components must support dark mode in a similar way, typically using `dark:`.


=== tailwindcss/v3 rules ===

## Tailwind 3

- Always use Tailwind CSS v3 - verify you're using only classes supported by this version.


=== tests rules ===

## Test Enforcement

- Every change must be programmatically tested. Write a new test or update an existing test, then run the affected tests to make sure they pass.
- Run the minimum number of tests needed to ensure code quality and speed. Use `php artisan test` with a specific filename or filter.
</laravel-boost-guidelines>
- i've enabled laravel boost and playwright mcp servers for you - also site is available at jkudish.test
- When a user asks to show or investigate an error or to look at the errors from flare, use the Flare MCP tool to get data. The project name in Flare is 'jkudish.com'.