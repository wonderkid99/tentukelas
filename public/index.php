<?php
require_once __DIR__ . '/../src/config.php';
require_once __DIR__ . '/../src/Controllers/ClassController.php';

// Kita akan menggunakan parameter URL untuk menentukan halaman mana yang akan dimuat.
// Contoh: index.php?page=admin-classes
$page = $_GET['page'] ?? 'home'; // Jika parameter 'page' tidak ada, anggap 'home'

switch ($page) {
    case 'admin-classes-store':
        // ...
        break;

    case 'admin-classes-edit':
        $controller = new ClassController();
        $controller->edit();
        break;

    case 'admin-classes-update':
        $controller = new ClassController();
        $controller->update();
        break;
    // ---------------------------------

        case 'admin-classes-delete':
        $controller = new ClassController();
        $controller->destroy();
        break;
    // ---

    default:
        // ...
}