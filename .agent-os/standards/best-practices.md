# Development Best Practices

## Context

Global development guidelines for Agent OS projects.

<conditional-block context-check="core-principles">
IF this Core Principles section already read in current context:
  SKIP: Re-reading this section
  NOTE: "Using Core Principles already in context"
ELSE:
  READ: The following principles

## Core Principles

### Keep It Simple
- Implement code in the fewest lines possible
- Avoid over-engineering solutions
- Choose straightforward approaches over clever ones

### Optimize for Readability
- Prioritize code clarity over micro-optimizations
- Write self-documenting code with clear variable names
- Add comments for "why" not "what"

### DRY (Don't Repeat Yourself)
- Extract repeated business logic to re-usable methods
- Extract repeated UI markup to reusable components
- Create utility functions for common operations
  </conditional-block>

### File Structure
- Very important to follow existing patterns when working in an existing project.
- When working in a new/greenfield project, use Laravel's latest naming and folder conventions

### Testing
- Very important to follow existing testing patterns when working in an existing project.
- Write tests for new functionality
- Ensure no test regressions happen
- Test edge cases and error conditions whenever possible

<conditional-block context-check="dependencies" task-condition="choosing-external-library">
IF current task involves choosing an external library:
  IF Dependencies section already read in current context:
    SKIP: Re-reading this section
    NOTE: "Using Dependencies guidelines already in context"
  ELSE:
    READ: The following guidelines
ELSE:
  SKIP: Dependencies section not relevant to current task

## Dependencies

### Choose Libraries Wisely
When adding third-party dependencies:
- Select the most popular and actively maintained option
- Check the library's GitHub repository for:
    - Recent commits (within last 6 months)
    - Active issue resolution
    - Number of stars/downloads
    - Clear documentation
- Consult with me before making a final decision
</conditional-block>
