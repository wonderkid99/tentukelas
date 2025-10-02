<?php
require_once __DIR__ . '/../Core/Database.php';

class UserModel {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function findUserByEmail($email) {
        try {
            $query = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function registerUser($data) {
        try {
            $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
            $studentRoleId = 2;

            $query = "INSERT INTO users (name, email, password, role_id) VALUES (:name, :email, :password, :role_id)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':role_id', $studentRoleId, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    /**
     * Verifikasi login user.
     * @param string $email
     * @param string $password
     * @return mixed User data jika berhasil, false jika gagal.
     */
    public function loginUser($email, $password) {
        try {
            // Query untuk mendapatkan data user beserta nama rolenya
            $query = "SELECT u.*, r.role_name 
                      FROM users u 
                      JOIN roles r ON u.role_id = r.id 
                      WHERE u.email = :email";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                // Jika user ditemukan dan password cocok, kembalikan data user
                return $user;
            }
            return false;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}