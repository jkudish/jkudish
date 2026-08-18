# Pest tooling

## Detect committed capabilities

Treat Composer files, test configuration, and CI workflows as authoritative:

```bash
composer show --direct
vendor/bin/pest --version
vendor/bin/pest --help
composer run --list
```

Compare the installed runner and plugins with `composer.lock` before treating their help output or behavior as repository capabilities. A stale `vendor/` tree can expose an older Pest interface and invalidate otherwise green verification; install from the lock before probing or running authoritative gates when they differ.

Do not install optional tooling incidentally during ordinary feature work.

## TIA

Before enabling TIA, scan for PHPUnit test classes and confirm a supported coverage driver is available. Keep a full non-TIA CI run as the release signal.

Common commands:

```bash
vendor/bin/pest --tia
vendor/bin/pest --tia --filtered
vendor/bin/pest --tia --fresh
vendor/bin/pest --no-tia
```

Use `--filtered` for fast feedback. Rebuild the graph after broad refactors or when dependency results are suspect. Do not commit local TIA storage unless the repository deliberately implements a shared baseline.

## Agent probes

Check the installed version and help output, then smoke the exact syntax documented for that version. Do not substitute a similarly named option based on its help description alone. For versions that expose `--agent`, quote snippets so the shell does not expand PHP variables:

```bash
vendor/bin/pest --agent='expect(true)->toBeTrue();'
```

If the option is forwarded to PHPUnit as unknown, or another plugin prevents a clean probe result, report the capability as unavailable and use a focused committed test instead.

Treat probes as disposable verification. Move one into the suite only when it protects durable behavior at the correct layer.

## PHPStan/Larastan

Check whether test analysis is active:

```bash
composer show --direct
rg -n "pest-plugin-phpstan|extension.neon|tests/" composer.json phpstan*.neon
composer run --list | rg "phpstan|analyse|static"
```

When the Pest extension is present, ensure analyzed paths include `tests/` and that exclusions do not remove the whole test tree. Use the repository's Composer script. Fix impossible expectations, invalid `throws()` or `covers()` targets, duplicate descriptions, and invalid closure-context usage.

If a legacy suite needs a baseline, keep it narrow and visible. Configure it to fail on new findings without hiding the entire test directory.

## Browser tests

Browser tests live in the repository's configured browser suite and use local-only authentication seams. Assert JavaScript and console health for critical journeys and keep screenshots, traces, and transient artifacts ignored.

Browser requests cross an HTTP boundary, so use the repository-approved committed-fixture strategy. Keep ordinary feature tests transactional.

## Time-balanced shards

Generate timings using the same database, runner shape, and serial/parallel mode used by CI:

```bash
vendor/bin/pest --parallel --update-shards
vendor/bin/pest --parallel --shard=1/4
```

Commit the generated shard data only with the measurement that justifies the chosen shard count. Refresh after substantial suite/runtime changes or when Pest reports drift.
