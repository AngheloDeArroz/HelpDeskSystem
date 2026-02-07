## Project Overview

The TALL Stack Ticketing System is a web application built using **TailwindCSS, Alpine.js, Laravel, and Livewire (TALL)** with PostgreSQL. It provides role-based ticket management for Users, Support, and Admins, allowing ticket submission, commenting, status updates, and administrative actions.

## Setup Instructions

1. Install PHP dependencies

   ```bash
   composer install
   ```
2. Install Node dependencies

   ```bash
   npm install && npm run dev
   ```
3. Copy environment file

   ```bash
   cp .env.example .env
   ```
4. Configure PostgreSQL in `.env`
5. Generate Laravel key

   ```bash
   php artisan key:generate
   ```
6. Run migrations and seeders

   ```bash
   php artisan migrate --seed
   ```
7. Serve application locally

   ```bash
   php artisan serve
   ```

## Tech Stack Used

* **Laravel** (PHP Framework)
* **Livewire** (Reactive components)
* **TailwindCSS** (UI styling)
* **Alpine.js** (Frontend interactions)
* **PostgreSQL** (Database)
* **Node.js & NPM** (Frontend build tools)
