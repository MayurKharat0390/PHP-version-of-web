<?php
namespace App\Controllers;

use App\Core\Auth;
use App\Core\Database;
use App\Core\View;

class ProgressController {
    public function __construct() {
        if (!Auth::check()) {
            redirect('login', ['error' => 'Please sign in to view your progress dashboard.']);
        }
    }

    public function index(): void {
        $userId = Auth::id();
        $progress = Database::fetchOne("SELECT * FROM `progress_userprogress` WHERE user_id = :uid", ['uid' => $userId]);

        // Update counts
        $totalReflections = (int)Database::fetchColumn("SELECT COUNT(*) FROM `reflections_userresponse` WHERE user_id = :uid", ['uid' => $userId]);
        $totalJournals = (int)Database::fetchColumn("SELECT COUNT(*) FROM `journals_journalentry` WHERE user_id = :uid", ['uid' => $userId]);

        if ($progress) {
            Database::update(
                'progress_userprogress',
                [
                    'total_reflections' => $totalReflections,
                    'total_journal_entries' => $totalJournals
                ],
                'user_id = :uid',
                ['uid' => $userId]
            );
            $progress['total_reflections'] = $totalReflections;
            $progress['total_journal_entries'] = $totalJournals;
        }

        // Get 30 days login activity
        $thirtyDaysAgo = date('Y-m-d', strtotime('-30 days'));
        $recent_logins = Database::fetchAll(
            "SELECT * FROM `progress_loginstreak` WHERE user_id = :uid AND date >= :dt ORDER BY date ASC",
            ['uid' => $userId, 'dt' => $thirtyDaysAgo]
        );

        View::render('progress.dashboard', [
            'progress' => $progress,
            'recent_logins' => $recent_logins
        ]);
    }
}
