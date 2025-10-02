<?php
// Selalu mulai session di file entri utama
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Memuat semua file yang dibutuhkan
require_once __DIR__ . '/../src/config.php';
require_once __DIR__ . '/../src/Core/Auth.php';
require_once __DIR__ . '/../src/Controllers/ClassController.php';
require_once __DIR__ . '/../src/Controllers/UserController.php';
require_once __DIR__ . '/../src/Controllers/RegistrationController.php';
require_once __DIR__ . '/../src/Controllers/DashboardController.php';
require_once __DIR__ . '/../src/Controllers/HomeController.php';

// Router dengan Access Control
$page = $_GET['page'] ?? 'home'; // Halaman default sekarang adalah login

// Halaman publik yang bisa diakses tanpa login
$public_pages = ['login', 'register', 'home'];

// Jika halaman yang diminta bukan halaman publik dan user belum login, paksa ke halaman login
if (!in_array($page, $public_pages) && !Auth::isLoggedIn()) {
    header('Location: index.php?page=login');
    exit;
}

switch ($page) {
    // --- Rute Publik ---
    case 'home':
        $homeController = new HomeController();
        $homeController->index();
        break;
    case 'login':
        $userController = new UserController();
        $userController->login();
        break;
    case 'register':
        $userController = new UserController();
        $userController->register();
        break;
    case 'logout':
        $userController = new UserController();
        $userController->logout();
        break;

    // --- Rute Admin ---
    case 'admin-classes':
    case 'admin-classes-create':
    case 'admin-classes-store':
    case 'admin-classes-edit':
    case 'admin-classes-update':
    case 'admin-classes-delete':
        Auth::requireAdmin(); // Wajib admin untuk mengakses rute ini
        $classController = new ClassController();
        // Memetakan rute ke method controller
        if ($page === 'admin-classes-create') $classController->create();
        elseif ($page === 'admin-classes-store') $classController->store();
        elseif ($page === 'admin-classes-edit') $classController->edit();
        elseif ($page === 'admin-classes-update') $classController->update();
        elseif ($page === 'admin-classes-delete') $classController->destroy();
        else $classController->index();
        break;

    // --- Rute Siswa ---
    case 'student-dashboard':
        Auth::requireLogin();
        $classController = new ClassController();
        $classController->studentIndex();
        break;

    case 'register-class': // Untuk memproses pendaftaran
        Auth::requireLogin();
        $regController = new RegistrationController();
        $regController->register();
        break;
    
    case 'my-classes': // Untuk halaman "Kelas Saya"
        Auth::requireLogin();
        $regController = new RegistrationController();
        $regController->myClasses();
        break;

    case 'admin-dashboard': // TAMBAHKAN RUTE INI
        Auth::requireAdmin();
        $dashboardController = new DashboardController();
        $dashboardController->index();
        break;

    default:
        http_response_code(404);
        echo "<h1>404 - Halaman Tidak Ditemukan</h1>";
        break;
}