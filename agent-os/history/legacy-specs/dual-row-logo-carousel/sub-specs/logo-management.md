# Logo Management Specification

This is the logo management strategy for the spec detailed in @.agent-os/specs/dual-row-logo-carousel.md

> Created: 2025-09-10
> Version: 1.0.0

## Logo Distribution Strategy

### Current Logo Inventory
Total logos: 23 client company logos
- Distribution: 12 logos in top row, 11 logos in bottom row
- Each logo triplicated for seamless infinite scroll
- Total rendered logos: 69 (23 × 3)

### Row Assignment Logic

#### Top Row (12 logos) - Premium Placement
Priority for logos that should receive maximum visibility:
- Largest/most recognizable client brands
- Most recent or important client relationships
- Logos with better visual contrast and readability
- Strategic brand associations

#### Bottom Row (11 logos) - Secondary Placement
Remaining client logos:
- Smaller or less prominent brands
- Older client relationships
- Logos that may be less visually striking
- Supporting brand associations

## Logo Data Structure

### Component Data Format
```php
<?php
// Logo array structure in component or controller

$clientLogos = [
    // Top row logos (12 total)
    [
        'src' => '/img/companies/company1.png',
        'alt' => 'Company 1 Logo',
        'row' => 'top',
        'priority' => 1
    ],
    [
        'src' => '/img/companies/company2.png',
        'alt' => 'Company 2 Logo', 
        'row' => 'top',
        'priority' => 2
    ],
    // ... additional top row logos
    
    // Bottom row logos (11 total)
    [
        'src' => '/img/companies/company13.png',
        'alt' => 'Company 13 Logo',
        'row' => 'bottom',
        'priority' => 13
    ],
    // ... additional bottom row logos
];

// Separate into row collections
$topRowLogos = collect($clientLogos)
    ->where('row', 'top')
    ->sortBy('priority')
    ->values();
    
$bottomRowLogos = collect($clientLogos)
    ->where('row', 'bottom')
    ->sortBy('priority')
    ->values();
```

### Alternative Simple Structure
```php
<?php
// Simplified approach - split by array index

$allLogos = [
    '/img/companies/company1.png',
    '/img/companies/company2.png',
    // ... 23 total logo paths
];

$topRowLogos = collect($allLogos)->take(12)->map(function($src, $index) {
    return [
        'src' => $src,
        'alt' => 'Client Logo ' . ($index + 1)
    ];
});

$bottomRowLogos = collect($allLogos)->skip(12)->map(function($src, $index) {
    return [
        'src' => $src,
        'alt' => 'Client Logo ' . ($index + 13)
    ];
});
```

## Logo File Requirements

### Image Specifications
- **Format**: PNG with transparent background preferred, SVG acceptable
- **Dimensions**: Minimum 320px width × 128px height for high DPI displays
- **Aspect Ratio**: Approximately 2.5:1 (width:height) for optimal display
- **File Size**: Maximum 50KB per logo for performance
- **Background**: Transparent or white background for versatility

### File Organization
```
public/img/companies/
├── company1.png
├── company2.png
├── company3.png
... (23 total files)
```

### Naming Convention
- Use kebab-case for filenames
- Include company identifier in filename
- Avoid special characters and spaces
- Examples: `microsoft.png`, `google-cloud.png`, `aws-amazon.png`

## Logo Optimization

### Performance Considerations
- Optimize all logos for web delivery using tools like TinyPNG
- Consider WebP format with PNG fallback for better compression
- Implement appropriate loading strategies (lazy loading for off-screen logos)
- Use consistent dimensions to prevent layout shifts

### Visual Consistency
- Ensure similar visual weight across all logos
- Standardize logo contrast and brightness
- Consider dark mode compatibility for logo colors
- Maintain consistent padding/margins in logo files

## Accessibility Requirements

### Alt Text Standards
- Provide descriptive alt text for each logo
- Format: "[Company Name] Logo" (e.g., "Microsoft Logo")
- Avoid generic descriptions like "Logo" or "Company"
- Include brief company description if logo is not text-based

### Semantic HTML
```html
<img 
    src="/img/companies/microsoft.png" 
    alt="Microsoft Logo"
    class="h-16 min-w-[160px] object-contain"
    loading="lazy"
    role="img"
    aria-label="Microsoft - Technology Partner"
>
```

## Future Scalability

### Adding New Logos
1. Optimize and save logo file to `/public/img/companies/`
2. Add logo data to component array
3. Rebalance row distribution if needed (maintain ~50/50 split)
4. Test carousel performance with additional logos
5. Update alt text and accessibility attributes

### Dynamic Logo Management
For future enhancement, consider:
- Database storage of logo metadata
- Admin interface for logo management
- Automatic row balancing algorithm
- Logo priority and visibility controls
- A/B testing for logo placement optimization

### Logo Removal Process
1. Remove file from `/public/img/companies/`
2. Remove entry from logo data array
3. Rebalance rows to maintain visual symmetry
4. Update any hardcoded references
5. Test carousel functionality after removal

## Quality Assurance

### Visual Testing Checklist
- [ ] All logos display at correct size (h-16, min-width 160px)
- [ ] Logos maintain aspect ratio without distortion
- [ ] Transparent backgrounds render correctly
- [ ] Hover effects work consistently across all logos
- [ ] Row distribution appears visually balanced
- [ ] Animation performs smoothly with all logos loaded

### Performance Testing
- [ ] Page load time impact assessment
- [ ] Carousel animation frame rate consistency
- [ ] Memory usage monitoring during extended animation
- [ ] Network request optimization verification
- [ ] Mobile device performance validation

### Accessibility Testing
- [ ] Screen reader compatibility with alt text
- [ ] Keyboard navigation functionality (if applicable)
- [ ] High contrast mode compatibility
- [ ] Color blindness accessibility verification
- [ ] Reduced motion preference support