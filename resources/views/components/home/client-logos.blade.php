@php
// Define style classes for different logo types (no hover effects)
// All logos now have aggressive darkening in light mode for better visibility
$logoStyles = [
    // Standard - all logos get darkened in light mode, inverted in dark mode
    'standard' => 'grayscale brightness-[0.3] opacity-90 dark:brightness-0 dark:invert dark:opacity-70',
    
    // Light logos that need inversion in light mode plus darkening
    'invert' => 'invert grayscale brightness-75 opacity-80 dark:invert-0 dark:brightness-200 dark:grayscale dark:opacity-70',
    
    // Logos that don't need darkening in light mode (already dark enough)
    'no-darken' => 'grayscale opacity-60 dark:brightness-0 dark:invert dark:opacity-70',
    
    // Special logos that need brightness boost instead of inversion in dark mode
    'colorful' => 'grayscale opacity-70 dark:grayscale dark:brightness-150 dark:opacity-90',
];

// Reorganized to distribute WordPress family companies across both rows
$allCompanies = [
    // Top row (first half) - all use 'standard' style now
    ['name' => 'WooCommerce', 'webp' => url('img/companies/woo.webp'), 'png' => url('img/companies/woo.png'), 'size' => 'max-h-14', 'classes' => $logoStyles['standard']],
    ['name' => 'TechCrunch', 'webp' => url('img/companies/techcrunch.webp'), 'png' => url('img/companies/techcrunch.png'), 'size' => 'max-h-20', 'classes' => $logoStyles['standard']],
    ['name' => '10up', 'webp' => url('img/companies/10up.webp'), 'png' => url('img/companies/10up.png'), 'size' => 'max-h-10', 'classes' => $logoStyles['standard']],
    ['name' => 'Metorik', 'webp_light' => url('img/companies/metorik-light.webp'), 'png_light' => url('img/companies/metorik-light.png'), 'webp_dark' => url('img/companies/metorik-dark.webp'), 'png_dark' => url('img/companies/metorik-dark.png'), 'size' => 'max-h-10', 'has_variants' => true],
    ['name' => "Sotheby's", 'webp' => url('img/companies/sothebys.webp'), 'png' => url('img/companies/sothebys.png'), 'size' => 'max-h-16', 'classes' => $logoStyles['standard']],
    ['name' => 'TELUS Health', 'webp' => url('img/companies/telus-health.webp'), 'png' => url('img/companies/telus-health.png'), 'size' => 'max-h-16', 'classes' => $logoStyles['standard']],
    ['name' => 'Pantheon', 'webp' => url('img/companies/pantheon.webp'), 'png' => url('img/companies/pantheon.png'), 'size' => 'max-h-10', 'classes' => $logoStyles['standard']],
    ['name' => 'Modern Tribe', 'webp' => url('img/companies/modern-tribe.webp'), 'png' => url('img/companies/modern-tribe.png'), 'size' => 'max-h-20', 'classes' => $logoStyles['invert']],
    ['name' => 'FedEx', 'webp' => url('img/companies/fedex.webp'), 'png' => url('img/companies/fedex.png'), 'size' => 'max-h-10', 'classes' => $logoStyles['no-darken']],
    ['name' => 'Automattic', 'webp' => url('img/companies/automattic.webp'), 'png' => url('img/companies/automattic.png'), 'size' => 'max-h-10', 'classes' => $logoStyles['invert']],
    ['name' => 'BC SPCA', 'webp' => url('img/companies/bcspca.webp'), 'png' => url('img/companies/bcspca.png'), 'size' => 'max-h-14', 'classes' => $logoStyles['standard']],
    ['name' => 'The Events Calendar', 'webp' => url('img/companies/the-events-calendar.webp'), 'png' => url('img/companies/the-events-calendar.png'), 'size' => 'max-h-20', 'classes' => $logoStyles['standard']],
    
    // Bottom row (second half) - all use 'standard' style now
    ['name' => 'Image Salon', 'webp' => url('img/companies/image-salon.webp'), 'png' => url('img/companies/image-salon.png'), 'size' => 'max-h-16', 'classes' => $logoStyles['standard']],
    ['name' => 'WordPress VIP', 'webp' => url('img/companies/wp-vip.webp'), 'png' => url('img/companies/wp-vip.png'), 'size' => 'max-h-10', 'classes' => $logoStyles['standard']],
    ['name' => 'DVLOP', 'webp' => url('img/companies/dvlop.webp'), 'png' => url('img/companies/dvlop.png'), 'size' => 'max-h-10', 'classes' => $logoStyles['standard']],
    ['name' => 'Teelaunch', 'webp' => url('img/companies/teelaunch.webp'), 'png' => url('img/companies/teelaunch.png'), 'size' => 'max-h-20', 'classes' => $logoStyles['standard']],
    ['name' => 'PHAiTO', 'webp' => url('img/companies/phaito.webp'), 'png' => url('img/companies/phaito.png'), 'size' => 'max-h-8', 'classes' => $logoStyles['standard']],
    ['name' => 'Spark Consulting', 'webp_light' => url('img/companies/spark-consulting-light.webp'), 'png_light' => url('img/companies/spark-consulting-light.png'), 'webp_dark' => url('img/companies/spark-consulting-dark.webp'), 'png_dark' => url('img/companies/spark-consulting-dark.png'), 'size' => 'max-h-20', 'has_variants' => true],
    ['name' => 'SmarterQueue', 'webp' => url('img/companies/smarterqueue.webp'), 'png' => url('img/companies/smarterqueue.png'), 'size' => 'max-h-10', 'classes' => $logoStyles['standard']],
    ['name' => 'Turquoise Goat', 'webp' => url('img/companies/turquoise-goat.webp'), 'png' => url('img/companies/turquoise-goat.png'), 'size' => 'max-h-20', 'classes' => $logoStyles['invert']],
    ['name' => 'FSquared Marketing', 'webp' => url('img/companies/fsquared.webp'), 'png' => url('img/companies/fsquared.png'), 'size' => 'max-h-20', 'classes' => $logoStyles['standard']],
    ['name' => 'Infrarouge', 'webp' => url('img/companies/infrarouge.webp'), 'png' => url('img/companies/infrarouge.png'), 'size' => 'max-h-14', 'classes' => $logoStyles['standard']],
    ['name' => 'Trusted Advisors', 'webp' => url('img/companies/trusted-advisors.webp'), 'png' => url('img/companies/trusted-advisors.png'), 'size' => 'max-h-20', 'classes' => $logoStyles['standard']],
];

