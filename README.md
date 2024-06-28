# Symfony RESTful API Development Challenge

## Objective

The objective of this challenge is to evaluate proficiency in PHP Symfony development, Docker, and static code analysis within a time limit of 4 hours.

## Repository

- **Code Repository**: [GitHub Repository Link](https://github.com/ahmed-cmyk/symfony_products_api)

## Overview

This project involves building a RESTful API using Symfony 5.4+, Dockerizing the application, and integrating static code analysis tools like PHPStan and PHP_CodeSniffer.

## Setup Instructions

### Prerequisites

Make sure you have Docker and Docker Compose installed on your machine.

### Steps to Run the Project

1. **Clone the Repository**

```bash
git clone <repository-url>
cd <repository-name>
```

2. **Build and Run Docker Containers**

```bash
docker compose up -d --build
```

3. **Install Dependencies and Setup Database**

```bash
docker compose run app composer install

docker compose run app php bin/console doctrine:schema:drop --force

docker compose run app php bin/console doctrine:migrations:migrate --no-interaction
```

4. **Access the API**

Visit the following URL on your machine:

```
http://localhost
```

# API Documentation

## Authentication

JWT Authentication is required to access the endpoints. You can generate tokens for testing purposes using Symfony's security features.

### Register a User

To register a user make a POST request on the following route.

```
http://localhost/registration
```

The request body should be in the JSON format and should follow the following format:

```json
{
  "email": "email@example.com",
  "password": "password"
}
```

### Get Authentication Token

To get the authentication token make a POST request on the following route.

```
http://localhost/api/login_check
```

The request body should be in the JSON format and should follow the following format:

```json
{
  "username": "email@example.com",
  "password": "password"
}
```

> The returned token is a Bearer token and should be placed in the Authorization header.

## Endpoints

### List all products

```
GET /api/products
```

### Create a new product

```
POST /api/products
```

### Get details of a single product

```
GET /api/products/{id}
```

### Update an existing product

```
PUT /api/products/{id}
```

### Delete a product

```
DELETE /api/products/{id}:
```

---

# Static Code Analysis

## Tools Used

- PHPStan for static analysis.
- PHP_CodeSniffer with PSR-12 standard for coding style checks.

## Running Static Analysis

```bash
docker compose run app ./vendor/bin/phpstan analyse
docker compose run app php php-cs-fixer.phar fix
```

---

## Assumptions Made

- A docker container is required only for the development environment
- Symfony 7 is acceptable for the creation of the API.
- JWT tokens are generated and validated using Symfony's security components.
- Basic CRUD operations on products are implemented with validation and error handling.
- A User model is required. There were also some assumptions made regarding the structure of the User model.

---
