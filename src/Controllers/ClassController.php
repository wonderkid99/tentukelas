<?php
require_once __DIR__ . '/../Models/ClassModel.php';

class ClassController {

    /**
     * Menampilkan halaman utama manajemen kelas (daftar kelas).
     */
    public function index() {
        // 1. Minta data ke Model
        $classModel = new ClassModel();
        $classes = $classModel->getAllClasses();

        // 2. Tampilkan data ke View
        // Variabel $classes akan tersedia di file view
        require_once __DIR__ . '/../Views/admin/classes/index.php';
    }
}