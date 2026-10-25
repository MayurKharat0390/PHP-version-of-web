<?php
namespace App\Controllers;

use App\Core\Auth;
use App\Core\View;
use App\Models\Journal;

class JournalController {
    public function __construct() {
        if (!Auth::check()) {
            redirect('login', ['error' => 'Please log in to access your journal.']);
        }
    }

    public function index(): void {
        $userId = Auth::id();
        $entries = Journal::getByUser($userId);

        View::render('journals.list', [
            'entries' => $entries
        ]);
    }

    public function create(): void {
        $error = null;
        $content = '';
        $mood = '';
        $tags = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $content = trim($_POST['content'] ?? '');
            $mood = trim($_POST['mood'] ?? '');
            $tags = trim($_POST['tags'] ?? '');

            // Word count validation: minimum 150 words
            $wordCount = word_count($content);
            if ($wordCount < 150) {
                $error = "Journal entry must be at least 150 words. You currently have {$wordCount} words (need " . (150 - $wordCount) . " more).";
            } else {
                Journal::create(Auth::id(), $content, $mood ?: null, $tags);
                redirect('journals', ['success' => 'Journal entry saved successfully! 🌟']);
            }
        }

        View::render('journals.create', [
            'error' => $error,
            'content' => $content,
            'mood' => $mood,
            'tags' => $tags
        ]);
    }

    public function detail($id): void {
        $entry = Journal::find((int)$id, Auth::id());
        if (!$entry) {
            http_response_code(404);
            View::render('core.404', ['title' => 'Journal Entry Not Found']);
            return;
        }

        View::render('journals.detail', [
            'entry' => $entry
        ]);
    }
}
