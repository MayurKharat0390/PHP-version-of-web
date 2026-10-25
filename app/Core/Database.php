<?php
namespace App\Core;

use PDO;
use PDOException;

class Database {
    private static ?PDO $instance = null;

    public static function getInstance(): PDO {
        if (self::$instance === null) {
            $config = require __DIR__ . '/../../config/database.php';
            $default = $config['default'];
            $settings = $config['connections'][$default];

            try {
                if ($default === 'sqlite') {
                    $dbPath = $settings['database'];
                    if (!file_exists($dbPath)) {
                        // Create SQLite DB if missing
                        touch($dbPath);
                    }
                    self::$instance = new PDO("sqlite:" . $dbPath);
                } elseif ($default === 'mysql') {
                    $dsn = "mysql:host={$settings['host']};port={$settings['port']};dbname={$settings['database']};charset={$settings['charset']}";
                    self::$instance = new PDO($dsn, $settings['username'], $settings['password']);
                }

                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                
                // For SQLite enable foreign keys
                if ($default === 'sqlite') {
                    self::$instance->exec('PRAGMA foreign_keys = ON;');
                }
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }

        return self::$instance;
    }

    public static function query(string $sql, array $params = []): \PDOStatement {
        $stmt = self::getInstance()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public static function fetchAll(string $sql, array $params = []): array {
        return self::query($sql, $params)->fetchAll();
    }

    public static function fetchOne(string $sql, array $params = []): ?array {
        $result = self::query($sql, $params)->fetch();
        return $result ?: null;
    }

    public static function fetchColumn(string $sql, array $params = [], int $column = 0) {
        return self::query($sql, $params)->fetchColumn($column);
    }

    public static function execute(string $sql, array $params = []): bool {
        return self::query($sql, $params)->rowCount() >= 0;
    }

    public static function insert(string $table, array $data): int {
        $keys = array_keys($data);
        $fields = implode(', ', array_map(fn($k) => "`$k`", $keys));
        $placeholders = implode(', ', array_map(fn($k) => ":$k", $keys));
        
        $sql = "INSERT INTO `$table` ($fields) VALUES ($placeholders)";
        self::query($sql, $data);
        return (int)self::getInstance()->lastInsertId();
    }

    public static function update(string $table, array $data, string $where, array $whereParams = []): int {
        $setClauses = [];
        $params = [];
        foreach ($data as $key => $val) {
            $setClauses[] = "`$key` = :set_$key";
            $params["set_$key"] = $val;
        }
        $setString = implode(', ', $setClauses);
        $sql = "UPDATE `$table` SET $setString WHERE $where";
        $stmt = self::query($sql, array_merge($params, $whereParams));
        return $stmt->rowCount();
    }

    public static function delete(string $table, string $where, array $params = []): int {
        $sql = "DELETE FROM `$table` WHERE $where";
        $stmt = self::query($sql, $params);
        return $stmt->rowCount();
    }

    public static function lastInsertId(): string {
        return self::getInstance()->lastInsertId();
    }
}
