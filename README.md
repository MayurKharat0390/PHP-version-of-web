<div align="center">

# 🏛️ Institute Universal Human Values Cell (UHV Cell)
### *A Digital Ecosystem for Holistic Human Excellence (Native PHP Edition)*

![PHP 8.3+](https://img.shields.io/badge/Backend-PHP_8.3+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Python Free](https://img.shields.io/badge/Python_Files-0_(100%25_PHP)-success?style=for-the-badge)
![License](https://img.shields.io/badge/Category-Institutional-blue?style=for-the-badge)

</div>

---

## 🌟 Mission & Overview
The **Universal Human Values Cell (UHV Cell)** at Pimpri Chinchwad College of Engineering (PCCOE) facilitates a transformative journey for students and faculty alike, moving from **Information** to **Transformation** through self-exploration, living in harmony, and value education.

This project is a native, modern **PHP MVC Application** engineered with **zero Python dependencies**, preserving all original database records, assets, and design aesthetics.

---

## 🚀 Key Feature Pillars

### 📝 1. Daily Reflection & Mindfulness Engine
*   **Daily Values Rotation**: Daily scenario rotation based on calendar day or date.
*   **Interactive Dilemmas**: 4 multiple-choice perspectives with instant feedback and value alignment scoring (+10 pts).
*   **Intelligent Journaling**: Personal secure journals with word count validation, mood tracking (😊, 😌, 🤔, etc.), and tags.

### 🤝 2. Community, Activities & Mentors
*   **Student Impact Stories**: Peer testimonials with photo/video upload modal and full administrative moderation (Approve / Reject / Delete).
*   **Activities & Workshops**: Campus workshops and awareness videos with interactive gallery lightbox and student attendance counts.
*   **Faculty Mentors**: Directory of mentors with photos and educational philosophies.
*   **Learning Resources**: Categorized library of articles, videos, and downloadable PDFs with dynamic view counting.
*   **UHV Digital Innovations**: Showcase of digital platforms (apps, web tools) built around human values.

### 📊 3. Analytics, Streaks & Progress
*   **30-Day Activity Calendar**: Visual heatmap tracking daily login streaks and milestones.
*   **Achievement Badges**: Longest streak celebrations and reflection totals.
*   **Live Visitor Tracking**: IP-based automatic visitor counter.
*   **Announcement Ticker**: Dynamic header marquee with configurable updates, events, and highlights.
*   **Event Announcement Flyer**: Engaging homepage popup for upcoming institutional events.

### ⚙️ 4. Unified Admin Command Center (`/admin`)
*   **Master Dashboard**: Real-time KPI cards, pending stories alert, and recent contact inquiries.
*   **User Management**: Role toggling (Student / Faculty / Staff / Admin) and secure account control.
*   **Scenario Studio**: Full CRUD for reflection dilemmas with inline options, scores, and feedback.
*   **Content Moderation**: Instant moderation of student voices, stories, and file uploads.
*   **Workshop Manager**: Activity publisher with cover photo and multiple gallery picture uploads.
*   **Resources & Innovations CMS**: Easy management of downloadable PDFs, links, and project showcases.
*   **Daily Quotes & News Ticker**: Add, toggle active, and manage quotes and marquee updates.
*   **Inbound Messages**: Contact inbox with mailto replies.

---

## 🛠️ Architecture & Technology Stack

*   **Language**: Native **PHP 8.2+ / 8.3+** with strict typing and PSR-4 compliant autoloading.
*   **Database**: SQLite (`db.sqlite3`) and MySQL-ready PDO wrapper with prepared statements.
*   **Authentication**: Secure session auth with backward compatibility for legacy Django PBKDF2-SHA256 password hashes as well as native PHP `password_hash`/`password_verify`.
*   **Styling**: Modern Vanilla CSS, Tailwind CSS (via CDN), Alpine.js, HTMX, glassmorphism, 3D card tilts, and smooth gradients.
*   **Autoloading**: Built-in zero-dependency PSR-4 autoloader (No composer required).

---

## 📁 Directory Structure

```text
UHV-Website/
├── app/
│   ├── Controllers/            # Route Controllers (Home, Activity, Admin, Auth, etc.)
│   ├── Core/                   # Engine (Auth, Database, Helper, Middleware, Router, View)
│   └── Models/                 # PDO Data Models (User, Reflection, Activity, Journal, etc.)
├── config/
│   ├── app.php                 # Application & Mail Configuration
│   └── database.php            # PDO Database Connection Settings
├── media/                      # Uploaded files (story photos, activity galleries, thumbnails)
├── static/                     # Images, logos, flyers, icons, and styling assets
├── views/
│   ├── activities/             # Activities list & detail views
│   ├── admin/                  # Admin control panel views
│   ├── core/                   # Home, UHV Cell, Contact Us, 404 views
│   ├── faculty/                # Mentors directory views
│   ├── innovations/            # Digital innovations views
│   ├── journals/               # Student journal views
│   ├── layouts/                # Master responsive layout (main.php)
│   ├── progress/               # Dashboard & 30-day streak views
│   ├── reflections/            # Daily dilemma cards & feedback views
│   ├── resources/              # Learning resource views
│   ├── users/                  # Login, Signup, Profile views
│   └── voices/                 # Student stories & submission modal views
├── db.sqlite3                  # Active database populated with 21 tables & records
├── index.php                   # Primary Front Controller & Route Registry
├── router.php                  # CLI Router for PHP built-in web server
├── .htaccess                   # Apache URL Rewriting rules
└── vercel.json / Procfile      # Production deployment descriptors
```

---

## 💻 Running Locally

### Option 1: PHP Built-in Server (Recommended)
Open a terminal in the project directory and run:

```bash
php -S localhost:8000 router.php
```

Then visit [http://localhost:8000](http://localhost:8000) in your browser.

### Option 2: Apache / XAMPP / WampServer / cPanel
1. Copy the project folder into your web root (e.g., `htdocs/uhv` or `www`).
2. Ensure `mod_rewrite` is enabled in Apache.
3. The included `.htaccess` file handles URL rewriting to `index.php` automatically.

---

## 🔐 Default Admin Access
*   **Admin Route**: `/admin`
*   **Existing Credentials**:
    *   **User**: `admin` or `Mayur`
    *   (Uses existing password from database via Django-compatible PBKDF2 hash verification)

---

## 📜 Academic Integrity & License
This project is an official initiative of the **Institute Universal Human Values Cell - PCCOE**.
