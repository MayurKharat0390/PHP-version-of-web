<?php
/**
 * Database Configuration
 * Universal Human Values (UHV) Web Platform
 */

return [
    'default' => 'sqlite',
    'connections' => [
        'sqlite' => [
            'driver' => 'sqlite',
            'database' => __DIR__ . '/../db.sqlite3',
            'prefix' => '',
        ],
        'mysql' => [
            'driver' => 'mysql',
            'host' => getenv('DB_HOST') ?: '127.0.0.1',
            'port' => getenv('DB_PORT') ?: '3306',
            'database' => getenv('DB_NAME') ?: 'uhv_db',
            'username' => getenv('DB_USER') ?: 'root',
            'password' => getenv('DB_PASS') ?: '',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
        ]
    ]
];
