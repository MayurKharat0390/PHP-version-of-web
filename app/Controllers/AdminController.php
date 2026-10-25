<?php
namespace App\Controllers;

use App\Core\Auth;
use App\Core\Database;
use App\Core\View;
use App\Models\User;
use App\Models\Activity;
use App\Models\Reflection;
use App\Models\Journal;
use App\Models\StudentVoice;
use App\Models\Innovation;
use App\Models\Resource;
use App\Models\Faculty;
use App\Models\Quote;
use App\Models\NewsUpdate;
use App\Models\ContactMessage;

class AdminController {
    public function __construct() {
        if (!Auth::check() || !Auth::isAdmin()) {
            redirect('login', ['error' => 'Access denied. Administrator privileges required.']);
        }
    }

    public function index(): void {
        $stats = [
            'users' => (int)Database::fetchColumn("SELECT COUNT(*) FROM `users_customuser`"),
            'reflections' => (int)Database::fetchColumn("SELECT COUNT(*) FROM `reflections_userresponse`"),
            'scenarios' => (int)Database::fetchColumn("SELECT COUNT(*) FROM `reflections_reflectionscenario`"),
            'journals' => (int)Database::fetchColumn("SELECT COUNT(*) FROM `journals_journalentry`"),
            'activities' => (int)Database::fetchColumn("SELECT COUNT(*) FROM `activities_activity`"),
            'voices_pending' => (int)Database::fetchColumn("SELECT COUNT(*) FROM `voices_studentvoice` WHERE is_approved = 0"),
            'voices_total' => (int)Database::fetchColumn("SELECT COUNT(*) FROM `voices_studentvoice`"),
            'innovations' => (int)Database::fetchColumn("SELECT COUNT(*) FROM `innovations_innovation`"),
            'resources' => (int)Database::fetchColumn("SELECT COUNT(*) FROM `resources_resource`"),
            'messages' => (int)Database::fetchColumn("SELECT COUNT(*) FROM `core_contactmessage`"),
            'visitors' => (int)Database::fetchColumn("SELECT SUM(visit_count) FROM `core_sitevisitor`"),
        ];

        $recent_messages = ContactMessage::all();
        $recent_responses = array_slice(Reflection::allResponses(), 0, 5);
        $pending_voices = Database::fetchAll("SELECT * FROM `voices_studentvoice` WHERE is_approved = 0 ORDER BY created_at DESC");

        View::render('admin.index', [
            'stats' => $stats,
            'recent_messages' => array_slice($recent_messages, 0, 5),
            'recent_responses' => $recent_responses,
            'pending_voices' => $pending_voices
        ]);
    }

    // --- User Management ---
    public function users(): void {
        $users = User::all();
        View::render('admin.users', ['users' => $users]);
    }

    public function updateUserRole(): void {
        $id = (int)($_POST['id'] ?? 0);
        $role = $_POST['role'] ?? '';

        if ($id && $role) {
            $data = [];
            if ($role === 'student') {
                $data = ['is_student' => 1, 'is_faculty' => 0, 'is_staff' => 0];
            } elseif ($role === 'faculty') {
                $data = ['is_student' => 0, 'is_faculty' => 1, 'is_staff' => 0];
            } elseif ($role === 'staff') {
                $data = ['is_staff' => 1];
            }
            User::update($id, $data);
        }
        redirect('admin/users', ['success' => 'User role updated successfully.']);
    }

    public function deleteUser(): void {
        $id = (int)($_POST['id'] ?? 0);
        if ($id && $id !== Auth::id()) {
            User::delete($id);
            redirect('admin/users', ['success' => 'User deleted successfully.']);
        }
        redirect('admin/users', ['error' => 'Cannot delete current logged-in user.']);
    }

    // --- Reflection Scenarios ---
    public function reflections(): void {
        $scenarios = Reflection::allScenarios();
        $responses = Reflection::allResponses();
        View::render('admin.reflections', [
            'scenarios' => $scenarios,
            'responses' => $responses
        ]);
    }

