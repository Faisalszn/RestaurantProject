# Restaurant Project

A small restaurant website: a public menu backed by MySQL, a shopping cart
stored in the browser, and an admin panel for managing menu items.

## Setup

1. Start Apache + MySQL (e.g. via XAMPP/WAMP/MAMP) and place this folder in
   your webserver's document root.
2. Import the database schema and seed data:
   ```
   mysql -u root -p < database.sql
   ```
   This creates the `restaurant_db` database with `menu_items` and `admins`
   tables, and seeds the menu with the items already used in `photos/`.
3. Edit `connect.php` if your MySQL credentials differ from the defaults
   (`root` with no password).
4. Visit `index.html` in your browser.

## Admin panel

The admin panel (`admin.php`) requires login. The default seeded account is:

- **Username:** `admin`
- **Password:** `admin123`

Change this password (or add your own account) after first login by
updating the `admins` table — there is no self-service password change UI
yet.

## Project structure

- `index.html`, `menu.html`, `cart.html`, `me.html` — public pages.
- `menu.html` fetches live menu data from `get_menu.php`, so changes made
  in the admin panel are reflected immediately on the public menu.
- `admin.php`, `insert.php`, `update.php`, `delete.php` — admin CRUD pages
  for menu items (require login via `auth.php`).
- `login.php` / `logout.php` — admin session handling.
- `connect.php` — MySQL connection settings.
- `database.sql` — schema + seed data.
- `css/`, `js/`, `photos/` — static assets.
