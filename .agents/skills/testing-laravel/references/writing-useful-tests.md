# Writing useful Laravel tests

## Name the break

Before writing the test body, name a realistic production mistake that should make it fail: a wrong branch, argument, boundary result, state change, side effect, or contract. If only an intentional redesign or source-text change can fail it, assert the consumer-visible behavior that depends on that decision instead.

Derive expected values independently from the code under test. Prefer literals, hand-checked fixtures, or a trustworthy external oracle; never use the production helper or algorithm under test to compute both actual and expected values.

## What deserves a test

Test business rules, authorization boundaries, validation, state transitions, failure/retry behavior, external-contract shaping, queue handoffs, persistence constraints, and user journeys whose failure would matter.

Usually do not test framework declarations: a cast exists, a model uses a trait, an enum contains its own declared cases, a migration file contains a column statement, or a config key repeats a registry already guarded elsewhere. Test the behavior or constraint those declarations create.

Test the contract your application owns, not the framework's documented mechanics. If upstream behavior genuinely surprised the application, add one narrow characterization test that names the assumption. Exercise scripts and configuration against controlled inputs and assert outputs, side effects, or exit codes instead of grepping their source text.

## One matrix, strongest layer

Put the complete input/output matrix at the cheapest layer that owns the rule. Add one end-to-end wiring test per real delivery surface. Repeating every case through service, controller, rendered response, and browser layers multiplies setup cost without adding independent confidence.

Prefer merging tests that repeat expensive setup for single assertions when the combined test still has one clear behavioral story. A dataset is useful when cases are cheap and failures remain individually legible; it is not a cure for slow boot/setup repeated per case.

## Doubles and test seams

- Understand a dependency's side effects before replacing it. Fake or mock the slow or external boundary while keeping behavior the test depends on real.
- Laravel fakes are appropriate when the dispatched job, notification, mail, event, or outbound request is the application contract. Assert contract-relevant recipients, payloads, arguments, ordering, or state rather than the mere existence of a double.
- Make doubles branch-specific and realistic enough for every downstream consumer. Prefer canonical fixture builders or validated response objects over partial hand-built structures that hide integration assumptions.
- Keep cleanup and helper methods used only by tests in test support code, not production classes.
- When mock setup overwhelms the behavioral story, use a focused integration test with real components instead.

## Guards against false confidence

- A loop or dataset that can execute zero cases must assert that it examined at least one case.
- A test that returns or continues before every assertion is a failure, even when the runner is green.
- Break a new invariant once and confirm the test fails with a useful message, then restore it. Before finishing, mentally check realistic mutations such as a wrong argument or branch, a missing state change or side effect, an empty/default return, and missing boundary validation.
- Pin every factory value an assertion depends on. Random defaults are useful for exploration, not contractual expectations.
- Freeze time when meaning depends on today; avoid absolute dates that silently change from future to past.
- Never make live external calls in the default suite. Mock them or put them behind an explicit opt-in integration group.
- Never prove a performance rule with wall-clock time alone. Assert a deterministic signal emitted by the bounded path.

## Deletion review

Before deleting a test, write down what protects the rule now. Search code, configuration, documentation, and the rest of the suite for references to the test or invariant. Do not delete a test merely because it looks like scaffolding or contains a tautological assertion; those patterns are review signals, not automatic proof that the file has no purpose.

Remove or rewrite a test when it is duplicate, vacuous, framework-only, permanently skipped without a supported environment, or coupled to implementation details with no behavior at stake. Keep it when it is the only guard of a live rule, even if the syntax is ugly; improve the assertion in the same change.

For money, inventory, authorization, destructive operations, concurrency, retries, or external side effects, identify the replacement coverage explicitly before deletion.

## Coverage growth

Use coverage as a map, not a score chase. Prioritize changed code, money and inventory calculations, permissions, destructive operations, external synchronization boundaries, and defects that reached production. A new numerical threshold requires a stable baseline and a ratchet plan; never lower an existing threshold merely to make an upgrade pass.
