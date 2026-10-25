<?php
// router.php for PHP CLI built-in web server: php -S localhost:8000 router.php
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$file = __DIR__ . $uri;

if ($uri !== '/' && file_exists($file) && !is_dir($file)) {
    return false; // let PHP built-in server serve the file directly
}

require_once __DIR__ . '/index.php';
