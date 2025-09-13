<?php

use Illuminate\Support\Facades\Config;

it('has redis queue connection configured', function () {
    // Set the queue connection to redis for this test
    Config::set('queue.default', 'redis');

    expect(config('queue.default'))->toBe('redis');
    expect(config('queue.connections.redis'))->toBeArray();
    expect(config('queue.connections.redis.driver'))->toBe('redis');
    expect(config('queue.connections.redis.connection'))->toBe('default');
    expect(config('queue.connections.redis.queue'))->toBe('default');
});

it('has correct horizon supervisor configuration', function () {
    $defaults = config('horizon.defaults.supervisor-1');

    expect($defaults)->toBeArray();
    expect($defaults['connection'])->toBe('redis');
    expect($defaults['queue'])->toContain('default');
    expect($defaults['tries'])->toBe(3);
    expect($defaults['timeout'])->toBe(90);
    expect($defaults['memory'])->toBe(128);
});

it('has correct horizon production configuration', function () {
    $production = config('horizon.environments.production.supervisor-1');

    expect($production)->toBeArray();
    expect($production['maxProcesses'])->toBe(10);
    expect($production['memory'])->toBe(256);
    expect($production['tries'])->toBe(3);
    expect($production['timeout'])->toBe(90);
});

it('has correct horizon local configuration', function () {
    $local = config('horizon.environments.local.supervisor-1');

    expect($local)->toBeArray();
    expect($local['maxProcesses'])->toBe(3);
});

it('has redis configuration set', function () {
    expect(config('database.redis'))->toBeArray();
    expect(config('database.redis.default'))->toBeArray();
    expect(config('database.redis.default.host'))->toBe('127.0.0.1');
    expect(config('database.redis.default.port'))->toBe('6379');
});

it('horizon service provider is registered', function () {
    $providers = app()->getProviders(\App\Providers\HorizonServiceProvider::class);

    expect($providers)->toHaveCount(1);
});
