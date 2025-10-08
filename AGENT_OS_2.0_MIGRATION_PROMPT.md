# Agent OS 1.x to 2.0 Migration - One-Shot Prompt

Use this prompt to migrate an existing Agent OS 1.x project to Agent OS 2.0 in a single session.

---

## The Prompt

I need to migrate this project from Agent OS 1.0/1.x to Agent OS 2.0. Please perform a complete migration following these steps:

### Prerequisites
- Agent OS 2.0 has already been installed in this project (check for `agent-os/` directory with `config.yml`)
- The old `.agent-os/` directory exists with v1.0 structure

### Migration Tasks

**Phase 1: Analyze Current Structure**
First, analyze what exists in my `.agent-os/` directory:
1. List all subdirectories and their contents
2. Identify what project documentation exists (product/, project/, docs/, etc.)
3. Identify specs structure (specs/, features/, etc.)
4. Check for session history (recaps/, sessions/, history/, etc.)
5. Note any custom standards or documentation

**Phase 2: Create v2.0 Directory Structure**
Create these directories in `agent-os/` (only if needed):
   - `agent-os/project/` (for project-specific docs)
   - `agent-os/specs/` (for active specifications)
   - `agent-os/history/sessions/` (for session recaps, if they exist)
   - `agent-os/history/legacy-specs/` (for archived specs, if needed)
   - `agent-os/project/standards/` (for project-specific standards, if needed)

**Phase 3: Migrate Content Intelligently**

For each category, adapt based on what actually exists:

1. **Project Documentation** → `agent-os/project/overview.md`:
   - IF `.agent-os/product/overview.md` exists: use it as base
   - IF `.agent-os/product/tech-stack.md` exists: merge into overview
   - IF `.agent-os/project/` exists: migrate those files
   - IF other project docs exist: consolidate into overview.md
   - Create a comprehensive overview that includes: project description, tech stack, key features, and current status

2. **Decisions Log (if exists)** → `agent-os/history/decisions-archive.md`:
   - IF `.agent-os/product/decisions.md` exists: archive it
   - IF `.agent-os/decisions.md` exists: archive it
   - Note: v2.0 removes decision logs, but keep for historical reference

3. **Active Specs** → `agent-os/specs/`:
   - Identify "active" specs (recently dated folders like `YYYY-MM-DD-*`, structured spec folders)
   - Move these to `agent-os/specs/`
   - IF no specs exist: skip this step

4. **Legacy Specs** → `agent-os/history/legacy-specs/`:
   - Identify "legacy" specs (standalone .md files, older format, undated folders)
   - Move these to `agent-os/history/legacy-specs/`
   - IF all specs are active: skip this step

5. **Session History** → `agent-os/history/sessions/`:
   - IF `.agent-os/recaps/` exists: move files to sessions/
   - IF `.agent-os/sessions/` exists: move files to sessions/
   - IF `.agent-os/history/` exists: evaluate and migrate relevant files
   - IF no session history exists: skip this step

**Phase 4: Create Project Standards (if beneficial)**

Evaluate if project-specific standards would be helpful. Only create these if:
- The project has specific conventions beyond v2.0 defaults
- There are framework-specific patterns to document
- Custom workflows need to be captured

If creating standards, add to `agent-os/project/standards/`:

1. **tech-stack.md** (if project uses specific tech):
   - Framework, language, database versions
   - Frontend tools, CSS framework, build tools
   - Testing framework, deployment platform
   - Third-party services and APIs

2. **coding-style.md** (if project has specific conventions):
   - Framework-specific patterns
   - File organization structure
   - Naming conventions used in this project
   - Testing patterns
   - Project-specific security practices

3. **development.md** (if project has unique workflows):
   - Project context and purpose
   - Development priorities
   - Common patterns (forms, APIs, etc.)
   - Common tasks and workflows
   - Deployment procedures

Note: These should complement (not duplicate) the global v2.0 standards in `agent-os/standards/`.

**Phase 5: Update References**
Search for and update references to the old structure:
1. IF `CLAUDE.md` exists in project root:
   - Change all `.agent-os/` references to `agent-os/`
   - Update "Agent OS" mentions to "Agent OS 2.0"
   - Update any specific file paths to their new locations

2. IF `README.md` or other docs reference `.agent-os/`:
   - Update those references

**Phase 6: Clean Up Duplicates**

Check and remove duplicates that v2.0 installation may have created:

1. **Duplicate agent files**: IF `.claude/agents/agent-os/` exists:
   - Check for files in root that also exist in subdirectories
   - Subdirectories to check: `implementers/`, `specification/`, `verifiers/`, etc.
   - Remove root-level duplicates, keep organized subdirectories

