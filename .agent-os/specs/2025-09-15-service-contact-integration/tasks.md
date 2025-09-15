# Implementation Tasks

> Spec: Service-Specific Contact Form Integration
> Created: 2025-09-15

## Task Checklist

### 1. Contact Page Query Parameter Handling
- [ ] Update ContactController to accept and validate service query parameter
- [ ] Pass service context to contact view
- [ ] Add validation for allowed service values

### 2. Service-Specific Hero Components
- [ ] Create service-hero Blade component with dynamic content
- [ ] Map service slugs to display properties (colors, icons, messaging)
- [ ] Implement fallback to default hero when no service specified

### 3. Service Messaging Implementation
- [ ] Define service-specific intro messages in component
- [ ] Apply service colors from existing palette
- [ ] Integrate service icons from existing assets

### 4. Form Placeholder Customization
- [ ] Create service-aware placeholder text mappings
- [ ] Update form fields with dynamic placeholders
- [ ] Add service-specific helper text beneath fields

### 5. Update Service Page CTAs
- [ ] Modify Software Development service CTA link
- [ ] Modify AI Automation service CTA link
- [ ] Modify Product Launches service CTA link
- [ ] Modify Technical Consulting service CTA link

### 6. Smooth Scrolling Implementation
- [ ] Add CSS scroll-behavior to base styles
- [ ] Implement JavaScript fallback for older browsers
- [ ] Test with existing navigation components
- [ ] Add prefers-reduced-motion media query support

### 7. Testing
- [ ] Test each service parameter displays correct hero
- [ ] Verify form submission works with all service contexts
- [ ] Test smooth scrolling across different page sections
- [ ] Validate mobile responsiveness of service heroes
- [ ] Test fallback behavior for invalid parameters

### 8. Code Quality
- [ ] Run Laravel Pint for code formatting
- [ ] Write Pest tests for new functionality
- [ ] Update any affected existing tests

## Notes

- Maintain existing form validation and submission logic
- Preserve current dark mode support in new components
- Ensure all changes are mobile-responsive
- Keep SEO meta tags intact on contact page