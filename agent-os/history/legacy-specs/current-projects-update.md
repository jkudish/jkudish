# Current Projects Section Update

> Spec: current-projects-update
> Created: 2025-09-10
> Status: Planning

## Overview

Update the "What I'm Building Right Now" section with new content, improved design elements including project logos, status badges with icons, and proper links to project pages.

## User Stories

- As a website visitor, I want to see what Joey is currently building so I can follow his progress
- As a potential client, I want to click through to see Joey's live projects to evaluate his work
- As a mobile user, I want the projects section to be visually appealing and easy to navigate
- As an accessibility user, I want clear status indicators and proper navigation support

## Spec Scope

### Content Updates
Replace existing projects with:

1. **Tether**
   - Description: "Stay connected without roaming fees. SMS verification codes delivered straight to your Telegram."
   - Status: Building in public
   - Link: https://tethermobile.com

2. **The Maker Notes** 
   - Description: "Weekly dispatch: AI experiments, automation workflows, indie hacking lessons, and the best links I find online."
   - Status: First issue coming this month
   - Link: /newsletter (internal page)

3. **PHAiTO**
   - Description: "Lightroom AI that actually understands photography. Edit entire catalogs in minutes, not hours."
   - Status: Recently Launched
   - Link: https://phaito.com

### Visual Requirements

#### Logo Treatment
- **Tether**: Display logo at larger size (h-16), no text heading
- **Maker Notes**: Use mail icon from footer with text title
- **PHAiTO**: Logo only with grayscale treatment (matching footer style)

#### Status Badges
Implement consistent badge styling with unique colors and icons:
- **Building in public**: Amber/yellow background, hammer/tool icon
- **Coming Soon**: Blue background, rocket/clock icon  
- **Recently Launched**: Green background, checkmark/sparkle icon

#### Interactive Elements
- Each project card should be clickable (entire card links to project)
- Hover effects: slight scale, shadow enhancement, border color change
- Status badges should have subtle animation on hover

### Technical Requirements
- Maintain responsive grid layout (3 columns desktop, 2 tablet, 1 mobile)
- Use existing Tailwind utilities and project patterns
- Ensure dark mode compatibility for all elements
- Add proper external link indicators (icon or visual cue)
- Optimize logo display for performance

## Out of Scope

- Creating new project pages or landing pages
- Adding project filtering or search functionality
- Implementing project detail modals or overlays
- Adding social sharing buttons for projects
- Creating admin interface for project management

## Expected Deliverable

A fully updated "What I'm Building Right Now" section that:
- Displays three current projects with accurate, engaging content
- Provides clickable navigation to each project's respective page/site
- Features consistent, color-coded status badges with meaningful icons
- Maintains visual hierarchy through strategic logo and typography treatment
- Works seamlessly across all devices and in both light/dark modes
- Meets accessibility standards for navigation and visual indicators

## Design Specifications

### Layout Structure
```
Section Container
├── Section Header
│   └── "What I'm Building Right Now" (with decorative line)
└── Projects Grid (3 columns)
    ├── Tether Card
    │   ├── Logo (large, no heading)
    │   ├── Description
    │   └── Status Badge (amber)
    ├── Maker Notes Card
    │   ├── Icon + Title
    │   ├── Description
    │   └── Status Badge (blue)
    └── PHAiTO Card
        ├── Logo (grayscale)
        ├── Description
        └── Status Badge (green)
```

### Component Styling

#### Project Cards
```css
Base State:
- Background: bg-white/50 dark:bg-zinc-900/50
- Border: border-zinc-200 dark:border-zinc-700
- Padding: p-6
- Border radius: rounded-2xl
- Transition: all 150ms ease

Hover State:
- Transform: scale(1.02)
- Shadow: shadow-lg
- Border: border-emerald-500/30
```

#### Status Badges
```css
Base Structure:
- Display: inline-flex items-center gap-2
- Padding: px-3 py-1.5
- Border radius: rounded-full
- Font: text-xs font-semibold

Color Variants:
- Building: bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300
- Coming Soon: bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300
- Launched: bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300
```

#### Logo Specifications
- **Tether Logo**: `h-16 w-auto object-contain`
- **Maker Notes Icon**: `h-6 w-6` (use lucide-mail icon)
- **PHAiTO Logo**: `h-12 w-auto object-contain filter grayscale`

### Icon Selections
Using Lucide icons for consistency:
- Building in public: `lucide-hammer` or `lucide-wrench`
- Coming Soon: `lucide-rocket` or `lucide-clock`
- Recently Launched: `lucide-check-circle` or `lucide-sparkles`

## Implementation Details

### Data Structure
```php
$projects = [
    [
        'name' => 'Tether',
        'logo' => '/img/tether.png',
        'logo_size' => 'large',
        'show_title' => false,
        'description' => 'Stay connected without roaming fees. SMS verification codes delivered straight to your Telegram.',
        'status' => 'building',
        'status_label' => 'Building in public',
        'url' => 'https://tethermobile.com',
        'external' => true,
    ],
    [
        'name' => 'The Maker Notes',
        'icon' => 'lucide-mail',
        'show_title' => true,
        'description' => 'Weekly dispatch: AI experiments, automation workflows, indie hacking lessons, and the best links I find online.',
        'status' => 'coming_soon',
        'status_label' => 'First issue coming this month',
        'url' => route('newsletter'),
        'external' => false,
    ],
    [
        'name' => 'PHAiTO',
        'logo' => '/img/companies/phaito.png',
        'logo_size' => 'medium',
        'logo_filter' => 'grayscale',
        'show_title' => false,
        'description' => 'Lightroom AI that actually understands photography. Edit entire catalogs in minutes, not hours.',
        'status' => 'launched',
        'status_label' => 'Recently Launched',
        'url' => 'https://phaito.com',
        'external' => true,
    ],
];
```

### Accessibility Considerations
- Ensure all links have descriptive text for screen readers
- Add `aria-label` to project cards with full context
- Include `rel="noopener noreferrer"` for external links
- Provide focus states for keyboard navigation
- Status badges should have sufficient color contrast

### Testing Requirements
- Verify all links work correctly (internal and external)
- Test responsive layout at all breakpoints
- Confirm dark mode styling for all elements
- Check logo visibility in both color modes
- Validate hover and focus states
- Test with screen readers for accessibility

## Success Criteria
- [ ] All three projects display with updated content
- [ ] Each project links to its respective page/site
- [ ] Status badges show with appropriate colors and icons
- [ ] Logos display at specified sizes with correct treatments
- [ ] Dark mode provides good visibility for all elements
- [ ] Section maintains visual consistency with site design
- [ ] All interactive elements work smoothly
- [ ] Passes accessibility testing

## Spec Documentation

- Tasks: @.agent-os/specs/current-projects-update-tasks.md
- Technical Specification: @.agent-os/specs/current-projects-update/sub-specs/technical-spec.md