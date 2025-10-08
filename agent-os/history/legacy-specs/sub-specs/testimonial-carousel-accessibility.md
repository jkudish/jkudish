# Accessibility Requirements

This is the accessibility specification for the spec detailed in @.agent-os/specs/testimonial-carousel.md

> Created: 2025-01-21
> Version: 1.0.0

## Accessibility Standards

### Compliance Target
- **WCAG 2.1 Level AA** compliance
- **Section 508** compliance for government accessibility
- **EN 301 549** European standard compliance

### Core Principles
1. **Perceivable**: Information must be presentable in ways users can perceive
2. **Operable**: Interface components must be operable by all users
3. **Understandable**: Information and UI operation must be understandable
4. **Robust**: Content must be robust enough for various assistive technologies

## Keyboard Navigation Requirements

### Primary Navigation
- **Left Arrow**: Navigate to previous testimonial
- **Right Arrow**: Navigate to next testimonial
- **Tab**: Move focus between interactive elements
- **Enter/Space**: Activate focused buttons
- **Home**: Jump to first testimonial (optional enhancement)
- **End**: Jump to last testimonial (optional enhancement)

### Focus Management
```html
<!-- Carousel container with proper focus management -->
<div role="region" 
     aria-label="Customer testimonials"
     aria-roledescription="carousel"
     x-data="testimonialCarousel()">
    
    <!-- Navigation buttons with proper focus styling -->
    <button aria-label="Previous testimonial"
            x-on:click="previousSlide()"
            x-bind:disabled="currentSlide === 0"
            class="focus:ring-2 focus:ring-emerald-500 focus:outline-none">
        <svg aria-hidden="true"><!-- Previous arrow --></svg>
    </button>
    
    <button aria-label="Next testimonial"
            x-on:click="nextSlide()"
            x-bind:disabled="currentSlide === maxSlides()"
            class="focus:ring-2 focus:ring-emerald-500 focus:outline-none">
        <svg aria-hidden="true"><!-- Next arrow --></svg>
    </button>
</div>
```

### Focus Order
1. Previous button (if not disabled)
2. Testimonial content area
3. Next button (if not disabled)
4. Dot indicators (if implemented)

## Screen Reader Support

### ARIA Live Regions
```html
<!-- Status announcements for screen readers -->
<div aria-live="polite" aria-atomic="true" class="sr-only">
    <span x-text="`Showing testimonial ${currentSlide + 1} of ${testimonials.length}`"></span>
</div>

<!-- Optional: More detailed announcements -->
<div aria-live="polite" class="sr-only">
    <span x-text="announceSlideChange()"></span>
</div>
```

### ARIA Labels and Descriptions
```html
<!-- Carousel wrapper -->
<div role="region" 
     aria-label="Customer testimonials" 
     aria-roledescription="carousel">
    
    <!-- Individual testimonials -->
    <div role="group" 
         x-bind:aria-label="`Testimonial ${index + 1}: ${testimonial.author} from ${testimonial.company}`"
         x-bind:aria-current="currentSlide === index ? 'true' : 'false'">
        
        <!-- Testimonial content with proper structure -->
        <blockquote aria-label="Customer testimonial">
            <p>"{{ testimonial.quote }}"</p>
            <cite aria-label="Testimonial author">
                <strong>{{ testimonial.author }}</strong>
                <span aria-label="Company">{{ testimonial.company }}</span>
            </cite>
        </blockquote>
    </div>
    
    <!-- Navigation controls -->
    <button aria-label="View previous testimonial" 
            x-bind:aria-disabled="currentSlide === 0 ? 'true' : 'false'">
    </button>
    
    <button aria-label="View next testimonial"
            x-bind:aria-disabled="currentSlide === maxSlides() ? 'true' : 'false'">
    </button>
</div>
```

### Screen Reader Announcements
```javascript
announceSlideChange() {
    const current = this.testimonials[this.currentSlide];
    return `Now showing testimonial from ${current.author} at ${current.company}`;
},

announceNavigation(direction) {
    const total = this.testimonials.length;
    const current = this.currentSlide + 1;
    return `Moved ${direction}. Now on testimonial ${current} of ${total}`;
}
```

