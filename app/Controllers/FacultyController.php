<?php
namespace App\Controllers;

use App\Core\View;
use App\Models\Faculty;

class FacultyController {
    public function index(): void {
        $faculty_members = Faculty::all();
        View::render('faculty.list', [
            'faculty_members' => $faculty_members
        ]);
    }
}
