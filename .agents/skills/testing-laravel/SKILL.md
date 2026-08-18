---
name: testing-laravel
description: "Designs, writes, reviews, migrates, and optimizes Laravel tests with Pest or PHPUnit. Use when changing test files; working with test()/it()/expect(), datasets, fakes or mocks, RefreshDatabase, architecture or browser tests; planning behavior or regression coverage; modernizing suites; cleaning up low-value tests; or handling PHPStan test analysis, TIA, parallelization, sharding, flaky tests, and CI strategy."
---

# Testing Laravel

Use this skill for Laravel testing work. Read the repository instructions, test configuration, Composer scripts, CI workflows, and testing documentation before changing tests. Those sources decide the database, isolation model, available tooling, and authoritative commands.

## Start with behavior

State the protected rule and a realistic production mistake the test should catch, then choose the cheapest layer that proves it:

1. Pure unit or domain/service test for calculations and branching rules.
2. Feature test for HTTP behavior, validation, authorization, jobs, persistence, and rendered response data.
3. Browser test for a critical JavaScript-driven journey that lower layers cannot prove.
4. One wiring check at each additional delivery surface; do not repeat the full matrix at every layer.

Read [writing-useful-tests.md](references/writing-useful-tests.md) before adding, deleting, or substantially rewriting tests.

## Establish the repository profile

Before acting, identify:

- the test runner and optional plugins from committed Composer files, plus whether installed versions match the lock before probing them;
- test suites, groups, coverage driver, and risky/no-assertion policy;
- database engine and transactional, truncation, or committed-state groups;
- shared Redis, cache, queue, session, filesystem, port, and external-fake state;
- focused, full, static-analysis, coverage, browser, and CI commands;
- current PHPUnit-style/native-Pest inventory and any acceleration configuration.

Do not turn an ordinary test change into a dependency upgrade. If required tooling is absent, report it and use a dedicated tooling change.

## Testing workflow

- Preserve RED-GREEN-REFACTOR evidence for changed behavior. A dependency/configuration-only change instead proves the harness with representative tests, plugin smoke commands, and CI-parity gates.
- Run focused tests serially against the worktree's assigned database. Use a profile-approved parallel command only for the full gate.
- Pin factory values that assertions depend on, freeze meaningful time, and prevent loops or datasets from passing with zero cases.
- Treat risky or no-assertion tests as failures. Confirm a new invariant can fail with a useful message before relying on it.
- Never make live external calls in the default suite.

## Native Pest migration

Treat native Pest as the destination when the repository uses Pest. Convert a small remaining PHPUnit tail promptly. For a large mixed suite, add a no-new-PHPUnit ratchet and convert by coherent domain in dedicated changes.

Preserve behavior and test-count parity during syntax migrations. Do not use conversion as permission to delete difficult coverage or redesign production behavior. Enable Pest-aware whole-suite tooling only when every discovered test is eligible.

Read [suite-migrations.md](references/suite-migrations.md) before planning or executing a mixed-suite conversion.

## Acceleration and browser testing

- **TIA:** require an all-native eligible suite and a supported coverage driver. Keep full CI authoritative and rebuild the graph after major refactors or when it is suspect.
- **Parallelization:** use Pest's `--parallel` interface only after worker-specific databases and namespaces exist for every shared resource. Compare serial and parallel test counts.
- **Sharding:** measure on CI after in-process parallelism is safe. Compare wall time and runner-minutes with equal test counts; commit timing data only for the selected execution mode.
- **Browser tests:** authenticate through a local test seam, never a third-party identity provider. Cover the critical signed-in shell and a few JavaScript-driven business journeys, with separate timeouts and failure artifacts.

Read [ci-strategy.md](references/ci-strategy.md) before changing workflows, process counts, shard counts, or browser lanes.

## Static analysis and agent probes

- Inspect Composer dependencies, PHPStan/Larastan configuration, analyzed paths, extensions, and scripts before relying on test analysis.
- When the Pest PHPStan extension is present, ensure `tests/` is analyzed and not globally excluded. Fix impossible or redundant expectations; baseline legacy findings narrowly and visibly.
- If static analysis is absent, keep adoption in a dedicated tooling change.
- Confirm an AI probe option is executable in the installed Pest version before relying on it. Help output alone is not proof: smoke the exact documented syntax and treat unknown or unhandled options as unavailable. Treat probes as disposable investigation unless they protect durable behavior at the correct layer.
- Prefer a focused existing test when the behavior already has coverage.

Read [pest-tooling.md](references/pest-tooling.md) for detection and command guidance.

## Review and continuous improvement

During review, summarize the meaningful behavior covered, notable low-value coverage removed or retained, focused and full-gate evidence, and any acceleration choice that differs from repository policy. Keep the report proportional.

Use coverage as a risk map rather than a test-count target. Prioritize changed code, escaped defects, permissions, money/inventory calculations, destructive operations, external synchronization, and retry/state-transition boundaries.
