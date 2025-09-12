# UI/UX Specification

This is the UI/UX specification for the spec detailed in @.agent-os/specs/2025-09-12-fun-404-page/spec.md

## Visual Concept

### Illustration Options
1. **404 Monster** - A friendly, quirky monster holding or eating the "404" numbers
   - Color scheme: Purple/pink gradient to match site accents
   - Style: Playful, geometric, modern illustration
   - Animation: Subtle floating animation using existing `float` class

2. **Lost in Space** - An astronaut or robot floating in digital space
   - Include stars, planets made of code brackets or pixels
   - Matches the "digital void" messaging concept
   - Could incorporate the site's gradient colors as nebula effects

3. **Maze Concept** - A character at the center of a simple maze
   - Represents being lost but with a clear path out
   - Could use site's teal/emerald for maze walls
   - Exit points lead to main navigation sections

### Layout Structure

```
┌─────────────────────────────────────┐
│         [Navigation Bar]            │
├─────────────────────────────────────┤
│                                     │
│         [404 Illustration]          │
│            200-300px height         │
│                                     │
│         "404"                       │
│    (Large, Gradient Text)           │
│                                     │
│    "Oops! Page Not Found"           │
│     (Playful Heading)               │
│                                     │
│  "Looks like this page wandered     │
│   off into the digital wilderness"   │
│     (Descriptive Subtext)           │
│                                     │
│  [Home] [Services] [Speaking]       │
│       (Action Buttons)              │
│                                     │
│   "Lost? Try starting from the      │
│    homepage or check the URL"       │
│      (Helper Text)                  │
│                                     │
├─────────────────────────────────────┤
│           [Footer]                  │
└─────────────────────────────────────┘
```

## Messaging Options

### Primary Headlines (rotate or A/B test)
- "Oops! This page got lost in the digital void"
- "404: Page not found, but your future project is!"
- "Hmm, this page seems to have wandered off"
- "Lost? Don't worry, even the best developers hit 404s"

### Supporting Text Options
- "The page you're looking for might have been moved, deleted, or perhaps it never existed in this timeline."
- "While you're here, why not explore what I can build for you?"
- "Let's get you back on track. Where would you like to go?"

## Interactive Elements

### Buttons
- Use existing `gradient-button` component
- Primary CTA: "Take Me Home" → links to homepage
- Secondary CTAs: "View Services", "See My Work", "Get in Touch"
- Hover states: Lift effect with shadow (existing hover classes)

### Micro-interactions
- Illustration: Gentle `float` animation on load
- 404 text: `fade-in` with `slide-up` animation
- Buttons: Staggered entrance using animation delays
- On hover: Illustration could have subtle reaction (eyes follow cursor, slight tilt)

## Color Palette Application

### Light Mode
- Background: Existing gradient mesh background
- 404 Numbers: `text-gradient-primary` (teal to emerald)
- Illustration: Purple/pink accents with teal highlights
- Text: Standard gray-900 for readability
- Buttons: Primary gradient style

### Dark Mode
- Background: Dark gradient with subtle grid overlay
- 404 Numbers: Brighter gradient for contrast
- Illustration: Adjusted colors for dark background
- Text: gray-100 for primary, gray-400 for secondary
- Buttons: Maintain gradient with adjusted brightness

## Mobile Considerations

### Breakpoint Adjustments
- **Mobile (< 640px)**
  - Illustration: 150-200px max height
  - 404 text: 4rem font size
  - Buttons: Full width, stacked vertically
  - Padding: 1.5rem horizontal

- **Tablet (640px - 1024px)**
  - Illustration: 200-250px height
  - 404 text: 6rem font size
  - Buttons: 2x2 grid layout
  - Padding: 2rem horizontal

- **Desktop (> 1024px)**
  - Illustration: 250-300px height
  - 404 text: 8rem font size
  - Buttons: Horizontal layout with spacing
  - Padding: Container max-width applied

## Accessibility Features

- **Alt Text for Illustration**: "A friendly monster holding a 404 sign, indicating the page was not found"
- **ARIA Labels**: Clear labels for all navigation buttons
- **Focus Management**: Auto-focus on first action button for keyboard users
- **Color Contrast**: Ensure WCAG AA compliance for all text/background combinations
- **Reduced Motion**: Respect `prefers-reduced-motion` for animations