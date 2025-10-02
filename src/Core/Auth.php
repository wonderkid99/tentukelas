<?php
// Selalu mulai session di awal
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class Auth {
    /**
     * Cek apakah user sudah login.
     */
    public static function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    /**
     * Cek apakah user yang login adalah admin.
     */
    public static function isAdmin() {
        return self::isLoggedIn() && $_SESSION['user_role'] === 'admin';
    }

    /**
     * Wajibkan user untuk login. Jika tidak, redirect ke halaman login.
     */
    public static function requireLogin() {
        if (!self::isLoggedIn()) {
            header('Location: index.php?page=login');
            exit;
        }
    }

    /**
     * Wajibkan user untuk menjadi admin. Jika tidak, tampilkan error.
     */
    public static function requireAdmin() {
        if (!self::isAdmin()) {
            http_response_code(403); // Forbidden
            die('Akses ditolak. Anda harus menjadi admin.');
        }
    }
}