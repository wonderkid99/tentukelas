<?php
require_once __DIR__ . '/../Models/ClassModel.php';

class HomeController {
    /**
     * Menampilkan halaman utama (landing page).
     */
    public function index() {
        $classModel = new ClassModel();
        // Ambil 3 kelas yang akan segera dimulai sebagai kelas unggulan
        $featuredClasses = $classModel->getFeaturedClasses(3);

        // Memuat view dan mengirimkan data kelas unggulan
        require_once __DIR__ . '/../Views/home.php';
    }
}