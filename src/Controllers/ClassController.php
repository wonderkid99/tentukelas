<?php
require_once __DIR__ . '/../Models/ClassModel.php';

class ClassController {

    /**
     * Menampilkan halaman utama manajemen kelas (daftar kelas).
     * PASTIKAN METHOD index() INI ADA.
     */
    public function index() {
        $classModel = new ClassModel();
        $classes = $classModel->getAllClasses();
        require_once __DIR__ . '/../Views/admin/classes/index.php';
    }

    /**
     * Menampilkan halaman form untuk menambah kelas baru.
     */
    public function create() {
        require_once __DIR__ . '/../Views/admin/classes/create.php';
    }

    /**
     * Menyimpan data kelas baru yang dikirim dari form.
     */
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validasi sederhana
            if (empty($_POST['class_name']) || empty($_POST['quota']) || empty($_POST['start_date']) || empty($_POST['end_date'])) {
                die('Semua field yang wajib harus diisi!');
            }

            $data = [
                'class_name' => $_POST['class_name'],
                'description' => $_POST['description'],
                'quota' => $_POST['quota'],
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date']
            ];

            $classModel = new ClassModel();
            if ($classModel->createClass($data)) {
                header('Location: index.php?page=admin-classes');
                exit;
            } else {
                die('Gagal menyimpan data kelas.');
            }
        }
    }
}