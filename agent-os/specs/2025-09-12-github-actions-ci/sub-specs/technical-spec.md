# Technical Specification

This is the technical specification for the spec detailed in @.agent-os/specs/2025-09-12-github-actions-ci/spec.md

> Created: 2025-09-12
> Version: 1.0.0

## Technical Requirements

### Laravel Pint Workflow
- Trigger on pull_request events (opened, synchronize, reopened)
- Use PHP 8.3 with required extensions (mbstring, xml, ctype, iconv, bcmath, pdo_sqlite)
- Cache Composer dependencies for faster runs
- Run `composer install` with optimized autoloader
- Execute `./vendor/bin/pint` with Laravel default preset
- If changes detected, commit back to PR branch using GitHub token
- Use git config with GitHub Actions bot identity
- Ensure workflow passes after auto-commit (not marked as failed)

### Pest Testing Workflow  
- Trigger on pull_request events (opened, synchronize, reopened)
- Use PHP 8.3 with same extensions as Pint workflow
- Cache Composer dependencies for performance
- Run `composer install` with optimized autoloader
- Copy .env.example to .env for test environment
- Generate application key with `php artisan key:generate`
- Execute `php artisan test` to run Pest suite
- Capture test output including failure details
- Post results as PR comment using GitHub API
- Format comment with markdown for readability
- Include specific test names and error messages for failures

### GitHub Actions Configuration
- Store workflows in `.github/workflows/` directory
- Name files descriptively: `pint.yml` and `pest.yml`
- Use GitHub's hosted Ubuntu latest runners
- Leverage actions/checkout@v4 for repository access
- Use shivammathur/setup-php@v2 for PHP environment
- Implement proper error handling and status reporting
- Set appropriate permissions for GITHUB_TOKEN (write for Pint, read + pull-requests:write for Pest)

### PR Comment Formatting
- Use markdown with clear headers and formatting
- Show pass/fail status with emoji indicators (✅/❌)
- List failed test names with their error messages
- Include file paths and line numbers when available
- Add timestamp and workflow run link

## Approach

### Workflow Implementation Strategy
1. Create two separate workflows for independence and clarity
2. Use proven GitHub Actions ecosystem (checkout, setup-php, cache)
3. Implement proper dependency caching to minimize CI time
4. Handle git operations securely with built-in GITHUB_TOKEN
5. Provide clear feedback through PR comments for test results

### Error Handling
- Gracefully handle Composer installation failures
- Catch and report PHP setup issues
- Handle git commit conflicts in Pint workflow
- Provide meaningful error messages in PR comments
- Ensure workflows don't fail silently

### Performance Optimization
- Cache Composer dependencies between runs
- Use optimized autoloader for faster class loading
- Minimize checkout depth where possible
- Run workflows only on relevant PR events

## External Dependencies

### GitHub Actions
- `actions/checkout@v4` - Repository checkout
- `shivammathur/setup-php@v2` - PHP environment setup
- `actions/cache@v3` - Dependency caching

### PHP Extensions Required
- mbstring (multibyte string handling)
- xml (XML parsing)
- ctype (character type checking)
- iconv (character encoding conversion)
- bcmath (arbitrary precision mathematics)
- pdo_sqlite (SQLite database support for testing)

### GitHub Permissions
- `contents: write` - For Pint workflow to commit changes
- `pull-requests: write` - For Pest workflow to post comments
- Default GITHUB_TOKEN provides read access to repository