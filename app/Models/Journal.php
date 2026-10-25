<?php
namespace App\Models;

use App\Core\Database;

class Journal {
    public static function all(): array {
        return Database::fetchAll("
            SELECT j.*, u.username
            FROM `journals_journalentry` j
            JOIN `users_customuser` u ON j.user_id = u.id
            ORDER BY j.created_at DESC
        ");
    }

    public static function getByUser(int $userId): array {
        return Database::fetchAll(
            "SELECT * FROM `journals_journalentry` WHERE user_id = :uid ORDER BY created_at DESC",
            ['uid' => $userId]
        );
    }

    public static function find(int $id, ?int $userId = null): ?array {
        if ($userId !== null) {
            return Database::fetchOne(
                "SELECT * FROM `journals_journalentry` WHERE id = :id AND user_id = :uid",
                ['id' => $id, 'uid' => $userId]
            );
        }
        return Database::fetchOne("SELECT * FROM `journals_journalentry` WHERE id = :id", ['id' => $id]);
    }

    public static function create(int $userId, string $content, ?string $mood = null, string $tags = ''): int {
        $now = date('Y-m-d H:i:s');
        $id = Database::insert('journals_journalentry', [
            'user_id' => $userId,
            'content' => $content,
            'mood' => $mood,
            'tags' => $tags,
            'created_at' => $now,
            'updated_at' => $now
        ]);

        // Update progress total_journal_entries
        $count = (int)Database::fetchColumn(
            "SELECT COUNT(*) FROM `journals_journalentry` WHERE user_id = :uid",
            ['uid' => $userId]
        );
        Database::update('progress_userprogress', ['total_journal_entries' => $count, 'updated_at' => $now], 'user_id = :uid', ['uid' => $userId]);

        return $id;
    }

    public static function delete(int $id): int {
        $entry = self::find($id);
        $deleted = Database::delete('journals_journalentry', 'id = :id', ['id' => $id]);
        if ($entry) {
            $userId = $entry['user_id'];
            $count = (int)Database::fetchColumn("SELECT COUNT(*) FROM `journals_journalentry` WHERE user_id = :uid", ['uid' => $userId]);
            Database::update('progress_userprogress', ['total_journal_entries' => $count], 'user_id = :uid', ['uid' => $userId]);
        }
        return $deleted;
    }

    public static function getMoods(): array {
        return [
            'happy' => '😊 Happy',
            'calm' => '😌 Calm',
            'thoughtful' => '🤔 Thoughtful',
            'grateful' => '🙏 Grateful',
            'challenged' => '💪 Challenged',
            'confused' => '😕 Confused',
        ];
    }

    public static function getMoodDisplay(?string $mood): string {
        $moods = self::getMoods();
        return $moods[$mood] ?? ($mood ?: '');
    }
}
