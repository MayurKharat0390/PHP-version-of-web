<?php
namespace App\Models;

use App\Core\Database;

class Faculty {
    public static function all(): array {
        return Database::fetchAll("SELECT * FROM `faculty_facultyprofile` ORDER BY id ASC");
    }

    public static function find(int $id): ?array {
        return Database::fetchOne("SELECT * FROM `faculty_facultyprofile` WHERE id = :id", ['id' => $id]);
    }

    public static function create(array $data): int {
        return Database::insert('faculty_facultyprofile', $data);
    }

    public static function update(int $id, array $data): int {
        return Database::update('faculty_facultyprofile', $data, 'id = :id', ['id' => $id]);
    }

    public static function delete(int $id): int {
        return Database::delete('faculty_facultyprofile', 'id = :id', ['id' => $id]);
    }
}
