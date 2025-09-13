# Technical Specification

This is the technical specification for the spec detailed in @.agent-os/specs/2025-09-11-seo-meta-tags/spec.md

## Technical Requirements

### SEO Component Architecture

- **Create Blade Component**: `resources/views/components/seo.blade.php`
  - Accept props for title, description, keywords, image, type, and custom properties
  - Generate meta tags, Open Graph tags, and Twitter Card tags
  - Support both default values and page-specific overrides
  - Handle URL generation for canonical links and og:url

### Meta Tag Implementation

- **Basic Meta Tags**:
  - Title tag with site name appending pattern
  - Meta description (155-160 characters optimal)
  - Meta keywords (relevant, page-specific)
  - Canonical URL
  - Robots meta tag (index, follow by default)
  - Author meta tag

- **Open Graph Tags**:
  - og:title (page title)
  - og:description (page description)
  - og:image (minimum 1200x630px for optimal display)
  - og:image:alt (accessibility text for image)
  - og:url (canonical page URL)
  - og:type (website, article, profile as appropriate)
  - og:site_name (Joey Kudish)
  - og:locale (en_US)

- **Twitter Card Tags**:
  - twitter:card (summary_large_image)
  - twitter:title (page title)
  - twitter:description (page description)
  - twitter:image (same as og:image)
  - twitter:site (@jkudish if applicable)
  - twitter:creator (@jkudish if applicable)

### Page-Specific Metadata

- **Home Page**:
  - Title: "Joey Kudish - Software Developer & AI Automation Consultant"
  - Description: "Expert Laravel developer and AI automation consultant helping businesses build scalable web applications and automate workflows. Based in [location]."
  - Keywords: "Joey Kudish, software developer, Laravel expert, AI automation, web development, consultant"

- **Speaking Page**:
  - Title: "Speaking & Presentations - Joey Kudish"
  - Description: "Conference talks, presentations, and workshops by Joey Kudish on software development, Laravel, WordPress, and AI automation."
  - Keywords: "tech speaker, conference presentations, Laravel talks, WordPress presentations, software development talks"

- **Services Page**:
  - Title: "Software Development & AI Automation Services - Joey Kudish"
  - Description: "Professional software development and AI automation services. Specializing in Laravel applications, custom integrations, and workflow automation."
  - Keywords: "software development services, AI automation, Laravel development, custom web applications, consulting"

- **Projects Page**:
  - Title: "Portfolio & Projects - Joey Kudish"
  - Description: "Explore Joey Kudish's portfolio of software projects, including web applications, open-source contributions, and client work."
  - Keywords: "software portfolio, web development projects, Laravel applications, case studies"

- **Newsletter Page**:
  - Title: "The Maker Notes Newsletter - Joey Kudish"
  - Description: "Subscribe to The Maker Notes for insights on software development, AI automation, and building digital products."
  - Keywords: "tech newsletter, software development newsletter, The Maker Notes, AI automation insights"

- **Contact Page**:
  - Title: "Contact Joey Kudish - Get in Touch"
  - Description: "Contact Joey Kudish for software development projects, AI automation consulting, or speaking engagements."
  - Keywords: "contact Joey Kudish, hire developer, consulting inquiries, speaking requests"

### Structured Data Implementation

- **Speaking Page** (Event/SpeakingEvent schema):
  - Each conference as an Event with name, date, location, and presenter
  - Include slide URLs as supplementary material

- **Contact Page** (Person/LocalBusiness schema):
  - Person schema with name, job title, and contact information
  - Social media profiles
  - Areas of expertise

- **Services Page** (Service schema):
  - Individual services as Service items
  - Service categories and descriptions

### Image Requirements

- **Default Open Graph Image**: 
  - Create a branded image (1200x630px) with Joey's photo/logo and tagline
  - Store in `public/img/social/og-default.jpg`

- **Page-Specific Images** (optional enhancement):
  - Speaking page: Conference collage or speaking photo
  - Services page: Service-themed graphic
  - Projects page: Portfolio showcase image

### Layout Component Integration

- Update `resources/views/components/layout.blade.php`:
  - Include the SEO component in the `<head>` section
  - Pass page-specific data from each view
  - Maintain backward compatibility with existing title prop

### URL Helper Function

- Create helper method or use existing Laravel helpers for:
  - Generating absolute URLs for canonical and og:url tags
  - Handling both local development (jkudish.test) and production domains

### Performance Considerations

- Minimize component processing overhead
- Use Laravel's view caching for production
- Preload critical meta images
- Ensure no duplicate meta tags

### XML Sitemap Implementation

- **Package Installation**:
  - Install `spatie/laravel-sitemap` package via Composer
  - Configure automatic sitemap generation

- **Sitemap Configuration**:
  - Include all public routes (home, speaking, services, projects, newsletter, contact)
  - Set appropriate priorities:
    - Home: 1.0
    - Services: 0.9
    - Projects: 0.8
    - Speaking: 0.8
    - Contact: 0.7
    - Newsletter: 0.6
  - Set change frequencies:
    - Home: weekly
    - Speaking: monthly (when new talks added)
    - Services: monthly
    - Projects: weekly
    - Newsletter: monthly
    - Contact: yearly
  - Add last modification dates where applicable

- **Sitemap Route**:
  - Create route for `/sitemap.xml`
  - Generate sitemap dynamically or cache with appropriate TTL
  - Include image sitemaps for Open Graph images if needed

### Robots.txt Configuration

- **Update existing robots.txt**:
  - Current file exists but is basic (allows all crawling)
  - Add sitemap reference: `Sitemap: https://jkudish.test/sitemap.xml` (update for production)
  - Add crawl delay if needed: `Crawl-delay: 1`
  - Ensure all pages are crawlable
  - Consider blocking any admin or private routes if they exist

- **Robots.txt Content**:
  ```
  User-agent: *
  Allow: /
  Disallow: /storage/
  Disallow: /vendor/
  
  Sitemap: https://jkudish.test/sitemap.xml
  ```

### Fathom Analytics Verification

- **Current Implementation**:
  - Fathom is already installed in `layout.blade.php`
  - Site code: OLWGPIDF
  - Script loads from: `https://cdn.usefathom.com/script.js`
  - Using defer attribute for performance

- **Verification Requirements**:
  - Confirm script loads on all pages (already in layout component)
  - Test page view tracking for each route
  - Verify custom events if needed (form submissions, clicks)
  - Ensure no duplicate tracking
  - Consider adding goal tracking for contact form submissions

- **Additional Analytics Considerations**:
  - Track 404 errors
  - Track external link clicks (optional)
  - Track file downloads (PDF slides on speaking page)
  - Set up custom events for newsletter signups

### Testing Requirements

- Validate meta tag output for each page
- Test Open Graph preview using Facebook's Sharing Debugger
- Verify Twitter Card using Twitter's Card Validator
- Validate structured data with Google's Rich Results Test
- Ensure unique titles and descriptions for all pages
- Verify sitemap.xml generates correctly and validates
- Test robots.txt serves correctly
- Confirm Fathom Analytics tracking on all pages
- Test sitemap accessibility and XML validity
- Verify all URLs in sitemap return 200 status codes