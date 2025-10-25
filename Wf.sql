-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for kuliah_wf2_2025
CREATE DATABASE IF NOT EXISTS `kuliah_wf2_2025` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `kuliah_wf2_2025`;

-- Dumping structure for table kuliah_wf2_2025.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table kuliah_wf2_2025.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table kuliah_wf2_2025.detail_rekam_medis
CREATE TABLE IF NOT EXISTS `detail_rekam_medis` (
  `iddetail_rekam_medis` int NOT NULL AUTO_INCREMENT,
  `idrekam_medis` int NOT NULL,
  `idkode_tindakan_terapi` int NOT NULL,
  `detail` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`iddetail_rekam_medis`),
  KEY `fk_detail_rekam_medis_rekam_medis1_idx` (`idrekam_medis`),
  KEY `idkode_tindakan_terapi` (`idkode_tindakan_terapi`),
  CONSTRAINT `detail_rekam_medis_ibfk_1` FOREIGN KEY (`idkode_tindakan_terapi`) REFERENCES `kode_tindakan_terapi` (`idkode_tindakan_terapi`),
  CONSTRAINT `fk_detail_rekam_medis_rekam_medis1` FOREIGN KEY (`idrekam_medis`) REFERENCES `rekam_medis` (`idrekam_medis`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table kuliah_wf2_2025.failed_jobs
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

-- Data exporting was unselected.

-- Dumping structure for table kuliah_wf2_2025.jenis_hewan
CREATE TABLE IF NOT EXISTS `jenis_hewan` (
  `idjenis_hewan` int NOT NULL AUTO_INCREMENT,
  `nama_jenis_hewan` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idjenis_hewan`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table kuliah_wf2_2025.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table kuliah_wf2_2025.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table kuliah_wf2_2025.kategori
CREATE TABLE IF NOT EXISTS `kategori` (
  `idkategori` int NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idkategori`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table kuliah_wf2_2025.kategori_klinis
CREATE TABLE IF NOT EXISTS `kategori_klinis` (
  `idkategori_klinis` int NOT NULL AUTO_INCREMENT,
  `nama_kategori_klinis` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idkategori_klinis`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table kuliah_wf2_2025.kode_tindakan_terapi
CREATE TABLE IF NOT EXISTS `kode_tindakan_terapi` (
  `idkode_tindakan_terapi` int NOT NULL AUTO_INCREMENT,
  `kode` varchar(5) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deskripsi_tindakan_terapi` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idkategori` int NOT NULL,
  `idkategori_klinis` int NOT NULL,
  PRIMARY KEY (`idkode_tindakan_terapi`),
  KEY `fk_kode_tindakan_terapi_kategori1_idx` (`idkategori`),
  KEY `fk_kode_tindakan_terapi_kategori_klinis1_idx` (`idkategori_klinis`),
  CONSTRAINT `fk_kode_tindakan_terapi_kategori_klinis1` FOREIGN KEY (`idkategori_klinis`) REFERENCES `kategori_klinis` (`idkategori_klinis`),
  CONSTRAINT `fk_ktt_kategori` FOREIGN KEY (`idkategori`) REFERENCES `kategori` (`idkategori`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table kuliah_wf2_2025.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table kuliah_wf2_2025.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table kuliah_wf2_2025.pemilik
CREATE TABLE IF NOT EXISTS `pemilik` (
  `idpemilik` int NOT NULL AUTO_INCREMENT,
  `no_wa` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `iduser` bigint NOT NULL,
  PRIMARY KEY (`idpemilik`),
  KEY `fk_pemilik_user_idx` (`iduser`),
  CONSTRAINT `fk_pemilik_user` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table kuliah_wf2_2025.pet
CREATE TABLE IF NOT EXISTS `pet` (
  `idpet` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `warna_tanda` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenis_kelamin` char(1) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idpemilik` int NOT NULL,
  `idras_hewan` int NOT NULL,
  PRIMARY KEY (`idpet`),
  KEY `fk_pet_pemilik1_idx` (`idpemilik`),
  KEY `fk_pet_ras_hewan1_idx` (`idras_hewan`),
  CONSTRAINT `fk_pet_ras_hewan1` FOREIGN KEY (`idras_hewan`) REFERENCES `ras_hewan` (`idras_hewan`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table kuliah_wf2_2025.ras_hewan
CREATE TABLE IF NOT EXISTS `ras_hewan` (
  `idras_hewan` int NOT NULL AUTO_INCREMENT,
  `nama_ras` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idjenis_hewan` int NOT NULL,
  PRIMARY KEY (`idras_hewan`),
  KEY `fk_ras_hewan_jenis_hewan1_idx` (`idjenis_hewan`),
  CONSTRAINT `fk_ras_hewan_jenis_hewan1` FOREIGN KEY (`idjenis_hewan`) REFERENCES `jenis_hewan` (`idjenis_hewan`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table kuliah_wf2_2025.rekam_medis
CREATE TABLE IF NOT EXISTS `rekam_medis` (
  `idrekam_medis` int NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `anamnesa` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `temuan_klinis` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `diagnosa` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idpet` int NOT NULL,
  `dokter_pemeriksa` int NOT NULL,
  PRIMARY KEY (`idrekam_medis`),
  KEY `fk_rekam_medis_pet1_idx` (`idpet`),
  KEY `fk_rekam_medis_role_user1_idx` (`dokter_pemeriksa`),
  CONSTRAINT `fk_rekam_medis_pet1` FOREIGN KEY (`idpet`) REFERENCES `pet` (`idpet`),
  CONSTRAINT `rekam_medis_ibfk_1` FOREIGN KEY (`dokter_pemeriksa`) REFERENCES `role_user` (`idrole_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table kuliah_wf2_2025.role
CREATE TABLE IF NOT EXISTS `role` (
  `idrole` int NOT NULL AUTO_INCREMENT,
  `nama_role` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idrole`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table kuliah_wf2_2025.role_user
CREATE TABLE IF NOT EXISTS `role_user` (
  `idrole_user` int NOT NULL AUTO_INCREMENT,
  `iduser` bigint NOT NULL,
  `idrole` int NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`idrole_user`),
  KEY `fk_role_user_user_idx` (`iduser`),
  KEY `fk_role_user_role1_idx` (`idrole`),
  CONSTRAINT `fk_role_user_role1` FOREIGN KEY (`idrole`) REFERENCES `role` (`idrole`),
  CONSTRAINT `fk_role_user_user` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table kuliah_wf2_2025.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table kuliah_wf2_2025.temu_dokter
CREATE TABLE IF NOT EXISTS `temu_dokter` (
  `idtemu_dokter` int NOT NULL AUTO_INCREMENT,
  `idpet` int NOT NULL,
  `idrole_user` int NOT NULL,
  `no_urut` int NOT NULL,
  `waktu_daftar` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`idtemu_dokter`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table kuliah_wf2_2025.user
CREATE TABLE IF NOT EXISTS `user` (
  `iduser` bigint NOT NULL AUTO_INCREMENT,
  `nama` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`iduser`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table kuliah_wf2_2025.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
