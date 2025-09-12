<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;

uses(RefreshDatabase::class);

it('allows access to horizon dashboard in local environment', function () {
    // Tests run in 'testing' environment by default, but we need to test 'local' behavior
    app()->detectEnvironment(fn () => 'local');

    $response = $this->get('/horizon');

    $response->assertOk();
});

it('restricts horizon dashboard access in production without authentication', function () {
    app()->detectEnvironment(fn () => 'production');

    $response = $this->get('/horizon');

    $response->assertForbidden();
});

it('allows authorized users to access horizon dashboard in production', function () {
    app()->detectEnvironment(fn () => 'production');

    // Create a user with authorized email
    $user = User::factory()->create([
        'email' => 'joey@jkudish.com',
    ]);

    $response = $this->actingAs($user)->get('/horizon');

    $response->assertOk();
});

it('denies unauthorized users access to horizon dashboard in production', function () {
    app()->detectEnvironment(fn () => 'production');

    // Create a user with unauthorized email
    $user = User::factory()->create([
        'email' => 'unauthorized@example.com',
    ]);

    $response = $this->actingAs($user)->get('/horizon');

    $response->assertForbidden();
});

it('has horizon gate defined', function () {
    expect(Gate::has('viewHorizon'))->toBeTrue();
});

it('horizon configuration exists', function () {
    expect(config('horizon'))->toBeArray();
    expect(config('horizon.path'))->toBe('horizon');
    expect(config('horizon.use'))->toBe('default');
});
