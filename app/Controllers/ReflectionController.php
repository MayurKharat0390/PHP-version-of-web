<?php
namespace App\Controllers;

use App\Core\Auth;
use App\Core\View;
use App\Models\Reflection;

class ReflectionController {
    public function index(): void {
        $this->dailyCard();
    }

    public function dailyCard(): void {
        $scenario = Reflection::getTodayScenario();
        $user = Auth::user();

        if ($user && Reflection::hasReflectedToday($user['id'])) {
            View::render('reflections.already_completed', [
                'scenario' => $scenario,
                'message' => "You've already reflected today!"
            ]);
            return;
        }

        View::render('reflections.daily_card', [
            'scenario' => $scenario
        ]);
    }

    public function submit($id): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('reflections');
        }

        $scenarioId = (int)$id;
        $scenario = Reflection::findScenario($scenarioId);
        if (!$scenario) {
            http_response_code(404);
            View::render('core.404', ['title' => 'Scenario Not Found']);
            return;
        }

        $optionId = (int)($_POST['option'] ?? 0);
        $option = Reflection::findOption($optionId);
        if (!$option) {
            redirect('reflections');
        }

        $user = Auth::user();
        $userId = $user ? (int)$user['id'] : null;

        if ($userId && Reflection::hasReflectedToday($userId)) {
            View::render('reflections.already_completed', [
                'scenario' => $scenario,
                'message' => "You've already reflected today!"
            ]);
            return;
        }

        // Record response
        Reflection::recordResponse($userId, $scenarioId, $optionId);

        // Render feedback view (or partial if HTMX request)
        $isHtmx = isset($_SERVER['HTTP_HX_REQUEST']);
        View::render('reflections.feedback', [
            'scenario' => $scenario,
            'selected_option' => $option
        ], $isHtmx ? null : 'main');
    }
}
