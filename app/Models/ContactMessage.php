<?php
namespace App\Models;

use App\Core\Database;

class ContactMessage {
    public static function all(): array {
        return Database::fetchAll("SELECT * FROM `core_contactmessage` ORDER BY created_at DESC");
    }

    public static function find(int $id): ?array {
        return Database::fetchOne("SELECT * FROM `core_contactmessage` WHERE id = :id", ['id' => $id]);
    }

    public static function create(array $data): int {
        $data['created_at'] = date('Y-m-d H:i:s');
        return Database::insert('core_contactmessage', $data);
    }

    public static function delete(int $id): int {
        return Database::delete('core_contactmessage', 'id = :id', ['id' => $id]);
    }
}
