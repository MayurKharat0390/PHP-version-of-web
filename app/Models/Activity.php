<?php
namespace App\Models;

use App\Core\Database;

class Activity {
    public static function all(): array {
        return Database::fetchAll("SELECT * FROM `activities_activity` ORDER BY `date` DESC");
    }

    public static function find(int $id): ?array {
        $activity = Database::fetchOne("SELECT * FROM `activities_activity` WHERE id = :id", ['id' => $id]);
        if ($activity) {
            $activity['images'] = self::getImages($id);
        }
        return $activity;
    }

    public static function getImages(int $activityId): array {
        return Database::fetchAll("SELECT * FROM `activities_activityimage` WHERE activity_id = :id ORDER BY id ASC", ['id' => $activityId]);
    }

    public static function create(array $data): int {
        return Database::insert('activities_activity', $data);
    }

    public static function update(int $id, array $data): int {
        return Database::update('activities_activity', $data, 'id = :id', ['id' => $id]);
    }

    public static function delete(int $id): int {
        Database::delete('activities_activityimage', 'activity_id = :id', ['id' => $id]);
        return Database::delete('activities_activity', 'id = :id', ['id' => $id]);
    }

    public static function addImage(int $activityId, string $imagePath, string $caption = ''): int {
        return Database::insert('activities_activityimage', [
            'activity_id' => $activityId,
            'image' => $imagePath,
            'caption' => $caption
        ]);
    }

    public static function deleteImage(int $imageId): int {
        return Database::delete('activities_activityimage', 'id = :id', ['id' => $imageId]);
    }
}
