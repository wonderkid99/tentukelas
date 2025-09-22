<?php

// Konfigurasi Database
// Di lingkungan produksi, informasi ini seharusnya dibaca dari environment variables (.env)
// untuk keamanan yang lebih baik.

define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_USER', 'root'); // Ganti dengan user database Anda
define('DB_PASS', '');     // Ganti dengan password Anda
define('DB_NAME', 'db_pendaftaran_kelas'); // Nama database yang akan kita buat