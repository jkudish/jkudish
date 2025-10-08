## Coding style best practices

### Formatting Standards
- **Indentation**: Use 4 spaces for indentation (never tabs)
- **Consistent Indentation**: Maintain consistent indentation throughout files and configure and use a linter to enforce it
- **Automated Formatting**: Use framework-specific formatting rules when available

### Naming Conventions
- **Methods and Variables**: Use lower camelCase (e.g., `userProfile`, `calculateTotal`)
- **Classes and Modules**: Use upper CamelCase (e.g., `UserProfile`, `PaymentProcessor`)
- **Constants**: Use UPPER_SNAKE_CASE (e.g., `MAX_RETRY_COUNT`)
- **Meaningful Names**: Choose descriptive names that reveal intent; avoid abbreviations and single-letter variables except in narrow contexts

### String Formatting
- **Default**: Use single quotes for strings: `'Hello World'`
- **Interpolation**: Use double quotes only when interpolation is needed

### Code Quality
- **Small, Focused Functions**: Keep functions small and focused on a single task for better readability and testability
- **Remove Dead Code**: Delete unused code, commented-out blocks, and imports rather than leaving them as clutter
- **DRY Principle**: Avoid duplication by extracting common logic into reusable functions or modules
- **Backward Compatibility**: Only when required. Unless specifically instructed otherwise, assume you do not need to write additional code logic to handle backward compatibility

### Code Comments
- **Self-Documenting Code**: Write code that explains itself through clear structure and naming
- **When to Comment**: Add concise comments to explain large sections of complex logic; document the "why" behind implementation choices, not the "what"
- **Evergreen Comments**: Don't comment changes or fixes; comments should be relevant far into the future, not temporary notes
- **Comment Maintenance**: Update comments when modifying code; remove comments when removing associated code
