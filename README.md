# Next-PHP Framework

A lightweight, custom-built PHP framework created for educational purposes. It features a custom router, security protections against traversal attacks, and a clean MVC-style architecture.

## Features
- **Custom Routing**: Handles URL resolution and query parameters manually.
- **Security**: Built-in protection against directory traversal attacks (handled in both PHP and Apache).
- **Modern PHP**: Utilizes `strict_types` and PHP 8+ typing features.
- **Error Handling**: Centralized exception handling for 400/500 errors.

## Requirements
- **PHP 8.0** or higher.
- **Apache** Web Server (XAMPP recommended) with `mod_rewrite` enabled.

## Installation & Setup

1. **Place Code**: Ensure the project folder is located inside XAMPP's htdocs directory.

2. **Start Server**: Open the XAMPP Control Panel and start **Apache**.

3. **Run**: access the application in your browser: http://localhost:8080/next-php

## Directory Structure
- `index.php`: The single entry point for all requests.
- `.htaccess`: Rewrites all URLs to `index.php`.
- `next-php/`: Core framework logic (`Router`, `App`, `View`).
- `config.php`: Application constants and configuration.