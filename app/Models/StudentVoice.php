<?php
namespace App\Models;

use App\Core\Database;

class StudentVoice {
    public static function all(): array {
        $voices = Database::fetchAll("SELECT * FROM `voices_studentvoice` ORDER BY `order` ASC, `created_at` DESC");
        foreach ($voices as &$v) {
            $v['media'] = self::getMedia($v['id']);
        }
        return $voices;
    }

    public static function getApproved(): array {
        $voices = Database::fetchAll("SELECT * FROM `voices_studentvoice` WHERE is_approved = 1 ORDER BY `order` ASC, `created_at` DESC");
        foreach ($voices as &$v) {
            $v['media'] = self::getMedia($v['id']);
        }
        return $voices;
    }

    public static function find(int $id): ?array {
        $voice = Database::fetchOne("SELECT * FROM `voices_studentvoice` WHERE id = :id", ['id' => $id]);
        if ($voice) {
            $voice['media'] = self::getMedia($id);
        }
        return $voice;
    }

    public static function getMedia(int $storyId): array {
        return Database::fetchAll("SELECT * FROM `voices_storymedia` WHERE story_id = :id ORDER BY id ASC", ['id' => $storyId]);
    }

    public static function create(array $data, array $files = []): int {
        $defaults = [
            'is_approved' => 0,
            'order' => 100,
            'created_at' => date('Y-m-d H:i:s'),
            'user_id' => null
        ];
        $insertData = array_merge($defaults, $data);
        $voiceId = Database::insert('voices_studentvoice', $insertData);

        foreach ($files as $filePath) {
            Database::insert('voices_storymedia', [
                'story_id' => $voiceId,
                'file' => $filePath,
                'uploaded_at' => date('Y-m-d H:i:s')
            ]);
        }

        return $voiceId;
    }

    public static function setApproved(int $id, bool $approved): int {
        return Database::update('voices_studentvoice', ['is_approved' => $approved ? 1 : 0], 'id = :id', ['id' => $id]);
    }

    public static function delete(int $id): int {
        Database::delete('voices_storymedia', 'story_id = :id', ['id' => $id]);
        return Database::delete('voices_studentvoice', 'id = :id', ['id' => $id]);
    }
}
