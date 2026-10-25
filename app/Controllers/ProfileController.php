<?php
namespace App\Controllers;

use App\Core\Auth;
use App\Core\Database;
use App\Core\View;

class ProfileController {
    public function __construct() {
        if (!Auth::check()) {
            redirect('login', ['error' => 'Please sign in to view your profile.']);
        }
    }

    public function index(): void {
        $user = Auth::user();
        $userId = $user['id'];

        $progress = Database::fetchOne("SELECT * FROM `progress_userprogress` WHERE user_id = :uid", ['uid' => $userId]);
        if (!$progress) {
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
            $progress = Database::fetchOne("SELECT * FROM `progress_userprogress` WHERE user_id = :uid", ['uid' => $userId]);
        }

        $recent_journals = Database::fetchAll(
            "SELECT * FROM `journals_journalentry` WHERE user_id = :uid ORDER BY created_at DESC LIMIT 5",
            ['uid' => $userId]
        );

        $recent_reflections = Database::fetchAll("
            SELECT r.*, s.title as scenario_title, s.related_value, o.option_text
            FROM `reflections_userresponse` r
            JOIN `reflections_reflectionscenario` s ON r.scenario_id = s.id
            JOIN `reflections_reflectionoption` o ON r.selected_option_id = o.id
            WHERE r.user_id = :uid
            ORDER BY r.created_at DESC LIMIT 5
        ", ['uid' => $userId]);

        View::render('users.profile', [
            'user' => $user,
            'progress' => $progress,
            'recent_journals' => $recent_journals,
            'recent_reflections' => $recent_reflections
        ]);
    }
}
