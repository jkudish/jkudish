# Icon System Migration to Lucide Icons

## Overview

Replace the current custom animated-icon component and all inline SVG icons with Lucide Icons, using the Blade SVG icons integration. This will standardize the icon system, reduce custom code maintenance, and provide access to a larger, consistently-designed icon library.

## Goals

1. Install and configure Blade UI Kit with Lucide Icons integration
2. Replace all animated-icon component usages with Lucide equivalents
3. Replace all inline SVG icons with Lucide alternatives
4. Remove the animated-icon component from codebase
5. Maintain visual consistency and functionality

## Technical Approach

### 1. Package Installation

Install required packages:
- `blade-ui-kit/blade-icons` - Core Blade icons package
- `mallardduck/blade-lucide-icons` - Lucide icons for Blade

### 2. Icon Mapping Strategy

Map existing icons to Lucide equivalents:

#### Service Icons
- `lightning-bolt` → `zap` (automation/speed)
- `code` → `code-2` or `terminal` (development)
- `document-report` → `file-text` or `clipboard-list` (audits/reports)
- `sparkles` → `sparkles` (premium/partnership)

#### Expertise Icons
- `command-line` → `terminal` (CLI/terminal)
- `cpu` → `cpu` (processing/tech)
- `beaker` → `flask` (testing/experimentation)
- `users` → `users` (team/collaboration)

#### Navigation/UI Icons
- `arrow-right` → `arrow-right` or `chevron-right`
- `arrow-down` → `arrow-down` or `chevron-down`
- Checkmarks → `check` or `check-circle`
- Email → `mail` or `send`
- Sun/Moon → `sun` and `moon` (theme toggle)

#### Additional Icons
- `rocket` → `rocket` (launch/speed)
- `star` → `star` (ratings/favorites)
- `server` → `server` (infrastructure)

### 3. Implementation Pattern

Replace animated-icon component usage:
```blade
<!-- Old -->
<x-ui.animated-icon icon="lightning-bolt" class="w-8 h-8 text-blue-500" />

<!-- New -->
<x-lucide-zap class="w-8 h-8 text-blue-500" />
```

For animations (if needed), add Tailwind classes:
```blade
<x-lucide-zap class="w-8 h-8 text-blue-500 hover:scale-110 transition-transform" />
```

### 4. Files to Update

#### High Priority (Main Pages)
1. `resources/views/components/home/services-preview.blade.php`
2. `resources/views/components/home/expertise.blade.php`
3. `resources/views/services.blade.php`
4. `resources/views/components/navigation.blade.php`
5. `resources/views/components/footer.blade.php`

#### Components
6. `resources/views/components/home/hero.blade.php`
7. `resources/views/components/services/faq.blade.php`
8. `resources/views/components/services/process.blade.php`
9. `resources/views/components/ui/gradient-button.blade.php`
10. `resources/views/speaking.blade.php`

#### Cleanup
11. Remove `resources/views/components/ui/animated-icon.blade.php`
12. Update any references in tests

## Implementation Steps

### Phase 1: Setup
1. Install Blade Icons packages via Composer
2. Publish configuration files
3. Configure Lucide icons namespace

### Phase 2: Icon Replacement
4. Replace service icons in services-preview component
5. Replace expertise icons in expertise component
6. Update main services page icons
7. Replace navigation and theme toggle icons
8. Update footer icons (newsletter, social media)
9. Replace hero section checkmarks
10. Update FAQ chevron icons
11. Replace process flow arrows
12. Update gradient button arrows
13. Replace speaking page arrows

### Phase 3: Cleanup
14. Remove animated-icon component file
15. Test all pages for proper icon display
16. Update any broken tests
17. Verify dark mode compatibility

## Testing Requirements

1. Visual inspection of all pages
2. Verify icon sizes are consistent
3. Check hover states and animations
4. Test dark mode appearance
5. Ensure no broken icon references
6. Run existing tests to catch any breaks

## Notes

- Social media icons (BlueSky, Glass, Twitter/X, GitHub) may need custom solutions as they might not be in Lucide
- Company logos in `/public/img/companies/` remain unchanged
- Service provider logos (Shopify, WooCommerce, etc.) remain unchanged
- Maintain current icon sizes (w-4, w-6, w-8, w-10 classes)
- Preserve color schemes for service differentiation

## Success Criteria

- All icons successfully replaced with Lucide equivalents
- No visual regressions or broken functionality
- Animated-icon component completely removed
- Consistent icon styling across all pages
- Tests passing
- Dark mode compatibility maintained