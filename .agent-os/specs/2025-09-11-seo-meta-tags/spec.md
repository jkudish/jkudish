# Spec Requirements Document

> Spec: SEO and Meta Tags Implementation
> Created: 2025-09-11

## Overview

Implement comprehensive SEO optimization for all pages of Joey's portfolio website, including meta tags, Open Graph tags, Twitter Cards, and structured data. This enhancement will improve search engine visibility, enable rich social media previews, and establish proper SEO foundations for the website's growth.

## User Stories

### SEO-Optimized Page Discovery

As a potential client searching for software development or AI automation services, I want to find Joey's website through search engines with relevant, descriptive results, so that I can learn about his expertise and services.

When searching for terms like "Laravel developer," "AI automation consultant," or "Joey Kudish," users should see well-formatted search results with compelling titles and descriptions that accurately represent each page's content. The search results should display the page title, a relevant description, and proper URL structure.

### Professional Social Media Sharing

As a conference organizer or colleague, I want to share Joey's speaking page or portfolio on social media with rich previews, so that my network can see his expertise at a glance.

When sharing any page from jkudish.test on platforms like LinkedIn, Twitter, or Facebook, the post should automatically generate an attractive card with the page title, description, and a relevant image. This makes shared content more engaging and professional, increasing click-through rates and establishing credibility.

### Enhanced Brand Visibility

As Joey (the site owner), I want each page to have optimized metadata and structured data, so that my personal brand and services have maximum visibility across search engines and social platforms.

Every page should contribute to overall SEO strength with unique titles, descriptions, and keywords. Speaking engagements should have event structured data, the contact page should have LocalBusiness schema, and services should be properly categorized for search engines to understand the site's offerings.

## Spec Scope

1. **SEO Component System** - Create a reusable Blade component for managing all meta tags, Open Graph, and Twitter Card data
2. **Page-Specific Metadata** - Define unique titles, descriptions, keywords, and social images for each of the six main pages
3. **Open Graph Implementation** - Add comprehensive Open Graph tags for rich social media previews on all pages
4. **Twitter Card Support** - Implement Twitter Card tags to optimize appearance on Twitter/X platform
5. **Structured Data** - Add JSON-LD structured data for speaking events, services, and contact information
6. **XML Sitemap Generation** - Implement automatic XML sitemap generation for all public pages with proper priorities and change frequencies
7. **Robots.txt Configuration** - Configure robots.txt with proper crawl directives and sitemap reference
8. **Analytics Verification** - Ensure Fathom Analytics tracking is properly configured and working on all pages

## Out of Scope

- Google Analytics or other tracking pixels (besides existing Fathom)
- Multi-language SEO support
- Dynamic content SEO (blog posts, dynamic portfolio items)
- SEO performance monitoring tools
- XML feeds or RSS
- Search console integration
- CDN configuration for SEO

## Expected Deliverable

1. All six pages (home, speaking, services, projects, newsletter, contact) display unique, descriptive titles and meta descriptions when viewed in browser tabs and search results
2. Social media platforms generate rich preview cards with images when any page URL is shared
3. Structured data validates correctly in Google's Rich Results Test tool for applicable pages
4. XML sitemap accessible at /sitemap.xml containing all public pages with appropriate priorities
5. Robots.txt properly configured with sitemap reference and appropriate crawl directives
6. Fathom Analytics tracking confirmed working on all pages with proper page view tracking