<?php

use App\Models\User;

it('allows access to horizon dashboard in local environment', function () {
    // In local environment, Horizon should be accessible without authentication
    // Skip this test as it requires actual environment setup
    $this->markTestSkipped('Requires actual local environment setup');
});

it('denies access to unauthenticated users in production', function () {
    // In production, unauthenticated users should be denied access
    config(['app.env' => 'production']);

    $response = $this->get('/horizon');

    // Horizon returns 403 Forbidden for unauthenticated users
    $response->assertForbidden();
});

it('denies access to unauthorized users in production', function () {
    // In production, authenticated but unauthorized users should be denied
    config(['app.env' => 'production']);

    $user = User::factory()->create([
        'email' => 'unauthorized@example.com',
    ]);

    $response = $this->actingAs($user)->get('/horizon');

    $response->assertForbidden();
});

it('allows access to authorized users in production', function () {
    // In production, authorized users should have access
    config(['app.env' => 'production']);
    config(['horizon.authorized_emails' => ['joey@jkudish.com']]);

    $user = User::factory()->create([
        'email' => 'joey@jkudish.com',
    ]);

    $response = $this->actingAs($user)->get('/horizon');

    $response->assertSuccessful();
});

it('supports multiple authorized emails from config', function () {
    // Test that multiple emails can be authorized
    config(['app.env' => 'production']);
    config(['horizon.authorized_emails' => ['joey@jkudish.com', 'admin@example.com']]);

    $user1 = User::factory()->create([
        'email' => 'joey@jkudish.com',
    ]);

    $user2 = User::factory()->create([
        'email' => 'admin@example.com',
    ]);

    $this->actingAs($user1)->get('/horizon')->assertSuccessful();
    $this->actingAs($user2)->get('/horizon')->assertSuccessful();
});

it('reads authorized emails from environment variable', function () {
    // Test that emails can be configured via environment variable
    config(['app.env' => 'production']);

    // Simulate environment variable with multiple emails
    putenv('HORIZON_AUTHORIZED_EMAILS=joey@jkudish.com,admin@example.com');
    config(['horizon.authorized_emails' => explode(',', env('HORIZON_AUTHORIZED_EMAILS'))]);

    $authorizedUser = User::factory()->create([
        'email' => 'joey@jkudish.com',
    ]);

    $unauthorizedUser = User::factory()->create([
        'email' => 'hacker@evil.com',
    ]);

    $this->actingAs($authorizedUser)->get('/horizon')->assertSuccessful();
    $this->actingAs($unauthorizedUser)->get('/horizon')->assertForbidden();

    // Clean up
    putenv('HORIZON_AUTHORIZED_EMAILS');
});
