# Configure Laravel Horizon for Job Handling

> Spec ID: configure-horizon-job-handling
> Created: 2025-01-03
> Status: Planning

## Overview

Configure Laravel Horizon for robust job queue management with proper authentication, monitoring, and production deployment settings. Horizon is already installed but needs proper configuration for production use.

## Goals

1. **Configure Horizon for production** - Set up proper supervisors, queues, and worker settings
2. **Implement secure authentication** - Ensure only authorized users can access the Horizon dashboard
3. **Set up monitoring** - Configure job metrics, failed job handling, and alerts
4. **Production deployment** - Configure for Laravel Forge deployment with proper process management

## Technical Approach

### 1. Authentication Strategy

#### Production Access Control
- Implement gate-based authorization using Laravel's built-in auth system
- Create a dedicated gate that checks if user is authorized to view Horizon
- Support multiple authentication methods:
  - Email-based whitelist for specific admin users
  - Environment-based bypass for local development
  - Optional IP whitelist for additional security

### 2. Queue Configuration

#### Queue Structure
```
default: General application tasks
high: Time-sensitive operations (emails, notifications)
low: Background tasks (reports, cleanup)
failed: Failed job handling
```

#### Worker Configuration
- **Local Environment**: 3 workers, balanced across queues
- **Production Environment**: 10 workers with auto-scaling
- **Memory Limits**: 256MB per worker in production
- **Timeout**: 90 seconds default, adjustable per job

### 3. Monitoring & Metrics

#### Job Metrics
- Track job throughput and wait times
- Monitor failed job rates
- Set up long-wait detection (60 seconds threshold)
- Configure metric retention (24 hours for graphs)

#### Failed Job Handling
- Automatic retry with exponential backoff
- Failed job notifications to admin email
- Weekly cleanup of old failed jobs
- Manual retry interface through Horizon dashboard

### 4. Security Configuration

#### Dashboard Access
- Secure route with authentication middleware
- HTTPS-only in production
- CSRF protection enabled
- Rate limiting on authentication attempts

#### Environment Variables
```env
HORIZON_PATH=horizon
HORIZON_PREFIX=jkudish_horizon
HORIZON_ADMIN_EMAILS=joey@jkudish.com
```

## Implementation Details

### File Structure
```
app/
  Providers/
    HorizonServiceProvider.php  # Authorization logic
  Jobs/
    ExampleJob.php              # Sample job for testing
config/
  horizon.php                   # Main configuration
  queue.php                     # Queue connection settings
routes/
  console.php                   # Horizon snapshot schedule
tests/
  Feature/
    HorizonAuthTest.php         # Authentication tests
    JobProcessingTest.php       # Queue processing tests
```

### Database Requirements
- Redis for queue backend (already configured)
- PostgreSQL tables:
  - `jobs` - Active job queue
  - `failed_jobs` - Failed job storage
  - `job_batches` - Batch job tracking

### Deployment Configuration

#### Laravel Forge Setup
```bash
# Supervisor configuration
[program:horizon]
process_name=%(program_name)s
command=php /home/forge/jkudish.com/artisan horizon
autostart=true
autorestart=true
user=forge
redirect_stderr=true
stdout_logfile=/home/forge/jkudish.com/horizon.log
stopwaitsecs=3600
```

#### Deployment Commands
```bash
php artisan horizon:terminate
php artisan horizon:purge
php artisan horizon:publish
php artisan optimize:clear
```

## Success Criteria

1. **Authentication Working**
   - ✅ Local environment allows unrestricted access
   - ✅ Production requires authenticated user
   - ✅ Only whitelisted emails can access dashboard
   - ✅ Access logs are maintained

2. **Queue Processing**
   - ✅ Jobs process successfully across all queues
   - ✅ Failed jobs are properly logged and retryable
   - ✅ Workers auto-scale based on load
   - ✅ Memory limits prevent runaway processes

3. **Monitoring Active**
   - ✅ Metrics display in dashboard
   - ✅ Failed job notifications sent
   - ✅ Long-wait detection triggers
   - ✅ Snapshot schedule runs hourly

4. **Production Ready**
   - ✅ Supervisor configuration deployed
   - ✅ Zero-downtime deployments work
   - ✅ Logs are properly rotated
   - ✅ Security headers in place

## Testing Requirements

### Unit Tests
- Gate authorization logic
- Queue configuration validation
- Failed job retry mechanism

### Feature Tests
- Dashboard authentication flow
- Job processing across queues
- Metrics data collection
- Failed job handling

### Integration Tests
- Redis connection and persistence
- Supervisor process management
- Deployment workflow

## Security Considerations

1. **Access Control**
   - Implement IP whitelisting option
   - Use secure session management
   - Log all access attempts

2. **Data Protection**
   - Sanitize job payloads in UI
   - Encrypt sensitive job data
   - Implement job payload size limits

3. **Rate Limiting**
   - Limit API requests to prevent abuse
   - Throttle failed authentication attempts
   - Monitor for suspicious activity

## Monitoring & Alerts

1. **Health Checks**
   - Queue worker status
   - Redis connection health
   - Memory usage monitoring

2. **Alert Triggers**
   - Failed job rate > 5%
   - Queue depth > 1000 jobs
   - Worker memory > 80%
   - Long wait time detected

3. **Logging**
   - Structured logging for all job events
   - Separate log channels for debugging
   - Log rotation and archival

## Documentation Requirements

1. **Admin Guide**
   - How to access Horizon dashboard
   - Understanding metrics and graphs
   - Managing failed jobs
   - Scaling workers

2. **Developer Guide**
   - Creating queueable jobs
   - Choosing appropriate queues
   - Handling job failures
   - Testing queued jobs

3. **Operations Guide**
   - Deployment procedures
   - Monitoring and alerts
   - Troubleshooting common issues
   - Performance tuning

## Dependencies

### Required Packages
- ✅ laravel/horizon: ^5.33 (already installed)
- ✅ predis/predis: ^2.0 (for Redis)
- ✅ ext-redis or ext-phpredis (PHP extension)

### Infrastructure
- Redis server (local and production)
- Supervisor process manager (production)
- Laravel Forge account (for deployment)

## Rollback Plan

1. **Disable Horizon**
   - Set QUEUE_CONNECTION=sync
   - Stop Horizon supervisor
   - Clear Redis queues

2. **Revert to Database Queue**
   - Update .env configuration
   - Run queue:work instead
   - Migrate existing jobs

3. **Emergency Procedures**
   - Force terminate workers
   - Flush Redis database
   - Restore from backup

## Notes

- Horizon provides real-time monitoring but adds Redis dependency
- Consider implementing queue priorities based on business needs
- Monitor Redis memory usage as job volume grows
- Plan for horizontal scaling if needed in future