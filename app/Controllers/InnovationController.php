<?php
namespace App\Controllers;

use App\Core\View;
use App\Models\Innovation;

class InnovationController {
    public function index(): void {
        $innovations = Innovation::all();
        View::render('innovations.list', [
            'innovations' => $innovations
        ]);
    }

    public function detail($slug): void {
        $innovation = Innovation::findBySlug($slug);
        if (!$innovation && is_numeric($slug)) {
            $innovation = Innovation::find((int)$slug);
        }

        if (!$innovation) {
            http_response_code(404);
            View::render('core.404', ['title' => 'Innovation Not Found']);
            return;
        }

        View::render('innovations.detail', [
            'innovation' => $innovation
        ]);
    }
}
