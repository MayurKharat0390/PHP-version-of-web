<?php
namespace App\Controllers;

use App\Core\Auth;
use App\Core\View;
use App\Models\StudentVoice;

class VoiceController {
    public function index(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->submit();
            return;
        }

        $voices = StudentVoice::getApproved();
        View::render('voices.list', [
            'voices' => $voices
        ]);
    }

    private function submit(): void {
        $nameDisplay = trim($_POST['name_display'] ?? 'Anonymous');
        $content = trim($_POST['content'] ?? '');

        if (empty($content)) {
            redirect('voices', ['error' => 'Please share your story before submitting.']);
        }

        $uploadedFiles = [];
        if (!empty($_FILES['media']['name'][0])) {
            $uploadDir = __DIR__ . '/../../media/story_media/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $count = count($_FILES['media']['name']);
            for ($i = 0; $i < $count; $i++) {
                if ($_FILES['media']['error'][$i] === UPLOAD_ERR_OK) {
                    $origName = $_FILES['media']['name'][$i];
                    $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
                    $safeName = time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
                    $targetPath = $uploadDir . $safeName;

                    if (move_uploaded_file($_FILES['media']['tmp_name'][$i], $targetPath)) {
                        $uploadedFiles[] = 'story_media/' . $safeName;
                    }
                }
            }
        }

        $voiceId = StudentVoice::create([
            'name_display' => $nameDisplay ?: 'Anonymous',
            'content' => $content,
            'is_approved' => 0,
            'order' => 100,
            'user_id' => Auth::id()
        ], $uploadedFiles);

        redirect('voices', ['success' => 'Thank you for sharing your story! It will appear here once approved by our team. 🌟']);
    }
}
