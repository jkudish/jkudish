# CI strategy for Laravel tests

## Useful lanes

Keep ordinary PHP tests, browser tests, and static analysis clearly separated. A typical pipeline has:

- a quality lane for PHP and frontend check-mode tools;
- an authoritative unit/feature lane, normally parallel where isolation permits;
- a browser lane or clearly named browser step with its own timeout and failure artifacts;
- PHPStan/Larastan either in the main gate or a separately visible analysis job.

TIA is a local feedback accelerator unless the repository deliberately implements and verifies shared CI baselines.

## Parallelization

Use Pest's `--parallel` interface. Confirm the database user can create or reach worker databases and that Redis, cache, session, queue, files, ports, and external fakes have worker-specific namespaces.

Measure serial and parallel runs with equal test counts. Set a process cap only when the host is shared or measurements justify it; otherwise let Pest detect available cores.

Keep tests that genuinely require committed or multiprocess state in a narrow serial group. Do not serialize an entire suite for a handful of integration tests.

## Sharding

Sharding duplicates dependency installation, asset builds, database setup, and migrations on every runner. Add it only when the slowest test step dominates that fixed prelude and remains slow after in-process parallelization.

Compare the smallest plausible configurations with at least three samples. Record median wall time, runner-minutes, test count, runner shape, database, and execution mode. Generate time-balanced data only after selecting the final mode.

Do not reuse timing data collected on a materially different machine, database, runner version, Pest major, or serial/parallel configuration without measuring again.

## Browser testing

Browser jobs should prove business-critical JavaScript journeys and frontend/runtime integration. Start with the signed-in shell and one high-risk stateful flow; expand from escaped defects or meaningful UI risk.

Authenticate through a development-only test seam. Use committed fixtures visible across the HTTP boundary—transactional setup is normally invisible to the browser server. SQLite browser lanes need a file-backed database, not `:memory:`.

Do not automate third-party authentication in the default suite. Do not use browser tests for rules that deterministic feature tests can prove.

## Optimization record

For every CI optimization, record before/after commands, runner shape, samples, median test-step time, runner-minutes, and equal test counts. If setup dominates, improve setup/caching or retain one job rather than spending more runners for cosmetic speed.
