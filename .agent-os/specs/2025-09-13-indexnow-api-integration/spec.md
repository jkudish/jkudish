# Spec Requirements Document

> Spec: IndexNow API Integration
> Created: 2025-09-13
> Status: Planning

## Overview

Implement IndexNow API integration to enable instant search engine indexing of website content through a simple Laravel artisan command. This feature will notify search engines immediately when content is published or updated, improving SEO visibility and reducing indexing delays.

## User Stories

### Instant Content Indexing

As a website owner, I want to notify search engines immediately when I publish new content or update existing pages, so that my content appears in search results faster.

When I publish a new blog post or update my portfolio, I can run a simple artisan command that instantly notifies Bing, Yandex, Seznam, and Naver search engines through the IndexNow API. The command handles all the technical details including API key management, verification file creation, and proper error reporting, allowing me to focus on content creation while ensuring maximum search visibility.

## Spec Scope

1. **Artisan Command Creation** - Build a single Laravel artisan command `indexnow:submit` for URL submission and API key management
2. **API Key Generation** - Generate secure 32-character random API keys with the `--generate-key` flag
3. **Configuration Management** - Store API key in Laravel config system using `services.indexnow.key` with environment variable support
4. **URL Submission** - Submit URLs to Bing's IndexNow endpoint which automatically shares with partner search engines
5. **Verification File Creation** - Automatically create and maintain the required verification file at `public/{key}.txt`

## Out of Scope

- Background job processing or queue implementation
- Database storage of submission history
- Automatic URL discovery or sitemap parsing
- Observer patterns for automatic model event indexing
- Multiple API key management or rotation
- Custom service classes or complex abstractions
- Admin UI or dashboard for managing submissions

## Expected Deliverable

1. Working artisan command `php artisan indexnow:submit {url?} {--generate-key}` that successfully submits URLs to IndexNow
2. Proper configuration entry in `config/services.php` that reads from `INDEXNOW_KEY` environment variable
3. Automatic verification file creation at `public/{key}.txt` containing the API key when key is generated

## Spec Documentation

- Tasks: @.agent-os/specs/2025-09-13-indexnow-api-integration/tasks.md
- Technical Specification: @.agent-os/specs/2025-09-13-indexnow-api-integration/sub-specs/technical-spec.md