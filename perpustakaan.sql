-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `kategori_buku`;
CREATE TABLE `kategori_buku` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

TRUNCATE `kategori_buku`;
INSERT INTO `kategori_buku` (`id`, `nama`) VALUES
(1,	'Web Programming'),
(2,	'Non Web Programming');

DROP TABLE IF EXISTS `anggota`;
CREATE TABLE `anggota` (
  `nim` varchar(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  PRIMARY KEY (`nim`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

TRUNCATE `anggota`;
INSERT INTO `anggota` (`nim`, `nama`, `jurusan`) VALUES
('100',	'Dewi',	'Sistem Informasi'),
('200',	'M Asad',	'Sistem Informasi'),
('300',	'Ali',	'Teknik Informatika'),
('400',	'Bagus',	'Sistem Informasi');

DROP TABLE IF EXISTS `buku`;
CREATE TABLE `buku` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kategori_id` int(10) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `stok` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

TRUNCATE `buku`;
INSERT INTO `buku` (`id`, `kategori_id`, `judul`, `stok`) VALUES
(1,	1,	'PHP Fundamental',	10),
(2,	2,	'JAVA for Beginner',	15),
(3,	2,	'Phyton is Easy',	30),
(4,	2,	'Android Development',	5),
(5,	1,	'HTML Tutorial',	30);

DROP TABLE IF EXISTS `denda`;
CREATE TABLE `denda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` varchar(255) NOT NULL,
  `biaya` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

TRUNCATE `denda`;
INSERT INTO `denda` (`id`, `jenis`, `biaya`) VALUES
(1,	'Terlambat',	10000),
(2,	'Buku Rusak',	30000),
(3,	'Buku Hilang',	100000);

DROP TABLE IF EXISTS `petugas`;
CREATE TABLE `petugas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

TRUNCATE `petugas`;
INSERT INTO `petugas` (`id`, `nama`) VALUES
(1,	'Rahmat'),
(2,	'Inna');

DROP TABLE IF EXISTS `peminjaman`;
CREATE TABLE `peminjaman` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nim` varchar(15) NOT NULL,
  `petugas_id` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `batas_tanggal_kembali` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKpeminjaman212020` (`nim`),
  KEY `FKpeminjaman186144` (`petugas_id`),
  CONSTRAINT `FKpeminjaman186144` FOREIGN KEY (`petugas_id`) REFERENCES `petugas` (`id`),
  CONSTRAINT `FKpeminjaman212020` FOREIGN KEY (`nim`) REFERENCES `anggota` (`nim`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

TRUNCATE `peminjaman`;
INSERT INTO `peminjaman` (`id`, `nim`, `petugas_id`, `tanggal_pinjam`, `batas_tanggal_kembali`) VALUES
(1,	'100',	1,	'2020-03-01',	'2020-03-07'),
(2,	'200',	1,	'2020-03-02',	'2020-03-08'),
(3,	'100',	2,	'2020-03-10',	'2020-03-17'),
(4,	'300',	2,	'2020-03-05',	'2020-03-12'),
(5,	'400',	1,	'2020-03-05',	'2020-03-12'),
(6,	'100',	2,	'2020-03-20',	'2020-03-27');

DROP TABLE IF EXISTS `peminjaman_buku`;
CREATE TABLE `peminjaman_buku` (
  `peminjaman_id` int(10) NOT NULL,
  `buku_id` int(10) NOT NULL,
  PRIMARY KEY (`peminjaman_id`,`buku_id`),
  KEY `FKpeminjaman210373` (`peminjaman_id`),
  KEY `FKpeminjaman870930` (`buku_id`),
  CONSTRAINT `FKpeminjaman210373` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjaman` (`id`),
  CONSTRAINT `FKpeminjaman870930` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

TRUNCATE `peminjaman_buku`;
INSERT INTO `peminjaman_buku` (`peminjaman_id`, `buku_id`) VALUES
(1,	1),
(1,	3),
(1,	4),
(2,	2),
(2,	3),
(3,	2),
(3,	4),
(3,	5),
(4,	1),
(4,	5),
(5,	2),
(5,	4),
(5,	5),
(6,	1),
(6,	4);

DROP TABLE IF EXISTS `pengembalian`;
CREATE TABLE `pengembalian` (
  `peminjaman_id` int(10) NOT NULL,
  `petugas_id` int(11) NOT NULL,
  `tanggal_kembali` date NOT NULL,
  PRIMARY KEY (`peminjaman_id`),
  KEY `petugas_id` (`petugas_id`),
  CONSTRAINT `pengembalian_ibfk_1` FOREIGN KEY (`petugas_id`) REFERENCES `petugas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

TRUNCATE `pengembalian`;
INSERT INTO `pengembalian` (`peminjaman_id`, `petugas_id`, `tanggal_kembali`) VALUES
(1,	1,	'2020-03-06'),
(2,	2,	'2020-03-10'),
(4,	2,	'2020-03-12'),
(5,	2,	'2020-03-20');

DROP TABLE IF EXISTS `pengembalian_denda`;
CREATE TABLE `pengembalian_denda` (
  `peminjaman_id` int(10) NOT NULL,
  `denda_id` int(11) NOT NULL,
  `qty` double NOT NULL,
  `nominal` double NOT NULL,
  PRIMARY KEY (`peminjaman_id`,`denda_id`),
  KEY `denda_id` (`denda_id`),
  CONSTRAINT `pengembalian_denda_ibfk_1` FOREIGN KEY (`denda_id`) REFERENCES `denda` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

TRUNCATE `pengembalian_denda`;
INSERT INTO `pengembalian_denda` (`peminjaman_id`, `denda_id`, `qty`, `nominal`) VALUES
(2,	1,	2,	20000),
(4,	3,	1,	100000),
(5,	1,	8,	80000),
(5,	2,	2,	60000),
(5,	3,	1,	100000);


-- 2020-03-14 08:43:41
