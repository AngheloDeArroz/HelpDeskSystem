# Deployment 

This document covers the environment setup, local run instructions, deployment flow, and basic CI/CD for the TALL stack ticketing system using PostgreSQL.

---

## Environment Setup

1. **Install PHP** (>=8.1)
2. **Install Composer**
3. **Install Node.js & npm**
4. **Install PostgreSQL**
5. **Install Laravel Dependencies**

   ```bash
   composer install
   ```
6. **Install NPM Dependencies**

   ```bash
   npm install && npm run dev
   ```
7. **Setup Environment File**

   ```bash
   cp .env.example .env
   ```

   Update the following in `.env`:

   ```dotenv
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=helpdesk
   DB_USERNAME=postgres
   DB_PASSWORD=admin
   ```
8. **Generate Application Key**

   ```bash
   php artisan key:generate
   ```

---

## Run Project Locally

1. **Run Database Migrations & Seeders**

   ```bash
   php artisan migrate --seed
   ```
2. **Start Laravel Server**

   ```bash
   php artisan serve
   ```
3. **Access the App**
   Open browser: `http://127.0.0.1:8000`

---

## Deployment Flow

**Steps:**

1. Push code to repository
2. CI pipeline runs tests & builds assets
3. On success, code is deployed to staging/production server
4. Server runs `composer install`, `npm install & npm run build`, migrations
5. Application is served via web server (Nginx/Apache) connected to PostgreSQL

**Flow Diagram (Conceptual):**

```
[Local Dev] --> [Repository] --> [CI/CD Pipeline] --> [Server Deployment] --> [Web Server + PostgreSQL] --> [Users Access WebApp]
```

---

## Basic CI/CD Explanation

* **CI (Continuous Integration):** Automatically run tests and build assets whenever code is pushed.
* **CD (Continuous Deployment):** Automatically deploy changes to staging/production after CI passes.
* Conceptually, it ensures that the application is always in a deployable state and reduces human error during deployment.

