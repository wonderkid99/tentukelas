<?php
// Memuat semua file yang dibutuhkan
require_once __DIR__ . '/../src/config.php';
require_once __DIR__ . '/../src/Controllers/ClassController.php';


// Router Super Sederhana
// Kita akan menggunakan parameter URL untuk menentukan halaman mana yang akan dimuat.
// Contoh: index.php?page=admin-classes
$page = $_GET['page'] ?? 'home'; // Jika parameter 'page' tidak ada, anggap 'home'

// ...
switch ($page) {
    case 'admin-classes':
        $controller = new ClassController();
        $controller->index();
        break;

    // --- TAMBAHKAN DUA CASE INI ---
    case 'admin-classes-create':
        $controller = new ClassController();
        $controller->create();
        break;

    case 'admin-classes-store':
        $controller = new ClassController();
        $controller->store();
        break;
    // ---------------------------------

    default:
        // ...
}