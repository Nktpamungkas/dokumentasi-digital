-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2018 at 05:19 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asm`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_departemen`
--

CREATE TABLE `tb_departemen` (
  `id_dep` int(11) NOT NULL,
  `nama_dep` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_departemen`
--

INSERT INTO `tb_departemen` (`id_dep`, `nama_dep`) VALUES
(1, 'Managemen Information System'),
(2, 'Human Resource Development'),
(4, 'Autocad Civil'),
(5, 'Autocad Manufakture');

-- --------------------------------------------------------

--
-- Table structure for table `tb_dokumen`
--

CREATE TABLE `tb_dokumen` (
  `id_dok` int(11) NOT NULL,
  `id_staff` varchar(10) DEFAULT NULL,
  `id_folder` int(11) DEFAULT NULL,
  `nama_dok` varchar(100) DEFAULT NULL,
  `nama_ori` varchar(100) DEFAULT NULL,
  `jenis_dok` varchar(50) DEFAULT NULL,
  `ukuran` int(50) DEFAULT NULL,
  `jml_download` int(50) DEFAULT NULL,
  `dok_create` datetime DEFAULT NULL,
  `dok_status` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_dokumen`
--

INSERT INTO `tb_dokumen` (`id_dok`, `id_staff`, `id_folder`, `nama_dok`, `nama_ori`, `jenis_dok`, `ukuran`, `jml_download`, `dok_create`, `dok_status`) VALUES
(6, '1', 30, '9645-data-alumni-balai-latihan-kerja-industri-2015.docx', 'Data Alumni Balai Latihan Kerja Industri 2015', 'docx', 282406, 1, '2017-08-25 11:06:55', '2'),
(7, '1', 33, '2008-profile-blki.docx', 'Profile BLKI', 'docx', 15455, 1, '2017-08-25 11:13:23', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_folder`
--

CREATE TABLE `tb_folder` (
  `id_folder` int(11) NOT NULL,
  `id_staff` int(11) DEFAULT NULL,
  `nama_folder` varchar(100) DEFAULT NULL,
  `folder_create` datetime DEFAULT NULL,
  `folder_status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_folder`
--

INSERT INTO `tb_folder` (`id_folder`, `id_staff`, `nama_folder`, `folder_create`, `folder_status`) VALUES
(30, 1, 'Autocad Civil', '2017-08-25 11:06:36', '1'),
(31, 1, 'Autocad Manufacture', '2017-08-25 11:09:07', '1'),
(32, 1, 'Autocad Sipil', '2017-08-25 11:09:14', '1'),
(33, 1, 'Teknik Mesin', '2017-08-25 11:12:46', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_message`
--

CREATE TABLE `tb_message` (
  `id_mes` int(11) NOT NULL,
  `sender` int(11) DEFAULT NULL,
  `id_dok` int(11) DEFAULT NULL,
  `message` text,
  `mes_create` datetime DEFAULT NULL,
  `mes_status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_message`
--

INSERT INTO `tb_message` (`id_mes`, `sender`, `id_dok`, `message`, `mes_create`, `mes_status`) VALUES
(1, 3, 6, 'Terima Kasih Sudah DI validasi', '2017-08-25 11:08:33', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_notifikasi`
--

CREATE TABLE `tb_notifikasi` (
  `id_notif` int(11) NOT NULL,
  `type` varchar(10) DEFAULT NULL,
  `id_staff` int(11) DEFAULT NULL,
  `kode` varchar(10) DEFAULT NULL,
  `item` varchar(10) DEFAULT NULL,
  `notif_create` datetime DEFAULT NULL,
  `notif_status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_notifikasi`
--

INSERT INTO `tb_notifikasi` (`id_notif`, `type`, `id_staff`, `kode`, `item`, `notif_create`, `notif_status`) VALUES
(4, '1', 1, '3', '6', '2017-08-25 11:07:18', '2'),
(5, '2', 3, '1', '6', '2017-08-25 11:08:33', '2'),
(6, '1', 1, '3', '7', '2017-08-25 11:15:08', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_share`
--

CREATE TABLE `tb_share` (
  `id_share` int(11) NOT NULL,
  `id_dok` int(11) DEFAULT NULL,
  `dok_owner` int(11) DEFAULT NULL,
  `staff_share` int(11) DEFAULT NULL,
  `share_create` datetime DEFAULT NULL,
  `share_status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_share`
--

INSERT INTO `tb_share` (`id_share`, `id_dok`, `dok_owner`, `staff_share`, `share_create`, `share_status`) VALUES
(10, 6, 1, 3, '2017-08-25 11:07:18', '2'),
(11, 7, 1, 3, '2017-08-25 11:15:08', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_staff`
--

CREATE TABLE `tb_staff` (
  `id_staff` int(11) NOT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `staff_create` date DEFAULT NULL,
  `staff_status` varchar(2) DEFAULT NULL,
  `departemen` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_staff`
--

INSERT INTO `tb_staff` (`id_staff`, `nik`, `nama`, `password`, `jabatan`, `staff_create`, `staff_status`, `departemen`) VALUES
(1, '1304030092', 'Admin', '123', 'IT Staff', '2016-01-31', '1', '2'),
(2, '1304030092', 'Nilo', '12345678', 'HR Manager', '2016-01-31', '2', '1'),
(3, '1304030099', 'Ir. Nana Sunarya', 'qwerty', 'Kepala Jurusan Autocad Civil', '2017-07-22', '1', '4'),
(4, '1304030011', 'Diki Kurniawan', 'password', 'Kepala Jurusan Autocad Manufakture', '2017-07-31', '1', '5');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_departemen`
--
ALTER TABLE `tb_departemen`
  ADD PRIMARY KEY (`id_dep`);

--
-- Indexes for table `tb_dokumen`
--
ALTER TABLE `tb_dokumen`
  ADD PRIMARY KEY (`id_dok`);

--
-- Indexes for table `tb_folder`
--
ALTER TABLE `tb_folder`
  ADD PRIMARY KEY (`id_folder`);

--
-- Indexes for table `tb_message`
--
ALTER TABLE `tb_message`
  ADD PRIMARY KEY (`id_mes`);

--
-- Indexes for table `tb_notifikasi`
--
ALTER TABLE `tb_notifikasi`
  ADD PRIMARY KEY (`id_notif`);

--
-- Indexes for table `tb_share`
--
ALTER TABLE `tb_share`
  ADD PRIMARY KEY (`id_share`);

--
-- Indexes for table `tb_staff`
--
ALTER TABLE `tb_staff`
  ADD PRIMARY KEY (`id_staff`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_departemen`
--
ALTER TABLE `tb_departemen`
  MODIFY `id_dep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_dokumen`
--
ALTER TABLE `tb_dokumen`
  MODIFY `id_dok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tb_folder`
--
ALTER TABLE `tb_folder`
  MODIFY `id_folder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `tb_message`
--
ALTER TABLE `tb_message`
  MODIFY `id_mes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_notifikasi`
--
ALTER TABLE `tb_notifikasi`
  MODIFY `id_notif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tb_share`
--
ALTER TABLE `tb_share`
  MODIFY `id_share` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tb_staff`
--
ALTER TABLE `tb_staff`
  MODIFY `id_staff` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
