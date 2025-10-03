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
        $notificationEmail = config('horizon.notification_email', 'joey@jkudish.com');
        Horizon::routeMailNotificationsTo($notificationEmail);

        // Configure Horizon to use the application's timezone
        Horizon::use(config('horizon.use', 'default'));
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
            $authorizedEmails = config('horizon.authorized_emails', ['joey@jkudish.com']);

            if (! $user) {
                return false;
            }

            return in_array($user->email, $authorizedEmails);
        });
    }
}
