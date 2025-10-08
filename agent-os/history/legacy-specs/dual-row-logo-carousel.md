# Dual-Row Logo Carousel Technical Specification

> Spec: Dual-Row Logo Carousel Implementation
> Created: 2025-09-10
> Status: Planning

## Overview

Implement a dual-row logo carousel component that displays client logos in two horizontally scrolling rows with opposite directions. The top row scrolls right-to-left while the bottom row scrolls left-to-right, creating an engaging visual effect. The implementation will be built using Laravel Blade components with Alpine.js for JavaScript functionality.

## User Stories

- As a visitor, I want to see client logos displayed in an attractive, animated carousel format
- As a visitor, I want the logos to scroll smoothly and continuously without jarring transitions
- As a visitor, I want to be able to hover over logos to see them highlighted
- As a site owner, I want the carousel to work seamlessly on all device sizes
- As a site owner, I want the carousel to handle any number of logos efficiently

## Spec Scope

### In Scope
- Dual-row horizontal scrolling carousel with opposite directions
- Smooth JavaScript-based animation using Alpine.js
- Seamless infinite loop with logo triplication
- Gradient mask fade effects on carousel edges
- Responsive design for mobile, tablet, and desktop
- Hover effects with opacity and grayscale transitions
- Logo distribution across two rows (12 top, 11 bottom for 23 total logos)
- Clean, minimal design without borders or containers

### Technical Requirements
- Alpine.js for scroll animation management
- CSS mask-image for gradient fade effects
- Tailwind CSS for styling and responsive design
- Blade component architecture for reusability
- 30ms interval smooth scrolling animation
- Logo dimensions: 160px min-width × 64px height
- 48px gap between logos
- Grayscale filter with hover state transitions

## Out of Scope

- Logo upload/management interface (logos remain hardcoded)
- Admin panel for carousel configuration
- Alternative carousel layouts (single row, vertical, etc.)
- Logo click-through functionality to client websites
- Lazy loading for logo images
- Accessibility features beyond basic semantic HTML

## Expected Deliverable

A complete dual-row logo carousel component integrated into the existing home page, featuring:
- Smooth bi-directional scrolling animation
- Professional visual presentation matching site design
- Responsive behavior across all screen sizes
- Clean, maintainable code following Laravel and Alpine.js best practices
- Optimized performance with minimal JavaScript overhead

## Technical Implementation Details

### Component Architecture
- Main Blade component: `resources/views/components/home/dual-logo-carousel.blade.php`
- Logo data management within component or passed as prop
- Integration into existing home page layout
- Utilization of existing container and section components

### Alpine.js Animation Logic
```javascript
// Scroll animation using Alpine.js data and methods
{
    scrollPosition1: 0,
    scrollPosition2: 0,
    animationId: null,
    
    init() {
        this.startAnimation();
    },
    
    startAnimation() {
        this.animationId = setInterval(() => {
            this.scrollPosition1 -= 1; // Right to left
            this.scrollPosition2 += 1; // Left to right
            
            // Reset positions for seamless loop
            if (Math.abs(this.scrollPosition1) >= this.getRowWidth()) {
                this.scrollPosition1 = 0;
            }
            if (this.scrollPosition2 >= this.getRowWidth()) {
                this.scrollPosition2 = 0;
            }
            
            // Apply transforms
            this.updateTransforms();
        }, 30);
    }
}
```

### CSS Gradient Mask Implementation
```css
.carousel-row {
    mask-image: linear-gradient(
        to right,
        transparent 0%,
        black 10%,
        black 90%,
        transparent 100%
    );
    -webkit-mask-image: linear-gradient(
        to right,
        transparent 0%,
        black 10%,
        black 90%,
        transparent 100%
    );
}
```

### Logo Distribution Strategy
- **Top Row (12 logos)**: Distribute larger/more prominent client logos
- **Bottom Row (11 logos)**: Remaining client logos
- Each logo triplicated for seamless infinite scroll
- Total rendered logos: 69 (23 × 3)

### Responsive Design Requirements
- **Mobile (< 640px)**: Reduce logo size and gaps, maintain dual-row layout
- **Tablet (640px - 1024px)**: Standard sizing with adjusted container width
- **Desktop (> 1024px)**: Full-size implementation with maximum visual impact

## Performance Considerations

### Animation Optimization
- Use CSS transforms for hardware acceleration
- Implement efficient scroll position calculations
- Consider using requestAnimationFrame for smoother animation
- Minimize DOM manipulation during scroll updates

### Image Optimization
- Ensure all logos are optimized for web delivery
- Consider WebP format with PNG fallbacks
- Implement appropriate alt text for accessibility
- Use consistent logo dimensions to prevent layout shifts

## Spec Documentation

- Tasks: @.agent-os/specs/dual-row-logo-carousel/tasks.md
- Technical Implementation: @.agent-os/specs/dual-row-logo-carousel/sub-specs/technical-implementation.md
- Logo Management: @.agent-os/specs/dual-row-logo-carousel/sub-specs/logo-management.md
- Styling Guide: @.agent-os/specs/dual-row-logo-carousel/sub-specs/styling-guide.md