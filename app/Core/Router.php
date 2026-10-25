<?php
namespace App\Core;

class Router {
    private array $routes = [];

    public function get(string $pattern, $handler): void {
        $this->addRoute('GET', $pattern, $handler);
    }

    public function post(string $pattern, $handler): void {
        $this->addRoute('POST', $pattern, $handler);
    }

    public function any(string $pattern, $handler): void {
        $this->addRoute('GET', $pattern, $handler);
        $this->addRoute('POST', $pattern, $handler);
    }

    private function addRoute(string $method, string $pattern, $handler): void {
        $this->routes[] = [
            'method' => $method,
            'pattern' => $pattern,
            'handler' => $handler
        ];
    }

    public function dispatch(): void {
        // Run global middleware (visitor tracking, login streak)
        Middleware::run();

        $uri = $this->resolveUri();
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        // Check if requesting static or media file directly when running through front-controller
        if ($this->handleStaticFiles($uri)) {
            return;
        }

        foreach ($this->routes as $route) {
            if ($route['method'] !== $method) {
                continue;
            }

            // Convert pattern {param} to regex
            $regex = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[^/]+)', $route['pattern']);
            $regex = "#^" . $regex . "$#";

            if (preg_match($regex, $uri, $matches)) {
                $params = array_values(array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY));
                $this->executeHandler($route['handler'], $params);
                return;
            }
        }

        // 404 Not Found
        http_response_code(404);
        View::render('core.404', ['title' => 'Page Not Found']);
    }

    private function resolveUri(): string {
        // Support ?route=... for environments without rewrite
        if (!empty($_GET['route'])) {
            return '/' . ltrim($_GET['route'], '/');
        }

        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        $scriptDir = dirname($_SERVER['SCRIPT_NAME'] ?? '');
        $scriptDir = str_replace('\\', '/', $scriptDir);

        // Strip query string
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }

        // Strip subfolder if app is installed in subfolder
        if ($scriptDir !== '/' && $scriptDir !== '.' && str_starts_with($uri, $scriptDir)) {
            $uri = substr($uri, strlen($scriptDir));
        }

        $uri = '/' . trim($uri, '/');
        return $uri === '//' ? '/' : $uri;
    }

    private function handleStaticFiles(string $uri): bool {
        $cleanUri = ltrim($uri, '/');

        // Check static or media files
        if (str_starts_with($cleanUri, 'static/') || str_starts_with($cleanUri, 'media/') || $cleanUri === 'favicon.ico' || str_starts_with($cleanUri, 'google')) {
            $filePath = __DIR__ . '/../../' . $cleanUri;
            if (file_exists($filePath) && !is_dir($filePath)) {
                $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                $mimes = [
                    'css'  => 'text/css',
                    'js'   => 'application/javascript',
                    'png'  => 'image/png',
                    'jpg'  => 'image/jpeg',
                    'jpeg' => 'image/jpeg',
                    'gif'  => 'image/gif',
                    'webp' => 'image/webp',
                    'svg'  => 'image/svg+xml',
                    'ico'  => 'image/x-icon',
                    'pdf'  => 'application/pdf',
                    'mp4'  => 'video/mp4',
                    'webm' => 'video/webm',
                    'html' => 'text/html',
                    'json' => 'application/json',
                ];
                $contentType = $mimes[$ext] ?? 'application/octet-stream';
                header('Content-Type: ' . $contentType);
                header('Content-Length: ' . filesize($filePath));
                header('Cache-Control: public, max-age=86400');
                readfile($filePath);
                return true;
            }
        }
        return false;
    }

    private function executeHandler($handler, array $params): void {
        if (is_callable($handler)) {
            call_user_func_array($handler, $params);
            return;
        }

        if (is_string($handler) && str_contains($handler, '@')) {
            list($controller, $action) = explode('@', $handler);
            $fullClass = "App\\Controllers\\" . $controller;

            if (class_exists($fullClass)) {
                $instance = new $fullClass();
                if (method_exists($instance, $action)) {
                    call_user_func_array([$instance, $action], $params);
                    return;
                }
            }
            die("Controller or action not found: $fullClass@$action");
        }
    }
}
