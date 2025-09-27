<?php
// Memuat semua file yang dibutuhkan
require_once __DIR__ . '/../src/config.php';
require_once __DIR__ . '/../src/Controllers/ClassController.php';


// Router Super Sederhana
// Kita akan menggunakan parameter URL untuk menentukan halaman mana yang akan dimuat.
// Contoh: index.php?page=admin-classes
$page = $_GET['page'] ?? 'home'; // Jika parameter 'page' tidak ada, anggap 'home'

switch ($page) {
    case 'admin-classes':
        $controller = new ClassController();
        $controller->index();
        break;
    
    // Anda bisa menambahkan case lain di sini untuk halaman lain
    // case 'student-dashboard':
    //     // ...
    //     break;

    default:
        // Halaman default jika 'page' tidak cocok
        http_response_code(404);
        echo "<h1>404 - Halaman Tidak Ditemukan</h1>";
        break;
}