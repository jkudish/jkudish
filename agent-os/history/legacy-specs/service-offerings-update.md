# Service Offerings Update

## Feature Overview

Update the service offerings on the website to reflect three new service packages:
1. Code Audit & Strategy - Technical assessment and roadmap
2. Build Your Product - MVP and product development
3. Ongoing Partnership - Technical co-founder as a service

## Business Value

- Clearer value proposition for potential clients
- Better segmentation of services (assessment, build, maintain)
- More compelling copy that speaks directly to client pain points
- Improved conversion potential with specific CTAs and pricing

## User Story

As a potential client visiting the website, I want to quickly understand the available service options and their value propositions so I can choose the service that best fits my needs and budget.

## Technical Specification

### Component Structure

The service cards will maintain the existing layout structure with updated content. Each service will have:
- Main content area (left side on desktop)
- Service details card (right side on desktop)

### Service Data Structure

Each service object will contain:
```php
[
    'id' => 'string', // URL anchor identifier
    'icon' => 'string', // Icon identifier
    'name' => 'string', // Service headline
    'tagline' => 'string', // Subheadline
    'description' => 'string', // Main description
    'ideal_for' => [], // Array of ideal client types
    'deliverables' => [], // Array of what client gets
    'process' => [], // Array of process steps
    'pricing' => 'string', // Investment amount
    'duration' => 'string', // Timeline
    'cta' => 'string', // Call to action text
]
```

### Page Updates

1. **Services Page** (`resources/views/services.blade.php`)
   - Replace existing service data array with new services
   - Maintain existing layout and styling
   - Update service IDs for anchor navigation

2. **Home Page Services Preview** (`resources/views/components/home/services-preview.blade.php`)
   - Update service preview cards to match new services
   - Simplify features to 3-4 key points per service
   - Update pricing to match main services page

### Content Mapping

#### Service 1: Code Audit & Strategy
- ID: `code-audit-strategy`
- Icon: `code` or `search`
- Pricing: Starting at $1,500
- Timeline: 7-14 business days

#### Service 2: Build Your Product
- ID: `build-product`
- Icon: `rocket`
- Pricing: Starting at $15,000
- Timeline: 4-12 weeks

#### Service 3: Ongoing Partnership
- ID: `ongoing-partnership`
- Icon: `users` or `handshake`
- Pricing: $3,000 - $10,000/month
- Timeline: Month-to-month, no lock-in

## Implementation Approach

### Phase 1: Update Services Page
1. Update the `$services` array with new service data
2. Maintain existing component structure
3. Ensure all CTAs link to contact page

### Phase 2: Update Home Page Preview
1. Update services preview component
2. Ensure consistency with main services page
3. Test responsive layout

### Phase 3: Verification
1. Test all service cards display correctly
2. Verify responsive behavior
3. Ensure dark mode compatibility
4. Test all CTAs and navigation

## Testing Requirements

- Visual testing on desktop, tablet, mobile
- Dark mode compatibility check
- Link functionality verification
- Content accuracy review

## Success Criteria

- [ ] All three new services displayed correctly on services page
- [ ] Home page preview shows updated services
- [ ] All CTAs link to contact page
- [ ] Responsive layout works on all devices
- [ ] Dark mode styling is consistent
- [ ] Content matches provided specifications exactly