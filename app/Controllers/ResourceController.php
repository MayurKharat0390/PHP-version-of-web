<?php
namespace App\Controllers;

use App\Core\View;
use App\Models\Resource;

class ResourceController {
    public function index(): void {
        $category = $_GET['category'] ?? 'all';
        $resources = Resource::all($category);
        $categories = Resource::getCategories();

        View::render('resources.list', [
            'resources' => $resources,
            'categories' => $categories,
            'current_category' => $category
        ]);
    }

    public function detail($id): void {
        $resource = Resource::find((int)$id);
        if (!$resource) {
            http_response_code(404);
            View::render('core.404', ['title' => 'Resource Not Found']);
            return;
        }

        Resource::incrementViews((int)$id);
        // Refresh resource to get updated views
        $resource['views_count'] = (int)$resource['views_count'] + 1;

        View::render('resources.detail', [
            'resource' => $resource
        ]);
    }
}
