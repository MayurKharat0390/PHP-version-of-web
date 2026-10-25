<?php
namespace App\Controllers;

use App\Core\Auth;
use App\Core\Database;
use App\Core\View;
use App\Models\User;

class AuthController {
    public function showLogin(): void {
        if (Auth::check()) {
            redirect('');
        }
        View::render('users.login', [
            'error' => flash('error'),
            'username' => ''
        ]);
    }

    public function login(): void {
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if (empty($username) || empty($password)) {
            View::render('users.login', [
                'error' => 'Please provide both username and password.',
                'username' => $username
            ]);
            return;
        }

        if (Auth::attempt($username, $password)) {
            $user = Auth::user();
            redirect('', ['success' => "Welcome back, {$user['username']}! 🌟"]);
        } else {
            View::render('users.login', [
                'error' => 'Invalid username or password. Please try again.',
                'username' => $username
            ]);
        }
    }

    public function showSignup(): void {
        if (Auth::check()) {
            redirect('');
        }
        View::render('users.signup', [
            'errors' => [],
            'username' => '',
            'email' => ''
        ]);
    }

    public function signup(): void {
        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password1'] ?? $_POST['password'] ?? '';
        $passwordConfirm = $_POST['password2'] ?? $_POST['password_confirmation'] ?? '';

        $errors = [];
        if (empty($username)) {
            $errors['username'] = 'Username is required.';
        } elseif (strlen($username) < 3) {
            $errors['username'] = 'Username must be at least 3 characters.';
        } elseif (User::findByUsername($username)) {
            $errors['username'] = 'A user with that username already exists.';
        }

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'A valid email address is required.';
        } elseif (User::findByEmail($email)) {
            $errors['email'] = 'A user with that email already exists.';
        }

        if (empty($password)) {
            $errors['password1'] = 'Password is required.';
        } elseif (strlen($password) < 6) {
            $errors['password1'] = 'Password must be at least 6 characters.';
        }

        if ($password !== $passwordConfirm) {
            $errors['password2'] = 'The two password fields didn’t match.';
        }

        if (!empty($errors)) {
            View::render('users.signup', [
                'errors' => $errors,
                'username' => $username,
                'email' => $email
            ]);
            return;
        }

        $userId = User::create([
            'username' => $username,
            'email' => $email,
            'password' => Auth::hashPassword($password),
            'is_student' => 1,
            'is_faculty' => 0,
            'is_staff' => 0,
            'is_superuser' => 0
        ]);

        // Create initial progress record
        $now = date('Y-m-d H:i:s');
        Database::insert('progress_userprogress', [
            'user_id' => $userId,
            'total_reflections' => 0,
            'total_logins' => 1,
            'current_streak' => 1,
            'longest_streak' => 1,
            'last_login_date' => date('Y-m-d'),
            'total_journal_entries' => 0,
            'created_at' => $now,
            'updated_at' => $now
        ]);

        $user = User::find($userId);
        Auth::login($user);

        redirect('', ['success' => "Welcome to UHV PCCOE, {$username}! Your account has been created successfully. 🌟"]);
    }

    public function logout(): void {
        Auth::logout();
        redirect('', ['info' => 'You have been signed out.']);
    }
}
