# Technical Implementation Specification

This is the technical implementation for the spec detailed in @.agent-os/specs/dual-row-logo-carousel.md

> Created: 2025-09-10
> Version: 1.0.0

## Alpine.js Component Structure

### Main Component Data
```javascript
{
    // Animation state
    scrollPosition1: 0,          // Top row position
    scrollPosition2: 0,          // Bottom row position
    animationId: null,           // setInterval ID
    isAnimating: true,           // Animation control
    
    // Configuration
    scrollSpeed: 1,              // Pixels per frame
    frameRate: 30,               // Milliseconds between frames
    
    // Calculated values
    rowWidth: 0,                 // Width of single logo set
    logoCount1: 12,              // Top row logo count
    logoCount2: 11,              // Bottom row logo count
    
    // Initialization
    init() {
        this.calculateRowWidths();
        this.startAnimation();
        this.handleVisibilityChange();
    },
    
    // Animation control
    startAnimation() {
        if (this.animationId) return;
        
        this.animationId = setInterval(() => {
            if (!this.isAnimating) return;
            
            // Update positions
            this.scrollPosition1 -= this.scrollSpeed;  // Right to left
            this.scrollPosition2 += this.scrollSpeed;  // Left to right
            
            // Reset for seamless loop
            if (Math.abs(this.scrollPosition1) >= this.rowWidth) {
                this.scrollPosition1 = 0;
            }
            if (this.scrollPosition2 >= this.rowWidth) {
                this.scrollPosition2 = 0;
            }
            
            // Apply transforms
            this.updateRowTransforms();
        }, this.frameRate);
    },
    
    stopAnimation() {
        if (this.animationId) {
            clearInterval(this.animationId);
            this.animationId = null;
        }
    },
    
    // Transform application
    updateRowTransforms() {
        const row1 = this.$refs.row1;
        const row2 = this.$refs.row2;
        
        if (row1) {
            row1.style.transform = `translateX(${this.scrollPosition1}px)`;
        }
        if (row2) {
            row2.style.transform = `translateX(${this.scrollPosition2}px)`;
        }
    },
    
    // Width calculations
    calculateRowWidths() {
        // Logo width (160px) + gap (48px) = 208px per logo
        this.rowWidth = Math.max(this.logoCount1, this.logoCount2) * 208;
    },
    
    // Pause animation when tab is not visible
    handleVisibilityChange() {
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                this.isAnimating = false;
            } else {
                this.isAnimating = true;
            }
        });
    }
}
```

## Blade Component Template

