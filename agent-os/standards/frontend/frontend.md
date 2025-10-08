## Frontend best practices

### CSS & Styling
- **Use TailwindCSS**: Always use the latest version of TailwindCSS; use context7 MCP to access latest Tailwind docs when needed
- **Class Ordering**: Focus and hover classes should be last; custom CSS classes should be included at the start
- **Work With Framework**: Work with Tailwind's patterns rather than fighting against them with excessive overrides
- **Maintain Design System**: Establish and document design tokens (colors, spacing, typography) for consistency
- **Minimize Custom CSS**: Leverage Tailwind utilities to reduce custom CSS maintenance burden
- **Performance**: Optimize for production with CSS purging/tree-shaking to remove unused styles

### HTML Structure
- **Semantic HTML**: Use appropriate HTML elements (nav, main, button, etc.) that convey meaning to assistive technologies
- **Indentation**: Use 4 spaces for indentation; place each HTML attribute on its own line
- **Logical Heading Structure**: Use heading levels (h1-h6) in proper order to create a clear document outline

### JavaScript
- **Semicolons**: Always use semicolons at the end of statements
- **Arrow Functions**: Use arrow functions for anonymous functions and callbacks
- **Trailing Commas**: Use trailing commas in multi-line object and array literals
- **Comments**: Use `//` for single-line comments, `/* ... */` for multi-line comments

### Components
- **Single Responsibility**: Each component should have one clear purpose and do it well
- **Reusability**: Design components to be reused across different contexts with configurable props
- **Composability**: Build complex UIs by combining smaller, simpler components
- **Clear Interface**: Define explicit, well-documented props with sensible defaults
- **State Management**: Keep state as local as possible; lift it up only when needed by multiple components
- **Minimal Props**: Keep the number of props manageable; if a component needs many props, consider composition or splitting it

### Accessibility
- **Keyboard Navigation**: Ensure all interactive elements are accessible via keyboard with visible focus indicators
- **Color Contrast**: Maintain sufficient contrast ratios (4.5:1 for normal text) and don't rely solely on color to convey information
- **Alternative Text**: Provide descriptive alt text for images and meaningful labels for all form inputs
- **Screen Reader Testing**: Test and verify that all views are accessible on screen reading devices
- **ARIA When Needed**: Use ARIA attributes to enhance complex components when semantic HTML isn't sufficient
- **Focus Management**: Manage focus appropriately in dynamic content, modals, and single-page applications

### Responsive Design
- **Mobile-First Development**: Start with mobile layout and progressively enhance for larger screens
- **Standard Breakpoints**: Consistently use standard breakpoints across the application
- **Fluid Layouts**: Use percentage-based widths and flexible containers that adapt to screen size
- **Relative Units**: Prefer rem/em units over fixed pixels for better scalability and accessibility
- **Test Across Devices**: Test and verify UI changes across multiple screen sizes from mobile to tablet to desktop
- **Touch-Friendly Design**: Ensure tap targets are appropriately sized (minimum 44x44px) for mobile users
- **Performance on Mobile**: Optimize images and assets for mobile network conditions
- **Readable Typography**: Maintain readable font sizes across all breakpoints without requiring zoom
- **Content Priority**: Show the most important content first on smaller screens
