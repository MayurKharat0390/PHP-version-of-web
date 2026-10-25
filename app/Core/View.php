<?php
namespace App\Core;

class View {
    public static function render(string $view, array $data = [], ?string $layout = 'main'): void {
        // Extract data for view
        extract($data);

        // Fetch global context variables
        $currentUser = Auth::user();
        $isLoggedIn = Auth::check();
        $isAdmin = Auth::isAdmin();

        // 1. Daily Quote
        $daily_quote = null;
        try {
            $quotes = Database::fetchAll("SELECT * FROM `quotes_quote` WHERE is_active = 1");
            if (!empty($quotes)) {
                $daily_quote = $quotes[array_rand($quotes)];
            }
        } catch (\Throwable $e) {}

        // 2. News Ticker Updates
        $ticker_updates = [];
        try {
            $ticker_updates = Database::fetchAll("SELECT * FROM `core_newsupdate` WHERE is_active = 1 ORDER BY `order` ASC, `created_at` DESC");
        } catch (\Throwable $e) {}

        if (empty($ticker_updates)) {
            $ticker_updates = [
                ['text' => 'MDP on Universal Human Values inaugurated at PCCoE (8th-10th April). Organized for senior leaders.', 'icon_type' => 'event', 'link' => ''],
                ['text' => '78 delegates (48 PCCoE, 31 from other institutions) participating in the 3-day MDP program.', 'icon_type' => 'update', 'link' => ''],
                ['text' => 'Dignitaries: Dr. Pramod Patil, Dr. Rajeev Nargundkar, & Dr. Govind Kulkarni graced the inauguration.', 'icon_type' => 'update', 'link' => ''],
                ['text' => 'AICTE UHV Cell: Dr. Umesh Jadhav (Resource Person), Dr. Anita Mane (Co-Facilitator), Ms. Kiran Naphade (Observer).', 'icon_type' => 'update', 'link' => ''],
                ['text' => 'MDP focuses on Right Understanding, Right Feelings, and Right Conduct for ethical leadership.', 'icon_type' => 'update', 'link' => ''],
            ];
        }

        // 3. Daily Reflection Scenario
        $daily_scenario = null;
        try {
            $today = date('Y-m-d');
            $scenario = Database::fetchOne("SELECT * FROM `reflections_reflectionscenario` WHERE active_date = :dt", ['dt' => $today]);
            
            if (!$scenario) {
                // Rotate based on day of year
                $scenarios = Database::fetchAll("SELECT * FROM `reflections_reflectionscenario` ORDER BY id ASC");
                if (!empty($scenarios)) {
                    $dayOfYear = (int)date('z');
                    $index = $dayOfYear % count($scenarios);
                    $scenario = $scenarios[$index];
                }
            }

            if ($scenario) {
                $options = Database::fetchAll(
                    "SELECT * FROM `reflections_reflectionoption` WHERE scenario_id = :sid ORDER BY id ASC",
                    ['sid' => $scenario['id']]
                );
                $scenario['options'] = $options;
                $daily_scenario = $scenario;
            }
        } catch (\Throwable $e) {}

        // 4. Visitor count
        $total_visitors = 0;
        try {
            $total_visitors = (int)Database::fetchColumn("SELECT SUM(visit_count) FROM `core_sitevisitor`");
        } catch (\Throwable $e) {}

        // Flash messages
        $flashSuccess = flash('success');
        $flashError = flash('error');
        $flashInfo = flash('info');

        // Render view file into buffer
        $viewFile = __DIR__ . '/../../views/' . str_replace('.', '/', $view) . '.php';
        if (!file_exists($viewFile)) {
            die("View file not found: views/{$view}.php");
        }

        ob_start();
        include $viewFile;
        $content = ob_get_clean();

        // If layout requested, wrap with layout
        if ($layout) {
            $layoutFile = __DIR__ . '/../../views/layouts/' . $layout . '.php';
            if (file_exists($layoutFile)) {
                include $layoutFile;
                return;
            }
        }

        echo $content;
    }

    public static function json(array $data, int $statusCode = 200): void {
        http_response_code($statusCode);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
        exit;
    }
}
