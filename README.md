# 🎫 HelpDesk System

A modern, streamlined HelpDesk Ticket Management System built with **Laravel 12**, **Livewire (Volt)**, and **Tailwind CSS**. Designed for performance and ease of use, it features a complete Dockerized environment and Supabase integration.

---

## 🚀 Features

- **Role-Based Access Control**: Tailored dashboards for **Admins**, **Support Agents**, and **Users**.
- **Intelligent Search**: Powerful filtering by subject, user, status, or priority.
- **Real-time Interaction**: Livewire-powered components for a seamless, SPA-like experience.
- **Communication Thread**: Native commenting system for collaborative ticket resolution.
- **Admin Command Center**: Advanced tools for archiving, restoring, and system-wide monitoring.
- **Secure Authentication**: Robust profile and session management via Laravel Breeze.

---

## 🛠️ Technical Stack

- **Backend**: Laravel 12.49+ (PHP 8.4)
- **Frontend**: Livewire 3 / Volt / Vite
- **Styling**: Tailwind CSS
- **Database**: PostgreSQL (Supabase)
- **Containerization**: Docker & Docker Compose
- **Server**: Nginx & Supervisor

---

## 🐳 Docker Setup (Recommended)

The easiest way to get the HelpDesk system running is using Docker.

### 1. Prerequisites
- [Docker Desktop](https://www.docker.com/products/docker-desktop/) installed and running.
- A **Supabase** project for the PostgreSQL database.

### 2. Environment Configuration
Copy the `.env.example` file to `.env` and fill in your Supabase connection details:

```bash
cp .env.example .env
```

**Required Database Variables:**
```env
DB_CONNECTION=pgsql
DB_HOST=your-supabase-host.supabase.co
DB_PORT=6543
DB_DATABASE=postgres
DB_USERNAME=postgres.your-project-id
DB_PASSWORD=your-database-password
```

### 3. Launch the Application
Build and start the containers:

```bash
docker-compose up -d --build
```

The system will automatically:
- Install dependencies.
- Compile frontend assets.
- Generate an application key (if missing).
- Run database migrations.

**Access the app at:** [http://localhost:8000](http://localhost:8000)

### 4. Seed the Database
To populate the system with default roles, statuses, and test users, run:

```bash
docker exec -it helpdesk-app php artisan db:seed
```

---

## 🔐 Default Test Credentials

| Role | Email | Permissions |
| :--- | :--- | :--- |
| **Admin** | `admin@example.com` | Full Control, Archive, Restore, Delete |
| **Support** | `support@example.com` | Solve Tickets, Comment |
| **User** | `user1@example.com` | Create & Track Own Tickets |

*Default Password: `password`*

---

## 📂 Project Structure

- `app/Http/Controllers`: Core business logic and search implementation.
- `app/Models`: Database entities (Ticket, User, Role, Status, Priority).
- `resources/views/livewire`: Reactive UI components.
- `docker/`: Nginx, Supervisor, and Entrypoint configurations.
- `routes/web.php`: Role-protected route definitions.

---
Built with ❤️ using the TALL Stack.