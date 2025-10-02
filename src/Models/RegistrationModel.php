<?php
require_once __DIR__ . '/../Core/Database.php';

class RegistrationModel {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    /**
     * Cek apakah user sudah terdaftar di kelas tertentu.
     */
    public function isAlreadyRegistered($userId, $classId) {
        $query = "SELECT COUNT(*) FROM registrations WHERE user_id = :user_id AND class_id = :class_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':class_id', $classId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    /**
     * Mengambil sisa kuota kelas secara akurat.
     */
    public function getRemainingQuota($classId) {
        $query = "SELECT (c.quota - COUNT(r.id)) AS remaining_quota 
                  FROM classes c 
                  LEFT JOIN registrations r ON c.id = r.class_id 
                  WHERE c.id = :class_id 
                  GROUP BY c.id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':class_id', $classId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    /**
     * Mendaftarkan user ke kelas dengan Transaction.
     * Ini penting untuk mencegah race condition (rebutan kuota).
     */
    public function createRegistration($userId, $classId) {
        try {
            $this->db->beginTransaction();

            // 1. Cek duplikat (FOR UPDATE mengunci baris untuk transaksi)
            $queryCheck = "SELECT COUNT(*) FROM registrations WHERE user_id = :user_id AND class_id = :class_id FOR UPDATE";
            $stmtCheck = $this->db->prepare($queryCheck);
            $stmtCheck->execute(['user_id' => $userId, 'class_id' => $classId]);
            if ($stmtCheck->fetchColumn() > 0) {
                throw new Exception("Anda sudah terdaftar di kelas ini.");
            }

            // 2. Cek kuota (FOR UPDATE mengunci baris kelas)
            $queryQuota = "SELECT (c.quota - (SELECT COUNT(*) FROM registrations WHERE class_id = c.id)) AS remaining 
                           FROM classes c WHERE c.id = :class_id FOR UPDATE";
            $stmtQuota = $this->db->prepare($queryQuota);
            $stmtQuota->execute(['class_id' => $classId]);
            if ($stmtQuota->fetchColumn() <= 0) {
                throw new Exception("Kuota untuk kelas ini sudah penuh.");
            }

            // 3. Jika semua cek lolos, masukkan data
            $queryInsert = "INSERT INTO registrations (user_id, class_id) VALUES (:user_id, :class_id)";
            $stmtInsert = $this->db->prepare($queryInsert);
            $stmtInsert->execute(['user_id' => $userId, 'class_id' => $classId]);

            // 4. Selesaikan transaksi
            $this->db->commit();
            return ['success' => true];

        } catch (Exception $e) {
            // 5. Jika terjadi error, batalkan semua perubahan
            $this->db->rollBack();
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Mengambil semua ID kelas yang diikuti oleh user.
     */
    public function getRegisteredClassIdsByUser($userId) {
        $query = "SELECT class_id FROM registrations WHERE user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        // Mengembalikan array yang berisi ID saja, cth: [1, 3, 5]
        return $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
    }

    /**
     * Mengambil detail lengkap kelas yang diikuti oleh user.
     */
    public function getRegisteredClassesByUser($userId) {
        $query = "SELECT c.*, r.registration_date 
                  FROM registrations r
                  JOIN classes c ON r.class_id = c.id
                  WHERE r.user_id = :user_id
                  ORDER BY c.start_date ASC";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}