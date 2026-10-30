<?php
namespace App\Controllers;

use App\Core\Auth;

class AuthController {
    public function showLogin(): void {
        redirect('');
    }

    public function login(): void {
        redirect('');
    }

    public function showSignup(): void {
        redirect('');
    }

    public function signup(): void {
        redirect('');
    }

    public function logout(): void {
        Auth::logout();
        redirect('', ['info' => 'You have been signed out.']);
    }
}
