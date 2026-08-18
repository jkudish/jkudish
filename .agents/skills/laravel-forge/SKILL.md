---
name: laravel-forge
description: Use Laravel Forge API v2, the current Forge CLI, and Forge SDK v4 for server, site, deployment, backup, scheduler, and organization automation. Trigger when diagnosing Forge API traffic, migrating legacy Forge v1 calls, writing Forge integrations, or operating Forge resources safely.
---

# Laravel Forge v2

Use the new Laravel Forge API, which Forge documents as API v2. Keep the API base URL as `https://forge.laravel.com/api`. Do not append `/v1` or `/v2`; the version is represented by the new API contract and resource model.

Treat every `https://forge.laravel.com/api/v1` reference as legacy. Do not fix a caller by changing only the URL. Most resource calls now require an organization slug, and endpoint names and response shapes may differ. Read the [official API reference](https://laravel.com/forge/docs/api-reference/introduction) and the [OpenAPI specification](https://laravel.com/api/docs.openapi) for the exact resource.

## Choose the access path

- Use the Forge CLI for interactive operator work such as listing organizations, switching the active organization or server, deploying, reading logs, and running commands.
- Use `laravel/forge-sdk` v4 for PHP applications. SDK v4 targets Forge API v2 and makes organization scoping explicit.
- Use raw HTTP with `curl` when the CLI or SDK does not expose an operation. Keep the base URL in one configuration value and map the endpoint from the OpenAPI document.

Do not expose tokens in output, shell history, process listings, source code, or skill files. Prefer `FORGE_API_TOKEN` from a secret store or an environment inherited by the process. Never read or print the token value merely to diagnose a caller.

## Trace legacy callers first

Search the relevant source, automation, and task logs before changing anything:

```bash
rg -n -i --hidden \
  --glob '!**/.git/**' --glob '!**/vendor/**' --glob '!**/node_modules/**' \
  'forge\\.laravel\\.com/api/v1|FORGE_API_TOKEN|laravel/forge|deployment-history' \
  <repo-or-automation-root>
```

Distinguish Forge's URL from an application's own `/api/v1` routes. A Laravel app may legitimately expose its own versioned API while still calling Forge through `https://forge.laravel.com/api`.

For the current machine, inspect these known integration points:

- `~/Herd/yums-dev/plugins/yums-dev/stacks/laravel-forge.md` — shared Forge deployment instructions. Its “Forge API + SSH idioms” section still contains legacy `/api/v1` guidance and is the primary local migration target.
- `~/Herd/yums-dev/plugins/yums-dev/agents/run-doctor.md` — describes read-only deployment-history polling and inherits the stack's endpoint guidance.
- `~/.laravel-forge/config.json` — local Forge CLI state. Read only the non-secret fields when diagnosing configuration; never print `token`.

The installed global CLI is currently `laravel/forge-cli` v2.0.2. Its presence does not prove that every other script is v2-compatible. Check the actual URL and client used by each caller.

## Authenticate with the CLI

Install or update the current CLI as documented by Forge:

```bash
composer global require laravel/forge-cli
```

Authenticate with a token created in the Forge API dashboard:

```bash
forge login
forge login --token="your-api-token"
forge logout
```

For CI, provide `FORGE_API_TOKEN` through the CI secret store. Do not put a token in a committed workflow, command file, deployment document, or prompt.

Forge v2 organizes resources under organizations. Check and select the organization before server or site operations:

```bash
forge organization:list
forge organization:current
forge organization:switch acme
forge server:list
forge server:current
forge server:switch staging
forge site:list
```

Use the CLI's current command names from `forge` and the [Forge CLI documentation](https://laravel.com/forge/docs/cli). Do not assume a v1 server/site command maps one-to-one to v2.

## Use the PHP SDK v4

Install the SDK in the PHP project that owns the integration:

```bash
composer require laravel/forge-sdk
```

Create the client from a token and resolve the organization slug once. Cache the slug in application configuration instead of resolving it on every request:

```php
use Laravel\Forge\Forge;

$forge = new Forge($token);

$organizations = $forge->organizations();
$organizationSlug = $organizations[0]->slug;

$servers = $forge->servers($organizationSlug);
foreach ($servers->lazy() as $server) {
    // Inspect or process the current page of servers.
}
```

Methods that do not require an organization include `user()` / `me()`, `organizations()`, `providers()`, `permissions()`, and `predefinedRoles()`. Most server, site, database, backup, scheduler, team, and deployment methods take the organization slug first.

Expect these v2 SDK changes when upgrading from SDK v3:

- Resource collections use cursor pagination. Use the paginator directly, `toArray()` for the current page, or `lazy()` to traverse all pages.
- Some operations are asynchronous. Use the SDK's built-in wait behavior or explicitly disable it and poll using a bounded timeout.
- “Daemons” are now “background processes”; use the renamed methods and traits.
- Catch the SDK's dedicated validation, not-found, forbidden, failed-action, rate-limit, and timeout exceptions.

Read the [Forge SDK guide](https://laravel.com/forge/docs/sdk) before porting a non-trivial integration.

## Send raw v2 requests

Keep the base URL at `/api` and send the required JSON headers:

```bash
FORGE_API_BASE="${FORGE_API_BASE:-https://forge.laravel.com/api}"

curl --fail-with-body --silent --show-error \
  -H "Authorization: Bearer ${FORGE_API_TOKEN:?Set FORGE_API_TOKEN in the environment}" \
  -H 'Accept: application/json' \
  -H 'Content-Type: application/json' \
  "${FORGE_API_BASE}/organizations"
```

For a resource operation:

1. Resolve or configure the organization slug.
2. Find the exact v2 path and request body in the [OpenAPI specification](https://laravel.com/api/docs.openapi).
3. Start with a read-only `GET` and inspect the response shape.
4. Add pagination and rate-limit handling before traversing collections.
5. Treat `POST`, `PUT`, `PATCH`, and `DELETE` as state-changing operations. Obtain explicit approval before running them against live Forge resources.

Use `--fail-with-body` and preserve the HTTP status in diagnostics. Handle `401`, `403`, `404`, `422`, `429`, `500`, and `503` separately. Do not retry a state-changing request unless the API operation is documented as idempotent.

## Migrate a v1 caller

Use this sequence for each caller:

1. Record the current request method, path, payload, token source, and calling process. Redact token values.
2. Replace the legacy base with `https://forge.laravel.com/api`.
3. Resolve the target organization slug. Do not infer it from a server or site ID.
4. Map the old endpoint to its v2 resource in OpenAPI. Confirm path parameters, request body, response shape, pagination, and asynchronous behavior.
5. Update the client library if applicable. SDK v3 callers need the SDK v4 upgrade guide, not only a Composer version bump.
6. Add a safe read-only verification. For deployment history, verify the deployment status and commit metadata, not only site health.
7. Run the caller against a non-production or read-only target first. Get explicit approval before live writes.
8. Remove or update the legacy `/api/v1` instruction so future agents and operators cannot recreate the old call.

Do not bulk-replace `/api/v1` across a repository. That can corrupt unrelated application APIs and still leave Forge v2 organization scoping unresolved.

## Deployment and secret safety

- Treat deployment scripts as global, unattended execution surfaces. After any approved update, read the script back and compare it with the intended content.
- Do not put secrets in Forge command history. Use the approved secret store or an encrypted transfer path.
- Scope server, site, queue, scheduler, and restart actions to the target resource. Never run a server-wide action on shared infrastructure without explicit approval.
- Do not infer a successful deploy from a healthy site alone. Check the deployment's own status and output, then verify migrations, workers, and logs using the stack's documented procedure.
- Keep diagnosis read-only. A token's “last used” timestamp identifies a credential event, not the local process that made it. Correlate it with command history, CI logs, task transcripts, and the caller's token source before attributing it.

## Official references

- [API introduction](https://laravel.com/forge/docs/api-reference/introduction)
- [API basics and token management](https://laravel.com/forge/docs/api)
- [API pagination](https://laravel.com/forge/docs/api-reference/pagination)
- [API rate limiting](https://laravel.com/forge/docs/api-reference/rate-limiting)
- [API filtering and sorting](https://laravel.com/forge/docs/api-reference/filtering)
- [API relationships and includes](https://laravel.com/forge/docs/api-reference/relationships)
- [Forge CLI](https://laravel.com/forge/docs/cli)
- [Forge SDK](https://laravel.com/forge/docs/sdk)
- [Forge OpenAPI specification](https://laravel.com/api/docs.openapi)
