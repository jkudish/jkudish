# Laravel Horizon Setup Guide

## Overview

Laravel Horizon has been configured for robust job queue management with production-ready authentication and monitoring.

## Configuration Complete

### 🔐 Authentication
- Email-based whitelist authorization implemented
- Production dashboard secured with gate-based authentication
- Local environment allows unrestricted access for development
- Authorized email: joey@jkudish.com

### ⚙️ Queue Configuration
- Redis configured as queue driver
- Default queue with auto-scaling workers
- Local: 3 workers max
- Production: 10 workers max with auto-scaling
- Memory limits: 128MB (local), 256MB (production)
- Timeout: 90 seconds per job

### 📊 Monitoring
- Failed job email notifications to joey@jkudish.com
- Horizon snapshots scheduled every 5 minutes for metrics
- Job metrics retention: 24 hours
- Failed job retention: 7 days

### 🧪 Testing
- Example job created: `ProcessExampleTask`
- Comprehensive authentication tests
- All tests passing

## Usage

### Access Horizon Dashboard
- Local: http://jkudish.test/horizon (no authentication required)
- Production: https://jkudish.com/horizon (requires login with joey@jkudish.com)

### Dispatch Example Job

```php
use App\Jobs\ProcessExampleTask;

// Dispatch a successful job
ProcessExampleTask::dispatch('Test data');

// Dispatch a job that will fail (for testing)
ProcessExampleTask::dispatch('fail test');
```

### Running Horizon

```bash
# Start Horizon locally
php artisan horizon

# Monitor Horizon status
php artisan horizon:status

# Pause/Continue processing
php artisan horizon:pause
php artisan horizon:continue

# Terminate gracefully
php artisan horizon:terminate
```

## Production Deployment (Laravel Forge)

### 1. Environment Variables
Add to production .env:
```
QUEUE_CONNECTION=redis
HORIZON_AUTHORIZED_EMAILS=joey@jkudish.com
HORIZON_NOTIFICATION_EMAIL=joey@jkudish.com
```

### 2. Supervisor Configuration
Create daemon in Forge:
- **Command**: `php /home/forge/jkudish.com/artisan horizon`
- **User**: forge
- **Directory**: /home/forge/jkudish.com
- **Processes**: 1
- **Start Seconds**: 1
- **Stop Wait Seconds**: 60
- **Stop Signal**: TERM

### 3. Deployment Script
Add to deploy script:
```bash
php artisan horizon:terminate
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
```

### 4. Monitor Health
Check Horizon is running:
```bash
php artisan horizon:status
```

## Security Notes

- Dashboard protected by authentication gate in production
- Only whitelisted emails can access dashboard
- Failed job notifications sent to admin email
- All job payloads logged for debugging

## Troubleshooting

### Horizon Not Processing Jobs
1. Check Redis is running: `redis-cli ping`
2. Check Horizon is running: `php artisan horizon:status`
3. Check logs: `tail -f storage/logs/laravel.log`

### Authentication Issues
1. Verify email in HORIZON_AUTHORIZED_EMAILS
2. Ensure user is logged in
3. Check APP_ENV is set correctly

### Failed Job Notifications Not Sending
1. Verify mail configuration
2. Check HORIZON_NOTIFICATION_EMAIL is set
3. Review mail logs

## Next Steps

1. ✅ Deploy to production via Forge
2. ✅ Configure supervisor daemon
3. ✅ Test job processing in production
4. ✅ Monitor metrics via dashboard

All configuration is complete and ready for production deployment!