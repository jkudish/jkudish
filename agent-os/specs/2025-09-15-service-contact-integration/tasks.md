# Spec Tasks

These are the tasks to be completed for the spec detailed in @.agent-os/specs/2025-09-15-service-contact-integration/spec.md

> Created: 2025-09-15
> Status: Ready for Implementation

## Tasks

- [x] 1. Implement Service-Specific Contact Heroes
  - [x] 1.1 Write tests for service parameter handling and hero display
  - [x] 1.2 Update ContactController to accept and validate service query parameter
  - [x] 1.3 Create service-hero Blade component with dynamic content and messaging
  - [x] 1.4 Map service slugs to colors, icons, and custom messages
  - [x] 1.5 Implement fallback behavior for invalid or missing parameters
  - [x] 1.6 Verify all tests pass

- [x] 2. Customize Form Field Placeholders and Descriptions
  - [x] 2.1 Write tests for dynamic placeholder functionality
  - [x] 2.2 Create service-aware placeholder text mappings for each service
  - [x] 2.3 Update contact form component to accept service context
  - [x] 2.4 Apply dynamic placeholders and helper text based on service
  - [x] 2.5 Ensure form validation and submission remain unchanged
  - [x] 2.6 Verify all tests pass

- [x] 3. Update Service Page CTAs
  - [x] 3.1 Write tests for CTA link generation
  - [x] 3.2 Update Software Development service CTA to include query parameter
  - [x] 3.3 Update AI Automation service CTA to include query parameter
  - [x] 3.4 Update Product Launches service CTA to include query parameter
  - [x] 3.5 Update Technical Consulting service CTA to include query parameter
  - [x] 3.6 Verify all tests pass

- [x] 4. Implement Site-Wide Smooth Scrolling
  - [x] 4.1 Write tests for smooth scrolling functionality
  - [x] 4.2 Add scroll-behavior CSS to base application styles
  - [x] 4.3 Implement JavaScript fallback for unsupported browsers
  - [x] 4.4 Add prefers-reduced-motion media query support
  - [x] 4.5 Test with navigation and all anchor links
  - [x] 4.6 Verify all tests pass

- [x] 5. Final Integration and Quality Assurance
  - [x] 5.1 Test complete user flow from each service to contact form
  - [x] 5.2 Verify mobile responsiveness for all service heroes
  - [x] 5.3 Confirm dark mode support for new components
  - [x] 5.4 Run Laravel Pint for code formatting
  - [x] 5.5 Run complete test suite to ensure no regressions
  - [x] 5.6 Document any configuration or usage notes