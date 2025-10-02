<?php
require_once __DIR__ . '/../Models/UserModel.php';
require_once __DIR__ . '/../Core/Auth.php';

class UserController {
    public function register() {
        // ... (Kode registrasi dari langkah sebelumnya tidak perlu diubah)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = ['name' => trim($_POST['name']), 'email' => trim($_POST['email']), 'password' => $_POST['password'], 'confirm_password' => $_POST['confirm_password']];
            if (empty($data['name']) || empty($data['email']) || empty($data['password'])) { die('Mohon isi semua kolom.'); }
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) { die('Format email tidak valid.'); }
            if (strlen($data['password']) < 6) { die('Password minimal harus 6 karakter.'); }
            if ($data['password'] !== $data['confirm_password']) { die('Konfirmasi password tidak cocok.'); }
            $userModel = new UserModel();
            if ($userModel->findUserByEmail($data['email'])) { die('Email ini sudah terdaftar.'); }
            if ($userModel->registerUser($data)) {
                header('Location: index.php?page=login&status=reg_success');
                exit;
            } else { die('Terjadi kesalahan. Gagal mendaftar.'); }
        } else {
            require_once __DIR__ . '/../Views/users/register.php';
        }
    }

    /**
     * Menangani form login (GET) dan proses login (POST).
     */
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = new UserModel();
            $user = $userModel->loginUser($email, $password);

            if ($user) {
                // Jika login berhasil, simpan data user di session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_role'] = $user['role_name'];

                // Redirect berdasarkan peran
                if ($user['role_name'] === 'admin') {
                    header('Location: index.php?page=admin-dashboard'); // Mengarahkan ke dashboard
                } else {
                    header('Location: index.php?page=student-dashboard');
                }
                exit;
            } else {
                // Jika gagal, kembali ke halaman login dengan pesan error
                header('Location: index.php?page=login&error=invalid_credentials');
                exit;
            }
        } else {
            // Tampilkan form login
            require_once __DIR__ . '/../Views/users/login.php';
        }
    }

    /**
     * Proses logout.
     */
    public function logout() {
        session_unset();
        session_destroy();
        header('Location: index.php?page=login&status=logout_success');
        exit;
    }
}