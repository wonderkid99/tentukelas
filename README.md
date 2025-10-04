# Proyek: TENTUKELAS - Sistem Pendaftaran Kelas Real-time

TENTUKELAS adalah aplikasi web yang memungkinkan siswa untuk melihat daftar kelas yang tersedia, melihat sisa kuota secara real-time, dan mendaftarkan diri. Administrator dapat mengelola (membuat, membaca, mengupdate, menghapus) data kelas dan melihat daftar peserta.

## Fitur Utama

- **Untuk Siswa:**
  - Registrasi & Login Akun
  - Melihat daftar kelas yang tersedia beserta sisa kuota.
  - Mendaftar ke kelas.
  - Melihat riwayat kelas yang sudah diikuti ("Kelas Saya").
- **Untuk Admin:**
  - Login & Dashboard Statistik.
  - Grafik analitik untuk popularitas kelas dan tren pendaftaran.
  - Manajemen Kelas (CRUD - Create, Read, Update, Delete).

## Teknologi

- **Backend:** PHP (Native/Vanilla)
- **Frontend:** HTML, Tailwind CSS (via CDN), JavaScript (untuk grafik menggunakan chart.js)
- **Database:** MySQL
- **Manajemen Dependensi PHP:** Composer
- **Testing:** PHPUnit

## Arsitektur & ERD

Aplikasi ini menggunakan pola arsitektur **Model-View-Controller (MVC)** yang disederhanakan untuk memisahkan logika, data, dan tampilan.

```mermaid
erDiagram
    ROLES { int id PK; varchar role_name; }
    USERS { int id PK; varchar name; varchar email UK; varchar password; int role_id FK; }
    CLASSES { int id PK; varchar class_name; text description; int quota; datetime start_date; }
    REGISTRATIONS { int id PK; int user_id FK; int class_id FK; timestamp registration_date; }
    USERS ||--o{ ROLES : "has"; REGISTRATIONS }o--|| USERS : "makes"; REGISTRATIONS }o--|| CLASSES : "receives"
```

## Panduan Instalasi (Lokal)

Prasyarat: XAMPP (dengan PHP 8+, MySQL), Composer, Git.

1. Clone repositori ini: git clone https://github.com/wonderkid99/tentukELAS.git

2. Pindahkan folder tentukelas ke dalam htdocs XAMPP Anda.

3. Jalankan composer install di direktori proyek untuk menginstal dependensi.

4. Buat database baru di phpMyAdmin bernama db_tentukelas.

5. Impor file database/schema.sql ke database yang baru dibuat.

6. Buat user admin secara manual di tabel users dengan role_id = 1.

7. Akses proyek melalui http://localhost/tentukelas/public/.
