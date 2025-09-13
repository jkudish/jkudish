# Styling Guide Specification

This is the styling implementation guide for the spec detailed in @.agent-os/specs/dual-row-logo-carousel.md

> Created: 2025-09-10
> Version: 1.0.0

## Design System Integration

### Color Scheme
Following the existing site's dark/light mode design:
- **Logo Treatment**: Grayscale filter with opacity reduction for neutral appearance
- **Hover States**: Full color restoration with opacity increase
- **Background**: Transparent, relies on section background
- **Fade Gradients**: Black-to-transparent for mask effects

### Typography & Spacing
- **Section Spacing**: 4rem (py-16) top and bottom padding
- **Row Spacing**: 2rem (mb-8) between carousel rows
- **Logo Gaps**: 3rem (gap-12) between individual logos
- **Container**: Max-width of 7xl (1280px) with responsive padding

## Tailwind CSS Classes

### Container Structure
```html
<!-- Section wrapper -->
<section class="py-16 overflow-hidden">
    <!-- Container with max-width and padding -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Carousel wrapper -->
        <div class="relative" x-data="logoCarousel()">
            <!-- Row containers -->
            <div class="carousel-container mb-8">
                <!-- Scrolling row -->
                <div class="carousel-row flex items-center gap-12 will-change-transform">
                    <!-- Logo items -->
                    <div class="logo-item flex-shrink-0">
                        <img class="h-16 min-w-[160px] object-contain grayscale opacity-60 hover:grayscale-0 hover:opacity-100 transition-all duration-300">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
```

### Logo Styling Classes
```html
<img 
    src="..." 
    alt="..."
    class="h-16 min-w-[160px] object-contain grayscale opacity-60 hover:grayscale-0 hover:opacity-100 transition-all duration-300"
    loading="lazy"
>
```

**Class Breakdown:**
- `h-16`: Height of 4rem (64px)
- `min-w-[160px]`: Minimum width of 160px (arbitrary value)
- `object-contain`: Maintain aspect ratio within bounds
- `grayscale`: Apply grayscale filter by default
- `opacity-60`: 60% opacity for subtle appearance
- `hover:grayscale-0`: Remove grayscale on hover
- `hover:opacity-100`: Full opacity on hover
- `transition-all duration-300`: Smooth 300ms transitions
- `loading="lazy"`: Optimize image loading

## Custom CSS Implementation

### Gradient Mask Styles
```css
/* Add to resources/css/app.css */

.carousel-container {
    position: relative;
    overflow: hidden;
    width: 100%;
}

.carousel-row {
    display: flex;
    align-items: center;
    will-change: transform;
    
    /* Gradient mask for smooth edge fading */
    mask-image: linear-gradient(
        to right,
        transparent 0%,
        black 5%,
        black 95%,
        transparent 100%
    );
    
    /* WebKit prefix for broader browser support */
    -webkit-mask-image: linear-gradient(
        to right,
        transparent 0%,
        black 5%,
        black 95%,
        transparent 100%
    );
}

/* Hardware acceleration optimization */
.carousel-row {
    transform: translateZ(0);
    backface-visibility: hidden;
}

.logo-item {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Enhanced hover effects */
.logo-item img {
    transition: filter 0.3s ease, opacity 0.3s ease, transform 0.3s ease;
}

.logo-item:hover img {
    transform: scale(1.05);
}
```

### Performance Optimizations
```css
/* Optimize for smooth animation */
.carousel-row {
    will-change: transform;
    transform: translate3d(0, 0, 0); /* Force GPU acceleration */
    backface-visibility: hidden;
    perspective: 1000px;
}

/* Minimize paint and layout operations */
.logo-item img {
    will-change: filter, opacity, transform;
    contain: layout style paint;
}
```

## Responsive Design Breakpoints

### Mobile (< 640px)
```css
@media (max-width: 639px) {
    .carousel-row {
        gap: 2rem; /* Reduce from gap-12 to gap-8 */
    }
    
    .logo-item img {
        height: 3rem; /* Reduce from h-16 to h-12 */
        min-width: 120px; /* Reduce from 160px */
    }
    
    /* Adjust section padding */
    .carousel-section {
        padding-top: 3rem;
        padding-bottom: 3rem;
    }
}
```

