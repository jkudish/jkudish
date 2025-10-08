# Database Schema

This is the database schema implementation for the spec detailed in @.agent-os/specs/2025-10-02-newsletter-archive-integration/spec.md

## Database Changes

### New Table: broadcasts

Create a new `broadcasts` table to store newsletter broadcast data synced from Bento.

#### Migration

```php
Schema::create('broadcasts', function (Blueprint $table) {
    $table->id();
    $table->string('bento_id')->unique(); // Bento's broadcast ID
    $table->string('name'); // Broadcast name from Bento
    $table->string('subject'); // Email subject line
    $table->longText('html_content'); // Full HTML content from template
    $table->string('share_url')->nullable(); // Bento's public share URL
    $table->timestamp('sent_at')->nullable(); // When the broadcast was sent
    $table->json('stats')->nullable(); // Bento stats (open_rate, etc.)
    $table->timestamps();

    // Indexes
    $table->index('sent_at'); // For chronological ordering
});
```

#### Field Descriptions

- **id**: Primary key
- **bento_id**: Unique identifier from Bento API (prevents duplicate imports)
- **name**: Broadcast name from Bento (used for display title)
- **subject**: Email subject line (may differ from name)
- **html_content**: Full HTML content from Bento's template.html field
- **share_url**: Bento's public share URL (backup option)
- **sent_at**: Timestamp when broadcast was sent (from sent_final_batch_at)
- **stats**: JSON field for Bento statistics (open_rate, etc.)
- **timestamps**: Laravel's created_at and updated_at

#### Indexes

- **Unique index on bento_id**: Ensures no duplicate broadcasts can be imported
- **Index on sent_at**: Optimizes queries for reverse chronological ordering

#### Constraints

- **bento_id**: Must be unique, not nullable
- **name**: Not nullable (required for display)
- **subject**: Not nullable (required for display)
- **html_content**: Not nullable (core content)
- **sent_at**: Nullable (may not be sent yet, though we filter these out)

## Rationale

### Why store broadcasts in our database?

1. **Performance**: Avoids repeated API calls to Bento for each page load
2. **Reliability**: Site continues to work even if Bento API is temporarily unavailable
3. **Flexibility**: Enables future features like search, filtering, or custom ordering
4. **Speed**: Fast queries for chronological listing without external API latency

### Why index sent_at?

The primary query pattern will be listing newsletters in reverse chronological order (newest first). Indexing `sent_at` ensures this query remains fast even as the newsletter archive grows.

### Why use longText for html_content?

Newsletter content can be extensive with full HTML, styling, and images. `longText` supports up to 4GB of data, ensuring we never truncate newsletter content.

### Why store stats as JSON?

Bento provides various statistics (open rates, click rates, etc.) that may evolve over time. Using JSON allows flexible storage without schema changes, and we can query/display specific metrics as needed.