// Split logos into two rows
$halfPoint = ceil(count($allCompanies) / 2);
$topRowLogos = array_slice($allCompanies, 0, $halfPoint);
$bottomRowLogos = array_slice($allCompanies, $halfPoint);

// Triplicate logos for seamless loop
$topRowLogos = array_merge($topRowLogos, $topRowLogos, $topRowLogos);
$bottomRowLogos = array_merge($bottomRowLogos, $bottomRowLogos, $bottomRowLogos);
@endphp

<div x-data="dualRowCarousel()" x-init="init()" class="w-full overflow-hidden py-8">
    {{-- Section Header --}}
    <div class="text-center mb-8">
        <x-ui.typography variant="small" color="muted" weight="semibold" class="uppercase tracking-wider">
            Successful projects delivered for:
        </x-ui.typography>
    </div>

    {{-- Dual Row Carousel --}}
    <div class="space-y-4 sm:space-y-8">
        {{-- Top Row (scrolls right to left) --}}
        <div x-ref="topRow" 
             class="flex gap-8 sm:gap-16 overflow-hidden logo-carousel-mask">
            @foreach($topRowLogos as $index => $company)
            <div class="flex-shrink-0 flex items-center justify-center min-w-[120px] sm:min-w-[160px] h-20">
                @if(isset($company['has_variants']) && $company['has_variants'])
                    {{-- Light mode image --}}
                    <picture class="block dark:hidden">
                        <source srcset="{{ $company['webp_light'] }}" type="image/webp">
                        <img 
                            src="{{ $company['png_light'] }}" 
                            alt="{{ $company['name'] }}"
                            loading="lazy"
                            class="{{ $company['size'] }} w-auto object-contain"
                        />
                    </picture>
                    {{-- Dark mode image --}}
                    <picture class="hidden dark:block">
                        <source srcset="{{ $company['webp_dark'] }}" type="image/webp">
                        <img 
                            src="{{ $company['png_dark'] }}" 
                            alt="{{ $company['name'] }}"
                            loading="lazy"
                            class="{{ $company['size'] }} w-auto object-contain"
                        />
                    </picture>
                @else
                    <picture>
                        <source srcset="{{ $company['webp'] }}" type="image/webp">
                        <img 
                            src="{{ $company['png'] }}" 
                            alt="{{ $company['name'] }}"
                            loading="lazy"
                            class="{{ $company['size'] }} w-auto object-contain {{ $company['classes'] }}"
                        />
                    </picture>
                @endif
            </div>
            @endforeach
        </div>

        {{-- Bottom Row (scrolls left to right) --}}
        <div x-ref="bottomRow" 
             class="flex gap-8 sm:gap-16 overflow-hidden logo-carousel-mask">
            @foreach($bottomRowLogos as $index => $company)
            <div class="flex-shrink-0 flex items-center justify-center min-w-[120px] sm:min-w-[160px] h-20">
                @if(isset($company['has_variants']) && $company['has_variants'])
                    {{-- Light mode image --}}
                    <picture class="block dark:hidden">
                        <source srcset="{{ $company['webp_light'] }}" type="image/webp">
                        <img 
                            src="{{ $company['png_light'] }}" 
                            alt="{{ $company['name'] }}"
                            loading="lazy"
                            class="{{ $company['size'] }} w-auto object-contain"
                        />
                    </picture>
                    {{-- Dark mode image --}}
                    <picture class="hidden dark:block">
                        <source srcset="{{ $company['webp_dark'] }}" type="image/webp">
                        <img 
                            src="{{ $company['png_dark'] }}" 
                            alt="{{ $company['name'] }}"
                            loading="lazy"
                            class="{{ $company['size'] }} w-auto object-contain"
                        />
                    </picture>
                @else
                    <picture>
                        <source srcset="{{ $company['webp'] }}" type="image/webp">
                        <img 
                            src="{{ $company['png'] }}" 
                            alt="{{ $company['name'] }}"
                            loading="lazy"
                            class="{{ $company['size'] }} w-auto object-contain {{ $company['classes'] }}"
                        />
                    </picture>
                @endif
            </div>
            @endforeach
        </div>
    </div>

    {{-- Additional copy about other clients --}}
    <div class="mt-8 text-center">
        <x-ui.typography variant="small" color="muted">
            Plus dozens of startups, agencies, and innovative companies across e-commerce and SaaS industries
        </x-ui.typography>
    </div>
