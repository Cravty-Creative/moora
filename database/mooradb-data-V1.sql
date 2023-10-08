-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: mooradb
-- ------------------------------------------------------
-- Server version	8.0.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `karyawan`
--

LOCK TABLES `karyawan` WRITE;
/*!40000 ALTER TABLE `karyawan` DISABLE KEYS */;
INSERT INTO `karyawan` VALUES (12,14,'A1','Julianto','123456789','Staff','Software','2023-09-08 00:22:04','2023-09-08 00:22:04'),(13,15,'A2','Rizky Aditya Suryo','987654321','Staff','IT Support','2023-09-08 00:24:37','2023-09-08 00:24:37'),(14,16,'A3','Riski Setiawan','42536152','Staff','IT Support','2023-09-08 00:26:10','2023-09-08 00:26:10'),(15,17,'A4','Rizqi Maghfiru Romadhon','132132121','Staff','IT Support','2023-09-09 02:40:49','2023-09-09 02:40:49'),(16,18,'A5','Gilang Mahardhika','1321121433','Staff','IT Support','2023-09-09 02:41:21','2023-09-09 02:41:21'),(17,19,'A6','Agus Alamsyah','2321321432','Staff','IT Support','2023-09-09 02:42:06','2023-09-09 02:42:06'),(18,20,'A7','Ardiansyah','1231213214','Staff','IT Support','2023-09-09 02:42:37','2023-09-09 02:42:37'),(21,23,'A8','Alfiansyah','-','Programmer','Software','2023-10-06 22:36:34','2023-10-06 22:36:34');
/*!40000 ALTER TABLE `karyawan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `kriteria`
--

LOCK TABLES `kriteria` WRITE;
/*!40000 ALTER TABLE `kriteria` DISABLE KEYS */;
INSERT INTO `kriteria` VALUES (1,'C1','Greeting','Benefit',0.2,'(C1.1+C1.2)/2'),(2,'C2','Disiplin Kerapihan ','Benefit',0.3,'(C2.1+C2.2+C2.3+C2.4+C2.5+C2.6+C2.7)/7'),(3,'C3','Teknis Pekerjaan','Benefit',0.4,'(C3.1+C3.2+C3.3+C3.4+C3.5+C3.6+C3.7+C3.8)/8'),(4,'C4','Absen','Benefit',0.1,'C4');
/*!40000 ALTER TABLE `kriteria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `penilaian`
--

LOCK TABLES `penilaian` WRITE;
/*!40000 ALTER TABLE `penilaian` DISABLE KEYS */;
INSERT INTO `penilaian` VALUES (9,12,1,'September 2023',30,'2023-09-28 02:40:51','2023-09-28 02:40:51'),(10,12,2,'September 2023',39,'2023-09-28 02:40:51','2023-09-28 02:40:51'),(11,12,3,'September 2023',33,'2023-09-28 02:40:51','2023-09-28 02:40:51'),(12,12,4,'September 2023',30,'2023-09-28 02:40:51','2023-09-28 02:40:51'),(13,13,1,'September 2023',30,'2023-09-28 04:07:38','2023-09-28 04:07:38'),(14,13,2,'September 2023',39,'2023-09-28 04:07:38','2023-09-28 04:07:38'),(15,13,3,'September 2023',28,'2023-09-28 04:07:38','2023-09-28 04:07:38'),(16,13,4,'September 2023',50,'2023-09-28 04:07:38','2023-09-28 04:07:38'),(17,14,1,'September 2023',30,'2023-09-28 04:09:35','2023-09-28 04:09:35'),(18,14,2,'September 2023',36,'2023-09-28 04:09:35','2023-09-28 04:09:35'),(19,14,3,'September 2023',28,'2023-09-28 04:09:35','2023-09-28 04:09:35'),(20,14,4,'September 2023',50,'2023-09-28 04:09:35','2023-09-28 04:09:35'),(21,15,1,'September 2023',30,'2023-09-28 04:27:24','2023-09-28 04:27:24'),(22,15,2,'September 2023',39,'2023-09-28 04:27:24','2023-09-28 04:27:24'),(23,15,3,'September 2023',28,'2023-09-28 04:27:24','2023-09-28 04:27:24'),(24,15,4,'September 2023',50,'2023-09-28 04:27:24','2023-09-28 04:27:24'),(25,16,1,'September 2023',30,'2023-09-28 04:29:33','2023-09-28 04:29:33'),(26,16,2,'September 2023',36,'2023-09-28 04:29:33','2023-09-28 04:29:33'),(27,16,3,'September 2023',38,'2023-09-28 04:29:33','2023-09-28 04:29:33'),(28,16,4,'September 2023',50,'2023-09-28 04:29:33','2023-09-28 04:29:33'),(29,17,1,'September 2023',30,'2023-09-28 04:30:53','2023-09-28 04:30:53'),(30,17,2,'September 2023',39,'2023-09-28 04:30:53','2023-09-28 04:30:53'),(31,17,3,'September 2023',23,'2023-09-28 04:30:53','2023-09-28 04:30:53'),(32,17,4,'September 2023',30,'2023-09-28 04:30:53','2023-09-28 04:30:53'),(33,18,1,'September 2023',30,'2023-09-28 04:32:05','2023-09-28 04:32:05'),(34,18,2,'September 2023',33,'2023-09-28 04:32:05','2023-09-28 04:32:05'),(35,18,3,'September 2023',30,'2023-09-28 04:32:05','2023-09-28 04:32:05'),(36,18,4,'September 2023',50,'2023-09-28 04:32:05','2023-09-28 04:32:05'),(41,12,1,'Oktober 2023',50,'2023-10-07 02:09:05','2023-10-07 02:09:05'),(42,12,2,'Oktober 2023',50,'2023-10-07 02:09:05','2023-10-07 02:09:05'),(43,12,3,'Oktober 2023',50,'2023-10-07 02:09:05','2023-10-07 02:09:05'),(44,12,4,'Oktober 2023',50,'2023-10-07 02:09:05','2023-10-07 02:09:05');
/*!40000 ALTER TABLE `penilaian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `poin`
--

LOCK TABLES `poin` WRITE;
/*!40000 ALTER TABLE `poin` DISABLE KEYS */;
INSERT INTO `poin` VALUES (1,1,'1. Sering digunakan',50),(2,1,'2. Sudah tetapi jarang digunakan',30),(3,1,'3. Belum menggunakan',10),(4,2,'1. Sesuai',50),(5,2,'2. Sesuai + Improvisasi',30),(6,2,'3. Tidak Sesuai',10),(7,3,'1. Tiba sebelum jam masuk',50),(8,3,'2. Tiba tepat waktu',30),(9,3,'3. Sering terlambat',10),(10,4,'1. Setiap pergantian shift',50),(11,4,'2. Pernah ',30),(12,4,'3. Tidak Pernah',10),(13,5,'1. Tidak Pernah',50),(14,5,'2. Pernah',30),(15,5,'3. Setiap pergantian shift',10),(16,6,'1. Tidak pernah',50),(17,6,'2. Pernah',30),(18,6,'3. Setiap pergantian shift',10),(19,7,'1. Sangat cepat sebelum dering kedua',50),(20,7,'2. Setelah dering kedua',30),(21,7,'3. Lebih dari dering ketiga',10),(22,8,'1. Rapi dan sesuai',50),(23,8,'2. Tidak rapi tetapi sesuai',30),(24,8,'3. Rapi tetapi tidak sesuai',10),(25,9,'1. Selalu ',50),(26,9,'2. Jarang',30),(27,9,'3. Tidak Pernah',10),(28,10,'1. Langsung memahami',50),(29,10,'2. Memahami namun banyak bertanya',30),(30,10,'3. Tidak memahami dan harus eskalasi',10),(31,11,'1. Sangat cepat',50),(32,11,'2. Cepat',30),(33,11,'3. Lambat',10),(34,12,'1. Sangat efektif',50),(35,12,'2. Efektif',30),(36,12,'3. Tidak efektif',10),(37,13,'1. Memadai (menguasai)',50),(38,13,'2. Menguasai namun masih banyak bertanya',30),(39,13,'3. Tidak memadai dan harus eskalasi',10),(40,14,'1. Sering  setiap bertugas',50),(41,14,'2. Jika diperlukan saja',30),(42,14,'3. Jika diminta saja',10),(43,15,'1. Sangat proaktif',50),(44,15,'2. Kadang-kadang',30),(45,15,'3. Hanya jika diminta',10),(46,16,'1. Selalu ikut terlibat',50),(47,16,'2. Kadang-kadang',30),(48,16,'3. Tidak pernah',10),(49,17,'1. Bisa diandalkan',50),(50,17,'2. Masih banyak bertanya',30),(51,17,'3. Hanya jadi pendengar',10),(52,18,'1. Tidak hadir selain karena sakit <=3 hari',50),(53,18,'2. Tidak hadir selain karena sakit  4-7 hari',30),(54,18,'3. Tidak hadir selain karena sakit >=8 hari',10);
/*!40000 ALTER TABLE `poin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `sub_kriteria`
--

LOCK TABLES `sub_kriteria` WRITE;
/*!40000 ALTER TABLE `sub_kriteria` DISABLE KEYS */;
INSERT INTO `sub_kriteria` VALUES (1,1,'C1.1','Penggunaan Greeting','Apakah karyawan sudah menggunakan standard greetings pada saat melakukan atau menerima telepon dari customer baik internal maupun external.'),(2,1,'C1.2','Kesesuaian Standar','Apakah standard greeting yang dilakukan karyawan sudah sesuai dengan standard instruksi kerja dari perusahaan.'),(3,2,'C2.1','Ketepatan','Apakah karyawan selalu datang sebelum atau tepat dengan waktu bekerjanya.'),(4,2,'C2.2','Handover','Apakah Karyawan sudah melakukan serah terima informasi pekerjaan pada shift sebelumnya?'),(5,2,'C2.3','Meninggalkan Pos','Apakah karyawan Pernah meninggalkan pos sebelum shift berikutnya masuk'),(6,2,'C2.4','Mangkir','Apakah Karyawa sering meninggalkan pos saat bertugas?'),(7,2,'C2.5','Respon','Seberapa cepat karyawan dalam mengangkat telepon yang masuk'),(8,2,'C2.6','Kerapihan Pakaian','Apakah pakaian bekerja (termasuk sepatu) yang digunakan karyawan sudah rapih dan sesuai dengan ketentuan dari perusahaan ataupun lokasi karyawan bekerja'),(9,2,'C2.7','Kelengkapan','Apakah karyawan selalu menggunakan name tag perusahaan'),(10,3,'C3.1','Pemahaman Kendala','Apakah karyawan langsung memahami kendala atau gangguan atas keluhan yang diterimanya?'),(11,3,'C3.2','Kecepatan respon','Bagaimana kecepatan respon dari karyawan dalam merespon request atau gangguan yang terjadi'),(12,3,'C3.3','Efektifitas','Bagaimana efektifitas karyawan dalam melakukan 1st troubleshooting gangguan'),(13,3,'C3.4','Kemapuan Teknis','Bagaimana kemampuan teknis karyawan dalam melakukan analisa dan penyelesaian gangguan'),(14,3,'C3.5','Update Log','Sesering apa karyawan dalam melakukan update log-log gangguan yang terjadi.'),(15,3,'C3.6','Proaktif','Apakah karyawan proaktif dalam memberikan informasi dan update penanganan gangguan ke customer'),(16,3,'C3.7','Keterlibatan Karyawan','Bagaimana keterlibatan karyawan jika ada gangguan masal'),(17,3,'C3.8','Andil','Bagaimana andil karyawan dalam ikut menangani gangguan masal'),(18,4,'C4.1','Absen','Absen Karyawan');
/*!40000 ALTER TABLE `sub_kriteria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `sub_penilaian`
--

LOCK TABLES `sub_penilaian` WRITE;
/*!40000 ALTER TABLE `sub_penilaian` DISABLE KEYS */;
INSERT INTO `sub_penilaian` VALUES (35,9,1,30,'2023-09-28 02:40:51','2023-09-28 02:40:51'),(36,9,2,30,'2023-09-28 02:40:51','2023-09-28 02:40:51'),(37,10,3,30,'2023-09-28 02:40:51','2023-09-28 02:40:51'),(38,10,4,30,'2023-09-28 02:40:51','2023-09-28 02:40:51'),(39,10,5,50,'2023-09-28 02:40:51','2023-09-28 02:40:51'),(40,10,6,30,'2023-09-28 02:40:51','2023-09-28 02:40:51'),(41,10,7,30,'2023-09-28 02:40:51','2023-09-28 02:40:51'),(42,10,8,50,'2023-09-28 02:40:51','2023-09-28 02:40:51'),(43,10,9,50,'2023-09-28 02:40:51','2023-09-28 02:40:51'),(44,11,10,50,'2023-09-28 02:40:51','2023-09-28 02:40:51'),(45,11,11,30,'2023-09-28 02:40:51','2023-09-28 02:40:51'),(46,11,12,50,'2023-09-28 02:40:51','2023-09-28 02:40:51'),(47,11,13,30,'2023-09-28 02:40:51','2023-09-28 02:40:51'),(48,11,14,30,'2023-09-28 02:40:51','2023-09-28 02:40:51'),(49,11,15,30,'2023-09-28 02:40:51','2023-09-28 02:40:51'),(50,11,16,10,'2023-09-28 02:40:51','2023-09-28 02:40:51'),(51,11,17,30,'2023-09-28 02:40:51','2023-09-28 02:40:51'),(52,12,18,30,'2023-09-28 02:40:51','2023-09-28 02:40:51'),(53,13,1,30,'2023-09-28 04:07:38','2023-09-28 04:07:38'),(54,13,2,30,'2023-09-28 04:07:38','2023-09-28 04:07:38'),(55,14,3,50,'2023-09-28 04:07:38','2023-09-28 04:07:38'),(56,14,4,30,'2023-09-28 04:07:38','2023-09-28 04:07:38'),(57,14,5,50,'2023-09-28 04:07:38','2023-09-28 04:07:38'),(58,14,6,50,'2023-09-28 04:07:38','2023-09-28 04:07:38'),(59,14,7,30,'2023-09-28 04:07:38','2023-09-28 04:07:38'),(60,14,8,30,'2023-09-28 04:07:38','2023-09-28 04:07:38'),(61,14,9,30,'2023-09-28 04:07:38','2023-09-28 04:07:38'),(62,15,10,30,'2023-09-28 04:07:38','2023-09-28 04:07:38'),(63,15,11,30,'2023-09-28 04:07:38','2023-09-28 04:07:38'),(64,15,12,30,'2023-09-28 04:07:38','2023-09-28 04:07:38'),(65,15,13,30,'2023-09-28 04:07:38','2023-09-28 04:07:38'),(66,15,14,30,'2023-09-28 04:07:38','2023-09-28 04:07:38'),(67,15,15,10,'2023-09-28 04:07:38','2023-09-28 04:07:38'),(68,15,16,30,'2023-09-28 04:07:38','2023-09-28 04:07:38'),(69,15,17,30,'2023-09-28 04:07:38','2023-09-28 04:07:38'),(70,16,18,50,'2023-09-28 04:07:38','2023-09-28 04:07:38'),(71,17,1,30,'2023-09-28 04:09:35','2023-09-28 04:09:35'),(72,17,2,30,'2023-09-28 04:09:35','2023-09-28 04:09:35'),(73,18,3,30,'2023-09-28 04:09:35','2023-09-28 04:09:35'),(74,18,4,30,'2023-09-28 04:09:35','2023-09-28 04:09:35'),(75,18,5,30,'2023-09-28 04:09:35','2023-09-28 04:09:35'),(76,18,6,50,'2023-09-28 04:09:35','2023-09-28 04:09:35'),(77,18,7,50,'2023-09-28 04:09:35','2023-09-28 04:09:35'),(78,18,8,30,'2023-09-28 04:09:35','2023-09-28 04:09:35'),(79,18,9,30,'2023-09-28 04:09:35','2023-09-28 04:09:35'),(80,19,10,30,'2023-09-28 04:09:35','2023-09-28 04:09:35'),(81,19,11,30,'2023-09-28 04:09:35','2023-09-28 04:09:35'),(82,19,12,50,'2023-09-28 04:09:35','2023-09-28 04:09:35'),(83,19,13,10,'2023-09-28 04:09:35','2023-09-28 04:09:35'),(84,19,14,30,'2023-09-28 04:09:35','2023-09-28 04:09:35'),(85,19,15,30,'2023-09-28 04:09:35','2023-09-28 04:09:35'),(86,19,16,30,'2023-09-28 04:09:35','2023-09-28 04:09:35'),(87,19,17,10,'2023-09-28 04:09:35','2023-09-28 04:09:35'),(88,20,18,50,'2023-09-28 04:09:35','2023-09-28 04:09:35'),(89,21,1,30,'2023-09-28 04:27:24','2023-09-28 04:27:24'),(90,21,2,30,'2023-09-28 04:27:24','2023-09-28 04:27:24'),(91,22,3,50,'2023-09-28 04:27:24','2023-09-28 04:27:24'),(92,22,4,30,'2023-09-28 04:27:24','2023-09-28 04:27:24'),(93,22,5,50,'2023-09-28 04:27:24','2023-09-28 04:27:24'),(94,22,6,30,'2023-09-28 04:27:24','2023-09-28 04:27:24'),(95,22,7,30,'2023-09-28 04:27:24','2023-09-28 04:27:24'),(96,22,8,30,'2023-09-28 04:27:24','2023-09-28 04:27:24'),(97,22,9,50,'2023-09-28 04:27:24','2023-09-28 04:27:24'),(98,23,10,50,'2023-09-28 04:27:24','2023-09-28 04:27:24'),(99,23,11,30,'2023-09-28 04:27:24','2023-09-28 04:27:24'),(100,23,12,30,'2023-09-28 04:27:24','2023-09-28 04:27:24'),(101,23,13,10,'2023-09-28 04:27:24','2023-09-28 04:27:24'),(102,23,14,30,'2023-09-28 04:27:24','2023-09-28 04:27:24'),(103,23,15,30,'2023-09-28 04:27:24','2023-09-28 04:27:24'),(104,23,16,30,'2023-09-28 04:27:24','2023-09-28 04:27:24'),(105,23,17,10,'2023-09-28 04:27:24','2023-09-28 04:27:24'),(106,24,18,50,'2023-09-28 04:27:24','2023-09-28 04:27:24'),(107,25,1,30,'2023-09-28 04:29:33','2023-09-28 04:29:33'),(108,25,2,30,'2023-09-28 04:29:33','2023-09-28 04:29:33'),(109,26,3,50,'2023-09-28 04:29:33','2023-09-28 04:29:33'),(110,26,4,30,'2023-09-28 04:29:33','2023-09-28 04:29:33'),(111,26,5,30,'2023-09-28 04:29:33','2023-09-28 04:29:33'),(112,26,6,30,'2023-09-28 04:29:33','2023-09-28 04:29:33'),(113,26,7,50,'2023-09-28 04:29:33','2023-09-28 04:29:33'),(114,26,8,30,'2023-09-28 04:29:33','2023-09-28 04:29:33'),(115,26,9,30,'2023-09-28 04:29:33','2023-09-28 04:29:33'),(116,27,10,30,'2023-09-28 04:29:33','2023-09-28 04:29:33'),(117,27,11,50,'2023-09-28 04:29:33','2023-09-28 04:29:33'),(118,27,12,30,'2023-09-28 04:29:33','2023-09-28 04:29:33'),(119,27,13,30,'2023-09-28 04:29:33','2023-09-28 04:29:33'),(120,27,14,30,'2023-09-28 04:29:33','2023-09-28 04:29:33'),(121,27,15,30,'2023-09-28 04:29:33','2023-09-28 04:29:33'),(122,27,16,50,'2023-09-28 04:29:33','2023-09-28 04:29:33'),(123,27,17,50,'2023-09-28 04:29:33','2023-09-28 04:29:33'),(124,28,18,50,'2023-09-28 04:29:33','2023-09-28 04:29:33'),(125,29,1,30,'2023-09-28 04:30:53','2023-09-28 04:30:53'),(126,29,2,30,'2023-09-28 04:30:53','2023-09-28 04:30:53'),(127,30,3,30,'2023-09-28 04:30:53','2023-09-28 04:30:53'),(128,30,4,30,'2023-09-28 04:30:53','2023-09-28 04:30:53'),(129,30,5,50,'2023-09-28 04:30:53','2023-09-28 04:30:53'),(130,30,6,30,'2023-09-28 04:30:53','2023-09-28 04:30:53'),(131,30,7,30,'2023-09-28 04:30:53','2023-09-28 04:30:53'),(132,30,8,50,'2023-09-28 04:30:53','2023-09-28 04:30:53'),(133,30,9,50,'2023-09-28 04:30:53','2023-09-28 04:30:53'),(134,31,10,10,'2023-09-28 04:30:53','2023-09-28 04:30:53'),(135,31,11,30,'2023-09-28 04:30:53','2023-09-28 04:30:53'),(136,31,12,30,'2023-09-28 04:30:53','2023-09-28 04:30:53'),(137,31,13,10,'2023-09-28 04:30:53','2023-09-28 04:30:53'),(138,31,14,30,'2023-09-28 04:30:53','2023-09-28 04:30:53'),(139,31,15,10,'2023-09-28 04:30:53','2023-09-28 04:30:53'),(140,31,16,30,'2023-09-28 04:30:53','2023-09-28 04:30:53'),(141,31,17,30,'2023-09-28 04:30:53','2023-09-28 04:30:53'),(142,32,18,30,'2023-09-28 04:30:53','2023-09-28 04:30:53'),(143,33,1,30,'2023-09-28 04:32:05','2023-09-28 04:32:05'),(144,33,2,30,'2023-09-28 04:32:05','2023-09-28 04:32:05'),(145,34,3,50,'2023-09-28 04:32:05','2023-09-28 04:32:05'),(146,34,4,30,'2023-09-28 04:32:05','2023-09-28 04:32:05'),(147,34,5,30,'2023-09-28 04:32:05','2023-09-28 04:32:05'),(148,34,6,30,'2023-09-28 04:32:05','2023-09-28 04:32:05'),(149,34,7,30,'2023-09-28 04:32:05','2023-09-28 04:32:05'),(150,34,8,30,'2023-09-28 04:32:05','2023-09-28 04:32:05'),(151,34,9,30,'2023-09-28 04:32:05','2023-09-28 04:32:05'),(152,35,10,30,'2023-09-28 04:32:05','2023-09-28 04:32:05'),(153,35,11,30,'2023-09-28 04:32:05','2023-09-28 04:32:05'),(154,35,12,30,'2023-09-28 04:32:05','2023-09-28 04:32:05'),(155,35,13,30,'2023-09-28 04:32:05','2023-09-28 04:32:05'),(156,35,14,30,'2023-09-28 04:32:05','2023-09-28 04:32:05'),(157,35,15,30,'2023-09-28 04:32:05','2023-09-28 04:32:05'),(158,35,16,30,'2023-09-28 04:32:05','2023-09-28 04:32:05'),(159,35,17,30,'2023-09-28 04:32:05','2023-09-28 04:32:05'),(160,36,18,50,'2023-09-28 04:32:05','2023-09-28 04:32:05'),(179,41,1,50,'2023-10-07 02:09:05','2023-10-07 02:09:05'),(180,41,2,50,'2023-10-07 02:09:05','2023-10-07 02:09:05'),(181,42,3,50,'2023-10-07 02:09:05','2023-10-07 02:09:05'),(182,42,4,50,'2023-10-07 02:09:05','2023-10-07 02:09:05'),(183,42,5,50,'2023-10-07 02:09:05','2023-10-07 02:09:05'),(184,42,6,50,'2023-10-07 02:09:05','2023-10-07 02:09:05'),(185,42,7,50,'2023-10-07 02:09:05','2023-10-07 02:09:05'),(186,42,8,50,'2023-10-07 02:09:05','2023-10-07 02:09:05'),(187,42,9,50,'2023-10-07 02:09:05','2023-10-07 02:09:05'),(188,43,10,50,'2023-10-07 02:09:05','2023-10-07 02:09:05'),(189,43,11,50,'2023-10-07 02:09:05','2023-10-07 02:09:05'),(190,43,12,50,'2023-10-07 02:09:05','2023-10-07 02:09:05'),(191,43,13,50,'2023-10-07 02:09:05','2023-10-07 02:09:05'),(192,43,14,50,'2023-10-07 02:09:05','2023-10-07 02:09:05'),(193,43,15,50,'2023-10-07 02:09:05','2023-10-07 02:09:05'),(194,43,16,50,'2023-10-07 02:09:05','2023-10-07 02:09:05'),(195,43,17,50,'2023-10-07 02:09:05','2023-10-07 02:09:05'),(196,44,18,50,'2023-10-07 02:09:05','2023-10-07 02:09:05');
/*!40000 ALTER TABLE `sub_penilaian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin','admin@moora.com','$2y$10$sSjLZt4NumPbABdafgw2leUapOZ93tGO/aY3MG7ZR6/gfjuQLTdDy','Zmb2zVN2WKStA5eHPc2AR1wRBmFAc2gMoAFbR8jw9dogS13ugSo0uS7iMrQl','2023-05-30 00:09:31','2023-05-30 00:09:31'),(14,'Karyawan','julianto','julianto@gmail.com','$2y$10$IG0wvLXYcK39ltvJnIGjsOhYjN0ac9QE5DQ6Mfu4cShPO.YQ30V/K',NULL,'2023-09-08 00:22:04','2023-09-08 00:22:04'),(15,'Karyawan','rizky.aditya','rizky.aditya@gmail.com','$2y$10$JIihCXISwpJNvGublrZOQ.NTMKKjb5JMCGzlMUruAJiB.hx/FyT1m',NULL,'2023-09-08 00:24:37','2023-09-08 00:24:37'),(16,'Karyawan','riski.setiawan','riski.setiawan@gmail.com','$2y$10$EvdfeJU7MiHMf0oJEbzhnuZBw12abMcT6CHf6SjruMZ70Z9PXscyG',NULL,'2023-09-08 00:26:10','2023-09-08 00:26:10'),(17,'Karyawan','rizqi.maghfiru','rizqi.maghfiru@gmail.com','$2y$10$YOq8vjogLkI3SjQkhY23uuu/pumB7ATaxEk5mavlpOXx9cdb0V9Xi',NULL,'2023-09-09 02:40:49','2023-09-09 02:40:49'),(18,'Karyawan','gilang.mahardika','gilang.mahardika@gmail.com','$2y$10$gvXVNrjLEQe4OEClCe/tO.P1XBklwjVxrfY4xYpf8Av4m3GKjn/SK',NULL,'2023-09-09 02:41:21','2023-09-09 02:41:21'),(19,'Karyawan','agus.alamsyah','agus.alamsyah@gmail.com','$2y$10$UsrnpWjpeQX3FrAkaicFSOBJsaf8vL4WJ0qDieGch7njeflwd4e0m',NULL,'2023-09-09 02:42:06','2023-09-09 02:42:06'),(20,'Karyawan','ardiansyah','ardiansyah@gmail.com','$2y$10$/sCdila2.XWawMqQUrwQXeE4wCFV0eNHX9YKeTVkMyMmzcYyF6/L2',NULL,'2023-09-09 02:42:37','2023-09-09 02:42:37'),(23,'Karyawan','alfiansyah','alfiansyah@moora.com','$2y$10$/QRZ55W3DwDaPB5Qd78efup8CEpz695AE96bFV.Zp.ovLF3Cti.7O',NULL,'2023-10-06 22:36:34','2023-10-06 22:36:34');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-10-08 18:38:52
