<?php
namespace App\Controllers;

use App\Core\View;
use App\Models\ContactMessage;

class ContactController {
    public function index(): void {
        $this->show();
    }

    public function show(): void {
        View::render('core.contact', [
            'name' => '',
            'email' => '',
            'subject' => '',
            'message' => '',
            'errors' => []
        ]);
    }

    public function submit(): void {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $subject = trim($_POST['subject'] ?? '');
        $message = trim($_POST['message'] ?? '');

        $errors = [];
        if (empty($name)) $errors['name'] = 'Name is required.';
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Valid email is required.';
        if (empty($subject)) $errors['subject'] = 'Subject is required.';
        if (empty($message)) $errors['message'] = 'Message is required.';

        if (!empty($errors)) {
            View::render('core.contact', [
                'name' => $name,
                'email' => $email,
                'subject' => $subject,
                'message' => $message,
                'errors' => $errors
            ]);
            return;
        }

        // Save to DB
        ContactMessage::create([
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'message' => $message
        ]);

        // Try sending notification email
        try {
            $config = require __DIR__ . '/../../config/app.php';
            $to = $config['mail']['contact_recipient'];
            $from = $config['mail']['from_address'];
            $emailSubject = "[UHV Website] New Contact: $subject";
            $emailBody = "Name: $name\nEmail: $email\nSubject: $subject\n\nMessage:\n$message";
            $headers = "From: $from\r\nReply-To: $email\r\nX-Mailer: PHP/" . phpversion();

            @mail($to, $emailSubject, $emailBody, $headers);
        } catch (\Throwable $e) {}

        View::render('core.contact_success', [
            'name' => $name
        ]);
    }

    public function success(): void {
        View::render('core.contact_success');
    }
}
