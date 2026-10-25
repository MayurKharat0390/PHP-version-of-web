<?php
namespace App\Models;

use App\Core\Database;

class NewsUpdate {
    public static function all(): array {
        return Database::fetchAll("SELECT * FROM `core_newsupdate` ORDER BY `order` ASC, created_at DESC");
    }

    public static function getActive(): array {
        return Database::fetchAll("SELECT * FROM `core_newsupdate` WHERE is_active = 1 ORDER BY `order` ASC, created_at DESC");
    }

    public static function find(int $id): ?array {
        return Database::fetchOne("SELECT * FROM `core_newsupdate` WHERE id = :id", ['id' => $id]);
    }

    public static function create(array $data): int {
        $data['created_at'] = date('Y-m-d H:i:s');
        if (!isset($data['is_active'])) $data['is_active'] = 1;
        if (!isset($data['order'])) $data['order'] = 0;
        return Database::insert('core_newsupdate', $data);
    }

    public static function update(int $id, array $data): int {
        return Database::update('core_newsupdate', $data, 'id = :id', ['id' => $id]);
    }

    public static function toggleActive(int $id): int {
        $news = self::find($id);
        if ($news) {
            $newStatus = $news['is_active'] ? 0 : 1;
            return Database::update('core_newsupdate', ['is_active' => $newStatus], 'id = :id', ['id' => $id]);
        }
        return 0;
    }

    public static function delete(int $id): int {
        return Database::delete('core_newsupdate', 'id = :id', ['id' => $id]);
    }
}