## Visual Accessibility

### Color and Contrast
- **Minimum Contrast Ratio**: 4.5:1 for normal text, 3:1 for large text
- **Navigation Elements**: Ensure sufficient contrast in all themes
- **Focus Indicators**: High contrast focus rings (emerald-500 with 2px width)

### Color Independence
- Navigation must work without color (use icons + text)
- Active states indicated by more than just color
- Error states communicated through multiple channels

### Typography and Readability
```css
/* Ensure readable text sizes */
.testimonial-text {
    font-size: 1rem; /* 16px minimum */
    line-height: 1.6; /* Optimal reading line height */
}

.testimonial-author {
    font-size: 0.875rem; /* 14px minimum for metadata */
}
```

## Motion and Animation

### Reduced Motion Support
```css
@media (prefers-reduced-motion: reduce) {
    .testimonial-carousel {
        transition: none !important;
        transform: none !important;
    }
    
    .testimonial-slide {
        animation: none !important;
    }
}
```

### Animation Guidelines
- **Duration**: Keep transitions under 300ms
- **Easing**: Use `ease-in-out` for natural feel
- **Respect Preferences**: Honor `prefers-reduced-motion`
- **Optional**: Provide animation toggle in UI

## Touch and Mobile Accessibility

### Touch Target Sizes
- **Minimum Size**: 44x44px for all interactive elements
- **Navigation Buttons**: Larger on mobile (48x48px minimum)
- **Spacing**: Adequate space between touch targets

### Swipe Gestures
```javascript
// Ensure swipe gestures work with assistive technology
setupAccessibleSwipeGestures() {
    // Implement custom swipe detection that works with switch controls
    // and other assistive technologies
}
```

### Mobile Screen Reader Support
- Test with VoiceOver (iOS) and TalkBack (Android)
- Ensure swipe navigation doesn't interfere with screen reader gestures
- Provide alternative navigation methods for screen reader users

## Testing Requirements

### Automated Testing
```javascript
// Example Pest test for accessibility
it('has accessible carousel navigation', function() {
    $this->get('/')
         ->assertSee('aria-label="Customer testimonials"', false)
         ->assertSee('role="region"', false);
});

it('provides keyboard navigation', function() {
    // Test keyboard event handling
    // Verify focus management
    // Check ARIA attributes
});
```

### Manual Testing Checklist

#### Screen Reader Testing
- [ ] Test with NVDA (Windows)
- [ ] Test with JAWS (Windows)
- [ ] Test with VoiceOver (macOS/iOS)
- [ ] Test with TalkBack (Android)

#### Keyboard Testing
- [ ] Tab through all interactive elements
- [ ] Use arrow keys for carousel navigation
- [ ] Test with keyboard only (no mouse)
- [ ] Verify focus indicators are visible

#### Visual Testing
- [ ] Check color contrast ratios
- [ ] Test with high contrast mode
- [ ] Verify text scaling up to 200%
- [ ] Test with color blindness simulators

#### Motion Testing
- [ ] Enable `prefers-reduced-motion`
- [ ] Verify animations are disabled
- [ ] Test with vestibular disorder considerations

### Assistive Technology Compatibility

#### Screen Readers
- **NVDA**: Full compatibility required
- **JAWS**: Full compatibility required  
- **VoiceOver**: Full compatibility required
- **TalkBack**: Mobile compatibility required

#### Other Assistive Technologies
- **Voice Control**: Ensure voice commands work
- **Switch Controls**: Compatible with switch navigation
- **Eye Tracking**: Proper focus management for gaze-based control

## Documentation and Maintenance

### Accessibility Documentation
- Document all ARIA patterns used
- Maintain list of keyboard shortcuts
- Keep testing results and remediation notes
- Document known limitations and workarounds

### Future Enhancements
- Consider implementing `aria-describedby` for additional context
- Evaluate need for carousel auto-play controls
- Monitor for new ARIA patterns and best practices
- Plan for future WCAG updates (2.2, 3.0)