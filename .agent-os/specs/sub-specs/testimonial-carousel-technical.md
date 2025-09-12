# Technical Specification

This is the technical specification for the spec detailed in @.agent-os/specs/testimonial-carousel.md

> Created: 2025-01-21
> Version: 1.0.0

## Technical Requirements

### Frontend Framework Integration
- **Primary Framework**: Laravel Blade templates
- **JavaScript Framework**: Alpine.js (lightweight, already in use)
- **CSS Framework**: TailwindCSS v3 with existing utility classes
- **Image Optimization**: WebP with PNG/JPG fallbacks using `<picture>` elements

### Carousel Architecture

#### HTML Structure
```html
<div x-data="testimonialCarousel()" class="relative">
    <!-- Carousel Container -->
    <div class="overflow-hidden" x-ref="container">
        <div class="flex transition-transform duration-300 ease-in-out" 
             x-bind:style="`transform: translateX(-${currentSlide * slideWidth}px)`">
            <!-- Testimonial Cards -->
            <div class="flex-none w-full md:w-1/2 px-4" 
                 x-for="testimonial in testimonials">
                <!-- Existing testimonial card structure -->
            </div>
        </div>
    </div>
    
    <!-- Navigation Controls -->
    <button x-on:click="previousSlide()" 
            x-show="showPrevious()" 
            class="absolute left-0 top-1/2 transform -translate-y-1/2">
        <!-- Previous arrow -->
    </button>
    <button x-on:click="nextSlide()" 
            x-show="showNext()" 
            class="absolute right-0 top-1/2 transform -translate-y-1/2">
        <!-- Next arrow -->
    </button>
    
    <!-- Progress Indicators -->
    <div class="flex justify-center mt-6 space-x-2">
        <button x-for="(testimonial, index) in testimonials" 
                x-on:click="goToSlide(index)"
                x-bind:class="currentSlide === index ? 'active' : 'inactive'">
        </button>
    </div>
</div>
```

#### Alpine.js Component Logic
```javascript
function testimonialCarousel() {
    return {
        currentSlide: 0,
        slideWidth: 0,
        testimonials: [], // Populated from Blade data
        
        init() {
            this.calculateSlideWidth();
            this.setupEventListeners();
            this.setupKeyboardNavigation();
        },
        
        calculateSlideWidth() {
            const container = this.$refs.container;
            this.slideWidth = container.offsetWidth;
        },
        
        nextSlide() {
            if (this.currentSlide < this.maxSlides()) {
                this.currentSlide++;
            }
        },
        
        previousSlide() {
            if (this.currentSlide > 0) {
                this.currentSlide--;
            }
        },
        
        goToSlide(index) {
            this.currentSlide = index;
        },
        
        maxSlides() {
            const breakpoint = this.getBreakpoint();
            const visibleSlides = breakpoint === 'mobile' ? 1 : 2;
            return Math.max(0, this.testimonials.length - visibleSlides);
        },
        
        showPrevious() {
            return this.currentSlide > 0;
        },
        
        showNext() {
            return this.currentSlide < this.maxSlides();
        },
        
        setupKeyboardNavigation() {
            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') this.previousSlide();
                if (e.key === 'ArrowRight') this.nextSlide();
            });
        },
        
        setupTouchGestures() {
            // Touch/swipe implementation for mobile
        }
    }
}
```

### Responsive Breakpoints
- **Mobile** (`< 768px`): 1 testimonial visible
- **Tablet** (`768px - 1024px`): 2 testimonials visible
- **Desktop** (`≥ 1024px`): 2 testimonials visible

### Image Optimization Strategy

#### Avatar Processing Pipeline
1. **Source**: Download from Twitter at 400x400px resolution
2. **Processing**:
   - Resize to 96x96px (2x the displayed 48x48px for retina)
   - Create WebP version with 85% quality
   - Keep original JPG as fallback with 90% quality
3. **Implementation**:
   ```html
   <picture>
       <source srcset="{{ asset('img/testimonials/bryce-adams.webp') }}" type="image/webp">
       <img src="{{ asset('img/testimonials/bryce-adams.jpg') }}" 
            alt="Bryce Adams" 
            class="w-12 h-12 rounded-full object-cover border-2 border-white dark:border-zinc-800 shadow-sm">
   </picture>
   ```

### Performance Optimizations

#### Lazy Loading Strategy
- Implement `IntersectionObserver` for off-screen testimonials
- Load images only when testimonials are about to become visible
- Progressive enhancement approach (works without JavaScript)

#### CSS Optimizations
```css
/* Smooth scrolling with hardware acceleration */
.testimonial-carousel {
    transform: translate3d(0, 0, 0);
    will-change: transform;
}

/* Reduced motion support */
@media (prefers-reduced-motion: reduce) {
    .testimonial-carousel {
        transition: none !important;
    }
}
```

### Accessibility Implementation

#### ARIA Attributes
- `role="region"` on carousel container
- `aria-label="Customer testimonials"` on carousel
- `aria-live="polite"` for slide change announcements
- `aria-current="true"` on active slide indicator

#### Keyboard Navigation
- Arrow keys for navigation
- Tab focus management for navigation controls
- Enter/Space key activation for buttons

#### Screen Reader Support
```html
<div aria-live="polite" aria-atomic="true" class="sr-only">
    Testimonial <span x-text="currentSlide + 1"></span> of <span x-text="testimonials.length"></span>
</div>
```

## Approach

### Implementation Strategy
1. **Progressive Enhancement**: Start with functional static layout
2. **Component-Based**: Maintain existing Blade component structure
3. **Mobile-First**: Design for mobile, enhance for larger screens
4. **Performance-Conscious**: Optimize for Core Web Vitals

### Technology Choices
- **Alpine.js**: Lightweight, already in project, perfect for carousel logic
- **CSS Grid/Flexbox**: For layout flexibility and responsive design
- **TailwindCSS**: Maintain consistency with existing design system
- **Vanilla JavaScript**: For touch gestures and advanced interactions

### File Structure Changes
```
resources/views/components/home/
├── social-proof.blade.php (updated)
└── testimonial-carousel.blade.php (new component)

public/img/testimonials/
├── bryce-adams.jpg (new)
├── bryce-adams.webp (new)
├── greg-isenberg.jpg (existing)
├── greg-isenberg.webp (existing)
├── jill-binder.jpg (new)
├── jill-binder.webp (new)
├── john-wu.jpg (new - placeholder)
├── john-wu.webp (new - placeholder)
├── justin-evans.jpg (existing)
└── justin-evans.webp (existing)
```

## External Dependencies

### Image Processing Tools
- **ImageMagick** or **Sharp**: For batch image optimization
- **WebP conversion**: Built into most modern image processing tools

### Runtime Dependencies
- **Alpine.js**: Already included in project
- **TailwindCSS**: Already included in project
- No additional NPM packages required

### Browser Support
- **Modern browsers**: Full functionality with Alpine.js and CSS Grid
- **Legacy browsers**: Graceful degradation to static layout
- **Mobile browsers**: Touch gesture support via native JavaScript events

### Performance Budget
- **Images**: Max 10KB per avatar (WebP format)
- **JavaScript**: Max 2KB additional for carousel functionality
- **CSS**: Utilize existing TailwindCSS classes, minimal custom CSS
- **Core Web Vitals**: Maintain existing scores or improve