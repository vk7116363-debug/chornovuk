# Repository Guidelines

## Project Structure & Module Organization
The project is a PHP-based e-commerce landing page with a JSON-driven product catalog.
- **Root**: Contains main page components (`header.php`, `footer.php`, `products.php`) and entry point (`index.php`).
- **`products.json`**: The source of truth for the product catalog.
- **`cache/`**: Stores generated HTML fragments (`catalog.cache.html`) and stock data (`stock-cache.json`) to improve performance.
- **`assets/PHPMailer/`**: Third-party library for handling email notifications.
- **`post.php`**: Core backend logic for processing orders, sending data to CRM (`lp-crm.biz`), and triggering emails.
- **`stock-api.php`**: Proxy for fetching stock availability from a Google Apps Script macro.

## Build, Test, and Development Commands
This is a plain PHP project without a formal build system or package manager.
- **Web Server**: Requires a standard PHP environment (e.g., Apache, Nginx) with `curl` support.
- **Cache Management**: The catalog cache in `products.php` automatically rebuilds if `products.json` is newer than the cache file.
- **Manual Cache Refresh**: A hidden UI trigger (3 clicks on the catalog title) activates a refresh button that calls `/clear-cache.php`.

## Coding Style & Naming Conventions
- **Naming**: PHP files use `kebab-case.php` or `snake_case.php`. Variables and functions generally follow `snake_case`.
- **Formatting**: Mixed HTML and PHP patterns are used throughout. Indentation is typically 2 or 4 spaces.
- **Security**: `config.php` is protected against direct browser access and stores sensitive tokens like `FB_CAPI_TOKEN`.

## Integration Guidelines
- **CRM**: Orders are sent via cURL to `http://rarechin.lp-crm.biz/api/addNewOrder.html`.
- **Meta Pixel**: Facebook Pixel is integrated in `header.php`.
- **Email**: Uses SMTP via Hostinger (`smtp.hostinger.com`) to send order confirmations to `mriyajeans@gmail.com`.

## Testing Guidelines
No automated testing framework is present. Verification must be done manually by:
1. Validating `products.json` schema.
2. Simulating form submissions to `post.php` and checking CRM/Email logs.
3. Inspecting the browser console for JS errors in `header.php` or `footer.php`.
