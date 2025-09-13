<?php

use Illuminate\Support\Facades\Gate;

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

it('has horizon gate defined', function () {
    expect(Gate::has('viewHorizon'))->toBeTrue();
});

it('horizon configuration exists', function () {
    expect(config('horizon'))->toBeArray();
    expect(config('horizon.path'))->toBe('horizon');
    expect(config('horizon.use'))->toBe('default');
});