</div>

<script>
function dualRowCarousel() {
    return {
        topScrollPosition: 0,
        bottomScrollPosition: 0,
        animationFrameId: null,
        isVisible: true,
        
        init() {
            // Start animation
            this.startAnimation();
            
            // Handle visibility changes
            document.addEventListener('visibilitychange', () => {
                if (document.hidden) {
                    this.pauseAnimation();
                } else {
                    this.resumeAnimation();
                }
            });
            
            // Handle page unload
            window.addEventListener('beforeunload', () => {
                this.pauseAnimation();
            });
        },
        
        startAnimation() {
            const topRow = this.$refs.topRow;
            const bottomRow = this.$refs.bottomRow;
            
            if (!topRow || !bottomRow) return;
            
            // Get the scroll width and client width
            const topScrollWidth = topRow.scrollWidth;
            const topClientWidth = topRow.clientWidth;
            const bottomScrollWidth = bottomRow.scrollWidth;
            const bottomClientWidth = bottomRow.clientWidth;
            
            // Initialize bottom row scroll position
            this.bottomScrollPosition = bottomScrollWidth - bottomClientWidth;
            bottomRow.scrollLeft = this.bottomScrollPosition;
            
            const animate = () => {
                if (!this.isVisible) return;
                
                // Determine scroll speed based on screen size
                const isMobile = window.innerWidth < 640; // sm breakpoint
                const scrollSpeed = isMobile ? 0.5 : 0.25; // Faster on mobile
                
                // Scroll top row right to left
                this.topScrollPosition += scrollSpeed;
                if (this.topScrollPosition >= topScrollWidth / 3) {
                    this.topScrollPosition = 0;
                }
                topRow.scrollLeft = this.topScrollPosition;
                
                // Scroll bottom row left to right
                this.bottomScrollPosition -= scrollSpeed;
                if (this.bottomScrollPosition <= 0) {
                    this.bottomScrollPosition = bottomScrollWidth / 3;
                }
                bottomRow.scrollLeft = this.bottomScrollPosition;
                
                this.animationFrameId = requestAnimationFrame(animate);
            };
            
            // Start the animation
            this.animationFrameId = requestAnimationFrame(animate);
        },
        
        pauseAnimation() {
            this.isVisible = false;
            if (this.animationFrameId) {
                cancelAnimationFrame(this.animationFrameId);
                this.animationFrameId = null;
            }
        },
        
        resumeAnimation() {
            this.isVisible = true;
            if (!this.animationFrameId) {
                this.startAnimation();
            }
        }
    }
}
</script>

<style>
.logo-carousel-mask {
    mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
    -webkit-mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
}
</style>