<?php
/**
 * UHV PCCOE - Universal Human Values Web Application
 * Native Modern PHP 8.3 Architecture (Zero Python Dependencies)
 */

declare(strict_types=1);

// Error reporting for development
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Start session if not active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Zero-dependency PSR-4 Autoloader for App\ namespace
spl_autoload_register(function (string $class): void {
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/app/';
    $len = strlen($prefix);

    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relativeClass = substr($class, $len);
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});

// Load Global Helpers
require_once __DIR__ . '/app/Core/Helper.php';

use App\Core\Router;

// Initialize Router
$router = new Router();

// --- Public Routes ---
$router->get('/', 'HomeController@index');
$router->get('/uhv-cell', 'HomeController@uhvCell');
$router->get('/contact', 'ContactController@index');
$router->post('/contact', 'ContactController@submit');
$router->get('/contact/success', 'ContactController@success');

// --- Activities & Workshops ---
$router->get('/activities', 'ActivityController@index');
$router->get('/activities/{id}', 'ActivityController@detail');

// --- Daily Reflections & Dilemmas ---
$router->get('/reflections', 'ReflectionController@index');
$router->post('/reflections', 'ReflectionController@submit');
$router->get('/reflections/{id}/feedback', 'ReflectionController@feedback');
$router->get('/reflections/already-completed', 'ReflectionController@alreadyCompleted');

// --- Student Self-Exploration Journals ---
$router->get('/journals', 'JournalController@index');
$router->get('/journals/create', 'JournalController@create');
$router->post('/journals/create', 'JournalController@store');
$router->get('/journals/{id}', 'JournalController@detail');

// --- Community Voices & Impact Stories ---
$router->get('/voices', 'VoiceController@index');
$router->post('/voices', 'VoiceController@index');

// --- Digital Innovations ---
$router->get('/innovations', 'InnovationController@index');
$router->get('/innovations/{id}', 'InnovationController@detail');

// --- Resource Repository ---
$router->get('/resources', 'ResourceController@index');
$router->get('/resources/{id}', 'ResourceController@detail');

// --- Faculty Mentors ---
$router->get('/faculty', 'FacultyController@index');

// --- Progress & Login Streaks ---
$router->get('/progress', 'ProgressController@index');
$router->get('/dashboard', 'ProgressController@index');

// --- Authentication & User Profile ---
$router->get('/login', 'AuthController@showLogin');
$router->post('/login', 'AuthController@login');
$router->get('/signup', 'AuthController@showSignup');
$router->post('/signup', 'AuthController@signup');
$router->get('/logout', 'AuthController@logout');
$router->post('/logout', 'AuthController@logout');
$router->get('/profile', 'ProfileController@index');

// --- Admin Control Panel ---
$router->get('/admin', 'AdminController@index');

// Admin Users
$router->get('/admin/users', 'AdminController@users');
$router->post('/admin/users/role', 'AdminController@updateUserRole');
$router->post('/admin/users/delete', 'AdminController@deleteUser');

// Admin Scenarios
$router->get('/admin/reflections', 'AdminController@reflections');
$router->get('/admin/reflections/create', 'AdminController@createScenario');
$router->post('/admin/reflections/create', 'AdminController@createScenario');
$router->get('/admin/reflections/{id}/edit', 'AdminController@editScenario');
$router->post('/admin/reflections/{id}/edit', 'AdminController@editScenario');
$router->post('/admin/reflections/{id}/delete', 'AdminController@deleteScenario');

// Admin Journals
$router->get('/admin/journals', 'AdminController@journals');

// Admin Activities
$router->get('/admin/activities', 'AdminController@activities');
$router->get('/admin/activities/create', 'AdminController@createActivity');
$router->post('/admin/activities/create', 'AdminController@createActivity');
$router->get('/admin/activities/{id}/edit', 'AdminController@editActivity');
$router->post('/admin/activities/{id}/edit', 'AdminController@editActivity');
$router->post('/admin/activities/{id}/delete', 'AdminController@deleteActivity');

// Admin Stories Moderation
$router->get('/admin/voices', 'AdminController@voices');
$router->post('/admin/voices/{id}/approve', 'AdminController@approveVoice');
$router->post('/admin/voices/{id}/reject', 'AdminController@rejectVoice');
$router->post('/admin/voices/{id}/delete', 'AdminController@deleteVoice');

// Admin Innovations
$router->get('/admin/innovations', 'AdminController@innovations');
$router->get('/admin/innovations/create', 'AdminController@createInnovation');
$router->post('/admin/innovations/create', 'AdminController@createInnovation');
$router->post('/admin/innovations/{id}/delete', 'AdminController@deleteInnovation');

// Admin Resources
$router->get('/admin/resources', 'AdminController@resources');
$router->get('/admin/resources/create', 'AdminController@createResource');
$router->post('/admin/resources/create', 'AdminController@createResource');
$router->post('/admin/resources/{id}/delete', 'AdminController@deleteResource');

// Admin Faculty Mentors
$router->get('/admin/faculty', 'AdminController@faculty');
$router->get('/admin/faculty/create', 'AdminController@createFaculty');
$router->post('/admin/faculty/create', 'AdminController@createFaculty');
$router->post('/admin/faculty/{id}/delete', 'AdminController@deleteFaculty');

// Admin Quotes
$router->get('/admin/quotes', 'AdminController@quotes');
$router->post('/admin/quotes/create', 'AdminController@createQuote');
$router->post('/admin/quotes/{id}/toggle', 'AdminController@toggleQuote');
$router->post('/admin/quotes/{id}/delete', 'AdminController@deleteQuote');

// Admin News Ticker
$router->get('/admin/news', 'AdminController@news');
$router->post('/admin/news/create', 'AdminController@createNews');
$router->post('/admin/news/{id}/toggle', 'AdminController@toggleNews');
$router->post('/admin/news/{id}/delete', 'AdminController@deleteNews');

// Admin Inbound Messages
$router->get('/admin/messages', 'AdminController@messages');
$router->post('/admin/messages/{id}/delete', 'AdminController@deleteMessage');

// Dispatch request
$router->dispatch();