### Main Component Structure
```blade
{{-- resources/views/components/home/dual-logo-carousel.blade.php --}}
<section class="py-16 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header (optional) -->
        <div class="text-center mb-12">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                Trusted by Industry Leaders
            </h2>
        </div>
        
        <!-- Dual Logo Carousel -->
        <div 
            x-data="logoCarousel()" 
            class="relative"
            x-init="init()"
        >
            <!-- Top Row -->
            <div class="carousel-container mb-8">
                <div 
                    x-ref="row1"
                    class="carousel-row flex items-center gap-12 will-change-transform"
                    style="width: {{ ($topRowLogos->count() * 3 * 208) }}px;"
                >
                    <!-- Triplicated logos for seamless loop -->
                    @for($i = 0; $i < 3; $i++)
                        @foreach($topRowLogos as $logo)
                            <div class="logo-item flex-shrink-0">
                                <img 
                                    src="{{ $logo['src'] }}" 
                                    alt="{{ $logo['alt'] }}"
                                    class="h-16 min-w-[160px] object-contain grayscale opacity-60 hover:grayscale-0 hover:opacity-100 transition-all duration-300"
                                    loading="lazy"
                                >
                            </div>
                        @endforeach
                    @endfor
                </div>
            </div>
            
            <!-- Bottom Row -->
            <div class="carousel-container">
                <div 
                    x-ref="row2"
                    class="carousel-row flex items-center gap-12 will-change-transform"
                    style="width: {{ ($bottomRowLogos->count() * 3 * 208) }}px;"
                >
                    <!-- Triplicated logos for seamless loop -->
                    @for($i = 0; $i < 3; $i++)
                        @foreach($bottomRowLogos as $logo)
                            <div class="logo-item flex-shrink-0">
                                <img 
                                    src="{{ $logo['src'] }}" 
                                    alt="{{ $logo['alt'] }}"
                                    class="h-16 min-w-[160px] object-contain grayscale opacity-60 hover:grayscale-0 hover:opacity-100 transition-all duration-300"
                                    loading="lazy"
                                >
                            </div>
                        @endforeach
                    @endfor
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function logoCarousel() {
    return {
        scrollPosition1: 0,
        scrollPosition2: 0,
        animationId: null,
        isAnimating: true,
        scrollSpeed: 1,
        frameRate: 30,
        rowWidth: 0,
        logoCount1: {{ $topRowLogos->count() }},
        logoCount2: {{ $bottomRowLogos->count() }},
        
        init() {
            this.calculateRowWidths();
            this.startAnimation();
            this.handleVisibilityChange();
        },
        
        startAnimation() {
            if (this.animationId) return;
            
            this.animationId = setInterval(() => {
                if (!this.isAnimating) return;
                
                this.scrollPosition1 -= this.scrollSpeed;
                this.scrollPosition2 += this.scrollSpeed;
                
                if (Math.abs(this.scrollPosition1) >= this.rowWidth) {
                    this.scrollPosition1 = 0;
                }
                if (this.scrollPosition2 >= this.rowWidth) {
                    this.scrollPosition2 = 0;
                }
                
                this.updateRowTransforms();
            }, this.frameRate);
        },
        
        stopAnimation() {
            if (this.animationId) {
                clearInterval(this.animationId);
                this.animationId = null;
            }
        },
        
        updateRowTransforms() {
            if (this.$refs.row1) {
                this.$refs.row1.style.transform = `translateX(${this.scrollPosition1}px)`;
            }
            if (this.$refs.row2) {
                this.$refs.row2.style.transform = `translateX(${this.scrollPosition2}px)`;
            }
        },
        
        calculateRowWidths() {
            this.rowWidth = Math.max(this.logoCount1, this.logoCount2) * 208;
        },
        
        handleVisibilityChange() {
            document.addEventListener('visibilitychange', () => {
                if (document.hidden) {
                    this.isAnimating = false;
                } else {
                    this.isAnimating = true;
                }
            });
        }
    }
}
</script>
```

## CSS Implementation

### Carousel Styles
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
    
    /* Gradient mask for fade effects */
    mask-image: linear-gradient(
        to right,
        transparent 0%,
        black 5%,
        black 95%,
        transparent 100%
    );
    -webkit-mask-image: linear-gradient(
        to right,
        transparent 0%,
        black 5%,
        black 95%,
        transparent 100%
    );
}

.logo-item {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.logo-item img {
    transition: filter 0.3s ease, opacity 0.3s ease;
}

/* Responsive adjustments */
@media (max-width: 640px) {
    .carousel-row {
        gap: 2rem; /* Reduce gap on mobile */
    }
    
    .logo-item img {
        height: 3rem; /* Smaller logos on mobile */
        min-width: 120px;
    }
}

@media (max-width: 480px) {
    .carousel-row {
        gap: 1.5rem;
    }
    
    .logo-item img {
        height: 2.5rem;
        min-width: 100px;
    }
}
```

## Logo Data Management

### Component Data Structure
```php
<?php
// In the component class or controller

$logos = [
    ['src' => '/img/companies/company1.png', 'alt' => 'Company 1'],
    ['src' => '/img/companies/company2.png', 'alt' => 'Company 2'],
    // ... 23 total logos
];

// Split logos between rows
$topRowLogos = collect($logos)->take(12);
$bottomRowLogos = collect($logos)->skip(12);
```

## Performance Optimizations

### Hardware Acceleration
- Use `will-change: transform` on animated elements
- Apply transforms via JavaScript for smooth animation
- Minimize DOM queries by caching references

### Memory Management
- Clear intervals when component is destroyed
- Pause animation when page is not visible
- Use efficient logo triplication strategy

### Responsive Calculations
- Dynamically calculate row widths based on logo count
- Adjust animation speed based on screen size
- Implement efficient responsive breakpoints

## Browser Compatibility

### Modern Browser Support
- CSS mask-image with webkit prefix fallback
- setInterval-based animation for broad compatibility
- Transform-based positioning for hardware acceleration

### Fallback Strategies
- Graceful degradation for browsers without mask support
- Alternative fade effects using pseudo-elements if needed
- JavaScript feature detection for advanced functionality