/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 5.7.19 : Database - inventori-baru
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`inventori-baru` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `inventori-baru`;

/*Table structure for table `audits` */

DROP TABLE IF EXISTS `audits`;

CREATE TABLE `audits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_id` bigint(20) unsigned NOT NULL,
  `old_values` text COLLATE utf8mb4_unicode_ci,
  `new_values` text COLLATE utf8mb4_unicode_ci,
  `url` text COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `audits_auditable_type_auditable_id_index` (`auditable_type`,`auditable_id`),
  KEY `audits_user_id_user_type_index` (`user_id`,`user_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `audits` */

/*Table structure for table `company` */

DROP TABLE IF EXISTS `company`;

CREATE TABLE `company` (
  `kode_company` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_company` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `npwp` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`kode_company`),
  KEY `company_created_by_index` (`created_by`),
  KEY `company_updated_by_index` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `company` */

insert  into `company`(`kode_company`,`nama_company`,`alamat`,`telp`,`npwp`,`status`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
('01','PT. GEMILANG UNGGUL INTERNASIONAL','JLN. SLAMET RIADY LR. LAWANG KIDUL LAUT NO. 1977 RT. 022 KEL. LAWANG KIDUL KEC. ILIR TIMUR II','0711-717959','03.103.981.1-301.000',1,'2018-12-17 10:18:15','2018-12-17 10:18:15',1,1),
('02','PT. GAJAH UNGGUL INTERNASIONAL','JL. SLAMET RIYADI LR. LAWANG KIDUL LAUT NO. 1977 RT. 022 KEL. LAWANG KIDUL KEC. ILIR TIMUR II','0711-654321','03.103.981.1-301.000',1,'2018-12-17 10:19:23','2018-12-17 10:19:23',1,1),
('03','PT. GEMILANG UTAMA INTERNASIONAL','JL. SLAMET RIYADY LR. LAWANG KIDUL LAUT NO. 1977 RT. 022 KEL. LAWANG KIDUL KEC. ILIR TIMUR II','0711-123456','03.103.981.1-301.000',1,'2018-12-17 10:20:18','2018-12-17 10:20:18',1,1),
('04','PT. GAJAH UTAMA INTERNSIONAL','JL. SLAMET RIYADI LR. LAWANG KIDUL LAUT NO. 1977 RT. 022 KEL. LAWANG KIDUL KEC. ILIR TIMUR II','-','-',1,'2018-12-17 10:20:55','2018-12-17 10:20:55',1,1),
('05','PT. LAUTAN JAYA MANGGALA','JLN. SLAMET RIADY LR. LAWANG KIDUL LAUT NO. 1977 RT. 022 KEL. LAWANG KIDUL KEC. ILIR TIMUR II','-','-',1,'2018-12-17 10:21:17','2018-12-17 10:21:17',1,1),
('06','PT. SELARAS UNGGUL BERSAMA','JLN. SLAMET RIADY LR. LAWANG KIDUL LAUT NO. 1977 RT. 022 KEL. LAWANG KIDUL KEC. ILIR TIMUR II','-','-',0,'2018-12-17 10:21:37','2018-12-26 10:30:35',1,1),
('07','PT. ABC','----','071122334455','-',1,'2019-01-18 15:24:46','2019-01-18 15:24:46',1,1);

/*Table structure for table `kategori_produk` */

DROP TABLE IF EXISTS `kategori_produk`;

CREATE TABLE `kategori_produk` (
  `kode_kategori` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kategori` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`kode_kategori`),
  KEY `kategori_produk_created_by_index` (`created_by`),
  KEY `kategori_produk_updated_by_index` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `kategori_produk` */

insert  into `kategori_produk`(`kode_kategori`,`nama_kategori`,`status`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
('1','AC',1,'2018-11-23 14:50:18','2018-11-27 15:58:19',1,1),
('10','UPS',1,'2019-01-18 15:52:24','2019-01-18 15:52:24',1,1),
('2','Grider',1,'2018-11-26 09:30:03','2018-11-26 10:08:36',1,1),
('3','ATK',1,'2019-01-18 15:51:37','2019-01-19 08:46:10',1,1),
('4','Komputer',1,'2018-11-24 09:10:55','2018-11-24 10:13:23',1,1),
('7','Meja',1,'2018-11-26 09:53:43','2018-11-26 10:08:41',1,1),
('8','Forklift',1,'2018-11-26 10:04:15','2018-11-26 10:04:15',1,1),
('9','BAN',1,'2018-12-17 10:35:43','2018-12-26 15:10:01',1,1);

/*Table structure for table `master_lokasi` */

DROP TABLE IF EXISTS `master_lokasi`;

CREATE TABLE `master_lokasi` (
  `id_lokasi` int(11) unsigned zerofill NOT NULL,
  `nama_lokasi` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nickname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_lokasi`),
  KEY `master_lokasi_created_by_index` (`created_by`),
  KEY `master_lokasi_updated_by_index` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `master_lokasi` */

insert  into `master_lokasi`(`id_lokasi`,`nama_lokasi`,`nickname`,`alamat`,`status`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
(00000000001,'Head Office','HO','Jln.Slamet Riadi','Aktif','2019-01-29 09:50:12','2019-01-29 09:50:12',1,1),
(00000000002,'Astaka Dodol','AD','--','Aktif','2019-01-29 09:50:45','2019-01-29 09:50:45',1,1),
(00000000003,'Sekayu','SK','--','Aktif','2019-01-29 09:56:10','2019-01-29 09:56:10',1,1);

/*Table structure for table `memo` */

DROP TABLE IF EXISTS `memo`;

CREATE TABLE `memo` (
  `no_memo` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_permintaan` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_memo` date NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `kode_company` char(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`no_memo`),
  KEY `memo_created_by_index` (`created_by`),
  KEY `memo_updated_by_index` (`updated_by`),
  KEY `no_permintaan` (`no_permintaan`),
  KEY `kode_company` (`kode_company`),
  CONSTRAINT `memo_ibfk_1` FOREIGN KEY (`no_permintaan`) REFERENCES `permintaan` (`no_permintaan`),
  CONSTRAINT `memo_ibfk_2` FOREIGN KEY (`kode_company`) REFERENCES `company` (`kode_company`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `memo` */

insert  into `memo`(`no_memo`,`no_permintaan`,`tanggal_memo`,`status`,`created_at`,`updated_at`,`created_by`,`updated_by`,`kode_company`) values 
('01NMM0119000001','01SPB0119000001','2019-01-31','POSTED','2019-01-31 10:09:57','2019-02-01 10:27:12',1,1,'01');

/*Table structure for table `memo_detail` */

DROP TABLE IF EXISTS `memo_detail`;

CREATE TABLE `memo_detail` (
  `no_memo` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_produk` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_satuan` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` double(10,3) NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kode_produk` (`kode_produk`),
  KEY `kode_satuan` (`kode_satuan`),
  KEY `no_memo` (`no_memo`),
  CONSTRAINT `memo_detail_ibfk_1` FOREIGN KEY (`kode_produk`) REFERENCES `produk` (`kode_produk`),
  CONSTRAINT `memo_detail_ibfk_2` FOREIGN KEY (`kode_satuan`) REFERENCES `satuan` (`kode_satuan`),
  CONSTRAINT `memo_detail_ibfk_3` FOREIGN KEY (`no_memo`) REFERENCES `memo` (`no_memo`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `memo_detail` */

insert  into `memo_detail`(`no_memo`,`kode_produk`,`kode_satuan`,`qty`,`id`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
('01NMM0119000001','010119001','1',10.000,8,'2019-01-31 10:09:57','2019-01-31 10:09:57',1,1),
('01NMM0119000001','010119002','8',10.000,9,'2019-01-31 10:09:57','2019-01-31 10:09:57',1,1);

/*Table structure for table `merek` */

DROP TABLE IF EXISTS `merek`;

CREATE TABLE `merek` (
  `kode_merek` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_merek` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`kode_merek`),
  KEY `merek_created_by_index` (`created_by`),
  KEY `merek_updated_by_index` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `merek` */

insert  into `merek`(`kode_merek`,`nama_merek`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
('1','SANY','2018-11-23 11:39:43','2019-01-18 15:06:54',1,1),
('2','ACIOS','2018-12-24 13:56:14','2018-12-24 14:01:29',1,1),
('3','ASTRA','2019-01-18 15:03:51','2019-01-18 15:03:51',1,1),
('4','PANASONIC','2019-01-19 14:26:58','2019-01-19 14:26:58',1,1),
('5','Samsung','2019-01-31 14:55:03','2019-01-31 14:55:03',1,1);

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2018_09_18_025728_laratrust_setup_tables',1),
(4,'2018_09_18_030309_table_permissions_add_field_tab',1),
(5,'2018_11_23_094941_merek',2),
(6,'2018_11_23_110942_ukuran',3),
(7,'2018_11_23_134335_create_audits_table',4),
(8,'2018_11_23_134759_kategoriproduk',5),
(9,'2018_11_26_101920_vendor',6),
(10,'2018_11_26_133950_produk',7),
(11,'2018_11_27_143526_company',8),
(12,'2018_11_30_092111_permintaan',9),
(13,'2018_11_30_135156_permintaan_detail',10),
(14,'2018_12_07_112642_pemakaian',11),
(15,'2018_12_10_090906_penerimaan',12),
(16,'2018_12_10_103548_penerimaan_detail',13),
(17,'2018_12_10_110134_penerimaan_detail',14),
(18,'2018_12_17_114555_memo',15),
(19,'2018_12_28_093541_pembelian',16),
(20,'2018_12_31_102101_pembelian_detail',17),
(21,'2018_12_31_103111_pembelian_detail',18),
(22,'2019_01_12_105320_master_lokasi',19),
(23,'2019_01_15_134656_stock',20),
(24,'2019_01_29_094243_lokasi',21);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `pemakaian` */

DROP TABLE IF EXISTS `pemakaian`;

CREATE TABLE `pemakaian` (
  `no_pemakaian` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_permintaan` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pemakaian` date NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `kode_company` char(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`no_pemakaian`),
  KEY `pemakaian_created_by_index` (`created_by`),
  KEY `pemakaian_updated_by_index` (`updated_by`),
  KEY `no_permintaan` (`no_permintaan`),
  KEY `kode_company` (`kode_company`),
  CONSTRAINT `pemakaian_ibfk_1` FOREIGN KEY (`no_permintaan`) REFERENCES `permintaan` (`no_permintaan`),
  CONSTRAINT `pemakaian_ibfk_2` FOREIGN KEY (`kode_company`) REFERENCES `company` (`kode_company`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pemakaian` */

/*Table structure for table `pemakaian_detail` */

DROP TABLE IF EXISTS `pemakaian_detail`;

CREATE TABLE `pemakaian_detail` (
  `no_pemakaian` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_produk` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_satuan` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` double(10,3) NOT NULL,
  `harga` double(13,2) NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `no_pemakaian` (`no_pemakaian`),
  KEY `kode_produk` (`kode_produk`),
  KEY `kode_satuan` (`kode_satuan`),
  CONSTRAINT `pemakaian_detail_ibfk_1` FOREIGN KEY (`no_pemakaian`) REFERENCES `pemakaian` (`no_pemakaian`),
  CONSTRAINT `pemakaian_detail_ibfk_2` FOREIGN KEY (`kode_produk`) REFERENCES `produk` (`kode_produk`),
  CONSTRAINT `pemakaian_detail_ibfk_3` FOREIGN KEY (`kode_satuan`) REFERENCES `satuan` (`kode_satuan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pemakaian_detail` */

/*Table structure for table `pembelian` */

DROP TABLE IF EXISTS `pembelian`;

CREATE TABLE `pembelian` (
  `no_pembelian` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_memo` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_vendor` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `kode_company` char(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`no_pembelian`),
  KEY `pembelian_created_by_index` (`created_by`),
  KEY `pembelian_updated_by_index` (`updated_by`),
  KEY `no_memo` (`no_memo`),
  KEY `kode_vendor` (`kode_vendor`),
  KEY `kode_company` (`kode_company`),
  CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`no_memo`) REFERENCES `memo` (`no_memo`),
  CONSTRAINT `pembelian_ibfk_2` FOREIGN KEY (`kode_vendor`) REFERENCES `vendor` (`kode_vendor`),
  CONSTRAINT `pembelian_ibfk_3` FOREIGN KEY (`kode_company`) REFERENCES `company` (`kode_company`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pembelian` */

/*Table structure for table `pembelian_detail` */

DROP TABLE IF EXISTS `pembelian_detail`;

CREATE TABLE `pembelian_detail` (
  `no_pembelian` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_produk` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_satuan` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` double(10,3) NOT NULL,
  `harga` double(13,2) NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pembelian_detail_created_by_index` (`created_by`),
  KEY `pembelian_detail_updated_by_index` (`updated_by`),
  KEY `no_pembelian` (`no_pembelian`),
  KEY `kode_produk` (`kode_produk`),
  KEY `kode_satuan` (`kode_satuan`),
  CONSTRAINT `pembelian_detail_ibfk_1` FOREIGN KEY (`no_pembelian`) REFERENCES `pembelian` (`no_pembelian`),
  CONSTRAINT `pembelian_detail_ibfk_2` FOREIGN KEY (`kode_produk`) REFERENCES `produk` (`kode_produk`),
  CONSTRAINT `pembelian_detail_ibfk_3` FOREIGN KEY (`kode_satuan`) REFERENCES `satuan` (`kode_satuan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pembelian_detail` */

/*Table structure for table `penerimaan` */

DROP TABLE IF EXISTS `penerimaan`;

CREATE TABLE `penerimaan` (
  `no_penerimaan` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_pembelian` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_penerimaan` date NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `kode_company` char(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`no_penerimaan`),
  KEY `penerimaan_created_by_index` (`created_by`),
  KEY `penerimaan_updated_by_index` (`updated_by`),
  KEY `kode_company` (`kode_company`),
  KEY `no_pembelian` (`no_pembelian`),
  CONSTRAINT `penerimaan_ibfk_1` FOREIGN KEY (`kode_company`) REFERENCES `company` (`kode_company`),
  CONSTRAINT `penerimaan_ibfk_2` FOREIGN KEY (`no_pembelian`) REFERENCES `pembelian` (`no_pembelian`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `penerimaan` */

/*Table structure for table `penerimaan_detail` */

DROP TABLE IF EXISTS `penerimaan_detail`;

CREATE TABLE `penerimaan_detail` (
  `no_penerimaan` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_produk` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` double(10,3) NOT NULL,
  `harga` double(13,2) NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `penerimaan_detail_created_by_index` (`created_by`),
  KEY `penerimaan_detail_updated_by_index` (`updated_by`),
  KEY `no_penerimaan` (`no_penerimaan`),
  KEY `kode_produk` (`kode_produk`),
  CONSTRAINT `penerimaan_detail_ibfk_1` FOREIGN KEY (`no_penerimaan`) REFERENCES `penerimaan` (`no_penerimaan`),
  CONSTRAINT `penerimaan_detail_ibfk_2` FOREIGN KEY (`kode_produk`) REFERENCES `produk` (`kode_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `penerimaan_detail` */

/*Table structure for table `permintaan` */

DROP TABLE IF EXISTS `permintaan`;

CREATE TABLE `permintaan` (
  `no_permintaan` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_permintaan` date DEFAULT NULL,
  `type` enum('Umum','Mobil','Alat','Jasa','Stok') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_company` char(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`no_permintaan`),
  KEY `kode_company` (`kode_company`),
  CONSTRAINT `permintaan_ibfk_1` FOREIGN KEY (`kode_company`) REFERENCES `company` (`kode_company`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permintaan` */

insert  into `permintaan`(`no_permintaan`,`deskripsi`,`tanggal_permintaan`,`type`,`status`,`created_at`,`updated_at`,`created_by`,`updated_by`,`kode_company`) values 
('01SPB0119000001','Ban Mobil','2019-01-22','Mobil','POSTED','2019-01-22 10:11:54','2019-01-31 14:59:06','1','1','01'),
('01SPB0119000002','Beli minyak','2019-01-23','Umum','POSTED','2019-01-23 10:47:20','2019-01-28 13:46:49','1','1','01'),
('01SPB0119000003','Beli Sekering Aki','2019-01-25','Mobil','POSTED','2019-01-25 09:35:56','2019-01-26 13:03:50','1','1','01'),
('01SPB0119000004','Stok Solar','2019-01-26','Stok','POSTED','2019-01-26 13:06:37','2019-01-26 13:06:41','1','1','01'),
('01SPB0119000005','SOLAR','2019-01-31','Stok','POSTED','2019-01-31 15:13:04','2019-01-31 15:17:20','1','1','01');

/*Table structure for table `permintaan_detail` */

DROP TABLE IF EXISTS `permintaan_detail`;

CREATE TABLE `permintaan_detail` (
  `no_permintaan` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_produk` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_satuan` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` double(10,3) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `permintaan_detail_created_by_index` (`created_by`),
  KEY `permintaan_detail_updated_by_index` (`updated_by`),
  KEY `no_permintaan` (`no_permintaan`),
  KEY `kode_produk` (`kode_produk`),
  KEY `kode_satuan` (`kode_satuan`),
  CONSTRAINT `permintaan_detail_ibfk_1` FOREIGN KEY (`no_permintaan`) REFERENCES `permintaan` (`no_permintaan`),
  CONSTRAINT `permintaan_detail_ibfk_2` FOREIGN KEY (`kode_produk`) REFERENCES `produk` (`kode_produk`),
  CONSTRAINT `permintaan_detail_ibfk_3` FOREIGN KEY (`kode_satuan`) REFERENCES `satuan` (`kode_satuan`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permintaan_detail` */

insert  into `permintaan_detail`(`no_permintaan`,`kode_produk`,`kode_satuan`,`qty`,`created_at`,`updated_at`,`created_by`,`updated_by`,`id`) values 
('01SPB0119000001','010119001','1',10.000,'2019-01-30 08:48:32','2019-01-30 08:48:32',1,1,1),
('01SPB0119000001','010119002','8',10.000,'2019-01-31 09:29:56','2019-01-31 09:29:56',1,1,2),
('01SPB0119000001','010119003','1',10.000,'2019-01-31 14:44:10','2019-01-31 14:44:10',1,1,3),
('01SPB0119000005','010119001','1',10.000,'2019-02-06 10:51:42','2019-02-06 10:51:42',1,1,25),
('01SPB0119000005','010119002','1',12.000,'2019-02-06 10:51:58','2019-02-06 10:51:58',1,1,26);

/*Table structure for table `permission_role` */

DROP TABLE IF EXISTS `permission_role`;

CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permission_role` */

insert  into `permission_role`(`permission_id`,`role_id`) values 
(1,1),
(2,1),
(3,1),
(4,1),
(5,1),
(6,1),
(7,1),
(8,1),
(9,1),
(10,1),
(1,2),
(2,2),
(3,2),
(4,2),
(9,2),
(10,2),
(9,3),
(10,3);

/*Table structure for table `permission_user` */

DROP TABLE IF EXISTS `permission_user`;

CREATE TABLE `permission_user` (
  `permission_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  KEY `permission_user_permission_id_foreign` (`permission_id`),
  CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permission_user` */

insert  into `permission_user`(`permission_id`,`user_id`,`user_type`) values 
(9,4,'App\\User'),
(10,4,'App\\User'),
(11,4,'App\\User');

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tab` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`name`,`display_name`,`tab`,`description`,`created_at`,`updated_at`) values 
(1,'create-users','Create Users','Users','Create Users','2018-11-22 11:14:34','2018-11-22 11:14:34'),
(2,'read-users','Read Users','Users','Read Users','2018-11-22 11:14:34','2018-11-22 11:14:34'),
(3,'update-users','Update Users','Users','Update Users','2018-11-22 11:14:34','2018-11-22 11:14:34'),
(4,'delete-users','Delete Users','Users','Delete Users','2018-11-22 11:14:34','2018-11-22 11:14:34'),
(5,'create-acl','Create Acl','Acl','Create Acl','2018-11-22 11:14:34','2018-11-22 11:14:34'),
(6,'read-acl','Read Acl','Acl','Read Acl','2018-11-22 11:14:34','2018-11-22 11:14:34'),
(7,'update-acl','Update Acl','Acl','Update Acl','2018-11-22 11:14:34','2018-11-22 11:14:34'),
(8,'delete-acl','Delete Acl','Acl','Delete Acl','2018-11-22 11:14:34','2018-11-22 11:14:34'),
(9,'read-profile','Read Profile','Profile','Read Profile','2018-11-22 11:14:34','2018-11-22 11:14:34'),
(10,'update-profile','Update Profile','Profile','Update Profile','2018-11-22 11:14:34','2018-11-22 11:14:34'),
(11,'create-profile','Create Profile',NULL,'Create Profile','2018-11-22 11:14:36','2018-11-22 11:14:36');

/*Table structure for table `produk` */

DROP TABLE IF EXISTS `produk`;

CREATE TABLE `produk` (
  `kode_produk` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_kategori` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_merek` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_ukuran` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_satuan` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_beli` double(13,2) NOT NULL,
  `harga_jual` double(13,2) NOT NULL,
  `hpp` double(13,2) NOT NULL,
  `stok` double(12,3) NOT NULL,
  `aktif` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `kode_company` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  PRIMARY KEY (`kode_produk`),
  KEY `produk_created_by_index` (`created_by`),
  KEY `produk_updated_by_index` (`updated_by`),
  KEY `kode_kategori` (`kode_kategori`),
  KEY `kode_merek` (`kode_merek`),
  KEY `kode_ukuran` (`kode_ukuran`),
  KEY `kode_satuan` (`kode_satuan`),
  KEY `kode_company` (`kode_company`),
  CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`kode_kategori`) REFERENCES `kategori_produk` (`kode_kategori`),
  CONSTRAINT `produk_ibfk_2` FOREIGN KEY (`kode_merek`) REFERENCES `merek` (`kode_merek`),
  CONSTRAINT `produk_ibfk_3` FOREIGN KEY (`kode_ukuran`) REFERENCES `ukuran` (`kode_ukuran`),
  CONSTRAINT `produk_ibfk_4` FOREIGN KEY (`kode_satuan`) REFERENCES `satuan` (`kode_satuan`),
  CONSTRAINT `produk_ibfk_5` FOREIGN KEY (`kode_company`) REFERENCES `company` (`kode_company`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `produk` */

insert  into `produk`(`kode_produk`,`nama_produk`,`kode_kategori`,`kode_merek`,`kode_ukuran`,`kode_satuan`,`type`,`harga_beli`,`harga_jual`,`hpp`,`stok`,`aktif`,`created_at`,`updated_at`,`created_by`,`updated_by`,`kode_company`,`id_lokasi`) values 
('010119001','AC SAMSUNG 24Y','1','5','1','1','Non Serial',1000000.00,1000000.00,1000000.00,2.000,1,'2019-01-24 15:04:04','2019-01-31 14:57:44',1,1,'01',0),
('010119002','UPS SAMSUNG 800X','10','2','2','8','Non Serial',1000000.00,1000000.00,1000000.00,2.000,1,'2019-01-25 10:36:41','2019-01-25 10:56:45',1,1,'01',0),
('010119003','Solar','2','1','5','3','Non Serial',5000.00,5000.00,5000.00,50.000,1,'2019-01-29 09:52:01','2019-01-29 09:52:01',1,1,'01',1);

/*Table structure for table `role_user` */

DROP TABLE IF EXISTS `role_user`;

CREATE TABLE `role_user` (
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `role_user` */

insert  into `role_user`(`role_id`,`user_id`,`user_type`) values 
(1,1,'App\\User'),
(1,4,'App\\User'),
(2,2,'App\\User'),
(3,3,'App\\User');

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`display_name`,`description`,`created_at`,`updated_at`) values 
(1,'superadministrator','Superadministrator','Superadministrator','2018-11-22 11:14:34','2018-11-22 11:14:34'),
(2,'administrator','Administrator','Administrator','2018-11-22 11:14:35','2018-11-22 11:14:35'),
(3,'user','User','User','2018-11-22 11:14:35','2018-11-22 11:14:35');

/*Table structure for table `satuan` */

DROP TABLE IF EXISTS `satuan`;

CREATE TABLE `satuan` (
  `kode_satuan` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_satuan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`kode_satuan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `satuan` */

insert  into `satuan`(`kode_satuan`,`nama_satuan`,`status`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
('1','KG',1,'2018-11-22 14:35:32','2019-01-18 14:33:24',NULL,'1'),
('2','TON',1,'2018-12-19 16:05:03','2018-12-24 08:33:42','1','1'),
('3','Liter',1,'2018-12-19 16:05:16','2018-12-19 16:05:16','1','1'),
('4','Jerry can',1,'2018-11-24 10:18:55','2018-12-19 16:06:40','1','1'),
('5','Pcs',1,'2018-12-19 16:06:14','2018-12-19 16:06:14','1','1'),
('6','Meter',1,'2018-11-26 10:10:38','2018-12-21 10:57:57','1','1'),
('7','TON',1,'2018-12-20 10:54:59','2018-12-20 10:54:59','1','1'),
('8','Unit',1,'2018-12-19 08:54:40','2018-12-19 08:54:40','1','1'),
('9','Bundle',1,'2018-12-20 10:32:13','2018-12-21 10:41:55','1','1');

/*Table structure for table `stock` */

DROP TABLE IF EXISTS `stock`;

CREATE TABLE `stock` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stockName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stockPrice` int(11) NOT NULL,
  `stockYear` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stock_created_by_index` (`created_by`),
  KEY `stock_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `stock` */

insert  into `stock`(`id`,`stockName`,`stockPrice`,`stockYear`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
(1,'TCS',2500,1993,'2019-01-15 14:25:20','2019-01-15 14:25:20',1,1),
(2,'infosys',925,1992,'2019-01-15 14:25:25','2019-01-15 14:25:25',1,1),
(3,'Infosys',950,1992,'2019-01-15 14:34:27','2019-01-15 14:34:27',1,1),
(4,'TCS',2400,1993,'2019-01-15 14:35:26','2019-01-15 14:35:26',1,1),
(5,'Reliance',200,1992,'2019-01-15 14:36:13','2019-01-15 14:36:13',1,1),
(6,'Reliance',220,1993,'2019-01-15 14:36:32','2019-01-15 14:36:32',1,1),
(7,'HUL',100,1994,'2019-01-15 14:36:49','2019-01-15 14:36:49',1,1),
(8,'HUDCO',20,1991,'2019-01-15 14:37:16','2019-01-15 14:37:16',1,1),
(9,'Infosys',900,1991,'2019-01-15 14:38:03','2019-01-15 14:38:03',1,1),
(10,'Infosys',1000,1995,'2019-01-15 14:38:23','2019-01-15 14:38:23',1,1),
(11,'Infosys',2000,1996,'2019-01-15 14:38:40','2019-01-15 14:38:40',1,1),
(12,'Infosys',2500,1994,'2019-01-15 14:38:58','2019-01-15 14:38:58',1,1),
(13,'infosys',925,1991,'2019-01-15 14:39:30','2019-01-15 14:39:30',1,1),
(14,'Infosys',950,1992,'2019-01-15 14:39:48','2019-01-15 14:39:48',1,1),
(15,'TCS',2400,1992,'2019-01-15 14:40:19','2019-01-15 14:40:19',1,1),
(16,'TCS',2500,1993,'2019-01-15 14:40:32','2019-01-15 14:40:32',1,1);

/*Table structure for table `stocks` */

DROP TABLE IF EXISTS `stocks`;

CREATE TABLE `stocks` (
  `id` int(10) DEFAULT NULL,
  `stockName` varchar(765) DEFAULT NULL,
  `stockPrice` int(11) DEFAULT NULL,
  `stockYear` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `stocks` */

insert  into `stocks`(`id`,`stockName`,`stockPrice`,`stockYear`,`created_at`,`updated_at`) values 
(1,'Infosys',925,1993,'2017-07-15 13:58:28','2017-07-15 13:58:28'),
(2,'Infosys',950,1992,'2017-07-15 14:10:46','2017-07-15 14:10:46'),
(3,'TCS',2400,1992,'2017-07-15 14:12:06','2017-07-15 14:12:06'),
(4,'TCS',2500,1993,'2017-07-15 14:12:18','2017-07-15 14:12:18'),
(5,'Reliance',200,1992,'2017-07-15 14:12:32','2017-07-15 14:12:32'),
(6,'Reliance',220,1993,'2017-07-15 14:12:43','2017-07-15 14:12:43'),
(7,'HUL',100,1994,'2017-07-15 14:13:00','2017-07-15 14:13:00'),
(8,'HUDCO',20,1996,'2017-07-15 14:32:35','2017-07-15 14:32:35'),
(9,'Infosys',900,1991,'2017-07-15 21:54:17','2017-07-15 21:54:17'),
(10,'Infosys',1000,1995,'2017-07-15 21:55:08','2017-07-15 21:55:08'),
(11,'Infosys',2000,1996,'2017-07-15 21:55:19','2017-07-15 21:55:19'),
(12,'Infosys',2500,1994,'2017-07-16 10:03:26','2017-07-16 10:03:26'),
(NULL,'infosys',925,1991,'2019-01-15 14:20:03','2019-01-15 14:20:03'),
(NULL,'Infosys',950,1992,'2019-01-15 14:20:56','2019-01-15 14:20:56'),
(NULL,'TCS',2400,1992,'2019-01-15 14:22:31','2019-01-15 14:22:31'),
(NULL,'TCS',2500,1993,'2019-01-15 14:22:54','2019-01-15 14:22:54');

/*Table structure for table `ukuran` */

DROP TABLE IF EXISTS `ukuran`;

CREATE TABLE `ukuran` (
  `kode_ukuran` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_ukuran` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`kode_ukuran`),
  KEY `ukuran_created_by_index` (`created_by`),
  KEY `ukuran_updated_by_index` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `ukuran` */

insert  into `ukuran`(`kode_ukuran`,`nama_ukuran`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
('1','Kilometers','2018-11-23 11:34:04','2019-01-18 14:57:30',1,1),
('2','Centimeter','2018-11-27 08:30:44','2018-11-27 08:30:44',1,1),
('3','Meter','2018-11-29 10:12:36','2018-11-29 10:12:36',1,1),
('4','Kubiks','2018-12-24 09:48:03','2018-12-24 09:48:24',1,1),
('5','Volume','2018-12-24 11:01:10','2018-12-24 11:01:10',1,1),
('7','Mile','2019-01-18 14:48:33','2019-01-18 14:48:33',1,1),
('8','Metrik','2019-01-18 14:50:23','2019-01-18 14:50:23',1,1);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kode_company` char(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `kode_company` (`kode_company`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`kode_company`) REFERENCES `company` (`kode_company`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`password`,`remember_token`,`created_at`,`updated_at`,`kode_company`) values 
(1,'Superadministrator','superadministrator@app.com','$2y$10$M6hOiP7peVuoypPer9pvOOUpL5Px.1kCnjg.TSq6L9wersSRy6NFS','INZtCkSdR687HZdveaAjv8qIvGFVIxfzRLo2322mtLT7WUJdA7WiLlBC3ntM','2018-11-22 11:14:35','2019-01-22 14:23:39','01'),
(2,'Administrator','administrator@app.com','$2y$10$jwPrhSAyeqUdsXWQDvD/6uyifSB8up5VtwhV/ImZpC8RDbvIFCCK6',NULL,'2018-11-22 11:14:35','2019-01-25 10:18:19','02'),
(3,'User','user@app.com','$2y$10$kOOP45DOaOesgkYFGar9duqi9pcMDCsnbTSwe9ZOCZ5hky9eAJZ1S',NULL,'2018-11-22 11:14:35','2019-01-25 10:18:30','03'),
(4,'Cru User','cru_user@app.com','$2y$10$0gQCdjfYBMfRlZGrT50v/e0vMMo04b7/XZN299wC.xTOxE5JjKn/K','A8CuG44MqW','2018-11-22 11:14:36','2019-01-25 10:18:52','04');

/*Table structure for table `vendor` */

DROP TABLE IF EXISTS `vendor`;

CREATE TABLE `vendor` (
  `kode_vendor` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_vendor` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `npwp` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `termin_pembayaran` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`kode_vendor`),
  KEY `vendor_created_by_index` (`created_by`),
  KEY `vendor_updated_by_index` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `vendor` */

insert  into `vendor`(`kode_vendor`,`nama_vendor`,`alamat`,`telp`,`hp`,`npwp`,`termin_pembayaran`,`status`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
('1','PT.ANGKASA BAJA','JLN. SLAMET RIADY LR. LAWANG KIDUL LAUT NO. 1977 R...','071122334455','-','-',30,0,'2018-11-27 15:55:58','2019-01-18 15:41:51',1,1),
('2','PT. MAJU BERSAMA','Jln.Slamet Riadi','0711-717959','-','-',20,1,'2018-12-17 14:17:54','2018-12-17 14:17:54',1,1),
('3','PT. BAJA TUNGGAL','Jln.ABC','0711-321098','-','-',20,1,'2018-12-26 14:31:39','2018-12-26 14:31:39',1,1),
('4','PT. MANUNGGAL JAYA','--','0711','-','-',30,1,'2019-01-18 15:38:13','2019-01-18 15:41:26',1,1),
('5','PT. MANUNGGAL ABADI','--','--','--','--',25,1,'2019-01-18 15:39:46','2019-01-18 15:39:46',1,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
