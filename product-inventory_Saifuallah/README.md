# Product Inventory API

A Laravel-based RESTful API for product inventory management with authentication and role-based authorization.

## Features

- ✅ CRUD operations for products
- ✅ Token-based authentication (Laravel Sanctum)
- ✅ Role-based authorization (Spatie Permissions)
- ✅ PostgreSQL database
- ✅ API testing with Bruno

## Tech Stack

- **Framework**: Laravel 11.x
- **Database**: PostgreSQL 16+
- **Authentication**: Laravel Sanctum
- **Authorization**: Spatie Laravel Permission
- **Development Server**: Laravel Herd
- **API Testing**: Bruno

## Requirements

- PHP 8.2 or higher
- Composer
- PostgreSQL 16 or higher
- Laravel Herd (or any PHP development environment)
- Git

## Installation

### 1. Clone Repository
```bash
git clone <repository-url>
cd product-inventory-api
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Environment Configuration

Copy the example environment file:
```bash
cp .env.example .env
```

Configure your database in `.env`:
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=product_inventory
DB_USERNAME=postgres
DB_PASSWORD=
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Run Migrations
```bash
php artisan migrate
```

### 6. Seed Roles & Permissions
```bash
php artisan db:seed
```

This will create:
- 4 permissions: `products-view`, `products-create`, `products-update`, `products-delete`
- 3 roles: `admin`, `staff`, `viewer`

## Running the Application

### With Laravel Herd

Your application will be automatically available at:
```
http://product-inventory-api.test
```

### Without Herd (Alternative)
```bash
php artisan serve
```

Application available at: `http://127.0.0.1:8000`

## API Documentation

Base URL: `http://product-inventory-api.test/api`

### Authentication Endpoints

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| POST | `/auth/register` | Register new user | No |
| POST | `/auth/login` | Login and get token | No |
| GET | `/auth/me` | Get authenticated user | Yes |
| POST | `/auth/logout` | Logout (invalidate token) | Yes |

#### Register Request Example
```json
POST /api/auth/register
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}
```

#### Login Request Example
```json
POST /api/auth/login
{
    "email": "john@example.com",
    "password": "password123"
}
```

**Response includes token:**
```json
{
    "success": true,
    "message": "Login successful",
    "data": {
        "user": {...},
        "token": "1|abc123..."
    }
}
```

**Use token in Authorization header:**
```
Authorization: Bearer 1|abc123...
```

### Product Endpoints (Protected)

All product endpoints require authentication and appropriate permissions.

| Method | Endpoint | Description | Permission Required |
|--------|----------|-------------|---------------------|
| GET | `/products` | List all products | `products-view` |
| GET | `/products/{id}` | Get single product | `products-view` |
| POST | `/products` | Create new product | `products-create` |
| PUT | `/products/{id}` | Update product | `products-update` |
| DELETE | `/products/{id}` | Delete product | `products-delete` |

#### Create Product Request Example
```json
POST /api/products
Authorization: Bearer {token}

{
    "name": "Laptop",
    "description": "High-performance laptop",
    "price": 2999.99,
    "stock": 10
}
```

## Authorization

### Available Roles

| Role | Permissions |
|------|-------------|
| **admin** | All permissions (view, create, update, delete) |
| **staff** | View, create, update products |
| **viewer** | View products only |

### Assigning Roles to Users

Use Laravel Tinker to assign roles:
```bash
php artisan tinker
```
```php
// Get user by ID
$user = App\Models\User::find(1);

// Assign role
$user->assignRole('admin');
// or
$user->assignRole('staff');
// or
$user->assignRole('viewer');

// Verify role
$user->hasRole('admin'); // returns true/false

// Get user's permissions
$user->getAllPermissions();
```

### Response Status Codes

| Status Code | Description |
|-------------|-------------|
| 200 | Success |
| 201 | Created successfully |
| 401 | Unauthorized (no token or invalid token) |
| 403 | Forbidden (no permission) |
| 404 | Resource not found |
| 422 | Validation error |

## API Testing

Bruno API collection files are included in the `screenshots/` folder for testing all endpoints.

### Testing Flow

1. **Register a user** → Get token
2. **Login** → Get token
3. **Use token** in Authorization header for protected endpoints
4. **Test different roles** to verify permissions

## Git Workflow

This project uses feature branches:
```bash
# Main branch (Parts A-D)
main

# Authentication & Authorization branch (Part E)
feature/authz-spatie
```

## Project Structure
```
product-inventory-api/
├── app/
│   ├── Http/Controllers/
│   │   ├── Auth/
│   │   │   └── AuthController.php
│   │   └── ProductController.php
│   └── Models/
│       ├── Product.php
│       └── User.php
├── database/
│   ├── migrations/
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── RolePermissionSeeder.php
├── routes/
│   └── api.php
└── screenshots/
    └── (Bruno test screenshots)
```

## Troubleshooting

### Database Connection Error
- Verify PostgreSQL is running
- Check database credentials in `.env`
- Ensure database exists: `CREATE DATABASE product_inventory;`

### Token Authentication Not Working
- Verify `personal_access_tokens` table exists
- Check `HasApiTokens` trait is added to User model
- Ensure token format: `Bearer {token}`

### Permission Denied (403)
- Verify user has correct role assigned
- Check role has required permissions
- Run `php artisan optimize:clear` to clear cache

## Development

### Clear Cache
```bash
php artisan optimize:clear
```

### Reset Database
```bash
php artisan migrate:fresh --seed
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
