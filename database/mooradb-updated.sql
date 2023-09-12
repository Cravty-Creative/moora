-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.32 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.4.0.6659
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for mooradb
CREATE DATABASE IF NOT EXISTS `mooradb` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `mooradb`;

-- Dumping structure for table mooradb.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mooradb.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table mooradb.karyawan
CREATE TABLE IF NOT EXISTS `karyawan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `kode` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nik` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jabatan` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `departemen` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_karyawan_users_idx` (`user_id`),
  CONSTRAINT `fk_karyawan_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table mooradb.karyawan: ~7 rows (approximately)
INSERT INTO `karyawan` (`id`, `user_id`, `kode`, `nama`, `nik`, `jabatan`, `departemen`, `created_at`, `updated_at`) VALUES
	(12, 14, 'A1', 'Julianto', '123456789', 'Staff', 'Software', '2023-09-08 00:22:04', '2023-09-08 00:22:04'),
	(13, 15, 'A2', 'Rizky Aditya Suryo ', '987654321', 'Staff', 'IT Support', '2023-09-08 00:24:37', '2023-09-08 00:24:37'),
	(14, 16, 'A3', 'Riski Setiawan', '42536152', 'Staff', 'IT Support', '2023-09-08 00:26:10', '2023-09-08 00:26:10'),
	(15, 17, 'A4', 'Rizqi Maghfiru Romadhon', '132132121', 'Staff', 'IT Support', '2023-09-09 02:40:49', '2023-09-09 02:40:49'),
	(16, 18, 'A5', 'Gilang Mahardhika', '1321121433', 'Staff', 'IT Support', '2023-09-09 02:41:21', '2023-09-09 02:41:21'),
	(17, 19, 'A6', 'Agus Alamsyah', '2321321432', 'Staff', 'IT Support', '2023-09-09 02:42:06', '2023-09-09 02:42:06'),
	(18, 20, 'A7', 'Ardiansyah', '1231213214', 'Staff', 'IT Support', '2023-09-09 02:42:37', '2023-09-09 02:42:37');

-- Dumping structure for table mooradb.kriteria
CREATE TABLE IF NOT EXISTS `kriteria` (
  `id` tinyint NOT NULL AUTO_INCREMENT,
  `kode` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `type` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bobot` float NOT NULL,
  `rumus` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table mooradb.kriteria: ~4 rows (approximately)
INSERT INTO `kriteria` (`id`, `kode`, `nama`, `type`, `bobot`, `rumus`) VALUES
	(1, 'C1', 'Greeting', 'Benefit', 0.2, NULL),
	(2, 'C2', 'Disiplin Kerapihan ', 'Benefit', 0.3, NULL),
	(3, 'C3', 'Teknis Pekerjaan', 'Benefit', 0.4, NULL),
	(4, 'C4', 'Absen', 'Benefit', 0.1, NULL);

-- Dumping structure for table mooradb.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mooradb.migrations: ~4 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- Dumping structure for table mooradb.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mooradb.password_resets: ~0 rows (approximately)

-- Dumping structure for table mooradb.penilaian
CREATE TABLE IF NOT EXISTS `penilaian` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_karyawan` int NOT NULL,
  `id_kriteria` tinyint NOT NULL,
  `nilai` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_penilaian_karyawan_idx` (`id_karyawan`),
  KEY `fk_penilaian_kriteria_idx` (`id_kriteria`),
  CONSTRAINT `fk_penilaian_karyawan` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id`),
  CONSTRAINT `fk_penilaian_kriteria` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table mooradb.penilaian: ~0 rows (approximately)

-- Dumping structure for table mooradb.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mooradb.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table mooradb.poin
CREATE TABLE IF NOT EXISTS `poin` (
  `id` tinyint NOT NULL,
  `id_sub_kriteria` tinyint NOT NULL,
  `keterangan` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `poin` int DEFAULT NULL,
  PRIMARY KEY (`id`,`id_sub_kriteria`),
  KEY `fk_poin_sub_kriteria_idx` (`id_sub_kriteria`),
  CONSTRAINT `fk_poin_sub_kriteria` FOREIGN KEY (`id_sub_kriteria`) REFERENCES `sub_kriteria` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table mooradb.poin: ~0 rows (approximately)

-- Dumping structure for table mooradb.sub_kriteria
CREATE TABLE IF NOT EXISTS `sub_kriteria` (
  `id` tinyint NOT NULL AUTO_INCREMENT,
  `id_kriteria` tinyint NOT NULL,
  `kode` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `detail` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`,`id_kriteria`),
  KEY `fk_sub_kriteria_kriteria_idx` (`id_kriteria`),
  CONSTRAINT `fk_sub_kriteria_kriteria` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table mooradb.sub_kriteria: ~17 rows (approximately)
