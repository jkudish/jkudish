# Tasks: Configure Laravel Horizon for Job Handling

> Spec: configure-horizon-job-handling
> Status: Ready for Implementation

## Phase 1: Core Configuration

### 1.1 Configure Horizon Authentication
- [ ] Update HorizonServiceProvider with gate authorization
- [ ] Add email whitelist configuration
- [ ] Implement environment-based access control
- [ ] Test authentication in local environment

### 1.2 Set Up Queue Configuration
- [ ] Update config/horizon.php with production settings
- [ ] Configure supervisor settings for each environment
- [ ] Set up queue priorities (default, high, low)
- [ ] Configure memory limits and timeouts

### 1.3 Redis Configuration
- [ ] Verify Redis connection settings
- [ ] Configure Horizon Redis prefix
- [ ] Set up Redis persistence settings
- [ ] Test Redis connectivity

## Phase 2: Security & Access Control

### 2.1 Implement Authorization Gate
- [ ] Create Horizon authorization gate in HorizonServiceProvider
- [ ] Add admin email whitelist to .env.example
- [ ] Implement IP whitelist option (optional)
- [ ] Add logging for access attempts

### 2.2 Secure Dashboard Routes
- [ ] Configure HTTPS enforcement for production
- [ ] Add rate limiting middleware
- [ ] Ensure CSRF protection is active
- [ ] Test authentication flow

### 2.3 Environment Configuration
- [ ] Update .env.example with Horizon variables
- [ ] Document required environment variables
- [ ] Set up production environment variables
- [ ] Create .env.production template

## Phase 3: Monitoring & Metrics

### 3.1 Configure Job Metrics
- [ ] Set up metric snapshots schedule
- [ ] Configure retention periods
- [ ] Set wait time thresholds
- [ ] Enable long-wait detection

### 3.2 Failed Job Handling
- [ ] Configure failed job retention
- [ ] Set up retry logic
- [ ] Create failed job notification system
- [ ] Test manual retry functionality

### 3.3 Logging Configuration
- [ ] Set up Horizon-specific log channel
- [ ] Configure log rotation
- [ ] Implement structured logging
- [ ] Add debug logging option

## Phase 4: Testing

### 4.1 Write Authentication Tests
- [ ] Create HorizonAuthTest.php
- [ ] Test gate authorization logic
- [ ] Test email whitelist functionality
- [ ] Test environment-based access

### 4.2 Write Job Processing Tests
- [ ] Create JobProcessingTest.php
- [ ] Test queue priority handling
- [ ] Test failed job retry mechanism
- [ ] Test worker scaling

### 4.3 Integration Testing
- [ ] Test Redis connectivity
- [ ] Test supervisor integration
- [ ] Test deployment workflow
- [ ] Load test with sample jobs

## Phase 5: Sample Implementation

### 5.1 Create Example Jobs
- [ ] Create ExampleJob.php for testing
- [ ] Create high-priority notification job
- [ ] Create low-priority cleanup job
- [ ] Document job creation patterns

### 5.2 Queue Management Commands
- [ ] Create command to monitor queue health
- [ ] Create command to retry failed jobs in bulk
- [ ] Create command to clear old jobs
- [ ] Add commands to scheduler

## Phase 6: Production Deployment

### 6.1 Forge Configuration
- [ ] Create supervisor configuration file
- [ ] Set up deployment script
- [ ] Configure zero-downtime deployment
- [ ] Test deployment process

### 6.2 Process Management
- [ ] Configure Horizon supervisor
- [ ] Set up auto-restart on failure
- [ ] Configure log file management
- [ ] Test process monitoring

### 6.3 Health Monitoring
- [ ] Set up health check endpoint
- [ ] Configure uptime monitoring
- [ ] Set up alert notifications
- [ ] Test failure scenarios

## Phase 7: Documentation

### 7.1 Admin Documentation
- [ ] Document dashboard access procedures
- [ ] Create metrics interpretation guide
- [ ] Document failed job handling
- [ ] Create troubleshooting guide

### 7.2 Developer Documentation
- [ ] Document job creation patterns
- [ ] Explain queue selection criteria
- [ ] Document testing procedures
- [ ] Create code examples

### 7.3 Operations Documentation
- [ ] Document deployment procedures
- [ ] Create monitoring checklist
- [ ] Document scaling procedures
- [ ] Create incident response guide

## Phase 8: Optimization & Monitoring

### 8.1 Performance Tuning
- [ ] Optimize worker count for load
- [ ] Tune memory limits
- [ ] Optimize Redis configuration
- [ ] Implement caching strategies

### 8.2 Monitoring Setup
- [ ] Configure application monitoring
- [ ] Set up performance metrics
- [ ] Create custom dashboards
- [ ] Implement alerting rules

### 8.3 Backup & Recovery
- [ ] Set up Redis backup strategy
- [ ] Document recovery procedures
- [ ] Test backup restoration
- [ ] Create disaster recovery plan

## Completion Checklist

### Pre-Production
- [ ] All tests passing
- [ ] Documentation complete
- [ ] Security review completed
- [ ] Load testing performed

### Production Launch
- [ ] Environment variables configured
- [ ] Supervisor running
- [ ] Monitoring active
- [ ] Alerts configured

### Post-Launch
- [ ] Monitor for 24 hours
- [ ] Review performance metrics
- [ ] Address any issues
- [ ] Document lessons learned

## Notes

- Start with Phase 1 and 2 for basic functionality
- Phase 3 and 4 ensure reliability
- Phase 5 provides testing capabilities
- Phase 6 is required before production deployment
- Phase 7 should be completed alongside implementation
- Phase 8 is for optimization after initial deployment

## Priority Order

1. **Critical**: Phases 1, 2, 4.1
2. **High**: Phases 3, 4.2, 6
3. **Medium**: Phases 5, 7
4. **Low**: Phase 8

## Time-boxed Quick Start

If you need Horizon running quickly:
1. Complete Phase 1.1 and 2.1 (Authentication)
2. Use default configuration from Phase 1.2
3. Run basic tests from Phase 4.1
4. Deploy with minimal Phase 6.1

This gets you operational, then iterate through remaining phases.