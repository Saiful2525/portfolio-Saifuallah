# Product Inventory

A Laravel-based product inventory management system with PostgreSQL database.

## Requirements

- Laravel Herd (includes PHP 8.2+ and Composer)
- PostgreSQL 12 or higher
- Node.js & npm
- Git

## Installation

1. Clone the repository
```bash
git clone <repository-url>
cd product-inventory
```

2. Copy environment file
```bash
copy .env.example .env
```

3. Configure database in `.env` file
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=product_inventory
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

4. Install dependencies and setup

Using Laravel Herd:
```bash
composer install
php artisan key:generate
php artisan migrate
npm install
npm run build
```

Or use the automated setup script:
```bash
composer setup
```

## Running the Application

### Development Mode

Run all services (server, queue, vite) concurrently:
```bash
composer dev
```

Or run services individually:
```bash
# Terminal 1 - Laravel server
php artisan serve

# Terminal 2 - Queue worker
php artisan queue:listen --tries=1

# Terminal 3 - Vite dev server
npm run dev
```

### Production Build

```bash
npm run build
```

## API Endpoints

The application provides the following API endpoints for product management:

- `GET /api/Product` - Get all products
- `POST /api/Product` - Add new product
- `GET /api/Product/{id}` - Get a specific product
- `PUT /api/Product/{id}` - Update a specific product
- `DELETE /api/Product/{id}` - Delete a specific product

## Testing

Run the test suite:
```bash
composer test
```

Or directly:
```bash
php artisan test
```

## API Testing

Bruno API collection files are available in the `Product Inventory` folder for testing all endpoints.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
