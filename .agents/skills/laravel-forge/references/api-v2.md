# Forge API v2 reference notes

Use this file when an endpoint migration needs more detail than the main workflow.

## Contract

- Base URL: `https://forge.laravel.com/api`
- Authentication: `Authorization: Bearer <token>`
- Required headers: `Accept: application/json` and `Content-Type: application/json`
- New resource operations are generally organization-scoped by an organization slug.
- Collections use cursor pagination. A client must follow the documented cursor instead of assuming page-number pagination.
- Rate limiting is part of the API contract. Read the response headers and handle `429` with bounded backoff.

The new API is not a path-only rename from `/api/v1`. Use the OpenAPI document to map each endpoint. Confirm the HTTP method, path parameters, body, response envelope, pagination, and whether the operation is asynchronous.

## SDK v3 to v4 migration

Forge SDK v4 targets API v2 and has breaking changes:

- Add the organization slug as the first argument to most resource methods.
- Resolve the slug through `organizations()` and cache it in configuration.
- Treat collection results as `CursorPaginator` instances.
- Rename daemon concepts to background processes.
- Account for SDK polling on asynchronous resource creation and actions.
- Handle the dedicated SDK exceptions instead of matching arbitrary response strings.

## CLI v2 operator flow

```text
forge login
forge organization:list
forge organization:switch <slug>
forge server:list
forge server:switch <name-or-id>
forge site:list
forge deploy [site]
```

Check `forge` for the installed command set. A CLI login or switch can update local CLI state, so do not run it as part of a read-only diagnosis unless that local write is intended.

## Local migration target

The machine's shared `yums-dev` Forge stack still describes the legacy base URL in its “Forge API + SSH idioms” section:

```text
~/Herd/yums-dev/plugins/yums-dev/stacks/laravel-forge.md
```

That section is documentation used by deployment and monitoring workflows. Update it only with endpoint mappings confirmed against OpenAPI. The deployment workflow may call raw `curl` dynamically, so searching source for a complete URL is not sufficient; search for `FORGE_API_TOKEN`, `curl`, `deployment-history`, and the Forge host together.

## Migration checklist

| Legacy concern | v2 action |
| --- | --- |
| `/api/v1` base URL | Use `https://forge.laravel.com/api` |
| Server/site calls without an organization | Resolve and pass the organization slug |
| SDK v3 | Upgrade to SDK v4 and apply method signature changes |
| Array/page-number assumptions | Use cursor pagination and `lazy()` where appropriate |
| Daemon terminology | Use background-process resources and methods |
| Health-only deploy verification | Read deployment status and output as well as health |

## Sources

- [API introduction](https://laravel.com/forge/docs/api-reference/introduction)
- [Pagination](https://laravel.com/forge/docs/api-reference/pagination)
- [Rate limiting](https://laravel.com/forge/docs/api-reference/rate-limiting)
- [Relationships and includes](https://laravel.com/forge/docs/api-reference/relationships)
- [CLI](https://laravel.com/forge/docs/cli)
- [SDK](https://laravel.com/forge/docs/sdk)
- [OpenAPI](https://laravel.com/api/docs.openapi)
