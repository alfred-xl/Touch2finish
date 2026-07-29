# Touch2finish

Laravel website and quote-request workflow for Touch2finish, serving customers primarily across London.

## Local setup

1. Copy `.env.example` to `.env` and configure the database and mail transport.
2. Run `composer install` and `npm install`.
3. Run `php artisan key:generate` and `php artisan migrate`.
4. Start the application with `composer run dev`, or run the web server, queue worker and Vite separately.

## Quote notifications and queue

Quote submissions are saved before notification emails are dispatched. The internal notification goes to `CONTACT_RECEIVER_EMAIL` (default `info@touch2finish.co.uk`), followed by the customer acknowledgement. Uploaded photographs are stored privately and attached only when the stored file still exists.

The default queue connection is `database`. A queue worker must run continuously in every deployed environment:

```sh
php artisan queue:work --sleep=3 --tries=3 --timeout=120
```

Use Supervisor, systemd, or the hosting platform's worker facility to keep that command running. Run `php artisan queue:restart` after each deployment so workers load the new release. Monitor the `failed_jobs` table and retry resolved failures with `php artisan queue:retry all`.

## Production deployment

Set `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL`, `APP_TIMEZONE=Europe/London`, the production database credentials, a real mail transport, and `CONTACT_RECEIVER_EMAIL`. Then run:

```sh
composer install --no-dev --optimize-autoloader
npm ci
npm run build
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
php artisan queue:restart
```

Ensure `storage` and `bootstrap/cache` are writable by the application user and serve the site through the `public` directory.

## Verification

```sh
php artisan test
npm run build
```
