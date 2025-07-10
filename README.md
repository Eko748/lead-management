# 🧩 Lead Management REST API

This is a simple Lead Management RESTful API built with Laravel and PostgreSQL, containerized using Docker Compose.

---

## 🚀 Stack Used

- **Framework:** Laravel 12
- **Database:** PostgreSQL 16
- **Server:** Nginx (via Docker)
- **Runtime:** PHP 8.3 (FPM)
- **Containerization:** Docker & Docker Compose

---

## 📂 Folder Structure

- `storage/app/public/json/`
  - Contains sample responses for all API endpoints:
    - `lead_get.json` – response from GET `/leads`
    - `lead_post.json` – response from POST `/leads`
    - `lead_patch.json` – response from PATCH `/leads/:id`
    - `lead_put.json` – response from PUT `/leads/:id`
    - `lead_delete.json` – response from DELETE `/leads/:id`

---

## 📦 Running Locally with Docker

### 1. Clone the repository

```bash
git clone https://github.com/Eko748/lead-management-api.git
cd lead-management-api
```

### 2. Copy the environment file

```bash
cp .env.example .env
```

### 3. Start Docker containers

```bash
docker-compose up -d --build
```

### 4. Enter the PHP container

```bash
docker exec -it lead_management_api bash
```

### 5. Install dependencies, generate key, and run migration+seeder

```bash
composer install
php artisan key:generate
php artisan migrate --seed
```

### 6. Exit the container

```bash
exit
```

### 7. Access the API

```bash
http://localhost:8080/api/leads
```

- [📝 View Response](https://github.com/Eko748/lead-management-api/blob/main/public/json/lead_get.json)
