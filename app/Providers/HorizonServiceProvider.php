<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Horizon\Horizon;
use Laravel\Horizon\HorizonApplicationServiceProvider;

class HorizonServiceProvider extends HorizonApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        parent::boot();

        // Configure mail notifications for failed jobs
        Horizon::routeMailNotificationsTo('joey@jkudish.com');
    }

    /**
     * Register the Horizon gate.
     *
     * This gate determines who can access Horizon in non-local environments.
     */
    protected function gate(): void
    {
        Gate::define('viewHorizon', function ($user = null) {
            // Allow access in local environment without authentication
            if (app()->environment('local')) {
                return true;
            }

            // In production, require authentication with authorized email
            return in_array(optional($user)->email, [
                'joey@jkudish.com',
            ]);
        });
    }
}
