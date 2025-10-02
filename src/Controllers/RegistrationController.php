<?php
require_once __DIR__ . '/../Models/RegistrationModel.php';
require_once __DIR__ . '/../Core/Auth.php';

class RegistrationController {
    
    /**
     * Memproses permintaan pendaftaran kelas dari siswa.
     */
    public function register() {
        Auth::requireLogin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $classId = $_POST['class_id'] ?? null;
            $userId = $_SESSION['user_id'] ?? null;

            if (!$classId || !$userId) {
                header('Location: index.php?page=student-dashboard&error=Data tidak valid.');
                exit;
            }

            $regModel = new RegistrationModel();
            $result = $regModel->createRegistration($userId, $classId);

            if ($result['success']) {
                header('Location: index.php?page=student-dashboard&status=reg_success');
            } else {
                header('Location: index.php?page=student-dashboard&error=' . urlencode($result['error']));
            }
            exit;
        }
    }

    /**
     * Menampilkan halaman "Kelas Saya".
     */
    public function myClasses() {
        Auth::requireLogin();
        $userId = $_SESSION['user_id'];
        $regModel = new RegistrationModel();
        $myClasses = $regModel->getRegisteredClassesByUser($userId);

        // Memuat view
        require_once __DIR__ . '/../Views/student/my_classes.php';
    }
}