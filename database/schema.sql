-- CREATE DATABASE IF NOT EXISTS db_pendaftaran_kelas;
-- USE db_pendaftaran_kelas;

-- Tabel untuk peran pengguna (admin, student)
CREATE TABLE `roles` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `role_name` VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB;

-- Tabel untuk pengguna
CREATE TABLE `users` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL, -- Akan diisi dengan password yang sudah di-hash
  `role_id` INT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

-- Tabel untuk kelas
CREATE TABLE `classes` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `class_name` VARCHAR(255) NOT NULL,
  `description` TEXT,
  `quota` INT NOT NULL,
  `start_date` DATETIME NOT NULL,
  `end_date` DATETIME NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabel untuk pendaftaran
CREATE TABLE `registrations` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `class_id` INT NOT NULL,
  `registration_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`class_id`) REFERENCES `classes`(`id`) ON DELETE CASCADE,
  UNIQUE(`user_id`, `class_id`) -- Memastikan satu user hanya bisa mendaftar sekali di kelas yang sama
) ENGINE=InnoDB;

-- Memasukkan data awal untuk roles
INSERT INTO `roles` (`role_name`) VALUES ('admin'), ('student');