# Royal Restaurant - Workflow Update

This package preserves the existing Dark Luxury (black/gold) interface and adds the requested restaurant workflow.

## Included behavior

- The first account registered in a fresh database becomes the administrator.
- Every later registration receives the `user` role; the public registration form cannot choose a role.
- Admin-only routes protect the dashboard, categories, and meals management pages.
- The admin dashboard shows category, meal, and admin counts.
- Categories support create, list, edit, and delete (a category with meals cannot be deleted until those meals are moved or removed).
- The public menu supports filtering by category.
- Visitors can add meals to a session-based shopping cart, update quantities, remove items, and clear the cart.
- No checkout/payment flow was added because it was not part of the supplied reference screenshots.

## Database

The included SQLite database is `database/restaurant_db.sqlite`. Existing user, category, meal, and image data were preserved. The existing administrator account was updated to:

- Name: `admin`
- Email: `admin@gmail.com`
- Role: `admin`

The existing password hash was preserved; no plaintext password is stored in this package.

## Run locally

From the project directory:

```bash
composer install
php artisan key:generate
php artisan migrate --force
php artisan storage:link
npm install
npm run build
php artisan serve
```

Open `http://127.0.0.1:8000`.

The database already contains the two new migration records and the role/settings tables. Running `php artisan migrate` will not reset existing data. Do not run `php artisan migrate:fresh`.

For a brand-new empty database, the first account registered becomes admin; subsequent accounts are regular users.
