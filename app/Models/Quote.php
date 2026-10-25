<?php
namespace App\Models;

use App\Core\Database;

class Quote {
    public static function all(): array {
        return Database::fetchAll("SELECT * FROM `quotes_quote` ORDER BY created_at DESC");
    }

    public static function find(int $id): ?array {
        return Database::fetchOne("SELECT * FROM `quotes_quote` WHERE id = :id", ['id' => $id]);
    }

    public static function getRandomActive(): ?array {
        $quotes = Database::fetchAll("SELECT * FROM `quotes_quote` WHERE is_active = 1");
        return !empty($quotes) ? $quotes[array_rand($quotes)] : null;
    }

    public static function create(array $data): int {
        $data['created_at'] = date('Y-m-d H:i:s');
        if (!isset($data['is_active'])) $data['is_active'] = 1;
        return Database::insert('quotes_quote', $data);
    }

    public static function update(int $id, array $data): int {
        return Database::update('quotes_quote', $data, 'id = :id', ['id' => $id]);
    }

    public static function toggleActive(int $id): int {
        $quote = self::find($id);
        if ($quote) {
            $newStatus = $quote['is_active'] ? 0 : 1;
            return Database::update('quotes_quote', ['is_active' => $newStatus], 'id = :id', ['id' => $id]);
        }
        return 0;
    }

    public static function delete(int $id): int {
        return Database::delete('quotes_quote', 'id = :id', ['id' => $id]);
    }
}
