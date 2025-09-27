<?php
require_once __DIR__ . '/../Core/Database.php';

class ClassModel {
    private $db;

    public function __construct() {
        // Membuat koneksi ke database saat model diinisialisasi
        $this->db = (new Database())->getConnection();
    }

    /**
     * Mengambil semua data kelas dari database.
     * Diurutkan berdasarkan yang terbaru.
     * @return array
     */
    public function getAllClasses() {
        try {
            $query = "SELECT * FROM classes ORDER BY created_at DESC";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Untuk production, sebaiknya error di-log, bukan ditampilkan
            error_log("Gagal mengambil data kelas: " . $e->getMessage());
            return []; // Kembalikan array kosong jika gagal
        }
    }
}