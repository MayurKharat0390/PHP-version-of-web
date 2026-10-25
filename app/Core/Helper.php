<?php
/**
 * Global Helper Functions
 */

if (!function_exists('base_url')) {
    function base_url(string $path = ''): string {
        $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
        $dir = dirname($scriptName);
        $base = ($dir === '/' || $dir === '\\') ? '' : rtrim(str_replace('\\', '/', $dir), '/');
        
        $path = ltrim($path, '/');
        return $base . ($path ? '/' . $path : '');
    }
}

if (!function_exists('url')) {
    function url(string $path = ''): string {
        return base_url($path);
    }
}

if (!function_exists('asset')) {
    function asset(string $path): string {
        $path = ltrim($path, '/');
        if (str_starts_with($path, 'static/')) {
            return base_url($path);
        }
        if (str_starts_with($path, 'media/')) {
            return base_url($path);
        }
        // Default to static
        return base_url('static/' . $path);
    }
}

if (!function_exists('media')) {
    function media(?string $path): string {
        if (!$path) return '';
        $path = ltrim($path, '/');
        if (str_starts_with($path, 'media/')) {
            return base_url($path);
        }
        return base_url('media/' . $path);
    }
}

if (!function_exists('csrf_token')) {
    function csrf_token(): string {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
}

if (!function_exists('csrf_field')) {
    function csrf_field(): string {
        return '<input type="hidden" name="csrf_token" value="' . csrf_token() . '">';
    }
}

if (!function_exists('verify_csrf')) {
    function verify_csrf(): bool {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
            return !empty($token) && hash_equals($_SESSION['csrf_token'] ?? '', $token);
        }
        return true;
    }
}

if (!function_exists('flash')) {
    function flash(string $key, ?string $message = null) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($message !== null) {
            $_SESSION['flash'][$key] = $message;
            return;
        }
        if (isset($_SESSION['flash'][$key])) {
            $msg = $_SESSION['flash'][$key];
            unset($_SESSION['flash'][$key]);
            return $msg;
        }
        return null;
    }
}

if (!function_exists('e')) {
    function e(?string $value): string {
        return htmlspecialchars((string)($value ?? ''), ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('redirect')) {
    function redirect(string $path, array $flash = []): void {
        foreach ($flash as $k => $v) {
            flash($k, $v);
        }
        $target = (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) ? $path : url($path);
        header("Location: $target");
        exit;
    }
}

if (!function_exists('format_date')) {
    function format_date(?string $datetime, string $format = 'M j, Y'): string {
        if (!$datetime) return '';
        $ts = strtotime($datetime);
        return $ts ? date($format, $ts) : $datetime;
    }
}

if (!function_exists('word_count')) {
    function word_count(?string $text): int {
        if (!$text) return 0;
        return count(preg_split('/\s+/', trim($text), -1, PREG_SPLIT_NO_EMPTY));
    }
}

if (!function_exists('currentUser')) {
    function currentUser(): ?array {
        return \App\Core\Auth::user();
    }
}

