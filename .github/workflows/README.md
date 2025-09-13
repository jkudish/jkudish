# GitHub Actions CI Workflows

This directory contains automated CI workflows for maintaining code quality and test integrity.

## Workflows

### Laravel Pint (`pint.yml`)
Automatically formats PHP code using Laravel Pint on all pull requests.

**Features:**
- Triggers on PR open, synchronize, and reopen events
- Uses PHP 8.3 with required extensions
- Caches Composer dependencies for faster runs
- Automatically commits formatting changes back to the PR
- Workflow passes even when changes are made

**Required Permissions:**
- `contents: write` - To commit changes back to the PR branch

### Pest Tests (`pest.yml`)
Runs the Pest test suite and posts results as PR comments.

**Features:**
- Triggers on PR open, synchronize, and reopen events  
- Uses PHP 8.3 with all required extensions including PostgreSQL
- Caches Composer dependencies for performance
- Posts detailed test results as PR comments
- Shows pass/fail status with emoji indicators (✅/❌)
- Includes failure details with expandable sections

**Required Permissions:**
- `pull-requests: write` - To post comments on PRs

## Repository Settings

No special repository settings or secrets are required. The workflows use the default `GITHUB_TOKEN` which is automatically provided by GitHub Actions.

## Testing the Workflows

1. **Testing Laravel Pint:**
   - Create a PR with intentionally unformatted PHP code
   - The workflow should run and commit formatting fixes
   - The workflow should show as passing

2. **Testing Pest:**
   - Create a PR with your changes
   - The workflow will run all tests
   - A comment will be posted showing results
   - Failed tests will include detailed error messages

## Troubleshooting

### Pint workflow not committing changes
- Ensure the PR branch allows pushes from GitHub Actions
- Check that the repository allows GitHub Actions to create commits

### Pest tests failing due to environment
- Verify `.env.example` has all required environment variables
- Check that SQLite extension is available (used for testing)
- Ensure database migrations can run in test environment

### Comments not appearing on PRs
- Verify the workflow has `pull-requests: write` permission
- Check GitHub Actions logs for any API errors

## Local Testing

To test these workflows locally before pushing:

```bash
# Test Laravel Pint
./vendor/bin/pint --test

# Run Pest tests
php artisan test
```