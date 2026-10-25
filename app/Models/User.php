<?php
namespace App\Models;

use App\Core\Database;

class User {
    public static function all(): array {
        return Database::fetchAll("SELECT * FROM `users_customuser` ORDER BY date_joined DESC");
    }

    public static function find(int $id): ?array {
        return Database::fetchOne("SELECT * FROM `users_customuser` WHERE id = :id", ['id' => $id]);
    }

    public static function findByUsername(string $username): ?array {
        return Database::fetchOne("SELECT * FROM `users_customuser` WHERE username = :u", ['u' => $username]);
    }

    public static function findByEmail(string $email): ?array {
        return Database::fetchOne("SELECT * FROM `users_customuser` WHERE email = :e", ['e' => $email]);
    }

    public static function create(array $data): int {
        $now = date('Y-m-d H:i:s');
        $defaults = [
            'first_name' => '',
            'last_name' => '',
            'is_superuser' => 0,
            'is_staff' => 0,
            'is_active' => 1,
            'is_student' => 1,
            'is_faculty' => 0,
            'date_joined' => $now,
            'last_login' => null
        ];
        $insertData = array_merge($defaults, $data);
        return Database::insert('users_customuser', $insertData);
    }

    public static function update(int $id, array $data): int {
        return Database::update('users_customuser', $data, 'id = :id', ['id' => $id]);
    }

    public static function delete(int $id): int {
        // Cascade delete progress, streaks, journals
        Database::delete('progress_userprogress', 'user_id = :id', ['id' => $id]);
        Database::delete('progress_loginstreak', 'user_id = :id', ['id' => $id]);
        Database::delete('progress_reflectionstreak', 'user_id = :id', ['id' => $id]);
        Database::delete('journals_journalentry', 'user_id = :id', ['id' => $id]);
        Database::delete('reflections_userresponse', 'user_id = :id', ['id' => $id]);
        return Database::delete('users_customuser', 'id = :id', ['id' => $id]);
    }
}
