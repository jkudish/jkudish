# Spec Requirements Document

> Spec: Newsletter Archive Integration
> Created: 2025-10-02

## Overview

Integrate Bento newsletter broadcasts into the website by creating a database-backed archive that automatically syncs via the Bento API, allowing visitors to browse and read past newsletter issues directly on the site with proper styling for both light and dark modes.

## User Stories

### Newsletter Subscriber Discovery

As a potential newsletter subscriber, I want to browse past newsletter issues before subscribing, so that I can see the quality and topics covered to make an informed decision about subscribing.

Visitors can navigate to the /newsletter page and see a chronologically ordered list of all sent newsletters with titles and send dates. They can click on any newsletter to read the full content on the site without leaving to an external page.

### Automatic Newsletter Archive

As the site owner, I want newsletter broadcasts to automatically sync from Bento to my database, so that I don't have to manually update the site each time I send a new newsletter.

An hourly scheduled command fetches new broadcasts from the Bento API, stores them in the database (avoiding duplicates), and makes them immediately available on the site for visitors to read.

### Consistent Reading Experience

As a newsletter reader, I want to read archived newsletters with the same design and navigation as the rest of the site, so that I have a cohesive browsing experience.

Newsletter content is rendered within the site's standard layout with header and footer, works in both light and dark modes, and includes newsletter signup CTAs to encourage subscriptions while reading past issues.

## Spec Scope

1. **Broadcast Model & Migration** - Create a Laravel model and database table to store newsletter broadcasts (title, subject, content, send date, Bento ID, stats)
2. **Bento API Integration** - Create an Artisan command that fetches broadcasts from Bento API and syncs them to the database, preventing duplicate imports
3. **Scheduled Sync** - Configure Laravel scheduler to run the sync command hourly to keep the archive up-to-date automatically
4. **Newsletter Archive Page** - Update /newsletter page to display a list of sent newsletters in reverse chronological order with titles and send dates
5. **Individual Newsletter View** - Create newsletter detail pages at /newsletter/{id} that render the HTML content from Bento within the site layout, supporting light and dark modes
6. **Newsletter Signup CTAs** - Add newsletter signup forms to all newsletter pages (simplified version at top, detailed version at bottom)
7. **Copy Updates** - Update all pre-launch messaging across the site to reflect that the newsletter has launched

## Out of Scope

- Newsletter editing or management through the site (Bento remains the source of truth)
- Newsletter sending functionality (handled entirely by Bento)
- Analytics dashboard for newsletter metrics
- Search functionality for newsletter archive
- Category or tag filtering for newsletters

## Expected Deliverable

1. Visitors can browse a list of all sent newsletters at /newsletter showing titles and send dates in reverse chronological order
2. Visitors can click on any newsletter to read the full content at /newsletter/{slug-or-id} rendered within the site's layout with proper light/dark mode support
3. Newsletter signup forms appear on both the archive page and individual newsletter pages with appropriate CTAs
4. New newsletters sent via Bento automatically appear on the site within one hour without manual intervention
5. All pre-launch language has been updated throughout the site to reflect the newsletter's launched status
