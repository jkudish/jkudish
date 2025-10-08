# Technical Specification

This is the technical specification for the spec detailed in @.agent-os/specs/2025-09-10-projects-page-enhancement/spec.md

## Technical Requirements

### Container Structure
- Wrap the projects page content in the same container pattern used on the home page
- Use `<div class="flex justify-center my-8 lg:my-12">` as the outer wrapper
- Apply `<div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">` for consistent width and padding
- Implement the card container with `bg-white/90 dark:bg-zinc-900/80 backdrop-blur-xl rounded-lg overflow-hidden shadow-lg`

### Current Projects Section
- Reuse the existing `<x-home.current-projects />` component or copy its content directly
- Remove the Invoice → Xero Automation project from the projects array
- Maintain the same grid layout: `grid gap-6 sm:grid-cols-2 lg:grid-cols-3`
- Preserve hover effects and card styling with borders, shadows, and transitions
- Keep status badges with their color-coded styling (building, coming_soon, launched)

### Past Work Section Improvements
- Convert the current list-based layout to a card-based grid design
- Apply consistent card styling with borders and hover effects
- Use `rounded-2xl border border-zinc-200/50 dark:border-zinc-700/40` for cards
- Add subtle background colors alternating between sections
- Improve typography hierarchy with proper heading styles
- Add visual icons or indicators for each category

### Proven Track Record Integration
- Include the full `<x-home.social-proof />` component on the projects page
- Position it after the past work section for logical flow
- Ensure the metrics grid displays correctly: `grid gap-8 sm:grid-cols-2 lg:grid-cols-4`
- Verify the testimonial carousel functionality works with Alpine.js
- Include the client logos section as part of social proof

### Layout Sections
- Structure the page with clear visual sections using alternating backgrounds
- Apply `bg-white dark:bg-zinc-900` and `bg-zinc-50/50 dark:bg-zinc-800/50` alternately
- Use border separators: `border-t border-zinc-200/30 dark:border-zinc-700/50`
- Maintain consistent padding: `px-6 sm:px-8 lg:px-10 py-12 lg:py-16 xl:py-20`

### CTA Section
- Update the call-to-action at the bottom to be more prominent
- Consider using a gradient button or more compelling design
- Ensure proper routing to services page

### Copywriting Improvements
- Review and refine the page header description for clarity and impact
- Update section headings to be more engaging
- Ensure consistent tone throughout the page
- Add brief introductions to each section where appropriate

### Performance Considerations
- Ensure all images are optimized and use WebP format with fallbacks
- Maintain lazy loading for images below the fold
- Keep Alpine.js interactions lightweight
- Verify no layout shift occurs during page load