INSERT INTO `sub_kriteria` (`id`, `id_kriteria`, `kode`, `nama`, `detail`) VALUES
	(1, 1, 'C1.1', 'Penggunaan Greeting', 'Apakah karyawan sudah menggunakan standard greetings pada saat melakukan atau menerima telepon dari customer baik internal maupun external.'),
	(2, 1, 'C1.2', 'Kesesuaian Standar', 'Apakah standard greeting yang dilakukan karyawan sudah sesuai dengan standard instruksi kerja dari perusahaan.'),
	(3, 2, 'C2.1', 'Ketepatan', 'Apakah karyawan selalu datang sebelum atau tepat dengan waktu bekerjanya.'),
	(4, 2, 'C2.2', 'Handover', 'Apakah Karyawan sudah melakukan serah terima informasi pekerjaan pada shift sebelumnya?'),
	(5, 2, 'C2.3', 'Meninggalkan Pos', 'Apakah karyawan Pernah meninggalkan pos sebelum shift berikutnya masuk'),
	(6, 2, 'C2.4', 'Mangkir', 'Apakah Karyawa sering meninggalkan pos saat bertugas?'),
	(7, 2, 'C2.5', 'Respon', 'Seberapa cepat karyawan dalam mengangkat telepon yang masuk'),
	(8, 2, 'C2.6', 'Kerapihan Pakaian', 'Apakah pakaian bekerja (termasuk sepatu) yang digunakan karyawan sudah rapih dan sesuai dengan ketentuan dari perusahaan ataupun lokasi karyawan bekerja'),
	(9, 2, 'C2.7', 'Kelengkapan', 'Apakah karyawan selalu menggunakan name tag perusahaan'),
	(10, 3, 'C3.1', 'Pemahaman Kendala', 'Apakah karyawan langsung memahami kendala atau gangguan atas keluhan yang diterimanya?'),
	(11, 3, 'C3.2', 'Kecepatan respon', 'Bagaimana kecepatan respon dari karyawan dalam merespon request atau gangguan yang terjadi'),
	(12, 3, 'C3.3', 'Efektifitas', 'Bagaimana efektifitas karyawan dalam melakukan 1st troubleshooting gangguan'),
	(13, 3, 'C3.4', 'Kemapuan Teknis', 'Bagaimana kemampuan teknis karyawan dalam melakukan analisa dan penyelesaian gangguan'),
	(14, 3, 'C3.5', 'Update Log', 'Sesering apa karyawan dalam melakukan update log-log gangguan yang terjadi.'),
	(15, 3, 'C3.6', 'Proaktif', 'Apakah karyawan proaktif dalam memberikan informasi dan update penanganan gangguan ke customer'),
	(16, 3, 'C3.7', 'Keterlibatan Karyawan', 'Bagaimana keterlibatan karyawan jika ada gangguan masal'),
	(17, 3, 'C3.8', 'Andil', 'Bagaimana andil karyawan dalam ikut menangani gangguan masal');

-- Dumping structure for table mooradb.sub_penilaian
CREATE TABLE IF NOT EXISTS `sub_penilaian` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_penilaian` int NOT NULL,
  `id_sub_kriteria` tinyint NOT NULL,
  `nilai` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sub_penilaian_penilaian_idx` (`id_penilaian`),
  KEY `fk_sub_penilaian_sub_kriteria_idx` (`id_sub_kriteria`),
  CONSTRAINT `fk_sub_penilaian_penilaian` FOREIGN KEY (`id_penilaian`) REFERENCES `penilaian` (`id`),
  CONSTRAINT `fk_sub_penilaian_sub_kriteria` FOREIGN KEY (`id_sub_kriteria`) REFERENCES `sub_kriteria` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table mooradb.sub_penilaian: ~0 rows (approximately)

-- Dumping structure for table mooradb.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `role` enum('Admin','Karyawan') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mooradb.users: ~8 rows (approximately)
INSERT INTO `users` (`id`, `role`, `username`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'admin', 'admin@moora.com', '$2y$10$sSjLZt4NumPbABdafgw2leUapOZ93tGO/aY3MG7ZR6/gfjuQLTdDy', '956VygoIFraAEvx0zqLM73FGEj3av9l7ZEsy2VOXDX45gQdGaWY8z2Azvcqg', '2023-05-30 00:09:31', '2023-05-30 00:09:31'),
	(14, 'Karyawan', 'julianto', 'julianto@gmail.com', '$2y$10$IG0wvLXYcK39ltvJnIGjsOhYjN0ac9QE5DQ6Mfu4cShPO.YQ30V/K', NULL, '2023-09-08 00:22:04', '2023-09-08 00:22:04'),
	(15, 'Karyawan', 'rizky.aditya', 'rizky.aditya@gmail.com', '$2y$10$JIihCXISwpJNvGublrZOQ.NTMKKjb5JMCGzlMUruAJiB.hx/FyT1m', NULL, '2023-09-08 00:24:37', '2023-09-08 00:24:37'),
	(16, 'Karyawan', 'riski.setiawan', 'riski.setiawan@gmail.com', '$2y$10$EvdfeJU7MiHMf0oJEbzhnuZBw12abMcT6CHf6SjruMZ70Z9PXscyG', NULL, '2023-09-08 00:26:10', '2023-09-08 00:26:10'),
	(17, 'Karyawan', 'rizqi.maghfiru', 'rizqi.maghfiru@gmail.com', '$2y$10$YOq8vjogLkI3SjQkhY23uuu/pumB7ATaxEk5mavlpOXx9cdb0V9Xi', NULL, '2023-09-09 02:40:49', '2023-09-09 02:40:49'),
	(18, 'Karyawan', 'gilang.mahardika', 'gilang.mahardika@gmail.com', '$2y$10$gvXVNrjLEQe4OEClCe/tO.P1XBklwjVxrfY4xYpf8Av4m3GKjn/SK', NULL, '2023-09-09 02:41:21', '2023-09-09 02:41:21'),
	(19, 'Karyawan', 'agus.alamsyah', 'agus.alamsyah@gmail.com', '$2y$10$UsrnpWjpeQX3FrAkaicFSOBJsaf8vL4WJ0qDieGch7njeflwd4e0m', NULL, '2023-09-09 02:42:06', '2023-09-09 02:42:06'),
	(20, 'Karyawan', 'ardiansyah', 'ardiansyah@gmail.com', '$2y$10$/sCdila2.XWawMqQUrwQXeE4wCFV0eNHX9YKeTVkMyMmzcYyF6/L2', NULL, '2023-09-09 02:42:37', '2023-09-09 02:42:37');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
