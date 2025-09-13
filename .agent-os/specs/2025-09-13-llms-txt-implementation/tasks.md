# Spec Tasks

## Tasks

- [ ] 1. Create and configure llms.txt content file
  - [ ] 1.1 Write tests for llms.txt route and content delivery
  - [ ] 1.2 Create llms.blade.php view with structured content about Joey Kudish's services
  - [ ] 1.3 Ensure content is under 2-3KB and follows markdown formatting
  - [ ] 1.4 Include services, features, contact information, and use cases
  - [ ] 1.5 Verify all tests pass

- [ ] 2. Implement Laravel route for llms.txt
  - [ ] 2.1 Write tests for route response headers and content type
  - [ ] 2.2 Add GET route for /llms.txt in routes/web.php
  - [ ] 2.3 Configure route to return text/plain content-type header
  - [ ] 2.4 Test route accessibility and proper content delivery
  - [ ] 2.5 Verify all tests pass

- [ ] 3. Add LLM discovery meta tags
  - [ ] 3.1 Write tests for meta tag presence in HTML output
  - [ ] 3.2 Add standard meta description with keyword-rich content
  - [ ] 3.3 Add llm-description meta tag with LLM-oriented summary
  - [ ] 3.4 Add link rel="llm-instructions" pointing to /llms.txt
  - [ ] 3.5 Implement in main layout to ensure all pages include tags
  - [ ] 3.6 Verify all tests pass

- [ ] 4. Update robots.txt with LLM instructions
  - [ ] 4.1 Write tests for robots.txt accessibility and content
  - [ ] 4.2 Add LLM-Instructions directive pointing to /llms.txt
  - [ ] 4.3 Ensure robots.txt maintains existing directives
  - [ ] 4.4 Verify robots.txt is accessible at site root
  - [ ] 4.5 Verify all tests pass

- [ ] 5. Final validation and optimization
  - [ ] 5.1 Test complete flow of LLM discovery path
  - [ ] 5.2 Verify content is optimized for keywords and clarity
  - [ ] 5.3 Confirm all meta tags are properly rendered
  - [ ] 5.4 Test accessibility of all endpoints
  - [ ] 5.5 Run full test suite to ensure no regressions