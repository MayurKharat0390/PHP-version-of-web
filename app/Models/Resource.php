<?php
namespace App\Models;

use App\Core\Database;

class Resource {
    public static function all(?string $category = null): array {
        if ($category && $category !== 'all') {
            return Database::fetchAll(
                "SELECT * FROM `resources_resource` WHERE category = :cat ORDER BY is_featured DESC, created_at DESC",
                ['cat' => $category]
            );
        }
        return Database::fetchAll("SELECT * FROM `resources_resource` ORDER BY is_featured DESC, created_at DESC");
    }

    public static function find(int $id): ?array {
        return Database::fetchOne("SELECT * FROM `resources_resource` WHERE id = :id", ['id' => $id]);
    }

    public static function incrementViews(int $id): void {
        try {
            $resource = self::find($id);
            if ($resource) {
                Database::update(
                    'resources_resource',
                    ['views_count' => (int)$resource['views_count'] + 1],
                    'id = :id',
                    ['id' => $id]
                );
            }
        } catch (\Throwable $e) {}
    }

    public static function create(array $data): int {
        $now = date('Y-m-d H:i:s');
        $defaults = [
            'views_count' => 0,
            'is_featured' => 0,
            'created_at' => $now,
            'updated_at' => $now
        ];
        return Database::insert('resources_resource', array_merge($defaults, $data));
    }

    public static function update(int $id, array $data): int {
        $data['updated_at'] = date('Y-m-d H:i:s');
        return Database::update('resources_resource', $data, 'id = :id', ['id' => $id]);
    }

    public static function delete(int $id): int {
        return Database::delete('resources_resource', 'id = :id', ['id' => $id]);
    }

    public static function getCategories(): array {
        return [
            'all' => 'All Resources',
            'integrity' => 'Integrity',
            'responsibility' => 'Responsibility',
            'trust' => 'Trust',
            'respect' => 'Respect',
            'harmony' => 'Harmony',
            'general' => 'General',
        ];
    }

    public static function getTypeDisplay(string $type): string {
        $types = [
            'article' => 'Article',
            'video' => 'Video',
            'pdf' => 'PDF Document',
            'link' => 'External Link',
        ];
        return $types[$type] ?? ucfirst($type);
    }
}
