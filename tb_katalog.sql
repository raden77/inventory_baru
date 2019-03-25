/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 5.7.19 : Database - db_gui_inventory_319_emkl
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_gui_inventory_319_emkl` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_gui_inventory_319_emkl`;

/*Table structure for table `tb_katalog` */

DROP TABLE IF EXISTS `tb_katalog`;

CREATE TABLE `tb_katalog` (
  `kode_item` varchar(6) DEFAULT NULL,
  `partnumber` varchar(40) DEFAULT NULL,
  `nama_item_id` varchar(200) DEFAULT NULL,
  `nama_item_en` varchar(200) DEFAULT NULL,
  `tipe` varchar(50) DEFAULT NULL,
  `ic` varchar(50) DEFAULT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `company_code` char(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
