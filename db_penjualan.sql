/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.18-MariaDB : Database - db_penjualan
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_penjualan` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_penjualan`;

/*Table structure for table `baranggudang` */

DROP TABLE IF EXISTS `baranggudang`;

CREATE TABLE `baranggudang` (
  `no_barang` varchar(10) NOT NULL,
  `kode_barang` varchar(50) DEFAULT NULL,
  `kode` varchar(10) DEFAULT NULL,
  `qr_code` varchar(100) DEFAULT NULL,
  `nama_barang` varchar(50) DEFAULT NULL,
  `hargapokok` double DEFAULT NULL,
  `hargagrosir` double DEFAULT NULL,
  `hargajual` double DEFAULT NULL,
  `stok_gudang` int(10) DEFAULT NULL,
  `kode_item` int(10) DEFAULT NULL,
  `id_size` int(10) DEFAULT NULL,
  `id_warna` int(10) DEFAULT NULL,
  `id_satuan` int(10) DEFAULT NULL,
  `id_suplier` int(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`no_barang`),
  KEY `kode_item` (`kode_item`),
  KEY `id_size` (`id_size`),
  KEY `id_warna` (`id_warna`),
  KEY `id_satuan` (`id_satuan`),
  KEY `id_suplier` (`id_suplier`),
  CONSTRAINT `baranggudang_ibfk_1` FOREIGN KEY (`kode_item`) REFERENCES `kategori_item` (`kode_item`),
  CONSTRAINT `baranggudang_ibfk_2` FOREIGN KEY (`id_size`) REFERENCES `kategori_size` (`id_size`),
  CONSTRAINT `baranggudang_ibfk_3` FOREIGN KEY (`id_warna`) REFERENCES `kategori_warna` (`id_warna`),
  CONSTRAINT `baranggudang_ibfk_4` FOREIGN KEY (`id_satuan`) REFERENCES `satuan` (`id_satuan`),
  CONSTRAINT `baranggudang_ibfk_5` FOREIGN KEY (`id_suplier`) REFERENCES `suplier` (`id_suplier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `baranggudang` */

insert  into `baranggudang`(`no_barang`,`kode_barang`,`kode`,`qr_code`,`nama_barang`,`hargapokok`,`hargagrosir`,`hargajual`,`stok_gudang`,`kode_item`,`id_size`,`id_warna`,`id_satuan`,`id_suplier`,`created_at`,`updated_at`) values 
('000001','132000001','000001','132000001.png','BRACELET DAUN',5000,9500,10000,90,1,2,3,34,1,'2021-06-28 02:20:30','2021-06-28 10:36:21'),
('000002','181000002','000002','181000002.png','BRACELET MOUSE',5500,9500,10000,100,1,1,8,34,1,'2021-06-28 03:08:58','2021-07-05 05:02:25'),
('000003','182000003','000003','182000003.png','BRACELET KERANG',5000,9500,10000,90,1,2,8,34,1,'2021-06-28 03:33:41','2021-06-28 10:36:29'),
('000004','118000004','000004','118000004.png','BRACELET FLOWER',5000,9500,10000,90,1,1,8,34,1,'2021-07-02 07:36:32','2021-07-02 07:36:32'),
('000005','219000001','000001','219000001.png','BAG SHOPING KECIL',50000,60000,70000,90,2,1,9,13,1,'2021-07-02 07:40:20','2021-07-02 07:40:20'),
('000006','318000001','000001','318000001.png','PARASUT',70000,93000,100000,90,3,1,8,34,1,'2021-07-02 07:47:38','2021-07-02 07:47:38'),
('000007','242000002','000002','242000002.png','BAG SHOPING BESAR',50000,68000,70000,100,2,2,4,34,1,'2021-07-02 08:00:30','2021-07-02 08:16:57'),
('000008','132000005','000005','132000005.png','BRACELET KRISTAL BULAT',9000,10000,12000,90,1,3,2,34,1,'2021-07-02 08:02:02','2021-07-02 08:02:02'),
('000009','353000002','000002','353000002.png','PARASUT',89000,95000,100000,90,3,3,5,34,1,'2021-07-02 08:03:41','2021-07-02 08:17:36'),
('000010','237000003',NULL,'237000003.png','BAG SHOPING GLOBE',60000,75000,80000,90,2,3,7,34,1,'2021-07-02 08:32:26','2021-07-02 08:32:26'),
('000011','322000003',NULL,'322000003.png','PARASUT',100000,118000,120000,90,3,2,2,34,1,'2021-07-02 08:38:14','2021-07-02 08:38:14');

/*Table structure for table `barangtoko` */

DROP TABLE IF EXISTS `barangtoko`;

CREATE TABLE `barangtoko` (
  `id_barangtoko` int(10) NOT NULL AUTO_INCREMENT,
  `no_barang` varchar(10) DEFAULT NULL,
  `id_toko` int(10) DEFAULT NULL,
  `stok_toko` int(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_barangtoko`),
  KEY `id_toko` (`id_toko`),
  KEY `no_barang` (`no_barang`),
  CONSTRAINT `barangtoko_ibfk_2` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`),
  CONSTRAINT `barangtoko_ibfk_3` FOREIGN KEY (`no_barang`) REFERENCES `baranggudang` (`no_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

/*Data for the table `barangtoko` */

insert  into `barangtoko`(`id_barangtoko`,`no_barang`,`id_toko`,`stok_toko`,`created_at`,`updated_at`) values 
(1,'000002',1,7,'2021-06-28 07:59:29','2021-07-05 04:55:59'),
(2,'000002',2,5,'2021-07-02 05:58:52','2021-07-05 03:27:52'),
(3,'000002',3,1,'2021-07-02 06:01:54','2021-07-02 06:01:54'),
(4,'000002',4,0,'2021-07-02 06:02:57','2021-07-02 06:02:57'),
(5,'000001',1,9,'2021-07-05 04:55:56','2021-07-05 04:56:03'),
(6,'000003',1,9,'2021-07-05 04:56:06','2021-07-05 04:56:06'),
(7,'000004',1,10,'2021-07-05 04:56:10','2021-07-05 04:56:10'),
(8,'000008',1,9,'2021-07-05 04:56:16','2021-07-05 04:56:16'),
(9,'000005',1,9,'2021-07-05 04:56:27','2021-07-05 04:56:27'),
(10,'000010',1,10,'2021-07-05 04:56:43','2021-07-05 04:56:43'),
(11,'000006',1,9,'2021-07-05 04:56:48','2021-07-05 04:56:48'),
(12,'000009',1,10,'2021-07-05 04:56:55','2021-07-05 04:56:55'),
(13,'000011',1,10,'2021-07-05 04:57:01','2021-07-05 04:57:01');

/*Table structure for table `coa` */

DROP TABLE IF EXISTS `coa`;

CREATE TABLE `coa` (
  `kode_akun` varchar(50) NOT NULL,
  `nama_akun` varchar(100) DEFAULT NULL,
  `is_kode_akun` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kode_akun`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `coa` */

insert  into `coa`(`kode_akun`,`nama_akun`,`is_kode_akun`) values 
('1','PENERIMAAN INTERNAL','0'),
('101','Petty Cash','1'),
('102','Paypal','1'),
('103','BNI IDR Edward','1'),
('104','BNI USD Edward','1'),
('105','BNI IDR PT. Surface','1'),
('106','Mandiri PT. Surface','1'),
('107','Transferwise','1'),
('2','PENERIMAAN TRANSAKSI','0'),
('201','Diving','2'),
('3','TRANSAKSI PEMILIK','0'),
('4','INVESTASI DAN INVENTARIS','0'),
('400','TANAH','4'),
('401','GEDUNG','4'),
('402','Sofa','4'),
('403','Komputer','4'),
('5','GAJI DAN TUNJANGAN KARYAWAN','0'),
('500','Direktur','5'),
('6','BIAYA ADMINISTRASI & OPERASIONAL','0'),
('600','LISTRIK','6'),
('7','PAJAK DAN BANK','0'),
('700','PPH 21','7');

/*Table structure for table `detail_orderbarang` */

DROP TABLE IF EXISTS `detail_orderbarang`;

CREATE TABLE `detail_orderbarang` (
  `kode_order` varchar(50) DEFAULT NULL,
  `no_barang` varchar(10) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `jumlah` int(10) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `sub_total` double DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `tgl_kirim` datetime DEFAULT NULL,
  `id_toko` int(10) DEFAULT NULL,
  `id_suplier` int(10) DEFAULT NULL,
  KEY `kode_order` (`kode_order`),
  KEY `id_toko` (`id_toko`),
  KEY `id_suplier` (`id_suplier`),
  KEY `no_barang` (`no_barang`),
  CONSTRAINT `detail_orderbarang_ibfk_1` FOREIGN KEY (`kode_order`) REFERENCES `orderbarang` (`kode_order`),
  CONSTRAINT `detail_orderbarang_ibfk_3` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`),
  CONSTRAINT `detail_orderbarang_ibfk_4` FOREIGN KEY (`id_suplier`) REFERENCES `suplier` (`id_suplier`),
  CONSTRAINT `detail_orderbarang_ibfk_5` FOREIGN KEY (`no_barang`) REFERENCES `baranggudang` (`no_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `detail_orderbarang` */

insert  into `detail_orderbarang`(`kode_order`,`no_barang`,`username`,`jumlah`,`harga`,`sub_total`,`keterangan`,`tgl_kirim`,`id_toko`,`id_suplier`) values 
('AKT210628000001','000001','admin',10,5000,50000,'KIRIM','2021-06-28 16:31:55',NULL,1),
('AKT210628000001','000003','admin',10,5000,50000,'KIRIM','2021-06-28 16:31:55',NULL,1),
('ORT2107020001','000002','komang',10,5500,55000,'KIRIM','2021-07-05 08:42:09',1,NULL),
('ORG2107050001','000002','user',1,5500,5500,'KIRIM','2021-07-05 08:21:10',NULL,NULL),
('ORT2107050002','000002','andi',1,5500,5500,NULL,NULL,2,NULL),
('ORT10002','000011','komang',1,100000,100000,NULL,NULL,1,NULL);

/*Table structure for table `detail_returgudang` */

DROP TABLE IF EXISTS `detail_returgudang`;

CREATE TABLE `detail_returgudang` (
  `no_retur` varchar(100) DEFAULT NULL,
  `no_barang` varchar(10) DEFAULT NULL,
  `id_suplier` int(10) DEFAULT NULL,
  `jumlah` int(10) DEFAULT NULL,
  `hargapokok` double DEFAULT NULL,
  `subtotal` double DEFAULT NULL,
  KEY `id_suplier` (`id_suplier`),
  KEY `no_retur` (`no_retur`),
  KEY `no_barang` (`no_barang`),
  CONSTRAINT `detail_returgudang_ibfk_2` FOREIGN KEY (`id_suplier`) REFERENCES `suplier` (`id_suplier`),
  CONSTRAINT `detail_returgudang_ibfk_3` FOREIGN KEY (`no_retur`) REFERENCES `returgudang` (`no_retur`),
  CONSTRAINT `detail_returgudang_ibfk_4` FOREIGN KEY (`no_barang`) REFERENCES `baranggudang` (`no_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `detail_returgudang` */

insert  into `detail_returgudang`(`no_retur`,`no_barang`,`id_suplier`,`jumlah`,`hargapokok`,`subtotal`) values 
('RTS2806210001','000001',1,2,10000,20000),
('RTS2806210001','000002',1,1,10000,10000),
('RTS2806210002','000001',1,1,10000,10000),
('RTS2806210002','000003',1,1,10000,10000),
('RTS0507210001','000002',1,1,10000,10000);

/*Table structure for table `detail_stokin` */

DROP TABLE IF EXISTS `detail_stokin`;

CREATE TABLE `detail_stokin` (
  `no_stokin` varchar(50) DEFAULT NULL,
  `no_barang` varchar(10) DEFAULT NULL,
  `kode_order` varchar(50) DEFAULT NULL,
  `id_toko` int(10) DEFAULT NULL,
  `stokin_hargapokok` double DEFAULT NULL,
  `jumlah` int(10) DEFAULT NULL,
  `sub_total` double DEFAULT NULL,
  `stokin_ket` varchar(100) DEFAULT NULL,
  `tgl_terima` datetime DEFAULT NULL,
  KEY `id_toko` (`id_toko`),
  KEY `no_stokin` (`no_stokin`),
  KEY `detail_stokin_ibfk_5` (`no_barang`),
  KEY `kode_order` (`kode_order`),
  CONSTRAINT `detail_stokin_ibfk_1` FOREIGN KEY (`no_stokin`) REFERENCES `stok_in` (`no_stokin`),
  CONSTRAINT `detail_stokin_ibfk_3` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`),
  CONSTRAINT `detail_stokin_ibfk_5` FOREIGN KEY (`no_barang`) REFERENCES `baranggudang` (`no_barang`),
  CONSTRAINT `detail_stokin_ibfk_6` FOREIGN KEY (`kode_order`) REFERENCES `orderbarang` (`kode_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `detail_stokin` */

insert  into `detail_stokin`(`no_stokin`,`no_barang`,`kode_order`,`id_toko`,`stokin_hargapokok`,`jumlah`,`sub_total`,`stokin_ket`,`tgl_terima`) values 
('KRM28062100001','000002',NULL,1,5500,10,55000,'TERIMA','2021-06-28 12:59:26'),
('KRM01072100001','000001',NULL,1,5000,1,5000,'TERIMA','2021-07-05 09:55:43'),
('KRM02072100001','000002',NULL,2,5500,5,27500,'TERIMA','2021-07-02 10:58:49'),
('KRM02072100002','000002',NULL,3,5500,2,11000,'TERIMA','2021-07-02 11:01:52'),
('KRM02072100003','000002',NULL,4,5500,5,27500,'TERIMA','2021-07-02 11:02:54'),
('RET0507210003','000002','ORG2107050001',2,5500,1,5500,'TERIMA','2021-07-05 08:27:39'),
('KRM05072110004','000002','ORT2107020001',1,5500,2,11000,'TERIMA','2021-07-05 09:55:56'),
('KRM05072110005','000004',NULL,1,5000,10,50000,'TERIMA','2021-07-05 09:56:06'),
('KRM05072110005','000001',NULL,1,5000,10,50000,'TERIMA','2021-07-05 09:55:59'),
('KRM05072110005','000008',NULL,1,9000,10,90000,'TERIMA','2021-07-05 09:56:11'),
('KRM05072110005','000003',NULL,1,5000,10,50000,'TERIMA','2021-07-05 09:56:03'),
('KRM05072110005','000005',NULL,1,50000,10,500000,'TERIMA','2021-07-05 09:56:16'),
('KRM05072110005','000010',NULL,1,60000,10,600000,'TERIMA','2021-07-05 09:56:28'),
('KRM05072110005','000006',NULL,1,70000,10,700000,'TERIMA','2021-07-05 09:56:43'),
('KRM05072110005','000011',NULL,1,100000,10,1000000,'TERIMA','2021-07-05 09:56:55'),
('KRM05072110005','000009',NULL,1,89000,10,890000,'TERIMA','2021-07-05 09:56:48');

/*Table structure for table `detail_stokingudang` */

DROP TABLE IF EXISTS `detail_stokingudang`;

CREATE TABLE `detail_stokingudang` (
  `kode_stokin` varchar(100) DEFAULT NULL,
  `no_barang` varchar(10) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `jumlah` int(10) DEFAULT NULL,
  `subtotal` double DEFAULT NULL,
  `id_suplier` int(10) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `tgl_terima` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  KEY `id_suplier` (`id_suplier`),
  KEY `kode_stokin` (`kode_stokin`),
  KEY `no_barang` (`no_barang`),
  CONSTRAINT `detail_stokingudang_ibfk_1` FOREIGN KEY (`id_suplier`) REFERENCES `suplier` (`id_suplier`),
  CONSTRAINT `detail_stokingudang_ibfk_3` FOREIGN KEY (`kode_stokin`) REFERENCES `stokingudang` (`kode_stokin`),
  CONSTRAINT `detail_stokingudang_ibfk_4` FOREIGN KEY (`no_barang`) REFERENCES `baranggudang` (`no_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `detail_stokingudang` */

insert  into `detail_stokingudang`(`kode_stokin`,`no_barang`,`harga`,`jumlah`,`subtotal`,`id_suplier`,`keterangan`,`tgl_terima`) values 
('SUP280621000004','000002',5500,10,55000,1,'TERIMA','2021-06-28 00:00:00'),
('SUP280621000005','000001',5000,10,50000,1,'TERIMA','2021-06-28 00:00:00'),
('SUP280621000005','000003',5000,10,50000,1,'TERIMA','2021-06-28 00:00:00');

/*Table structure for table `detail_stokout` */

DROP TABLE IF EXISTS `detail_stokout`;

CREATE TABLE `detail_stokout` (
  `kode_stokout` varchar(50) DEFAULT NULL,
  `no_barang` varchar(10) DEFAULT NULL,
  `id_toko` int(10) DEFAULT NULL,
  `hargapokok` double DEFAULT NULL,
  `jumlah` int(10) DEFAULT NULL,
  `sub_total` double DEFAULT NULL,
  `ket` varchar(100) DEFAULT NULL,
  `tgl_terima` datetime DEFAULT NULL,
  KEY `id_toko` (`id_toko`),
  KEY `kode_stokout` (`kode_stokout`),
  KEY `no_barang` (`no_barang`),
  CONSTRAINT `detail_stokout_ibfk_2` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`),
  CONSTRAINT `detail_stokout_ibfk_3` FOREIGN KEY (`kode_stokout`) REFERENCES `stok_out` (`kode_stokout`),
  CONSTRAINT `detail_stokout_ibfk_4` FOREIGN KEY (`no_barang`) REFERENCES `baranggudang` (`no_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `detail_stokout` */

insert  into `detail_stokout`(`kode_stokout`,`no_barang`,`id_toko`,`hargapokok`,`jumlah`,`sub_total`,`ket`,`tgl_terima`) values 
('RET0107210001','000002',1,5500,1,5500,'TERIMA','2021-07-01 11:41:53'),
('RET0507210002','000002',1,5500,1,5500,'TERIMA','2021-07-05 05:02:24'),
('RET0507210003','000002',2,5500,1,5500,NULL,NULL);

/*Table structure for table `detail_transaksi` */

DROP TABLE IF EXISTS `detail_transaksi`;

CREATE TABLE `detail_transaksi` (
  `no_faktur` varchar(20) DEFAULT NULL,
  `no_barang` varchar(10) DEFAULT NULL,
  `id_toko` int(10) DEFAULT NULL,
  `hargapokok` double DEFAULT NULL,
  `hargajual` double DEFAULT NULL,
  `hargagrosir` double DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `subtotal` double DEFAULT NULL,
  KEY `no_faktur` (`no_faktur`),
  KEY `id_toko` (`id_toko`),
  KEY `no_barang` (`no_barang`),
  CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`no_faktur`) REFERENCES `transaksi` (`no_faktur`),
  CONSTRAINT `detail_transaksi_ibfk_3` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`),
  CONSTRAINT `detail_transaksi_ibfk_4` FOREIGN KEY (`no_barang`) REFERENCES `baranggudang` (`no_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `detail_transaksi` */

insert  into `detail_transaksi`(`no_faktur`,`no_barang`,`id_toko`,`hargapokok`,`hargajual`,`hargagrosir`,`jumlah`,`subtotal`) values 
('280621000001','000002',1,5500,10000,9500,2,20000),
('020721000001','000002',2,5500,10000,9500,2,20000),
('020721000002','000002',3,5500,10000,9500,1,10000),
('020721000003','000002',4,5500,10000,9500,5,50000),
('2050721000001','000002',2,5500,10000,9500,1,10000),
('1050721000001','000001',1,5000,10000,9500,1,10000),
('1050721000002','000003',1,5000,10000,9500,1,10000),
('1050721000002','000008',1,9000,12000,10000,1,12000),
('1290721000001','000001',1,5000,10000,9500,1,10000),
('1290721000002','000005',1,50000,70000,60000,1,70000),
('1290721000002','000006',1,70000,100000,93000,1,100000);

/*Table structure for table `jurnalumum` */

DROP TABLE IF EXISTS `jurnalumum`;

CREATE TABLE `jurnalumum` (
  `id_jurnalumum` varchar(10) NOT NULL,
  `kode_akun` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `uraian` varchar(200) DEFAULT NULL,
  `c_t` varchar(50) DEFAULT NULL,
  `d_c` varchar(50) DEFAULT NULL,
  `no_dc` varchar(50) DEFAULT NULL,
  `total` double DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `awal_saldo` double DEFAULT NULL,
  `akhir_saldo` double DEFAULT NULL,
  PRIMARY KEY (`id_jurnalumum`),
  KEY `jurnalumum_ibfk_1` (`kode_akun`),
  CONSTRAINT `jurnalumum_ibfk_1` FOREIGN KEY (`kode_akun`) REFERENCES `coa` (`kode_akun`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `jurnalumum` */

insert  into `jurnalumum`(`id_jurnalumum`,`kode_akun`,`tanggal`,`uraian`,`c_t`,`d_c`,`no_dc`,`total`,`code`,`awal_saldo`,`akhir_saldo`) values 
('01','106','2021-07-20','Pembelian Sofa Ruang Tunggu','Transfer','Debit','09786656454',7000000,'402',500000000,493000000),
('02','106','2021-07-02','Pembelian komputer Lenovo','Transfer','Credit','09786656454',20000000,'403',500000000,473000000);

/*Table structure for table `kategori_item` */

DROP TABLE IF EXISTS `kategori_item`;

CREATE TABLE `kategori_item` (
  `kode_item` int(10) NOT NULL,
  `nama_item` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`kode_item`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `kategori_item` */

insert  into `kategori_item`(`kode_item`,`nama_item`,`created_at`,`updated_at`) values 
(1,'ACCECORISS','2021-06-26 04:59:43','2021-06-28 14:31:34'),
(2,'BAG','2021-06-29 08:47:03','2021-06-29 08:47:06'),
(3,'PARASUT','2021-07-02 13:46:14','2021-07-02 13:46:17');

/*Table structure for table `kategori_size` */

DROP TABLE IF EXISTS `kategori_size`;

CREATE TABLE `kategori_size` (
  `id_size` int(10) NOT NULL,
  `nama_size` varchar(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_size`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `kategori_size` */

insert  into `kategori_size`(`id_size`,`nama_size`,`created_at`,`updated_at`) values 
(1,'S','2021-06-26 03:55:45','2021-06-26 03:55:45'),
(2,'L','2021-06-26 04:01:08','2021-06-26 04:01:08'),
(3,'XL','2021-06-28 09:38:09','2021-06-28 14:57:42');

/*Table structure for table `kategori_warna` */

DROP TABLE IF EXISTS `kategori_warna`;

CREATE TABLE `kategori_warna` (
  `id_warna` int(10) NOT NULL AUTO_INCREMENT,
  `nama_warna` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_warna`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `kategori_warna` */

insert  into `kategori_warna`(`id_warna`,`nama_warna`,`created_at`,`updated_at`) values 
(1,'PINK','2021-05-25 02:35:47','2021-06-19 09:21:47'),
(2,'Merah','2021-06-21 07:12:05','2021-06-21 07:12:05'),
(3,'Ungu','2021-06-04 03:58:19','2021-06-04 03:58:36'),
(4,'Hijau','2021-06-09 11:01:08','2021-06-09 11:01:08'),
(5,'Hitam','2021-06-09 11:01:08','2021-06-09 11:01:08'),
(6,'Putih','2021-06-09 11:01:08','2021-06-09 11:01:08'),
(7,'Kuning','2021-06-09 11:01:08','2021-06-09 11:01:08'),
(8,'Biru','2021-06-09 11:01:08','2021-06-09 11:01:08'),
(9,'Coklat','2021-06-09 11:01:08','2021-06-09 11:01:08'),
(10,'Marine Blue','2021-06-28 09:09:04','2021-06-28 09:09:04');

/*Table structure for table `kodeotp` */

DROP TABLE IF EXISTS `kodeotp`;

CREATE TABLE `kodeotp` (
  `id_kodeotp` int(11) NOT NULL,
  `tanggal_buat` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `email` varchar(150) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `tanggal_kadaluarsa` datetime NOT NULL,
  `status` char(1) NOT NULL COMMENT 'Y=Aktif,N=Tidak Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `kodeotp` */

insert  into `kodeotp`(`id_kodeotp`,`tanggal_buat`,`email`,`kode`,`tanggal_kadaluarsa`,`status`) values 
(0,'2021-06-18 12:14:41','admin','2415','2021-06-18 11:21:23','N'),
(0,'2021-06-18 12:16:23','admin','3954','2021-06-18 11:25:50','N'),
(0,'2021-06-18 13:06:58','admin','4698','2021-06-18 12:15:45','N'),
(0,'2021-06-18 13:27:17','admin','3698','2021-06-18 12:36:16','N'),
(0,'2021-06-18 14:10:07','admin','2167','2021-06-19 12:44:58','N'),
(0,'2021-06-18 15:12:07','admin','8569','2021-06-18 15:10:57','N'),
(0,'2021-06-18 16:30:06','admin','3715','2021-06-18 16:32:24','N'),
(0,'2021-06-18 16:30:06','admin','8645','2021-06-18 16:40:15','N'),
(0,'2021-06-18 16:32:12','admin','4062','2021-06-18 16:40:03','N'),
(0,'2021-06-18 16:40:50','admin','1483','2021-06-18 17:34:51','N'),
(0,'2021-06-18 16:45:41','admin','6403','2021-06-18 17:00:00','N'),
(0,'2021-06-18 16:48:33','admin','6137','2021-06-18 16:50:41','N'),
(0,'2021-06-18 16:51:37','admin','6270','2021-06-18 16:59:33','N'),
(0,'2021-06-18 16:53:30','admin','1389','2021-06-18 16:59:37','N'),
(0,'2021-06-18 16:55:31','admin','3127','2021-06-18 17:00:51','N'),
(0,'2021-06-18 16:56:59','admin','5210','2021-06-18 17:56:24','N'),
(0,'2021-06-19 08:29:42','admin','7639','2021-06-19 08:30:50','N'),
(0,'2021-06-19 10:12:20','admin','8205','2021-06-19 08:40:42','N'),
(0,'2021-06-19 10:13:16','admin','8926','2021-06-19 10:27:20','N'),
(0,'2021-06-19 10:19:46','admin','6483','2021-06-19 10:33:10','N'),
(0,'2021-06-19 10:21:47','admin','5803','2021-06-19 10:34:46','N'),
(0,'2021-06-21 09:22:46','admin','7123','2021-06-21 09:35:41','N'),
(0,'2021-06-21 09:45:47','admin','9236','2021-06-21 10:00:47','N'),
(0,'2021-06-21 09:46:46','admin','2413','2021-06-21 10:01:46','N'),
(0,'2021-06-21 10:36:22','admin','9835','2021-06-21 10:50:25','N'),
(0,'2021-06-21 10:42:52','admin','8623','2021-06-21 10:57:52','N'),
(0,'2021-06-21 11:49:53','sinta','3871','2021-06-21 11:55:36','N'),
(0,'2021-06-21 11:53:38','sinta','5273','2021-06-21 12:04:53','N'),
(0,'2021-06-21 12:19:30','eka','3548','2021-06-21 12:08:38','N'),
(0,'2021-06-21 12:21:17','Komang','9308','2021-06-21 12:34:30','N'),
(0,'2021-06-21 12:29:09','Komang','9703','2021-06-21 12:36:16','N'),
(0,'2021-06-21 12:31:23','eka','2516','2021-06-21 12:44:08','N'),
(0,'2021-06-21 12:42:12','admin','9423','2021-06-21 12:56:53','N'),
(0,'2021-06-21 12:42:51','admin','2154','2021-06-21 12:57:31','N'),
(0,'2021-06-23 09:27:46','putu','7568','2021-06-21 15:00:43','N'),
(0,'2021-06-23 09:22:24','admin','2908','2021-06-23 09:21:36','N'),
(0,'2021-06-23 09:22:55','admin','6392','2021-06-23 09:22:38','N'),
(0,'2021-06-28 15:31:34','admin','2569','2021-06-23 09:27:46','N'),
(0,'2021-06-28 15:31:34','admin','2036','2021-06-28 10:00:07','N'),
(0,'2021-06-28 15:31:34','admin','7523','2021-06-28 15:43:21','N'),
(0,'2021-06-28 15:57:42','admin','1742','2021-06-28 16:07:29','N'),
(0,'2021-07-07 08:36:03','admin','0241','2021-07-02 14:28:41','N'),
(0,'2021-07-07 08:36:03','admin','5687','2021-07-07 08:49:56','N'),
(0,'2021-07-07 08:36:44','admin','4378','2021-07-07 08:51:03','N'),
(0,'2021-07-07 08:50:58','admin','3254','2021-07-07 09:04:52','N'),
(0,'2021-07-07 08:54:24','admin','3015','2021-07-07 09:06:08','N'),
(0,'2021-07-07 08:54:24','admin','2385','2021-07-07 09:09:03','N'),
(0,'2021-07-07 09:00:09','admin','8267','2021-07-07 09:11:15','N'),
(0,'2021-07-07 09:00:09','admin','7902','2021-07-07 09:13:12','N'),
(0,'2021-07-07 09:00:09','admin','7596','2021-07-07 09:14:23','N');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`version`,`class`,`group`,`namespace`,`time`,`batch`) values 
(1,'2021-05-22-002429','App\\Database\\Migrations\\Users','default','App',1621643436,1),
(2,'2021-05-24-042449','App\\Database\\Migrations\\Satuan','default','App',1621830786,2),
(3,'2021-05-25-070310','App\\Database\\Migrations\\Kategori','default','App',1621926452,3);

/*Table structure for table `orderbarang` */

DROP TABLE IF EXISTS `orderbarang`;

CREATE TABLE `orderbarang` (
  `kode_order` varchar(50) NOT NULL,
  `tanggal_order` timestamp NULL DEFAULT current_timestamp(),
  `total_order` double DEFAULT NULL,
  `id_toko` int(10) DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL,
  `pesan` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`kode_order`),
  KEY `id_toko` (`id_toko`),
  CONSTRAINT `orderbarang_ibfk_1` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `orderbarang` */

insert  into `orderbarang`(`kode_order`,`tanggal_order`,`total_order`,`id_toko`,`ket`,`pesan`) values 
('AKT210628000001','2021-06-28 16:17:18',100000,NULL,'suplier','tolong kirimkan segera ya, karna stok sudah kosong'),
('AKT210701000001','2021-07-01 08:36:08',500000,NULL,'suplier','tolong segera dikirimkan'),
('ORG2107050001','2021-07-05 08:58:38',5500,1,'toko','tolong kirim kan ke toko 2'),
('ORT10002','2021-07-20 11:42:27',100000,NULL,'gudang','toolong kirimkan dengan cepat'),
('ORT2107020001','2021-07-02 09:34:40',55000,1,'gudang','Tolong kirimkan segera'),
('ORT2107050002','2021-07-05 10:00:45',5500,NULL,'gudang','tolongkirimkan barang tersebut segera');

/*Table structure for table `returgudang` */

DROP TABLE IF EXISTS `returgudang`;

CREATE TABLE `returgudang` (
  `no_retur` varchar(100) NOT NULL,
  `tanggal_retur` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total` double DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`no_retur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `returgudang` */

insert  into `returgudang`(`no_retur`,`tanggal_retur`,`total`,`keterangan`,`username`) values 
('RTS0507210001','2021-07-05 11:06:05',10000,'rusak dari toko','user'),
('RTS2806210001','2021-07-01 12:35:36',30000,'rusak berkarat','user'),
('RTS2806210002','2021-06-28 17:54:22',20000,'Cacad kiriman suplier','user');

/*Table structure for table `saldo_awal` */

DROP TABLE IF EXISTS `saldo_awal`;

CREATE TABLE `saldo_awal` (
  `id_saldo` int(10) NOT NULL AUTO_INCREMENT,
  `kode_akun` varchar(50) DEFAULT NULL,
  `saldo_awal` double DEFAULT NULL,
  `saldo_akhir` double DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_saldo`),
  KEY `kode_akun` (`kode_akun`),
  CONSTRAINT `saldo_awal_ibfk_1` FOREIGN KEY (`kode_akun`) REFERENCES `coa` (`kode_akun`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

/*Data for the table `saldo_awal` */

insert  into `saldo_awal`(`id_saldo`,`kode_akun`,`saldo_awal`,`saldo_akhir`,`updated_at`,`username`) values 
(5,'106',500000000,473000000,'2021-07-20 04:35:19','admin'),
(7,'105',500000000,500000000,'2021-07-30 04:29:02','admin'),
(8,'102',500000000,500000000,'2021-07-30 04:34:13','admin'),
(9,'101',500000000,500000000,'2021-07-30 04:39:33','admin'),
(10,'104',500000000,500000000,'2021-07-30 05:19:24','admin'),
(11,'107',500000000,500000000,'2021-07-30 05:20:06','admin'),
(12,'103',200000000,200000000,'2021-07-30 06:39:38','admin');

/*Table structure for table `satuan` */

DROP TABLE IF EXISTS `satuan`;

CREATE TABLE `satuan` (
  `id_satuan` int(10) NOT NULL AUTO_INCREMENT,
  `nama_satuan` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_satuan`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

/*Data for the table `satuan` */

insert  into `satuan`(`id_satuan`,`nama_satuan`,`created_at`,`updated_at`) values 
(12,'LUSIN (12 pcs)','2021-06-21 06:53:34','2021-06-21 06:53:34'),
(13,'KODI (20 pcs)','2021-05-24 22:46:30','2021-06-18 14:12:07'),
(34,'PCS (1 pcs)','2021-05-31 10:56:01','2021-06-19 09:13:16'),
(36,'DUS (40 PCS)','2021-06-04 03:50:40','2021-06-19 07:30:21');

/*Table structure for table `stok_in` */

DROP TABLE IF EXISTS `stok_in`;

CREATE TABLE `stok_in` (
  `no_stokin` varchar(50) NOT NULL,
  `tgl_stokin` timestamp NOT NULL DEFAULT current_timestamp(),
  `total` double DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `pesan` varchar(100) DEFAULT NULL,
  `id_toko` int(10) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`no_stokin`),
  KEY `id_toko` (`id_toko`),
  CONSTRAINT `stok_in_ibfk_1` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `stok_in` */

insert  into `stok_in`(`no_stokin`,`tgl_stokin`,`total`,`keterangan`,`pesan`,`id_toko`,`username`) values 
('KRM01072100001','2021-07-01 13:20:33',5000,'','gudang',1,'user'),
('KRM02072100001','2021-07-02 11:55:29',27500,'sebelum terima dicek ya',NULL,2,'user'),
('KRM02072100002','2021-07-02 11:57:20',11000,'',NULL,3,'user'),
('KRM02072100003','2021-07-02 11:58:09',27500,'',NULL,4,'user'),
('KRM05072110004','2021-07-05 09:42:59',11000,'ok sisa gudang ada 2 barang, jangan lupa dicek barangnya',NULL,1,'user'),
('KRM05072110005','2021-07-05 10:54:35',3930000,'',NULL,1,'user'),
('KRM28062100001','2021-06-28 13:13:09',55000,'Cek dulu ya sebelum diterima','gudang',1,'user'),
('RET0507210003','2021-07-05 09:21:34',5500,'cek dulu ya sebelum diterima',NULL,2,'komang');

/*Table structure for table `stok_out` */

DROP TABLE IF EXISTS `stok_out`;

CREATE TABLE `stok_out` (
  `kode_stokout` varchar(50) NOT NULL,
  `tgl_stokout` timestamp NULL DEFAULT current_timestamp(),
  `total` double DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `id_toko` varchar(10) DEFAULT NULL,
  `pesan` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`kode_stokout`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `stok_out` */

insert  into `stok_out`(`kode_stokout`,`tgl_stokout`,`total`,`keterangan`,`username`,`id_toko`,`pesan`) values 
('RET0107210001','2021-07-01 15:47:24',5500,'Retur Ke Gudang','komang','1','rusak toko'),
('RET0507210002','2021-07-05 08:55:42',5500,'Retur Ke Gudang','Komang',NULL,'Rusak Pengiriman'),
('RET0507210003','2021-07-05 09:21:34',5500,'Retur Ke Toko','komang',NULL,'cek dulu ya sebelum diterima');

/*Table structure for table `stokingudang` */

DROP TABLE IF EXISTS `stokingudang`;

CREATE TABLE `stokingudang` (
  `kode_stokin` varchar(100) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total` double DEFAULT NULL,
  `id_suplier` int(10) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`kode_stokin`),
  KEY `id_suplier` (`id_suplier`),
  CONSTRAINT `stokingudang_ibfk_1` FOREIGN KEY (`id_suplier`) REFERENCES `suplier` (`id_suplier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `stokingudang` */

insert  into `stokingudang`(`kode_stokin`,`tanggal`,`total`,`id_suplier`,`username`) values 
('SUP280621000004','2021-06-28 11:38:46',55000,1,'sinta'),
('SUP280621000005','2021-06-28 16:31:55',100000,1,'sinta');

/*Table structure for table `suplier` */

DROP TABLE IF EXISTS `suplier`;

CREATE TABLE `suplier` (
  `id_suplier` int(10) NOT NULL AUTO_INCREMENT,
  `nama_suplier` varchar(255) NOT NULL,
  `alamat_suplier` varchar(255) NOT NULL,
  `no_telp` varchar(12) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_suplier`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `suplier` */

insert  into `suplier`(`id_suplier`,`nama_suplier`,`alamat_suplier`,`no_telp`,`created_at`,`updated_at`) values 
(1,'Maju Mundur','Kuta, Badung','087796534390','2021-06-21 04:21:37','2021-06-21 12:41:25'),
(3,'Kemeja Polos','Banyuning, Singaraja','089977799791','2021-05-28 03:03:24','2021-06-21 12:41:39');

/*Table structure for table `toko` */

DROP TABLE IF EXISTS `toko`;

CREATE TABLE `toko` (
  `id_toko` int(10) NOT NULL AUTO_INCREMENT,
  `nama_toko` varchar(255) DEFAULT NULL,
  `alamat_toko` varchar(255) DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_toko`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `toko` */

insert  into `toko`(`id_toko`,`nama_toko`,`alamat_toko`,`no_telp`,`created_at`,`updated_at`) values 
(1,'Toko 1','Banyuning, Singaraja','087645332676','2021-05-25 03:08:50','2021-05-25 20:52:28'),
(2,'Toko 2','Kuta, Badung','087765544578','2021-05-28 03:03:58','2021-06-21 07:30:43'),
(3,'Toko 3','Gianyar','089977799790','2021-05-29 11:22:37','2021-06-21 12:31:21'),
(4,'Toko 4','Banyuning, Singaraja',NULL,'2021-06-01 07:03:31','2021-06-01 07:03:31'),
(5,'Toko 5','Tabanan',NULL,'2021-06-01 07:51:53','2021-06-01 07:51:53');

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `no_faktur` varchar(20) NOT NULL,
  `id_toko` int(10) DEFAULT NULL,
  `tanggal` timestamp NULL DEFAULT current_timestamp(),
  `username` varchar(100) DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `jml_uang` int(11) DEFAULT NULL,
  `kembalian` int(11) DEFAULT NULL,
  `grandtotal` int(11) DEFAULT NULL,
  PRIMARY KEY (`no_faktur`),
  KEY `id_toko` (`id_toko`),
  CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `transaksi` */

insert  into `transaksi`(`no_faktur`,`id_toko`,`tanggal`,`username`,`diskon`,`total`,`jml_uang`,`kembalian`,`grandtotal`) values 
('020721000001',2,'2021-07-02 11:59:20','andi',0,20000,50000,30000,20000),
('020721000002',3,'2021-07-02 12:02:20','cinta',0,10000,10000,0,10000),
('020721000003',4,'2021-07-02 12:03:24','eka',0,50000,50000,0,50000),
('1050721000001',1,'2021-07-05 12:09:48','komang',0,10000,10000,0,10000),
('1050721000002',1,'2021-07-05 12:17:49','komang',0,22000,50000,28000,22000),
('1290721000001',1,'2021-07-29 08:35:48','komang',0,10000,50000,40000,10000),
('1290721000002',1,'2021-07-29 14:20:39','komang',0,170000,200000,30000,170000),
('2050721000001',2,'2021-07-05 10:36:26','andi',0,10000,10000,0,10000),
('280621000001',1,'2021-06-28 14:44:36','komang',0,20000,50000,30000,20000);

/*Table structure for table `tutupkasiran` */

DROP TABLE IF EXISTS `tutupkasiran`;

CREATE TABLE `tutupkasiran` (
  `id_tutup` varchar(10) NOT NULL,
  `jenis` varchar(100) DEFAULT NULL,
  `tgl_tutup` timestamp NOT NULL DEFAULT current_timestamp(),
  `penjualan` double DEFAULT NULL,
  `retur` double DEFAULT NULL,
  `order` double DEFAULT NULL,
  `tunai_debit_credit` varchar(10) DEFAULT NULL,
  `totaltbc` double DEFAULT NULL,
  `penjualan_bersih` double DEFAULT NULL,
  PRIMARY KEY (`id_tutup`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tutupkasiran` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `status` varchar(2) DEFAULT '1',
  `level` varchar(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `id_toko` int(10) DEFAULT NULL,
  `id_suplier` int(10) DEFAULT NULL,
  PRIMARY KEY (`username`),
  KEY `id_toko` (`id_toko`),
  KEY `id_suplier` (`id_suplier`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`),
  CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_suplier`) REFERENCES `suplier` (`id_suplier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`username`,`password`,`name`,`no_telp`,`alamat`,`gender`,`status`,`level`,`created_at`,`updated_at`,`id_toko`,`id_suplier`) values 
('admin','$2y$10$GCFJaezoqadO96ifcy4Ucek2W6uj.44jYIFuG4s2t0umIQyyWKNUG','Admin','087736784410','JL,Merdeka','Perempuan','1','Admin','2021-05-21 21:07:32','2021-06-10 10:13:36',NULL,NULL),
('andi','$2y$10$WOF4TymM8aPGDPDQk9l3UO5NgxCAZ75mOEJFJRrjrHEfk/ZMSzmZO','Andi','089087896554','Jl,Mengwi','Laki-Laki','1','Kasir','2021-06-04 09:18:41','2021-06-04 09:18:44',2,NULL),
('cinta','$2y$10$bG8f1FWRtOrnf6Cw3xAwbOIkkEJ4AiDJo7LKRuaoleKY4nJAOX/Z6','Cinta Laura',NULL,'Jl,Majapahit','Perempuan','1','Kasir','2021-06-10 15:43:31','2021-06-10 09:42:53',3,NULL),
('eka','$2y$10$X4e66ULdvYV3zkDsGvi22ude/mZrs8HkBNvgxa4pQ9QOkFmGRF8C2','Kadek Eka','09876554457','JL. Mataram','Laki-Laki','1','Kasir','2021-05-28 19:55:14','2021-06-21 11:42:12',4,NULL),
('Komang','$2y$10$2suy3mapzu7BjuYSY4Xahu47DukWBrnKy1i8ABWFlvGi.XkLKudPW','Komang','09876554457','Kuta, Badung','Perempuan','1','Kasir','2021-05-25 10:03:30','2021-06-21 11:21:40',1,NULL),
('putu','$2y$10$fRknSU.3LHEXPHY6OaCcN.Sgke17.q3RLDK/fV6GdkyyuIsO4zCtm','Putu','087736784410','Jl. Abianbase','Perempuan','1','Owner','2021-06-05 09:29:08','2021-06-05 09:29:13',NULL,NULL),
('sinta','$2y$10$ArVePphX65AKv96alufC8uuDYAjSZZ6/S1wvG8h7YFKzJ4TsJA6cy','Sinta','087645332676','Jl. Abianbase','Perempuan','1','Suplier','2021-06-07 10:39:14','2021-06-07 10:39:17',NULL,1),
('user','$2y$10$gitSnwNMaW9G0Oa8J8HXBOgk8MnR729rChvhgaKByJEYwgl7iaMQm','user',NULL,'Jl. Abianbase','Perempuan','1','Gudang','2021-05-25 10:13:19','2021-05-25 10:21:36',NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
