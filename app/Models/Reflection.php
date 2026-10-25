<?php
namespace App\Models;

use App\Core\Database;

class Reflection {
    public static function allScenarios(): array {
        return Database::fetchAll("SELECT * FROM `reflections_reflectionscenario` ORDER BY `active_date` DESC, id DESC");
    }

    public static function findScenario(int $id): ?array {
        $scenario = Database::fetchOne("SELECT * FROM `reflections_reflectionscenario` WHERE id = :id", ['id' => $id]);
        if ($scenario) {
            $scenario['options'] = self::getOptions($id);
        }
        return $scenario;
    }

    public static function getOptions(int $scenarioId): array {
        return Database::fetchAll("SELECT * FROM `reflections_reflectionoption` WHERE scenario_id = :id ORDER BY id ASC", ['id' => $scenarioId]);
    }

    public static function findOption(int $optionId): ?array {
        return Database::fetchOne("SELECT * FROM `reflections_reflectionoption` WHERE id = :id", ['id' => $optionId]);
    }

    public static function getTodayScenario(): ?array {
        $today = date('Y-m-d');
        $scenario = Database::fetchOne("SELECT * FROM `reflections_reflectionscenario` WHERE active_date = :dt", ['dt' => $today]);

        if (!$scenario) {
            $all = self::allScenarios();
            if (!empty($all)) {
                $dayOfYear = (int)date('z');
                $index = $dayOfYear % count($all);
                $scenario = $all[$index];
            }
        }

        if ($scenario) {
            $scenario['options'] = self::getOptions($scenario['id']);
        }
        return $scenario;
    }

    public static function hasReflectedToday(?int $userId): bool {
        if (!$userId) return false;
        $today = date('Y-m-d');
        $row = Database::fetchOne(
            "SELECT id FROM `reflections_userresponse` WHERE user_id = :uid AND date(created_at) = :dt",
            ['uid' => $userId, 'dt' => $today]
        );
        return !empty($row);
    }

    public static function recordResponse(?int $userId, int $scenarioId, int $optionId): int {
        $now = date('Y-m-d H:i:s');
        $today = date('Y-m-d');

        $responseId = Database::insert('reflections_userresponse', [
            'user_id' => $userId,
            'scenario_id' => $scenarioId,
            'selected_option_id' => $optionId,
            'created_at' => $now
        ]);

        if ($userId) {
            // Update reflection streak
            $streak = Database::fetchOne(
                "SELECT id FROM `progress_reflectionstreak` WHERE user_id = :uid AND date = :dt",
                ['uid' => $userId, 'dt' => $today]
            );
            if (!$streak) {
                Database::insert('progress_reflectionstreak', [
                    'user_id' => $userId,
                    'date' => $today,
                    'reflection_completed' => 1
                ]);
            }

            // Update user progress
            $totalReflections = (int)Database::fetchColumn(
                "SELECT COUNT(*) FROM `reflections_userresponse` WHERE user_id = :uid",
                ['uid' => $userId]
            );

            $progress = Database::fetchOne("SELECT * FROM `progress_userprogress` WHERE user_id = :uid", ['uid' => $userId]);
            if ($progress) {
                Database::update(
                    'progress_userprogress',
                    [
                        'total_reflections' => $totalReflections,
                        'last_reflection_date' => $today,
                        'updated_at' => $now
                    ],
                    'user_id = :uid',
                    ['uid' => $userId]
                );
            }
        }

        return $responseId;
    }

    public static function createScenario(array $data, array $options): int {
        $scenarioId = Database::insert('reflections_reflectionscenario', $data);
        foreach ($options as $optText) {
            if (trim($optText) !== '') {
                Database::insert('reflections_reflectionoption', [
                    'scenario_id' => $scenarioId,
                    'option_text' => trim($optText)
                ]);
            }
        }
        return $scenarioId;
    }

    public static function updateScenario(int $id, array $data, ?array $options = null): int {
        $updated = Database::update('reflections_reflectionscenario', $data, 'id = :id', ['id' => $id]);
        if ($options !== null) {
            Database::delete('reflections_reflectionoption', 'scenario_id = :id', ['id' => $id]);
            foreach ($options as $optText) {
                if (trim($optText) !== '') {
                    Database::insert('reflections_reflectionoption', [
                        'scenario_id' => $id,
                        'option_text' => trim($optText)
                    ]);
                }
            }
        }
        return $updated;
    }

    public static function deleteScenario(int $id): int {
        Database::delete('reflections_reflectionoption', 'scenario_id = :id', ['id' => $id]);
        Database::delete('reflections_userresponse', 'scenario_id = :id', ['id' => $id]);
        return Database::delete('reflections_reflectionscenario', 'id = :id', ['id' => $id]);
    }

    public static function allResponses(): array {
        return Database::fetchAll("
            SELECT r.*, u.username, s.title as scenario_title, s.related_value, o.option_text
            FROM `reflections_userresponse` r
            LEFT JOIN `users_customuser` u ON r.user_id = u.id
            JOIN `reflections_reflectionscenario` s ON r.scenario_id = s.id
            JOIN `reflections_reflectionoption` o ON r.selected_option_id = o.id
            ORDER BY r.created_at DESC
        ");
    }
}
