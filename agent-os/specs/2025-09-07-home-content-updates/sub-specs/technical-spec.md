# Technical Specification

This is the technical specification for the spec detailed in @.agent-os/specs/2025-09-07-home-content-updates/spec.md

## Technical Requirements

- Update hero.blade.php component with new headline, subheading copy, and image source
- Consolidate social-proof.blade.php and client-logos.blade.php content into streamlined format
- Remove professional journey section from about.blade.php component
- Update technical skills arrays in about.blade.php with new technologies
- Modify current-projects.blade.php array to replace n8n with PHAiTO entry
- Convert joey.jpeg to WebP format and place in public/img/ directory
- Find and replace all Tailwind color classes from blue/cyan/turquoise to emerald/green variants
- Update footer.blade.php to remove email address
- Replace emoji icons with PNG images for Tether and add PHAiTO logo
- Maintain all existing responsive design and dark mode compatibility
- Preserve all existing component structure and functionality

## Color Mapping Requirements

- `text-blue-*` → `text-emerald-*`
- `bg-blue-*` → `bg-emerald-*`
- `border-blue-*` → `border-emerald-*`
- `text-cyan-*` → `text-green-*`
- `bg-cyan-*` → `bg-green-*`
- `from-cyan-*` → `from-emerald-*`
- `to-cyan-*` → `to-emerald-*`
- Teal references can remain as they align with the green color family