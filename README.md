# Laravel-CRUD-with-Breeze-and-JWT-Authentication

This is a Laravel 8 project that implements JWT (JSON Web Token) authentication for API endpoints and uses Laravel Breeze for web-based authentication. It provides a robust API for user authentication and management along with a web interface for CRUD operations.

## Table of Contents
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Setup Instructions](#setup-instructions)
- [Usage](#usage)
- [Features](#features)
- [License](#license)

## Prerequisites

Make sure you have the following installed on your machine:
- **PHP** (>= 7.3)
- **Composer** (for PHP dependencies)
- **Node.js** and **NPM** (for front-end assets)
- A database server (e.g., MySQL, SQLite, etc.) for migrations

## Installation

### Clone the Repository
First, clone the repository to your local machine:

```bash
git clone https://github.com/MuhonAli/Laravel-CRUD-with-Breeze-and-JWT-Authentication.git
cd Laravel-CRUD-with-Breeze-and-JWT-Authentication
```

### Install PHP Dependencies
Install the required PHP packages using Composer:

```bash
composer install
```

### Install Front-End Dependencies
If your project includes front-end assets, install them with npm:

```bash
npm install
```

### Create a `.env` File
Copy the example environment file and configure it for your setup:

```bash
cp .env.example .env
```

### Update Environment Variables
Open the `.env` file and configure the necessary environment variables, such as database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

### Generate Application Key
Generate the application key using Artisan:

```bash
php artisan key:generate
```

### Run Migrations
Run the migrations to create the necessary tables in your database:

```bash
php artisan migrate
```

> **Note:** Since no database is provided, ensure to create your database in your database server before running this command.

### Set Up JWT Authentication
Make sure to run the following command to generate the JWT secret key:

```bash
php artisan jwt:secret
```

This command adds the `JWT_SECRET` to your `.env` file, which is essential for signing your tokens.

## Usage

To start the Laravel development server, run:

```bash
php artisan serve
```

The application will be available at [http://localhost:8000](http://localhost:8000).

### Testing Authentication
1. **Login**: Send a POST request to `/api/login` with user credentials to receive a JWT token.

2. **Access Protected Routes**: Use the obtained JWT token in the `Authorization` header as `Bearer <token>` to access protected routes.

3. **Web Authentication**: Use the Laravel Breeze routes for web-based authentication.

## Features
- User Registration
- JWT Authentication for APIs
- Laravel Breeze for web authentication
- CRUD Operations

## License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.