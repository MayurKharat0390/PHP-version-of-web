<?php
namespace App\Controllers;

use App\Core\View;
use App\Models\Activity;

class ActivityController {
    public function index(): void {
        $activities = Activity::all();
        View::render('activities.list', [
            'activities' => $activities
        ]);
    }

    public function detail($id): void {
        $activity = Activity::find((int)$id);
        if (!$activity) {
            http_response_code(404);
            View::render('core.404', ['title' => 'Activity Not Found']);
            return;
        }

        View::render('activities.detail', [
            'activity' => $activity
        ]);
    }
}