    public function createScenario(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $text = trim($_POST['scenario_text'] ?? '');
            $explanation = trim($_POST['explanation'] ?? '');
            $relatedValue = trim($_POST['related_value'] ?? 'Responsibility');
            $activeDate = trim($_POST['active_date'] ?? date('Y-m-d'));
            $options = $_POST['options'] ?? [];

            if ($title && $text) {
                Reflection::createScenario([
                    'title' => $title,
                    'scenario_text' => $text,
                    'explanation' => $explanation,
                    'related_value' => $relatedValue,
                    'active_date' => $activeDate
                ], $options);
                redirect('admin/reflections', ['success' => 'Reflection scenario created successfully!']);
            }
        }
        View::render('admin.scenario_form', ['scenario' => null]);
    }

    public function editScenario($id): void {
        $scenario = Reflection::findScenario((int)$id);
        if (!$scenario) {
            redirect('admin/reflections', ['error' => 'Scenario not found.']);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $text = trim($_POST['scenario_text'] ?? '');
            $explanation = trim($_POST['explanation'] ?? '');
            $relatedValue = trim($_POST['related_value'] ?? 'Responsibility');
            $activeDate = trim($_POST['active_date'] ?? date('Y-m-d'));
            $options = $_POST['options'] ?? [];

            Reflection::updateScenario((int)$id, [
                'title' => $title,
                'scenario_text' => $text,
                'explanation' => $explanation,
                'related_value' => $relatedValue,
                'active_date' => $activeDate
            ], $options);

            redirect('admin/reflections', ['success' => 'Scenario updated successfully!']);
        }

        View::render('admin.scenario_form', ['scenario' => $scenario]);
    }

    public function deleteScenario($id): void {
        Reflection::deleteScenario((int)$id);
        redirect('admin/reflections', ['success' => 'Scenario deleted successfully.']);
    }

    // --- Journal Entries ---
    public function journals(): void {
        $entries = Journal::all();
        View::render('admin.journals', ['entries' => $entries]);
    }

    // --- Activities ---
    public function activities(): void {
        $activities = Activity::all();
        View::render('admin.activities', ['activities' => $activities]);
    }

    public function createActivity(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $date = trim($_POST['date'] ?? date('Y-m-d'));
            $value = trim($_POST['value_practiced'] ?? 'Harmony');
            $count = (int)($_POST['student_count'] ?? 0);
            $desc = trim($_POST['description'] ?? '');

            $imagePath = '';
            if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                $safeName = 'activity_' . time() . '.' . $ext;
                $target = __DIR__ . '/../../media/activities/' . $safeName;
                if (!is_dir(dirname($target))) mkdir(dirname($target), 0777, true);
                if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                    $imagePath = 'activities/' . $safeName;
                }
            }

            $activityId = Activity::create([
                'title' => $title,
                'date' => $date,
                'value_practiced' => $value,
                'student_count' => $count,
                'description' => $desc,
                'image' => $imagePath
            ]);

            // Handle additional gallery images
            if (!empty($_FILES['gallery']['name'][0])) {
                $galleryDir = __DIR__ . '/../../media/activities/gallery/';
                if (!is_dir($galleryDir)) mkdir($galleryDir, 0777, true);

                $total = count($_FILES['gallery']['name']);
                for ($i = 0; $i < $total; $i++) {
                    if ($_FILES['gallery']['error'][$i] === UPLOAD_ERR_OK) {
                        $ext = strtolower(pathinfo($_FILES['gallery']['name'][$i], PATHINFO_EXTENSION));
                        $safeName = 'gallery_' . time() . '_' . $i . '.' . $ext;
                        if (move_uploaded_file($_FILES['gallery']['tmp_name'][$i], $galleryDir . $safeName)) {
                            Activity::addImage($activityId, 'activities/gallery/' . $safeName);
                        }
                    }
                }
            }

            redirect('admin/activities', ['success' => 'Activity created successfully!']);
        }
        View::render('admin.activity_form', ['activity' => null]);
    }

    public function editActivity($id): void {
        $activity = Activity::find((int)$id);
        if (!$activity) {
            redirect('admin/activities', ['error' => 'Activity not found.']);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => trim($_POST['title'] ?? ''),
                'date' => trim($_POST['date'] ?? date('Y-m-d')),
                'value_practiced' => trim($_POST['value_practiced'] ?? 'Harmony'),
                'student_count' => (int)($_POST['student_count'] ?? 0),
                'description' => trim($_POST['description'] ?? '')
            ];

            if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                $safeName = 'activity_' . time() . '.' . $ext;
                $target = __DIR__ . '/../../media/activities/' . $safeName;
                if (!is_dir(dirname($target))) mkdir(dirname($target), 0777, true);
                if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                    $data['image'] = 'activities/' . $safeName;
                }
            }

            Activity::update((int)$id, $data);

            // Handle new gallery images
            if (!empty($_FILES['gallery']['name'][0])) {
                $galleryDir = __DIR__ . '/../../media/activities/gallery/';
                if (!is_dir($galleryDir)) mkdir($galleryDir, 0777, true);

                $total = count($_FILES['gallery']['name']);
                for ($i = 0; $i < $total; $i++) {
                    if ($_FILES['gallery']['error'][$i] === UPLOAD_ERR_OK) {
                        $ext = strtolower(pathinfo($_FILES['gallery']['name'][$i], PATHINFO_EXTENSION));
                        $safeName = 'gallery_' . time() . '_' . $i . '.' . $ext;
                        if (move_uploaded_file($_FILES['gallery']['tmp_name'][$i], $galleryDir . $safeName)) {
                            Activity::addImage((int)$id, 'activities/gallery/' . $safeName);
                        }
                    }
                }
            }

            redirect('admin/activities', ['success' => 'Activity updated successfully!']);
        }

        View::render('admin.activity_form', ['activity' => $activity]);
    }

    public function deleteActivity($id): void {
        Activity::delete((int)$id);
        redirect('admin/activities', ['success' => 'Activity deleted successfully.']);
    }

    // --- Voices Management ---
    public function voices(): void {
        $voices = StudentVoice::all();
        View::render('admin.voices', ['voices' => $voices]);
    }

    public function approveVoice($id): void {
        StudentVoice::setApproved((int)$id, true);
        redirect('admin/voices', ['success' => 'Story approved for public display!']);
    }

    public function rejectVoice($id): void {
        StudentVoice::setApproved((int)$id, false);
        redirect('admin/voices', ['info' => 'Story disapproved.']);
    }

    public function deleteVoice($id): void {
        StudentVoice::delete((int)$id);
        redirect('admin/voices', ['success' => 'Story removed successfully.']);
    }

    // --- Innovations Management ---
    public function innovations(): void {
        $innovations = Innovation::all();
        View::render('admin.innovations', ['innovations' => $innovations]);
    }

    public function createInnovation(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => trim($_POST['title'] ?? ''),
                'slug' => trim($_POST['slug'] ?? ''),
                'description' => trim($_POST['description'] ?? ''),
                'short_description' => trim($_POST['short_description'] ?? ''),
                'innovation_type' => trim($_POST['innovation_type'] ?? 'website'),
                'developed_by' => trim($_POST['developed_by'] ?? ''),
                'link' => trim($_POST['link'] ?? ''),
                'is_featured' => !empty($_POST['is_featured']) ? 1 : 0,
                'thumbnail' => ''
            ];

            if (!empty($_FILES['thumbnail']['name']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION));
                $safeName = 'inno_' . time() . '.' . $ext;
                $target = __DIR__ . '/../../media/innovations/thumbnails/' . $safeName;
                if (!is_dir(dirname($target))) mkdir(dirname($target), 0777, true);
                if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $target)) {
                    $data['thumbnail'] = 'innovations/thumbnails/' . $safeName;
                }
            }

            Innovation::create($data);
            redirect('admin/innovations', ['success' => 'Innovation created successfully!']);
        }
        View::render('admin.innovation_form', ['innovation' => null]);
    }

    public function deleteInnovation($id): void {
        Innovation::delete((int)$id);
        redirect('admin/innovations', ['success' => 'Innovation deleted successfully.']);
    }

    // --- Resources Management ---
    public function resources(): void {
        $resources = Resource::all();
        View::render('admin.resources', ['resources' => $resources]);
    }

    public function createResource(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => trim($_POST['title'] ?? ''),
                'description' => trim($_POST['description'] ?? ''),
                'resource_type' => trim($_POST['resource_type'] ?? 'article'),
                'category' => trim($_POST['category'] ?? 'general'),
                'url' => trim($_POST['url'] ?? ''),
                'is_featured' => !empty($_POST['is_featured']) ? 1 : 0,
                'thumbnail' => '',
                'file' => ''
            ];

            if (!empty($_FILES['thumbnail']['name']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION));
                $safeName = 'thumb_' . time() . '.' . $ext;
                $target = __DIR__ . '/../../media/resource_thumbnails/' . $safeName;
                if (!is_dir(dirname($target))) mkdir(dirname($target), 0777, true);
                if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $target)) {
                    $data['thumbnail'] = 'resource_thumbnails/' . $safeName;
                }
            }

            if (!empty($_FILES['file']['name']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
                $safeName = 'res_' . time() . '.' . $ext;
                $target = __DIR__ . '/../../media/resources/' . $safeName;
                if (!is_dir(dirname($target))) mkdir(dirname($target), 0777, true);
                if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
                    $data['file'] = 'resources/' . $safeName;
                }
            }

            Resource::create($data);
            redirect('admin/resources', ['success' => 'Resource created successfully!']);
        }
        View::render('admin.resource_form', ['resource' => null]);
    }

    public function deleteResource($id): void {
        Resource::delete((int)$id);
        redirect('admin/resources', ['success' => 'Resource deleted successfully.']);
    }

    // --- Faculty Management ---
    public function faculty(): void {
        $faculties = Faculty::all();
        View::render('admin.faculty', ['faculties' => $faculties]);
    }

    public function createFaculty(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => trim($_POST['name'] ?? ''),
                'role' => trim($_POST['role'] ?? ''),
                'philosophy' => trim($_POST['philosophy'] ?? ''),
                'image' => ''
            ];

            if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                $safeName = 'faculty_' . time() . '.' . $ext;
                $target = __DIR__ . '/../../media/faculty/' . $safeName;
                if (!is_dir(dirname($target))) mkdir(dirname($target), 0777, true);
                if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                    $data['image'] = 'faculty/' . $safeName;
                }
            }

            Faculty::create($data);
            redirect('admin/faculty', ['success' => 'Faculty member added successfully!']);
        }
        View::render('admin.faculty_form', ['faculty' => null]);
    }

    public function deleteFaculty($id): void {
        Faculty::delete((int)$id);
        redirect('admin/faculty', ['success' => 'Faculty member deleted.']);
    }

    // --- Quotes Management ---
    public function quotes(): void {
        $quotes = Quote::all();
        View::render('admin.quotes', ['quotes' => $quotes]);
    }

    public function createQuote(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $text = trim($_POST['text'] ?? '');
            $author = trim($_POST['author'] ?? '');
            $category = trim($_POST['category'] ?? 'general');

            if ($text && $author) {
                Quote::create([
                    'text' => $text,
                    'author' => $author,
                    'category' => $category,
                    'is_active' => 1
                ]);
                redirect('admin/quotes', ['success' => 'Quote created successfully!']);
            }
        }
        redirect('admin/quotes');
    }

    public function toggleQuote($id): void {
        Quote::toggleActive((int)$id);
        redirect('admin/quotes', ['success' => 'Quote status toggled.']);
    }

    public function deleteQuote($id): void {
        Quote::delete((int)$id);
        redirect('admin/quotes', ['success' => 'Quote deleted.']);
    }

    // --- News Updates Ticker Management ---
    public function news(): void {
        $news = NewsUpdate::all();
        View::render('admin.news', ['news' => $news]);
    }

    public function createNews(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $text = trim($_POST['text'] ?? '');
            $iconType = trim($_POST['icon_type'] ?? 'update');
            $link = trim($_POST['link'] ?? '');
            $order = (int)($_POST['order'] ?? 0);

            if ($text) {
                NewsUpdate::create([
                    'text' => $text,
                    'icon_type' => $iconType,
                    'link' => $link,
                    'order' => $order,
                    'is_active' => 1
                ]);
                redirect('admin/news', ['success' => 'Ticker update created successfully!']);
            }
        }
        redirect('admin/news');
    }

    public function toggleNews($id): void {
        NewsUpdate::toggleActive((int)$id);
        redirect('admin/news', ['success' => 'News ticker status updated.']);
    }

    public function deleteNews($id): void {
        NewsUpdate::delete((int)$id);
        redirect('admin/news', ['success' => 'News update deleted.']);
    }

    // --- Contact Messages ---
    public function messages(): void {
        $messages = ContactMessage::all();
        View::render('admin.messages', ['messages' => $messages]);
    }

    public function deleteMessage($id): void {
        ContactMessage::delete((int)$id);
        redirect('admin/messages', ['success' => 'Message deleted.']);
    }
}
