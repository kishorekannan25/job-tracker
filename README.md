# Job Tracker

A web app for tracking job applications — which companies you applied to, what stage each
application is at, and what you need to follow up on. Each user signs in and sees only their
own applications.

Built with Laravel 13, Tailwind CSS and MySQL.

![The applications list](docs/screenshot-list.png)

## Features

- **User accounts** — register, log in, log out. Each user's applications are private to them.
- **Authorization** — a policy blocks users from viewing, editing or deleting records they
  don't own, including by typing the URL directly.
- **Full CRUD** — add, view, edit and delete job applications
- **Status tracking** — applied / interview / offer / rejected, with colour-coded badges
- **Search and filter** — search by company, filter by status, or combine both; filters
  survive pagination
- **Pagination** — 10 applications per page
- **Server-side validation** — inline error messages, with the user's input preserved on failure
- **Flash messages** — confirmation after every create, update and delete

Each application records the company, role, status, date applied, salary range and free-text notes.

## Screenshots

| Search and filter | Validation errors |
| --- | --- |
| ![Filtering the list by status](docs/screenshot-filter.png) | ![Validation errors on the create form](docs/screenshot-validation.png) |
| **Adding an application** | **Application detail** |
| ![The create form](docs/screenshot-form.png) | ![An application's detail page](docs/screenshot-detail.png) |
| **Confirmation after deleting** | **Logging in** |
| ![Flash message after deleting an application](docs/screenshot-flash.png) | ![The login page](docs/screenshot-login.png) |

## Built with

- **Laravel 13** (PHP 8.3)
- **MySQL**
- **Blade** templates with a shared layout and a form partial reused by create and edit
- **Tailwind CSS 4**, compiled with Vite
- **PHPUnit** feature tests against an in-memory SQLite database

## Running it locally

**Requirements:** PHP 8.3+ (with `pdo_sqlite` enabled if you want to run the tests),
Composer, MySQL, Node.js

```bash
# 1. Clone and install PHP dependencies
git clone https://github.com/kishorekannan25/job-tracker.git
cd job-tracker
composer install

# 2. Set up the environment file
cp .env.example .env
php artisan key:generate

# 3. Create a MySQL database, then set these in .env:
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

Open http://localhost:8000, register an account, and you're in.

## Tests

```bash
php artisan test
```

Feature tests cover authentication, per-user data scoping, validation and the authorization
policy. They run against an in-memory SQLite database, so development data is never touched.

## Project structure

| Path | What's in it |
| --- | --- |
| `app/Models/Application.php` | The Eloquent model, with its `belongsTo` owner |
| `app/Models/User.php` | `hasMany` applications |
| `app/Http/Controllers/ApplicationController.php` | All seven RESTful actions |
| `app/Http/Controllers/Auth/` | Registration and session (login/logout) controllers |
| `app/Policies/ApplicationPolicy.php` | Who may view, update and delete a record |
| `database/migrations/` | The `applications` table and its `user_id` foreign key |
| `resources/views/layouts/app.blade.php` | Shared page shell |
| `resources/views/applications/` | Index, show, create and edit views |
| `resources/views/applications/partials/` | The form fields, shared by create and edit |
| `routes/web.php` | Resource routes behind `auth`, auth routes behind `guest` |
| `tests/Feature/ApplicationTest.php` | The feature tests |

## How this was built

I built this to learn Laravel properly, by typing it rather than cloning a tutorial.

I used an AI assistant as a tutor throughout: it explained each concept, told me what to
build next, reviewed what I'd written and pointed out my bugs. I typed the application code
myself — the controllers, models, migrations, views, policy and tests — one step at a time,
running each change in the browser before moving on. The rest is Laravel's own scaffolding,
and this README was drafted with the assistant's help.

The point was to come out of it able to read and debug Laravel, not just to end up with
working code. A fair amount of the learning came from the
mistakes: a misspelled `$request->` property that silently dropped data, a validation rule
with a stray space in it that made one dropdown option impossible to save, and a missing
`@method('PUT')` that produced a 405 I had to learn to read.

Concepts I worked through along the way: routing and RESTful resource controllers, Eloquent
models and migrations, Blade layouts and partials, forms and CSRF, HTTP method spoofing for
PUT and DELETE, server-side validation with old-input repopulation, route model binding,
query building with `when()`, authentication, foreign keys and relationships, authorization
policies, pagination, feature testing, and styling with Tailwind.

## Possible next steps

- Deploying it somewhere public
- A dashboard with counts per status
- File uploads for CVs and cover letters
- Reminders for follow-up dates
- Email verification on registration
