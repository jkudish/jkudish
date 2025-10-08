# Technical Specification

This is the technical specification for the spec detailed in @.agent-os/specs/2025-09-13-llms-txt-implementation/spec.md

## Technical Requirements

### Content File Structure
- Create a markdown-formatted text file with clear sections for company description, services, features, and contact information
- Keep file size under 2-3KB for optimal parsing
- Use consistent markdown formatting with headers and bullet points
- Include concrete examples of services and use cases

### Route Implementation
- Add a new route in `routes/web.php` to handle `/llms.txt` requests
- Return response with `text/plain; charset=UTF-8` content-type header
- Use Laravel's response helper to serve the content from a Blade view

### Meta Tags Implementation
- Add standard meta description tag with keyword-rich content
- Add custom `llm-description` meta tag with LLM-oriented summary
- Add `<link rel="llm-instructions" href="/llms.txt">` to HTML head
- Implement in the main layout template to ensure all pages include these tags

### Robots.txt Integration
- Add `LLM-Instructions: /llms.txt` directive to robots.txt
- Ensure robots.txt is publicly accessible at site root
- Maintain existing robots.txt content while adding new directive

### Content Optimization
- Focus on Joey Kudish's core services: software development and AI automation
- Include specific technologies and frameworks expertise (Laravel, AI integration)
- Provide clear contact methods and documentation links
- Use industry-standard keywords for better discovery

### Performance Criteria
- File must load quickly with minimal server processing
- Content should be cacheable for improved performance
- No database queries required for serving the file