# 🧩 Lead Management REST API

This is a simple Lead Management RESTful API built with Laravel and PostgreSQL, containerized using Docker Compose.

---

## 🚀 Stack Used

-   **Framework:** Laravel 12
-   **Database:** PostgreSQL 16
-   **Server:** Nginx (via Docker)
-   **Runtime:** PHP 8.3 (FPM)
-   **Containerization:** Docker & Docker Compose

---

## 📦 Running Locally with Docker

### 1. Clone the repository

```bash
git clone https://github.com/Eko748/lead-management.git
cd lead-management
```

### 2. Make sure the .env file is available

> The `.env` file is required for database connection configuration and other purposes.  
> If it doesn't exist, copy it from the example file:

```bash
cp .env.example .env
```

> Or, if you want to build manually, make sure at least the following configuration is available in `.env`:

```bash
DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=lead_management
DB_USERNAME=postgres
DB_PASSWORD=postgres
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
php artisan optimize:clear
```

### 6. Access the API

```bash
http://localhost:8080/api/leads
```

---

## 📘 Lead API Documentation Request Body (JSON)

### 📥 Create Lead - POST `http://localhost:8080/api/leads`

```bash
{
  "name": "John Doe",
  "email": "john@example.com",
  "phone": "08123456789",
  "status": "new"
}
```

### ♻️ Update Lead - PUT `http://localhost:8080/api/leads/4e5d8c32-3a8b-4bdf-9d20-1a3f3e6d1f01`

```bash
{
  "name": "Jane Doe",
  "email": "jane@example.com",
  "phone": "08987654321",
  "status": "contacted"
}
```

### 🔧 Partial Update Lead - PATCH `http://localhost:8080/api/leads/4e5d8c32-3a8b-4bdf-9d20-1a3f3e6d1f01`

```bash
{
  "email": "newmail@example.com",
}
```

---

## 📂 Folder Structure JSON Response

-   `public/json/`
    -   Contains sample responses for all API endpoints:
        -   `lead_get.json` – response from GET `/leads`
        -   `lead_post.json` – response from POST `/leads`
        -   `lead_patch.json` – response from PATCH `/leads/:id`
        -   `lead_put.json` – response from PUT `/leads/:id`
        -   `lead_delete.json` – response from DELETE `/leads/:id`

---

## 📘 Example API Responses

<details>
<summary>
1. GET `/leads`
</summary>

