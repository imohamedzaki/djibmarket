# 📧 Queue-Based Email System Setup Guide

## 🎯 Overview

The seller activation email system has been upgraded to use Laravel's queue system for better performance and user experience. Emails are now processed in the background, so users see immediate feedback without waiting for email delivery.

## ⚙️ Setup Instructions

### 1. Environment Configuration

Make sure your `.env` file has the following queue configuration:

```env
# Queue Configuration
QUEUE_CONNECTION=database
QUEUE_FAILED_DRIVER=database-uuids

# Mail Configuration (ensure these are set)
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email@domain.com
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@djibmarket.com
MAIL_FROM_NAME="DjibMarket"
```

### 2. Database Tables

The required queue tables should already exist:

-   `jobs` - Stores queued jobs
-   `failed_jobs` - Stores failed job attempts

If they don't exist, run:

```bash
php artisan migrate
```

### 3. Queue Worker Setup

#### For Development

Start the queue worker manually:

```bash
php artisan queue:work
```

#### For Production

Use a process manager like Supervisor to keep the queue worker running:

**Create supervisor config** (`/etc/supervisor/conf.d/djibmarket-worker.conf`):

```ini
[program:djibmarket-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /path/to/djibmarket/artisan queue:work --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/path/to/djibmarket/storage/logs/worker.log
stopwaitsecs=3600
```

Then run:

```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start djibmarket-worker:*
```

## 🧪 Testing the Queue System

### Test Email Queuing

```bash
php artisan test:seller-activation-email user@example.com
```

### Monitor Queue Status

```bash
# Check queued jobs
php artisan queue:monitor

# Check failed jobs
php artisan queue:failed

# Retry failed jobs
php artisan queue:retry all

# Clear all jobs
php artisan queue:clear
```

## 🚀 How It Works

### Before (Synchronous)

1. User submits registration
2. ⏳ **Wait** for email to send (2-5 seconds)
3. Show success message
4. Redirect to login

### After (Asynchronous)

1. User submits registration
2. ✅ **Instant** success message
3. Email queued for background processing
4. Immediate redirect to login
5. 📧 Email sent in background

## 📝 Queue Features Implemented

### ✅ Retry Logic

-   **Automatic retries**: 3 attempts with exponential backoff (30s, 1m, 2m)
-   **Timeout protection**: Jobs timeout after 10 minutes
-   **Failed job logging**: Failed attempts stored for review

### ✅ Queue Organization

-   **Dedicated queue**: Emails use `emails` queue for prioritization
-   **Job batching**: Multiple emails can be processed efficiently
-   **Memory management**: Queue worker restarts periodically

### ✅ Error Handling

-   **Graceful failures**: Failed emails don't crash the system
-   **Retry mechanisms**: Temporary failures are automatically retried
-   **Monitoring**: Failed jobs are logged for manual review

## 🔧 Queue Management Commands

```bash
# Start processing jobs
php artisan queue:work

# Process only one job and exit
php artisan queue:work --once

# Work specific queue
php artisan queue:work --queue=emails

# Stop worker gracefully
php artisan queue:restart

# Monitor queue performance
php artisan queue:monitor database

# View failed jobs
php artisan queue:failed

# Retry specific failed job
php artisan queue:retry {job-id}

# Clear all failed jobs
php artisan queue:flush
```

## 🏃‍♂️ Quick Start Checklist

-   [ ] ✅ Queue tables created (`jobs`, `failed_jobs`)
-   [ ] ⚙️ Environment variables configured
-   [ ] 📧 Mail settings verified
-   [ ] 🧪 Test email queuing works
-   [ ] 🔄 Queue worker running
-   [ ] 📊 Monitor queue in production

## 🎯 Performance Benefits

-   **Faster response times**: User sees success immediately
-   **Better reliability**: Failed emails are automatically retried
-   **Scalability**: Can handle high volume of registrations
-   **Resource efficiency**: Email sending doesn't block web requests
-   **Better user experience**: No waiting for email delivery

## 🚨 Production Considerations

1. **Process Management**: Always use Supervisor in production
2. **Monitoring**: Set up alerts for failed jobs
3. **Logs**: Monitor queue worker logs regularly
4. **Memory**: Restart workers periodically to prevent memory leaks
5. **Scaling**: Add more workers for high volume

---

## 📞 Support

If you encounter issues:

1. Check queue worker logs: `storage/logs/worker.log`
2. Review failed jobs: `php artisan queue:failed`
3. Test mail configuration: `php artisan test:seller-activation-email`
4. Restart queue worker: `php artisan queue:restart`