2. **Old v1.0 commands**: IF `.claude/commands/` has files at root level:
   - Look for commands referencing `.agent-os/instructions/`
   - Common old commands: `analyze-product.md`, `plan-product.md`, `create-spec.md`, `create-tasks.md`, `execute-tasks.md`
   - Remove these old commands
   - Keep only `agent-os/` subdirectory with v2.0 commands

3. **Stray files**:
   - Remove any `.DS_Store` files throughout the structure
   - Remove any unnecessary README.md files in spec folders

**Phase 7: Verify and Delete Old Structure**
1. Review the migrated content in `agent-os/`
2. Verify nothing important was missed from `.agent-os/`
3. Delete the entire `.agent-os/` directory

**Phase 8: Commit Changes**
1. Show me a summary of the changes
2. Create 2-3 logical commits:
   - Main migration commit
   - Cleanup of duplicates (if any)
   - Any additional cleanup (if needed)

### Migration Preferences

When asked for decisions during migration:
- **Decisions log**: Archive for reference (v2.0 removes decision logs)
- **Legacy specs**: Archive all to `history/legacy-specs/` for reference
- **Standards**: Keep v2.0 defaults + merge project-specific preferences
- **Config**: Confirm multi-agent mode is enabled in `agent-os/config.yml`

### Expected Final Structure

```
agent-os/
├── config.yml (multi-agent mode enabled)
├── standards/ (v2.0 global templates - keep as-is)
│   ├── backend/
│   ├── frontend/
│   ├── global/
│   └── testing/
├── project/ (project-specific)
│   ├── overview.md (merged from product/ docs)
│   └── standards/ (project overrides)
│       ├── tech-stack.md
│       ├── coding-style.md
│       └── development.md
├── specs/ (active specs only)
│   └── 2025-*/
└── history/
    ├── sessions/ (moved from recaps/)
    ├── legacy-specs/ (archived old specs)
    └── decisions-archive.md

.claude/
├── agents/agent-os/
│   ├── implementers/
│   ├── specification/
│   └── verifiers/
└── commands/agent-os/
    ├── plan-product.md
    ├── new-spec.md
    ├── create-spec.md
    └── implement-spec.md
```

### Key Learnings to Apply

1. **Analyze before acting**: Every project's `.agent-os/` structure is different. Take time to understand what exists before migrating.

2. **Check for duplicate agents**: The v2.0 installation may create both root-level AND subdirectory copies of agent files. Always remove root duplicates and keep only the organized subdirectories.

3. **Remove obsolete v1.0 commands**: Old slash commands reference `.agent-os/instructions/` which no longer exists. These must be deleted.

4. **Consolidate intelligently**: v2.0 prefers consolidated documentation. Merge multiple product/project docs into a single comprehensive `overview.md`.

5. **Create project standards only when useful**: Don't duplicate v2.0 templates. Only document project-specific choices and overrides if they add value.

6. **Distinguish active vs legacy specs**: Use dating, folder structure, and recency to determine what's active vs legacy. When in doubt, ask the user.

7. **Handle missing pieces gracefully**: Not all projects will have specs, recaps, or standards. Skip sections that don't apply.

8. **Verify multi-agent mode**: Check `agent-os/config.yml` has `multi_agent_mode: true` for Claude Code compatibility.

9. **Clean up hidden files**: Remove `.DS_Store` and other system files during migration.

10. **Preserve history**: Always archive rather than delete. Move old specs and decisions to `history/` even if you're not sure they're needed.

### Approach

1. **Be adaptive**: Adjust the migration based on what actually exists in my `.agent-os/` directory
2. **Ask when uncertain**: If the structure is unusual or unclear, ask me before proceeding
3. **Preserve over delete**: When in doubt, archive to `history/` rather than delete
4. **Show me the plan**: Before executing, show me what you found and your proposed migration strategy

### Commit Strategy

Create 2-3 logical commits based on what changes were needed:
- Main migration commit (restructure, move files, create standards if needed)
- Cleanup commit (duplicates, obsolete files, if any exist)
- Additional cleanup (if needed)

---

**Please start by analyzing my `.agent-os/` directory structure, then show me your proposed migration plan before executing.**

---

## How to Use This Prompt

1. Install Agent OS 2.0 in your project first
2. Paste this entire prompt into Claude Code
3. Claude will review your structure and create a migration plan
4. Confirm the plan
5. Claude will execute the full migration
6. Review and merge to main

**Estimated time**: 5-10 minutes for Claude to complete the migration.
