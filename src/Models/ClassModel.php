<?php
require_once __DIR__ . '/../Core/Database.php';


class ClassModel {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function getAllClasses() {
        try {
            $query = "SELECT * FROM classes ORDER BY created_at DESC";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Gagal mengambil data kelas: " . $e->getMessage());
            return [];
        }
    }
    public function createClass($data) {
        try {
            $query = "INSERT INTO classes (class_name, description, quota, start_date, end_date) 
                      VALUES (:class_name, :description, :quota, :start_date, :end_date)";

            $stmt = $this->db->prepare($query);

            // Bind parameter ke query untuk mencegah SQL Injection
            $stmt->bindParam(':class_name', $data['class_name']);
            $stmt->bindParam(':description', $data['description']);
            $stmt->bindParam(':quota', $data['quota'], PDO::PARAM_INT);
            $stmt->bindParam(':start_date', $data['start_date']);
            $stmt->bindParam(':end_date', $data['end_date']);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Gagal membuat kelas: " . $e->getMessage());
            return false;
        }
    }
}