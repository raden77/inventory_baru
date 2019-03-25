/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 5.7.19 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `stocks` (
	`id` int (10),
	`stockName` varchar (765),
	`stockPrice` int (11),
	`stockYear` int (11),
	`created_at` timestamp ,
	`updated_at` timestamp 
); 
insert into `stocks` (`id`, `stockName`, `stockPrice`, `stockYear`, `created_at`, `updated_at`) values('1','Infosys','925','1993','2017-07-15 13:58:28','2017-07-15 13:58:28');
insert into `stocks` (`id`, `stockName`, `stockPrice`, `stockYear`, `created_at`, `updated_at`) values('2','Infosys','950','1992','2017-07-15 14:10:46','2017-07-15 14:10:46');
insert into `stocks` (`id`, `stockName`, `stockPrice`, `stockYear`, `created_at`, `updated_at`) values('3','TCS','2400','1992','2017-07-15 14:12:06','2017-07-15 14:12:06');
insert into `stocks` (`id`, `stockName`, `stockPrice`, `stockYear`, `created_at`, `updated_at`) values('4','TCS','2500','1993','2017-07-15 14:12:18','2017-07-15 14:12:18');
insert into `stocks` (`id`, `stockName`, `stockPrice`, `stockYear`, `created_at`, `updated_at`) values('5','Reliance','200','1992','2017-07-15 14:12:32','2017-07-15 14:12:32');
insert into `stocks` (`id`, `stockName`, `stockPrice`, `stockYear`, `created_at`, `updated_at`) values('6','Reliance','220','1993','2017-07-15 14:12:43','2017-07-15 14:12:43');
insert into `stocks` (`id`, `stockName`, `stockPrice`, `stockYear`, `created_at`, `updated_at`) values('7','HUL','100','1994','2017-07-15 14:13:00','2017-07-15 14:13:00');
insert into `stocks` (`id`, `stockName`, `stockPrice`, `stockYear`, `created_at`, `updated_at`) values('8','HUDCO','20','1996','2017-07-15 14:32:35','2017-07-15 14:32:35');
insert into `stocks` (`id`, `stockName`, `stockPrice`, `stockYear`, `created_at`, `updated_at`) values('9','Infosys','900','1991','2017-07-15 21:54:17','2017-07-15 21:54:17');
insert into `stocks` (`id`, `stockName`, `stockPrice`, `stockYear`, `created_at`, `updated_at`) values('10','Infosys','1000','1995','2017-07-15 21:55:08','2017-07-15 21:55:08');
insert into `stocks` (`id`, `stockName`, `stockPrice`, `stockYear`, `created_at`, `updated_at`) values('11','Infosys','2000','1996','2017-07-15 21:55:19','2017-07-15 21:55:19');
insert into `stocks` (`id`, `stockName`, `stockPrice`, `stockYear`, `created_at`, `updated_at`) values('12','Infosys','2500','1994','2017-07-16 10:03:26','2017-07-16 10:03:26');
