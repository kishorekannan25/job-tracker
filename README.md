# Job Tracker

A web app for tracking job applications — which companies you applied to, what stage each
application is at, and what you need to follow up on. Built with Laravel 13.

![Job Tracker screenshot](docs/screenshot.png)

## Features

- **Full CRUD** — add, view, edit and delete job applications
- **Status tracking** — applied / interview / offer / rejected, with colour-coded badges
- **Search and filter** — search by company name, filter by status, or combine both
- **Server-side validation** — with inline error messages and input preserved on failure
- **Flash messages** — confirmation after every create, update and delete

Each application records the company, role, status, date applied, salary range and free-text notes.

## Built with

- **Laravel 13** (PHP 8.3)
- **MySQL**
- **Blade** templates with a shared layout and a reusable form partial
- **Tailwind CSS 4**, compiled with Vite

## Running it locally

**Requirements:** PHP 8.3+, Composer, MySQL, Node.js

```bash
# 1. Clone and install PHP dependencies
git clone https://github.com/kishorekannan25/job-tracker.git
cd job-tracker
composer install

# 2. Set up the environment file
cp .env.example .env
php artisan key:generate

# 3. Create the database, then set these in .env:
#    DB_DATABASE=job_tracker
#    DB_USERNAME=root
#    DB_PASSWORD=
php artisan migrate

# 4. Install front-end dependencies and start the asset build
npm install
npm run dev

# 5. Serve the app (in a second terminal)
php artisan serve
```

Then open http://localhost:8000/applications.

## Project structure

| Path | What's in it |
| --- | --- |
| `app/Models/Application.php` | The Eloquent model |
| `app/Http/Controllers/ApplicationController.php` | All seven RESTful actions |
| `database/migrations/` | The `applications` table schema |
| `resources/views/layouts/app.blade.php` | Shared page shell |
| `resources/views/applications/` | Index, show, create and edit views |
| `resources/views/applications/partials/` | The form fields, shared by create and edit |
| `routes/web.php` | A single `Route::resource` definition |

## About this project

I built this to learn Laravel by writing it myself rather than copying tutorials. Along the way
I worked through routing and RESTful resource controllers, Eloquent models and migrations, Blade
layouts and partials, form handling and CSRF, HTTP method spoofing for PUT and DELETE, server-side
validation with old-input repopulation, route model binding, query building with `when()`, and
styling with Tailwind.

## Possible next steps

- User accounts, so each person sees only their own applications
- A dashboard with counts per status
- File uploads for CVs and cover letters
- Reminders for follow-up dates
