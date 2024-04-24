# Bee hitting game

This is a Laravel project designed for hitting bees.

## Prerequisites

Before you begin, ensure you have met the following requirements:

- PHP 8.1 (or later)
- Composer (for PHP dependency management)
- Node.js and npm (for frontend assets) 

## Installation

To install this project, follow these steps:

1. Clone the repository to your local machine:

   ```bash
   git clone <repository_url>
   ```

2. Navigate to the project directory:

   ```bash
   cd project-directory
   ```

3. Install PHP dependencies using Composer:

   ```bash
   composer install
   ```

4. Copy the `.env.example` file to `.env`:

   ```bash
   cp .env.example .env
   ```

5. Generate an application key:

   ```bash
   php artisan key:generate
   ```

6. Configure your `.env` file with your database credentials and any other necessary settings.

7. Run database migrations and seeders:

   ```bash
   php artisan migrate --seed
   ```

8. Install frontend dependencies using npm:

   ```bash
   npm install
   ```

9. Compile frontend assets (e.g., CSS, JavaScript):

   ```bash
   npm run dev
   ```

## Usage

To start the development server, run the following command:

```bash
php artisan serve
```

You can then access the application at `http://localhost:8000`.

