<?php

use Illuminate\Support\Facades\Schedule;

// Console commands are defined in app/Console/Commands/ and auto-register in Laravel 11

// Schedule newsletter sync to run every hour
Schedule::command('app:sync-newsletters')->hourly();

// Schedule Horizon snapshots for metrics (every 5 minutes for better granularity)
Schedule::command('horizon:snapshot')->everyFiveMinutes();