```json
{
    "code": 200,
    "status": "OK",
    "message": "Leads retrieved successfully",
    "data": [
        {
            "public_id": "4e5d8c32-3a8b-4bdf-9d20-1a3f3e6d1f01",
            "name": "Lead 1",
            "email": "lead1@mail.com",
            "phone": "081234567890",
            "status": "new",
            "created_at": "10-07-2025 08:04:43",
            "updated_at": "10-07-2025 08:04:43",
            "created_by": {
                "public_id": "48935be0-7a8a-4b6c-94d5-b3d3097b7300",
                "name": "Norberto Cassin MD"
            },
            "updated_by": {
                "public_id": "a3b78bdf-0644-4d51-930b-ad423687192a",
                "name": "Abdiel Mayer"
            }
        },
        {
            "public_id": "866f651c-6614-4043-b8e3-33532059784e",
            "name": "Selina Feil",
            "email": "kaitlin03@example.net",
            "phone": "08118913966",
            "status": "new",
            "created_at": "10-07-2025 08:04:43",
            "updated_at": "10-07-2025 08:04:43",
            "created_by": {
                "public_id": "6324e994-c668-4010-893a-a32dc13f0438",
                "name": "Dr. Shawn Moore Sr."
            },
            "updated_by": {
                "public_id": "a3b78bdf-0644-4d51-930b-ad423687192a",
                "name": "Abdiel Mayer"
            }
        },
        {
            "public_id": "2fbe5baa-a75f-4e20-be0d-3ef4a6a7d66f",
            "name": "Prof. Coleman Hilpert V",
            "email": "arlo.heathcote@example.com",
            "phone": "08787213306",
            "status": "qualified",
            "created_at": "10-07-2025 08:04:43",
            "updated_at": "10-07-2025 08:04:43",
            "created_by": {
                "public_id": "2f49145a-4a92-4b89-980f-f85fb45b0ec2",
                "name": "Dr. Dallin Friesen V"
            },
            "updated_by": {
                "public_id": "ecc0f629-a66f-4a47-ae7e-82891b791056",
                "name": "Johnpaul Corwin"
            }
        },
        {
            "public_id": "c98be900-6ad1-47a3-bade-3fa4d79d2402",
            "name": "Mr. Lee Hahn MD",
            "email": "morton65@example.net",
            "phone": "08498418728",
            "status": "qualified",
            "created_at": "10-07-2025 08:04:43",
            "updated_at": "10-07-2025 08:04:43",
            "created_by": {
                "public_id": "7f84e01b-bb3e-420a-aaf0-fbaa9b96bd52",
                "name": "Chadd Grady"
            },
            "updated_by": {
                "public_id": "a3b78bdf-0644-4d51-930b-ad423687192a",
                "name": "Abdiel Mayer"
            }
        },
        {
            "public_id": "728b2fbd-aa10-4e44-9672-8d0e9ed04a1c",
            "name": "Andreane Cremin I",
            "email": "braun.eleanore@example.com",
            "phone": "08334436340",
            "status": "converted",
            "created_at": "10-07-2025 08:04:43",
            "updated_at": "10-07-2025 08:04:43",
            "created_by": {
                "public_id": "67b6eb64-acf5-41df-ac55-b3535cedb350",
                "name": "Anderson Blanda"
            },
            "updated_by": {
                "public_id": "48935be0-7a8a-4b6c-94d5-b3d3097b7300",
                "name": "Norberto Cassin MD"
            }
        },
        {
            "public_id": "477cb068-7893-4e0d-b974-25423b14afd9",
            "name": "Kiarra Stracke",
            "email": "jpouros@example.net",
            "phone": "08921100373",
            "status": "rejected",
            "created_at": "10-07-2025 08:04:43",
            "updated_at": "10-07-2025 08:04:43",
            "created_by": {
                "public_id": "fe89ab1d-ecb1-4f8b-b0e4-74d16ccaa534",
                "name": "Caesar Wyman"
            },
            "updated_by": {
                "public_id": "dd00136a-9c68-492b-af6e-25e394c43811",
                "name": "Kennedy Koelpin"
            }
        },
        {
            "public_id": "6ad0a420-c096-448a-b387-6332bad88587",
            "name": "Jazmyn Kuhic Sr.",
            "email": "jharris@example.com",
            "phone": "08858358372",
            "status": "contacted",
            "created_at": "10-07-2025 08:04:43",
            "updated_at": "10-07-2025 08:04:43",
            "created_by": {
                "public_id": "bffd119f-2912-480c-83d0-0f0e20d06053",
                "name": "Tyrel Christiansen"
            },
            "updated_by": {
                "public_id": "48935be0-7a8a-4b6c-94d5-b3d3097b7300",
                "name": "Norberto Cassin MD"
            }
        },
        {
            "public_id": "12aceb7b-96dc-48fe-a995-029908fb685c",
            "name": "Eladio Trantow",
            "email": "omer.wiza@example.org",
            "phone": "08829104992",
            "status": "new",
            "created_at": "10-07-2025 08:04:43",
            "updated_at": "10-07-2025 08:04:43",
            "created_by": {
                "public_id": "4cc7fba6-07b0-434d-b2b3-42deae68cd12",
                "name": "Darby Jacobson MD"
            },
            "updated_by": {
                "public_id": "4cc7fba6-07b0-434d-b2b3-42deae68cd12",
                "name": "Darby Jacobson MD"
            }
        },
        {
            "public_id": "da24303f-285e-40f4-b727-6ef3edcb8cbd",
            "name": "Montana Johnson",
            "email": "sauer.adriel@example.com",
            "phone": "08912310443",
            "status": "contacted",
            "created_at": "10-07-2025 08:04:43",
            "updated_at": "10-07-2025 08:04:43",
            "created_by": {
                "public_id": "d3b48148-92be-4530-a91e-32ecbcfd7f2d",
                "name": "Kennith Shields"
            },
            "updated_by": {
                "public_id": "b45b44d7-18a4-4ad2-846f-08714e714e68",
                "name": "Gregoria Kautzer IV"
            }
        },
        {
            "public_id": "c9a26777-a95f-439f-af2f-a9733420e0f6",
            "name": "Karley Klocko",
            "email": "trisha.yost@example.com",
            "phone": "08693875721",
            "status": "converted",
            "created_at": "10-07-2025 08:04:43",
            "updated_at": "10-07-2025 08:04:43",
            "created_by": {
                "public_id": "7f6a085f-e3b4-48b1-a1e5-004bfd8ecf6c",
                "name": "Lavada Wisozk PhD"
            },
            "updated_by": {
                "public_id": "a3b78bdf-0644-4d51-930b-ad423687192a",
                "name": "Abdiel Mayer"
            }
        }
    ],
    "pagination": {
        "total": 76,
        "limit": 10,
        "current_page": 1,
        "total_pages": 8
    }
}
```

</details>

<details>
<summary>
2. POST `/leads`
</summary>

```json
{
    "code": 201,
    "status": "Created",
    "message": "Lead created",
    "data": {
        "name": "Lead 2",
        "email": "lead1@mail.com",
        "phone": "+6288121921933",
        "status": "new",
        "public_id": "e4f1b61d-7066-4747-a1e6-a16d23719e95",
        "updated_at": "10-07-2025 15:53:55",
        "created_at": "10-07-2025 15:53:55"
    }
}
```

</details>

<details>
<summary>
3. PATCH `/leads/:id`
</summary>

```json
{
    "code": 200,
    "status": "OK",
    "message": "Lead updated",
    "data": {
        "public_id": "4e5d8c32-3a8b-4bdf-9d20-1a3f3e6d1f01",
        "name": "Lead 1AB",
        "email": "lead1a@mail.com",
        "phone": "088012912121",
        "status": "contacted",
        "created_at": "10-07-2025 15:04:43",
        "updated_at": "10-07-2025 15:47:33"
    }
}
```

</details>

<details>
<summary>
4. PUT `/leads/:id`
</summary>

```json
{
    "code": 200,
    "status": "OK",
    "message": "Lead updated",
    "data": {
        "public_id": "4e5d8c32-3a8b-4bdf-9d20-1a3f3e6d1f01",
        "name": "Lead 1A",
        "email": "lead1a@mail.com",
        "phone": "088012912121",
        "status": "contacted",
        "created_at": "10-07-2025 15:04:43",
        "updated_at": "10-07-2025 15:29:41"
    }
}
```

</details>

<details>
<summary>
5. DELETE `/leads/:id`
</summary>

```json
{
    "code": 200,
    "status": "OK",
    "message": "Lead deleted"
}
```

</details>