### Small Mobile (< 480px)
```css
@media (max-width: 479px) {
    .carousel-row {
        gap: 1.5rem; /* Further reduce gap */
    }
    
    .logo-item img {
        height: 2.5rem; /* h-10 equivalent */
        min-width: 100px; /* Minimum viable size */
    }
    
    /* Adjust mask gradient for smaller screens */
    .carousel-row {
        mask-image: linear-gradient(
            to right,
            transparent 0%,
            black 8%,
            black 92%,
            transparent 100%
        );
        -webkit-mask-image: linear-gradient(
            to right,
            transparent 0%,
            black 8%,
            black 92%,
            transparent 100%
        );
    }
}
```

### Tablet (640px - 1024px)
```css
@media (min-width: 640px) and (max-width: 1023px) {
    /* Standard desktop sizing works well for tablet */
    .carousel-row {
        gap: 2.5rem; /* Slightly reduced gap */
    }
}
```

### Large Desktop (> 1280px)
```css
@media (min-width: 1280px) {
    /* Consider larger logos on very wide screens */
    .logo-item img {
        height: 4.5rem; /* h-18 equivalent */
        min-width: 180px;
    }
    
    .carousel-row {
        gap: 4rem; /* gap-16 for more spacious layout */
    }
}
```

## Dark Mode Considerations

### Logo Compatibility
Most logos should work well in both light and dark modes due to:
- Grayscale filter creating neutral appearance
- Transparent/white backgrounds adapting to context
- Hover states revealing original colors

### Optional Dark Mode Enhancements
```css
/* If specific dark mode logo handling is needed */
@media (prefers-color-scheme: dark) {
    .logo-item img {
        /* Slightly increase brightness for dark backgrounds */
        filter: grayscale(1) brightness(1.1);
    }
    
    .logo-item:hover img {
        filter: grayscale(0) brightness(1);
    }
}

/* Dark mode class-based approach */
.dark .logo-item img {
    filter: grayscale(1) brightness(1.1);
}

.dark .logo-item:hover img {
    filter: grayscale(0) brightness(1);
}
```

## Animation Styling

### Smooth Transform Application
```css
.carousel-row {
    /* Ensure smooth animation during JavaScript updates */
    transition: none; /* Prevent CSS transitions interfering with JS animation */
    will-change: transform;
}

/* Pause animation on reduced motion preference */
@media (prefers-reduced-motion: reduce) {
    .carousel-row {
        animation-play-state: paused;
    }
}
```

### Loading States
```css
/* Optional loading skeleton */
.logo-skeleton {
    width: 160px;
    height: 64px;
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: loading 1.5s infinite;
    border-radius: 4px;
}

@keyframes loading {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}

.dark .logo-skeleton {
    background: linear-gradient(90deg, #374151 25%, #4b5563 50%, #374151 75%);
    background-size: 200% 100%;
}
```

## Accessibility Styling

### Focus States
```css
.logo-item img {
    border-radius: 4px; /* Subtle rounding for focus outline */
}

.logo-item img:focus {
    outline: 2px solid #3b82f6; /* Blue focus ring */
    outline-offset: 2px;
}

.dark .logo-item img:focus {
    outline-color: #60a5fa; /* Lighter blue for dark mode */
}
```

### High Contrast Mode
```css
@media (prefers-contrast: high) {
    .logo-item img {
        filter: grayscale(1) contrast(1.2);
    }
    
    .logo-item:hover img {
        filter: grayscale(0) contrast(1.1);
    }
}
```

## Print Styles

### Print Optimization
```css
@media print {
    .carousel-container {
        overflow: visible;
    }
    
    .carousel-row {
        mask-image: none;
        -webkit-mask-image: none;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
    }
    
    .logo-item img {
        filter: grayscale(1);
        max-width: 120px;
        height: auto;
    }
}
```

## Quality Assurance

### Visual Testing Checklist
- [ ] Gradient masks render correctly across browsers
- [ ] Hover effects are smooth and consistent
- [ ] Responsive breakpoints work as expected
- [ ] Dark mode compatibility is maintained
- [ ] Print styles provide usable output
- [ ] Loading states display appropriately
- [ ] Focus states are visible and accessible
- [ ] High contrast mode is supported