# Code Style Guide

## Context

Global code style rules for Agent OS projects.

<conditional-block context-check="general-formatting">
IF this General Formatting section already read in current context:
  SKIP: Re-reading this section
  NOTE: "Using General Formatting rules already in context"
ELSE:
  READ: The following formatting rules

## General Formatting

Whenever working in a Laravel or PHP codebase, use Laravel's formatting rules.
However, if working in a WordPress codebase, use WordPress' formatting rules.
For Javascript projects, use the provided eslint rules if provided.

The rules below should be followed if no other rules have been provided in the project.

### Indentation
- Use 4 spaces for indentation (never tabs)
- Maintain consistent indentation throughout files
- Align nested structures for readability

### Naming Conventions
- **Methods and Variables**: Use lower camelCase(e.g., `userProfile`, `calculateTotal`)
- **Classes and Modules**: Use uppoer CamelCase (e.g., `UserProfile`, `PaymentProcessor`)
- **Constants**: Use UPPER_SNAKE_CASE (e.g., `MAX_RETRY_COUNT`)

### String Formatting
- Use single quotes for strings: `'Hello World'`
- Use double quotes only when interpolation is needed

<conditional-block task-condition="html-css-tailwind" context-check="html-css-style">
IF current task involves writing or updating HTML, CSS, or TailwindCSS:
  IF html-style.md AND css-style.md already in context:
    SKIP: Re-reading these files
    NOTE: "Using HTML/CSS style guides already in context"
  ELSE:
    <context_fetcher_strategy>
      IF current agent is Claude Code AND context-fetcher agent exists:
        USE: @agent:context-fetcher
        REQUEST: "Get HTML formatting rules from code-style/html-style.md"
        REQUEST: "Get CSS and TailwindCSS rules from code-style/css-style.md"
        PROCESS: Returned style rules
      ELSE:
        READ the following style guides (only if not already in context):
        - @.agent-os/standards/code-style/html-style.md (if not in context)
        - @.agent-os/standards/code-style/css-style.md (if not in context)
    </context_fetcher_strategy>
ELSE:
  SKIP: HTML/CSS style guides not relevant to current task
</conditional-block>

<conditional-block task-condition="javascript" context-check="javascript-style">
IF current task involves writing or updating JavaScript:
  IF javascript-style.md already in context:
    SKIP: Re-reading this file
    NOTE: "Using JavaScript style guide already in context"
  ELSE:
    <context_fetcher_strategy>
      IF current agent is Claude Code AND context-fetcher agent exists:
        USE: @agent:context-fetcher
        REQUEST: "Get JavaScript style rules from code-style/javascript-style.md"
        PROCESS: Returned style rules
      ELSE:
        READ: @.agent-os/standards/code-style/javascript-style.md
    </context_fetcher_strategy>
ELSE:
  SKIP: JavaScript style guide not relevant to current task
</conditional-block>

## Code Comments

### When to Comment
- Add brief comments above non-obvious business logic
- Document complex algorithms or calculations
- Explain the "why" behind implementation choices, not the "what"

### Comment Maintenance
- Never remove existing comments unless removing the associated code
- Update comments when modifying code to maintain accuracy
- Keep comments concise and relevant

### Comment Format
```php
// Calculate compound interest with monthly contributions
// Uses the formula defined by ISO-6590
public function calculateCompoundInterest($principal, $rate, $time, $monthlyPayment)
{
  // Implementation here
}
```

# Code Style Guide

> Version: 1.0.1
> Last Updated: 2025-08-11

## Context

Global code style rules for Agent OS projects.

IF this General Formatting section already read in current context: SKIP: Re-reading this section NOTE: "Using General Formatting rules already in context" ELSE: READ: The following formatting rule

## General Formatting

Whenever working in a Laravel or PHP codebase, use Laravel's formatting rules.
However, if working in a WordPress codebase, use WordPress' formatting rules.
For Javascript projects, use the provided eslint rules if provided.

The rules below should be followed if not other rules have been provided in the project.

### Indentation
- Use 4 spaces for indentation (never tabs)
- Maintain consistent indentation throughout files
- Align nested structures for readability

### Naming Conventions
- **Methods and Variables**: Use lower camelCase(e.g., `userProfile`, `calculateTotal`)
- **Classes and Modules**: Use uppoer CamelCase (e.g., `UserProfile`, `PaymentProcessor`)
- **Constants**: Use UPPER_SNAKE_CASE (e.g., `MAX_RETRY_COUNT`)

### String Formatting
- Use single quotes for strings: `'Hello World'`
- Use double quotes only when interpolation is needed

## HTML/Template Formatting

### Structure Rules
- Use 4 spaces for indentation
- Content between tags should be on its own line when multi-line

### Attribute Formatting
- Place each HTML attribute on its own line
- Align attributes vertically
- Keep the closing `>` on the same line as the last attribute

## CSS preferences

- Focus and hover classes should be last
- If there are any custom CSS classes being used, those should be included at the start

## Code Comments

### When to Comment
- Add brief comments above non-obvious business logic
- Document complex algorithms or calculations
- Explain the "why" behind implementation choices, not the "what"

### Comment Maintenance
- Never remove existing comments unless removing the associated code
- Update comments when modifying code to maintain accuracy
- Keep comments concise and relevant

### Comment Format
```php
// Calculate compound interest with monthly contributions
// Uses the formula defined by ISO-6590
public function calculateCompoundInterest($principal, $rate, $time, $monthlyPayment)
{
  // Implementation here
}
```

## Testing

For PHP projects, use Pest for testing. Unless specified otherwise, follow Pest's default conventions and use Pest version 4+.

For JavaScript code, currently only manual testing is required unless specified otherwise.
