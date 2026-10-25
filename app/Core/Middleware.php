<?php
namespace App\Core;

class Middleware {
    public static function run(): void {
        self::trackVisitor();
        self::trackLoginStreak();
    }

    public static function trackVisitor(): void {
        try {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
            if (str_contains($ip, ',')) {
                $ip = trim(explode(',', $ip)[0]);
            }

            if (!filter_var($ip, FILTER_VALIDATE_IP)) {
                $ip = '127.0.0.1';
            }

            $existing = Database::fetchOne(
                "SELECT id, visit_count FROM `core_sitevisitor` WHERE ip_address = :ip",
                ['ip' => $ip]
            );

            $now = date('Y-m-d H:i:s');
            if ($existing) {
                Database::update(
                    'core_sitevisitor',
                    [
                        'last_visit' => $now,
                        'visit_count' => (int)$existing['visit_count'] + 1
                    ],
                    'id = :id',
                    ['id' => $existing['id']]
                );
            } else {
                Database::insert('core_sitevisitor', [
                    'ip_address' => $ip,
                    'last_visit' => $now,
                    'visit_count' => 1
                ]);
            }
        } catch (\Throwable $e) {
            // Silently continue if DB is temporarily locked
        }
    }

    public static function trackLoginStreak(): void {
        if (!Auth::check()) {
            return;
        }

        try {
            $userId = Auth::id();
            $today = date('Y-m-d');
            $now = date('Y-m-d H:i:s');

            // Find or create user progress
            $progress = Database::fetchOne(
                "SELECT * FROM `progress_userprogress` WHERE user_id = :uid",
                ['uid' => $userId]
            );

            if (!$progress) {
                Database::insert('progress_userprogress', [
                    'user_id' => $userId,
                    'total_reflections' => 0,
                    'total_logins' => 1,
                    'current_streak' => 1,
                    'longest_streak' => 1,
                    'last_login_date' => $today,
                    'total_journal_entries' => 0,
                    'created_at' => $now,
                    'updated_at' => $now
                ]);
                $progress = Database::fetchOne("SELECT * FROM `progress_userprogress` WHERE user_id = :uid", ['uid' => $userId]);
            }

            // Check login streak for today
            $streak = Database::fetchOne(
                "SELECT * FROM `progress_loginstreak` WHERE user_id = :uid AND date = :dt",
                ['uid' => $userId, 'dt' => $today]
            );

            if ($streak) {
                Database::update(
                    'progress_loginstreak',
                    ['login_count' => (int)$streak['login_count'] + 1],
                    'id = :id',
                    ['id' => $streak['id']]
                );
            } else {
                // First login today
                Database::insert('progress_loginstreak', [
                    'user_id' => $userId,
                    'date' => $today,
                    'login_count' => 1
                ]);

                // Calculate consecutive days streak
                $currentStreak = self::calculateStreak($userId, $today);
                $longestStreak = max((int)$progress['longest_streak'], $currentStreak);

                Database::update(
                    'progress_userprogress',
                    [
                        'total_logins' => (int)$progress['total_logins'] + 1,
                        'last_login_date' => $today,
                        'current_streak' => $currentStreak,
                        'longest_streak' => $longestStreak,
                        'updated_at' => $now
                    ],
                    'user_id = :uid',
                    ['uid' => $userId]
                );
            }
        } catch (\Throwable $e) {
            // Silently continue
        }
    }

    private static function calculateStreak(int $userId, string $today): int {
        $streak = 0;
        $currentDate = new \DateTime($today);

        while (true) {
            $dateStr = $currentDate->format('Y-m-d');
            $exists = Database::fetchOne(
                "SELECT id FROM `progress_loginstreak` WHERE user_id = :uid AND date = :dt",
                ['uid' => $userId, 'dt' => $dateStr]
            );

            if ($exists) {
                $streak++;
                $currentDate->modify('-1 day');
            } else {
                break;
            }
        }

        return $streak;
    }
}
