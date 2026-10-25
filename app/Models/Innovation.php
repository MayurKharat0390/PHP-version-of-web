<?php
namespace App\Models;

use App\Core\Database;

class Innovation {
    public static function all(): array {
        return Database::fetchAll("SELECT * FROM `innovations_innovation` ORDER BY is_featured DESC, created_at DESC");
    }

    public static function getFeatured(int $limit = 3): array {
        return Database::fetchAll("SELECT * FROM `innovations_innovation` WHERE is_featured = 1 ORDER BY created_at DESC LIMIT :lim", ['lim' => $limit]);
    }

    public static function find(int $id): ?array {
        return Database::fetchOne("SELECT * FROM `innovations_innovation` WHERE id = :id", ['id' => $id]);
    }

    public static function findBySlug(string $slug): ?array {
        return Database::fetchOne("SELECT * FROM `innovations_innovation` WHERE slug = :slug", ['slug' => $slug]);
    }

    public static function create(array $data): int {
        $now = date('Y-m-d H:i:s');
        if (empty($data['slug'])) {
            $data['slug'] = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $data['title']), '-'));
        }
        $data['created_at'] = $now;
        $data['updated_at'] = $now;
        return Database::insert('innovations_innovation', $data);
    }

    public static function update(int $id, array $data): int {
        $data['updated_at'] = date('Y-m-d H:i:s');
        return Database::update('innovations_innovation', $data, 'id = :id', ['id' => $id]);
    }

    public static function delete(int $id): int {
        return Database::delete('innovations_innovation', 'id = :id', ['id' => $id]);
    }

    public static function getTypeDisplay(string $type): string {
        $types = [
            'app' => 'Mobile Application',
            'website' => 'Website/Portal',
            'tool' => 'Digital Tool',
            'research' => 'Research Project',
        ];
        return $types[$type] ?? ucfirst($type);
    }
}
