<?php
namespace App\Core;

class Auth {
    private static ?array $currentUser = null;

    public static function check(): bool {
        return isset($_SESSION['user_id']);
    }

    public static function id(): ?int {
        return $_SESSION['user_id'] ?? null;
    }

    public static function user(): ?array {
        if (!self::check()) {
            return null;
        }

        if (self::$currentUser === null) {
            self::$currentUser = Database::fetchOne(
                "SELECT id, username, first_name, last_name, email, is_staff, is_superuser, is_student, is_faculty, date_joined, last_login FROM `users_customuser` WHERE id = :id",
                ['id' => self::id()]
            );
            if (!self::$currentUser) {
                self::logout();
            }
        }

        return self::$currentUser;
    }

    public static function isAdmin(): bool {
        $user = self::user();
        return $user && ($user['is_superuser'] == 1 || $user['is_staff'] == 1);
    }

    public static function isFaculty(): bool {
        $user = self::user();
        return $user && ($user['is_faculty'] == 1);
    }

    public static function isStudent(): bool {
        $user = self::user();
        return $user && ($user['is_student'] == 1);
    }

    public static function attempt(string $username, string $password): bool {
        $user = Database::fetchOne(
            "SELECT * FROM `users_customuser` WHERE username = :u OR email = :u",
            ['u' => $username]
        );

        if (!$user) {
            return false;
        }

        if (!self::verifyPassword($password, $user['password'])) {
            return false;
        }

        // Check if password needs rehash to bcrypt/argon2
        if (str_starts_with($user['password'], 'pbkdf2_sha256$')) {
            $newHash = password_hash($password, PASSWORD_BCRYPT);
            Database::update('users_customuser', ['password' => $newHash], 'id = :id', ['id' => $user['id']]);
        }

        self::login($user);
        return true;
    }

    public static function login(array $user): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['user_id'] = (int)$user['id'];
        $_SESSION['username'] = $user['username'];
        self::$currentUser = $user;

        // Update last login
        Database::update(
            'users_customuser',
            ['last_login' => date('Y-m-d H:i:s')],
            'id = :id',
            ['id' => $user['id']]
        );
    }

    public static function logout(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        self::$currentUser = null;
        session_regenerate_id(true);
    }

    public static function verifyPassword(string $password, string $hash): bool {
        // 1. Check Django pbkdf2_sha256
        if (str_starts_with($hash, 'pbkdf2_sha256$')) {
            $parts = explode('$', $hash);
            if (count($parts) === 4) {
                list($algorithm, $iterations, $salt, $expectedHash) = $parts;
                $computed = base64_encode(hash_pbkdf2('sha256', $password, $salt, (int)$iterations, 32, true));
                return hash_equals($expectedHash, $computed);
            }
            return false;
        }

        // 2. Native PHP password_verify (bcrypt/argon2)
        return password_verify($password, $hash);
    }

    public static function hashPassword(string $password): string {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}
