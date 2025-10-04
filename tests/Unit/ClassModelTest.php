<?php
use PHPUnit\Framework\TestCase;

// Muat file yang diperlukan
require_once __DIR__ . '/../../src/config.php';
require_once __DIR__ . '/../../src/Core/Database.php';
require_once __DIR__ . '/../../src/Models/ClassModel.php';

class ClassModelTest extends TestCase
{
    private $db;
    private $classModel;
    private static $createdClassId; // Properti untuk menyimpan ID

    // Method ini dijalankan sebelum setiap test
    protected function setUp(): void
    {
        $this->db = (new Database())->getConnection();
        $this->classModel = new ClassModel();
    }

    // Menggabungkan test create dan get menjadi satu test yang independen
    public function testCreateAndGetClass()
    {
        // Bagian 1: Create
        $data = [
            'class_name' => 'Test Class PHPUnit Modern',
            'description' => 'A test class following modern practices.',
            'quota' => 10,
            'start_date' => '2025-12-01 10:00:00',
            'end_date' => '2025-12-02 10:00:00'
        ];

        $result = $this->classModel->createClass($data);
        $this->assertTrue($result, "Gagal membuat kelas baru.");

        // Simpan ID yang baru dibuat
        self::$createdClassId = $this->db->lastInsertId();
        $this->assertIsNumeric(self::$createdClassId);

        // Bagian 2: Get & Verify
        $class = $this->classModel->getClassById(self::$createdClassId);

        $this->assertIsArray($class);
        $this->assertEquals('Test Class PHPUnit Modern', $class['class_name']);
    }
    
    // Method ini dijalankan di akhir untuk membersihkan data test
    public static function tearDownAfterClass(): void
    {
        // Hanya jalankan jika ID pernah dibuat
        if (self::$createdClassId) {
            $pdo = (new Database())->getConnection();
            $stmt = $pdo->prepare("DELETE FROM classes WHERE id = ?");
            $stmt->execute([self::$createdClassId]);
        }
    }
}