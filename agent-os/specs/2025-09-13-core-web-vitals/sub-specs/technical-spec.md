# Technical Specification

This is the technical specification for the spec detailed in @.agent-os/specs/2025-09-13-core-web-vitals/spec.md

## Technical Requirements

### JavaScript Optimization
- **Code Splitting**: Implement route-based code splitting using Vite's dynamic imports
- **Defer Non-Critical Scripts**: Add defer attribute to non-critical JavaScript files
- **Remove Unused Code**: Tree-shake Alpine.js to include only used components
- **Minimize Execution Time**: Reduce main thread blocking from 640ms to under 200ms

### Asset Loading Optimization
- **Preconnect to Origins**: Add preconnect hints for external domains (fonts, analytics)
- **Preload Critical Resources**: Preload critical fonts and above-fold images
- **Lazy Load Images**: Implement native lazy loading for below-fold images
- **Optimize Font Loading**: Use font-display: swap for web fonts to prevent invisible text

### Build Configuration
- **Vite Optimization**: Configure rollupOptions for optimal chunking strategy
- **Minification**: Ensure all CSS and JavaScript is properly minified
- **Compression**: Enable gzip/brotli compression for text assets
- **Cache Headers**: Set appropriate cache headers for static assets

### HTML & CSS Optimization
- **Critical CSS**: Inline critical CSS for above-fold content
- **Remove Unused CSS**: Purge unused TailwindCSS classes in production
- **Optimize CSS Delivery**: Load non-critical CSS asynchronously
- **Reduce DOM Size**: Simplify HTML structure where possible

### Performance Metrics Targets
- **First Contentful Paint (FCP)**: < 1.5s (currently 1.9s)
- **Largest Contentful Paint (LCP)**: < 2.5s (currently 2.7s)
- **Total Blocking Time (TBT)**: < 200ms (currently 640ms)
- **Speed Index**: < 3.0s (currently 4.0s)
- **Time to Interactive (TTI)**: < 2.5s (currently 2.9s)

### Implementation Priority
1. Reduce JavaScript blocking time (highest impact)
2. Optimize font loading strategy
3. Implement code splitting
4. Add resource hints (preconnect, preload)
5. Optimize build configuration