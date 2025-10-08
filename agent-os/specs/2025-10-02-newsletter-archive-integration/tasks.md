# Spec Tasks

These are the tasks to be completed for the spec detailed in @.agent-os/specs/2025-10-02-newsletter-archive-integration/spec.md

> Created: 2025-10-02
> Status: Ready for Implementation

## Tasks

- [x] 1. Database Setup and Broadcast Model
  - [x] 1.1 Write tests for Broadcast model and relationships
  - [x] 1.2 Create migration for broadcasts table with all required fields
  - [x] 1.3 Create Broadcast model with fillable fields, casts, and scopes
  - [x] 1.4 Run migration and verify database schema
  - [x] 1.5 Verify all tests pass

- [x] 2. Bento API Integration for Broadcasts
  - [x] 2.1 Write tests for BentoService::getBroadcasts() method
  - [x] 2.2 Add getBroadcasts() method to BentoService using Bento facade
  - [x] 2.3 Parse and filter API response for sent broadcasts only
  - [x] 2.4 Handle API errors gracefully with logging
  - [x] 2.5 Verify all tests pass

- [x] 3. Newsletter Sync Artisan Command
  - [x] 3.1 Write tests for sync command execution and duplicate prevention
  - [x] 3.2 Create app:sync-newsletters Artisan command
  - [x] 3.3 Implement broadcast fetching and database upsert logic
  - [x] 3.4 Add command logging for sync activity
  - [x] 3.5 Test command manually to verify it syncs broadcasts correctly
  - [x] 3.6 Verify all tests pass

- [x] 4. Schedule Hourly Newsletter Sync
  - [x] 4.1 Register command in Laravel scheduler (routes/console.php or bootstrap/app.php)
  - [x] 4.2 Configure to run hourly using ->hourly() method
  - [x] 4.3 Test scheduler locally with php artisan schedule:work
  - [x] 4.4 Document scheduler setup for production deployment

- [x] 5. Newsletter Archive Page Updates
  - [x] 5.1 Write tests for newsletter archive page display
  - [x] 5.2 Update newsletter.blade.php to fetch and display broadcasts list
  - [x] 5.3 Remove "launching soon" badge section
  - [x] 5.4 Display broadcasts in reverse chronological order with title and send date
  - [x] 5.5 Add links to individual newsletter pages
  - [x] 5.6 Test responsive design and dark mode support
  - [x] 5.7 Verify all tests pass

- [x] 6. Individual Newsletter View Pages
  - [x] 6.1 Write tests for newsletter show page and route model binding
  - [x] 6.2 Create route for /newsletter/{broadcast} with route model binding
  - [x] 6.3 Create NewsletterController@show method (or similar)
  - [x] 6.4 Create newsletter/show.blade.php view with site layout
  - [x] 6.5 Add simplified newsletter signup CTA at top
  - [x] 6.6 Render broadcast HTML content in container
  - [x] 6.7 Add detailed newsletter signup CTA at bottom
  - [x] 6.8 Test dark mode compatibility and responsive design
  - [x] 6.9 Add redirect to /newsletter for not-found broadcasts
  - [x] 6.10 Verify all tests pass

- [x] 7. Copy Updates Across Site
  - [x] 7.1 Update NewsletterController.php success messages (lines 40, 46)
  - [x] 7.2 Update footer.blade.php newsletter success message (line 53)
  - [x] 7.3 Update home/newsletter-signup.blade.php copy (line 18)
  - [x] 7.4 Update projects.blade.php newsletter status and label (lines 173-174)
  - [x] 7.5 Update home/current-projects.blade.php newsletter status and label (lines 34-35)
  - [x] 7.6 Test all pages to verify copy changes are correct

- [x] 8. Final Testing and Verification
  - [x] 8.1 Run full test suite to ensure no regressions
  - [x] 8.2 Manually test newsletter archive page displays correctly
  - [x] 8.3 Manually test individual newsletter pages render properly
  - [x] 8.4 Test newsletter signup CTAs work on all pages
  - [x] 8.5 Verify dark mode works across all newsletter pages
  - [x] 8.6 Test sync command with real Bento data
  - [x] 8.7 Verify all copy updates are complete and accurate
  - [x] 8.8 Performance test: check page load times and query counts
