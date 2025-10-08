# Speaking Page Redesign

## Overview

Redesign the speaking page to maintain visual consistency with the home, services, and projects pages while preserving all existing content. The page should use the same design patterns, components, and layout structure established across the site.

## Goals

1. **Visual Consistency**: Match the design language of home, services, and projects pages
2. **Hero Treatment**: Implement the same hero layout as the homepage with Joey's photo
3. **Container Structure**: Use the same container and section patterns from other pages
4. **Clean Presentation**: Format conference presentations using existing design elements
5. **No Content Changes**: Keep all existing conference data and text

## Technical Requirements

### Layout Structure
- Use the same `x-layout` wrapper
- Implement the rounded container with backdrop blur effect
- Match the section padding and spacing from other pages
- Use consistent border treatments between sections

### Hero Section
- Mirror the homepage hero layout with two-column grid
- Left column: Text content (current speaking page intro text)
- Right column: Joey's photo (same treatment as homepage)
- Use the same gradient overlay and mesh background pattern
- Include the "Hey, I'm Joey 👋" greeting

### Conference Presentations
- Organize presentations in a clean, scannable format
- Reuse existing UI components and patterns
- Group by visual hierarchy (title, conference info, location)
- Maintain the download slides functionality
- Apply consistent hover states and transitions

### Design Elements to Reuse
- Typography components (`x-ui.typography`)
- Gradient buttons (`x-ui.gradient-button`)
- Icon components with consistent sizing
- Color palette (emerald, teal, zinc)
- Border and shadow treatments
- Dark mode support

## Implementation Details

### Hero Section Structure
```blade
- Grid layout (lg:grid-cols-2)
- Text content on left (order-2 lg:order-1)
- Photo on right (order-1 lg:order-2)
- Gradient overlay backgrounds
- Mesh gradient pattern
```

### Conference List Design
- Use cards or list items with consistent spacing
- Clear visual hierarchy for:
  - Presentation title (prominent)
  - Conference name and location (secondary)
  - Download link (action item)
- Apply hover effects similar to project cards
- Consider grouping by year or adding subtle dividers

### Component Reuse
- `x-ui.typography` for headings
- `x-icon` for visual indicators
- Consistent color classes (text-zinc-*, dark:text-zinc-*)
- Border styles (border-zinc-200/30 dark:border-zinc-700/50)
- Shadow and hover transitions

## Constraints

- **No new content**: Do not add any additional text or data
- **No over-engineering**: Use existing patterns, don't create new ones
- **Maintain functionality**: Keep all links and download functionality
- **Clean design**: Avoid visual clutter or unnecessary embellishments

## Success Criteria

1. Speaking page matches the visual style of home, services, and projects pages
2. Hero section mirrors homepage layout with Joey's photo
3. Conference presentations are cleanly formatted and easy to scan
4. All existing content and functionality is preserved
5. Page maintains responsive design and dark mode support
6. Consistent use of existing UI components and design patterns