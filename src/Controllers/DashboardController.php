<?php
require_once __DIR__ . '/../Core/Auth.php';
require_once __DIR__ . '/../Models/UserModel.php';
require_once __DIR__ . '/../Models/ClassModel.php';
require_once __DIR__ . '/../Models/RegistrationModel.php';

class DashboardController {
    public function index() {
        Auth::requireAdmin();

        $userModel = new UserModel();
        $classModel = new ClassModel();
        $regModel = new RegistrationModel();

        // Mengambil data statistik (sudah ada)
        $stats = [
            'total_students' => $userModel->getTotalStudents(),
            'active_classes' => $classModel->getTotalActiveClasses(),
            'total_registrations' => $regModel->getTotalRegistrations()
        ];
        
        $latestRegistrations = $regModel->getLatestRegistrations();

        // --- BAGIAN BARU: MENGAMBIL DATA UNTUK GRAFIK ---
        $classPopularity = $regModel->getClassPopularityData();
        $registrationTrend = $regModel->getRegistrationTrendData();

        // Mengubah data menjadi format JSON agar mudah dibaca oleh JavaScript
        $chartData = [
            'classPopularity' => $classPopularity,
            'registrationTrend' => $registrationTrend
        ];
        $chartDataJSON = json_encode($chartData);
        // ------------------------------------------------

        // Memuat view dashboard dan mengirimkan semua data
        require_once __DIR__ . '/../Views/admin/dashboard.php';
    }
}