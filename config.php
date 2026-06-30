<?php
// config.php — тут зберігаємо секрети

// Захист від прямого виклику через браузер
if (php_sapi_name() !== 'cli' && basename(__FILE__) === basename($_SERVER['PHP_SELF'])) {
    http_response_code(403);
    exit('Access denied');
}

// Токен Meta
define('FB_CAPI_TOKEN', 'EAAJGEmNIs4EBPiABBMq9HMQRS6fPZCj6j0uxUhSfKMyGri3cKkJUP9uOG0rysUWe95WK3ofSeklSfuSX37t2IGXhyciLJwIkBe6BJIqTGUZCuMUG7eM8IEdNRysZCYuZA460UtGZCM8tG0mnIk34iPcvi4pRuyXygiQ312d430DpB38zoHMqUBvmEQi4YrPDsZCQZDZD');
