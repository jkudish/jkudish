---
name: laravel-code-reviewer
description: "Reviews Laravel, Livewire, Filament, Eloquent, queues, migrations, and Pest/PHPUnit changes. Use for Laravel-specific review lenses inside deep-review or standalone code review."
---

# Laravel Code Reviewer

Use this skill as a read-only review lens for Laravel applications and packages,
especially when a diff touches HTTP controllers, routes, middleware, policies,
FormRequests, Eloquent models, migrations, jobs, events, listeners, Livewire,
Filament, Blade, or tests.

## Review Scope

Start from the changed files, then read one hop out:

- routes, controllers, requests, policies, middleware, and model methods used by
  the changed path
- migrations, factories, seeders, casts, accessors, scopes, observers, and
  query builders affected by the change
- Livewire components, Filament resources/pages/actions, Blade views, and
  browser flows touched by the change
- Pest/PHPUnit tests, feature tests, and factories covering the behavior

## Laravel Boost Evidence

Consume the collector's `laravel_boost` state as evidence, without changing
the application or attempting to discover Boost by executing it:

- `not_installed`, `installed_not_configured`,
  `installed_configuration_unknown`, or `unusable`: for a Laravel application,
  report a visible, non-blocking tooling gap. The `unknown` state means a branch
  target cannot observe an installation-local or ignored `boost.json`; do not
  misreport that as definitely unconfigured. Escalate it to an evidence concern
  only if version-specific framework/package behavior, routes, schema,
  configuration, or logs cannot otherwise be verified.
- `available`: prefer its read-only application information, routes, schema,
  configuration, logs, and version-aware documentation when relevant.
- `intentional_exception`: record the exception without treating it as a gap;
  it is appropriate for Laravel packages and legacy projects.

Never install or configure Boost automatically, and never run `boost:mcp` just
to detect it. Do not give a reviewer unrestricted database-query, Tinker, or
code-execution authority.

## Checks

- Authorization: route middleware, policies/gates, tenant/workspace boundaries,
  route model binding, ownership checks, and Livewire/Filament action access.
- Validation: FormRequest rules, Livewire validation, enum/value constraints,
  nullable vs required semantics, file upload limits, and user-controlled IDs.
- Data integrity: transactions, idempotency, race conditions, unique indexes,
  soft deletes, mass assignment, casts, timestamps, and migration safety.
- Eloquent shape: N+1 queries, eager loading, unbounded result sets, scopes,
  aggregate correctness, pagination, locks, and query behavior under empty data.
- Jobs/events: queue selection, retries, idempotency, serialization, after-commit
  behavior, failed-job safety, and external service failure handling.
- Livewire/Filament: public state exposure, hydration assumptions, action
  placement, table filters/actions, modal behavior, validation messages, and
  authorization on both UI and server paths.
- Tests: feature coverage for the real route/component/action, factories with
  realistic relationships, permission matrix cases, database assertions, queue
  fakes that still prove dispatch payloads, and regression tests for bugs fixed.

Boost is supporting evidence, not a substitute for reading the changed code and
its one-hop dependencies. This pack adds emphasis only; it does not add a
reviewer seat or narrow the reviewer away from other blocker findings.

## Output

Return findings only when they have behavioral impact. Each finding should
include:

- severity
- file and line
- changed behavior and concrete impact
- fix recommendation
- evidence from code, tests, docs, or Laravel Boost

For deep-review panel use, keep output compact and conform to the reviewer JSON
contract supplied by the orchestrator.
