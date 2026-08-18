# Migrating mixed Laravel test suites

## Inventory first

Record:

- PHPUnit-style and native-Pest file counts;
- discovered tests and assertions in the authoritative serial run;
- suite/group ownership and base test cases or traits;
- transactional, truncation, committed-state, browser, Redis, and multiprocess groups;
- custom helpers, datasets, hooks, and static-analysis exclusions.

Add a CI ratchet that prevents new PHPUnit test classes before beginning a large conversion.

## Choose migration size

Convert a small remaining tail in one focused change. For a large suite, split by coherent domain or test boundary so each change has an understandable behavior inventory and can be reverted independently.

Do not split only by arbitrary file count when tightly related tests share setup or behavior.

## Preserve semantics

- Translate class setup/teardown to scoped hooks without broadening database or shared-state behavior.
- Keep datasets, exception expectations, mocks, assertion messages, and test descriptions behaviorally equivalent.
- Move class helper methods to narrowly named file or support helpers; avoid introducing global-name collisions.
- Preserve test-count and assertion-count explanations. A count decrease requires an explicit deletion or consolidation review.
- Do not combine production refactors, dependency upgrades, or broad test cleanup with mechanical syntax conversion.

Run the converted slice plus adjacent shared-helper consumers before the complete gate.

## Finish the migration

After the final class is converted:

1. prove no discoverable PHPUnit test class remains;
2. remove obsolete compatibility scaffolding;
3. run serial and approved parallel suites and compare counts;
4. run test-specific static analysis where configured;
5. enable TIA only when the suite and coverage driver qualify;
6. keep full CI authoritative.

If conversion exposes unsafe database or shared-resource isolation, fix or isolate that boundary before enabling parallelism. Do not hide it with file-by-file CI loops.
