## General development conventions

### Core Principles
- **Keep It Simple**: Implement code in the fewest lines possible; avoid over-engineering solutions; choose straightforward approaches over clever ones
- **Optimize for Readability**: Prioritize code clarity over micro-optimizations; write self-documenting code with clear variable names
- **DRY (Don't Repeat Yourself)**: Extract repeated business logic to re-usable methods; extract repeated UI markup to reusable components; create utility functions for common operations

### File Structure
- **Existing Projects**: Very important to follow existing patterns when working in an existing project
- **Greenfield Projects**: Use the latest naming and folder conventions of the framework in use

### Testing
- **Follow Patterns**: Very important to follow existing testing patterns when working in an existing project
- **Test New Features**: Write tests for new functionality
- **No Regressions**: Ensure no test regressions happen
- **Edge Cases**: Test edge cases and error conditions whenever possible
- **Use testing tools**: Use available testing tools in projects, use the right tool for each stack.

### Dependencies
- **Choose Wisely**: Select the most popular and actively maintained option
- **Verify Quality**: Check the library's GitHub repository for:
  - Recent commits (within last 6 months)
  - Active issue resolution
  - Number of stars/downloads
  - Clear documentation
- **Consult First**: Consult with the user first before making a final decision and before adding new dependencies unless previously agreed upon or confirmed
- **Use the latest version**: Check for the latest version when working with a new dependency. Make sure it’s compatible with existing dependencies.
- **Avoid dependencies for simple things**: If it’s only a few lines of code, write it yourself. Only include dependencies when it makes sense. If unsure, ask.

### Project Structure & Organization
- **Follow Existing Patterns**: Organize files logically by feature or domain; keep related code together (co-location)
- **Clear Directory Names**: Use clear, descriptive directory names that indicate purpose
- **Configuration Files**: Keep configuration files in project root; use `.env` for environment-specific variables
- **Environment Secrets**: Never commit secrets or API keys; document required environment variables in `.env.example`

### Documentation
- **README Files**: Maintain up-to-date README files with setup instructions and architecture overview
- **API Documentation**: Keep API documentation current and accessible
- **Contribution Guidelines**: Include contribution guidelines when relevant
- **Architecture Decisions**: Document significant architecture decisions

### Version Control
- **Commit Messages**: Use clear, meaningful commit messages
- **Feature Branches**: Create feature branches for new work
- **PR/MR Descriptions**: Write descriptive pull/merge request descriptions
- **Atomic Commits**: Keep commits focused and atomic

### Code Review & Quality
- **Consistent Process**: Establish a consistent code review process with clear expectations
- **Testing Requirements**: Define what level of testing is required before merging
- **Feature Flags**: Use feature flags for incomplete features rather than long-lived feature branches (live projects only)
- **Changelog**: Keep a changelog or release notes to track significant changes
