# Spec Tasks

## Tasks

- [x] 1. Create SEO Component System
  - [x] 1.1 Write tests for SEO component output and meta tag generation
  - [x] 1.2 Create the reusable SEO Blade component (resources/views/components/seo.blade.php)
  - [x] 1.3 Implement meta tag generation logic (basic meta, Open Graph, Twitter Cards)
  - [x] 1.4 Create default Open Graph image and store in public/img/social/
  - [x] 1.5 Update layout component to include SEO component in head section
  - [x] 1.6 Verify all tests pass and component renders correctly

- [x] 2. Implement Page-Specific SEO Metadata
  - [x] 2.1 Write tests for page-specific meta tag output
  - [x] 2.2 Add SEO metadata to home page with title, description, and keywords
  - [x] 2.3 Add SEO metadata to speaking page with conference-specific tags
  - [x] 2.4 Add SEO metadata to services, projects, newsletter, and contact pages
  - [x] 2.5 Create page-specific Open Graph images (optional, use default if not)
  - [x] 2.6 Verify unique meta tags on each page and all tests pass

- [x] 3. Add Structured Data Implementation
  - [x] 3.1 Write tests for structured data JSON-LD output
  - [x] 3.2 Implement Person/Organization schema for home and contact pages
  - [x] 3.3 Add Event/SpeakingEvent schema for speaking page conferences
  - [x] 3.4 Implement Service schema for services page
  - [x] 3.5 Validate structured data with Google's Rich Results Test
  - [x] 3.6 Verify all structured data tests pass

- [x] 4. Setup XML Sitemap Generation
  - [x] 4.1 Write tests for sitemap generation and route accessibility
  - [x] 4.2 Install and configure spatie/laravel-sitemap package
  - [x] 4.3 Create sitemap generation logic with priorities and change frequencies
  - [x] 4.4 Add /sitemap.xml route and controller
  - [x] 4.5 Test sitemap XML validity and URL accessibility
  - [x] 4.6 Verify all sitemap tests pass and validates correctly

- [x] 5. Configure Robots.txt and Analytics
  - [x] 5.1 Write tests for robots.txt content and Fathom Analytics presence
  - [x] 5.2 Update robots.txt with sitemap reference and proper directives
  - [x] 5.3 Verify Fathom Analytics loads on all pages
  - [x] 5.4 Implement custom Fathom events for form submissions and PDF downloads
  - [x] 5.5 Test analytics tracking and robots.txt accessibility
  - [x] 5.6 Verify all configuration tests pass