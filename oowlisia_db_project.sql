-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 03, 2022 at 10:42 PM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oowlisia_db_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_bidang`
--

CREATE TABLE `tb_bidang` (
  `bidangID` int(11) NOT NULL,
  `bidangNama` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_bidang`
--

INSERT INTO `tb_bidang` (`bidangID`, `bidangNama`) VALUES
(1, 'Marine'),
(2, 'Minerba'),
(3, 'Internal');

-- --------------------------------------------------------

--
-- Table structure for table `tb_client`
--

CREATE TABLE `tb_client` (
  `clientID` varchar(50) NOT NULL,
  `clientNPWP` varchar(255) DEFAULT NULL,
  `clientNama` varchar(255) DEFAULT NULL,
  `clientUsername` varchar(255) DEFAULT NULL,
  `clientPassword` varchar(255) DEFAULT NULL,
  `clientTglLahir` datetime DEFAULT NULL,
  `clientJenisKelamin` varchar(255) DEFAULT NULL,
  `clientAlamat` text,
  `clientTelepon` varchar(255) DEFAULT NULL,
  `clientEmail` varchar(255) DEFAULT NULL,
  `clientFotoProfil` varchar(255) DEFAULT NULL,
  `clientPerusahaan_nama` varchar(255) DEFAULT NULL,
  `clientPerusahaan_jabatan` varchar(255) DEFAULT NULL,
  `clientPerusahaan_email` varchar(255) DEFAULT NULL,
  `clientPerusahaan_telepon` varchar(255) DEFAULT NULL,
  `clientPerusahaan_alamat` text,
  `clientWaktu` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_client`
--

INSERT INTO `tb_client` (`clientID`, `clientNPWP`, `clientNama`, `clientUsername`, `clientPassword`, `clientTglLahir`, `clientJenisKelamin`, `clientAlamat`, `clientTelepon`, `clientEmail`, `clientFotoProfil`, `clientPerusahaan_nama`, `clientPerusahaan_jabatan`, `clientPerusahaan_email`, `clientPerusahaan_telepon`, `clientPerusahaan_alamat`, `clientWaktu`) VALUES
('2001021230005', '12345678912323', 'coba123', 'coba123', '34f70892f40cd3b2a340769c070c4f1a02335d87', '1981-10-02 00:00:00', '1', 'jl coba123', '08123456789122', '12345678912323', 'profil-210102-6d7e6c1936.jpg', 'jl coba1233', 'jl coba123', 'jl coba123', 'jl coba123', 'jl coba123', '2021-03-22 07:55:52'),
('2001271230005', '123456123456', 'coba12345', 'coba12345', '14efc62e51161c7aaa3993438d911927fbb009a1', '1987-06-26 00:00:00', '1', NULL, '08123451234', 'coba12345@gmail.com', 'default.jpg', NULL, NULL, NULL, NULL, NULL, '2021-01-27 22:47:30'),
('2002261230005', '123456789', 'coba321', 'coba321', '97c6953964e6ab83efbf6dfc9655a443e5fec416', '1986-06-28 00:00:00', '1', 'jl kusumanegara', '08123456789', '123456789', 'profil-210226-1126ed8a89.jpg', 'PT Sejahtera', 'CEO', 'sejahtera@gmail.com', '0812345678', 'jl Sejahtera', '2021-02-25 21:56:27'),
('2003109870005', '987654321', 'Satya', 'satya', 'fdf564b638c276f4f61bdb88b06f9bb0f8331a8c', '1982-10-10 00:00:00', '1', NULL, '08123445759', 'gula@gmail.com', 'default.jpg', NULL, NULL, NULL, NULL, NULL, '2021-03-10 10:29:04'),
('2003211230005', '123456123', 'uji1321', 'uji1321', 'eb291a099fda72887034546d3298ae3750b8db28', '1991-02-21 00:00:00', '1', 'jl Kusumanegara', '08123123456', '123456123', 'default.jpg', 'PT ABCD', 'MANAGER', 'abcd@gmail.com', '081232122', 'jl.kusumanegara', '2021-03-21 09:40:29'),
('2003220320005', '032573966008000', 'Sony Akbar', 'owlsa', '5eaa7c2f51dcdfee8fe5bd254fbbd6f49c1b0fb4', '1985-02-15 00:00:00', '1', NULL, '+6281385781221', 'ho.marine@oowl-indonesia.com', 'default.jpg', NULL, NULL, NULL, NULL, NULL, '2021-03-22 09:59:18'),
('2003220980005', '098789010', 'Budi Jatmiko', 'Jatmiko122', '2f4f5f98dd0c4282f3fad66c8ca438d577960095', '1980-03-03 00:00:00', '1', 'Jl. Maguwo 77 ', '089876768878', '098789010', 'default.jpg', 'PT. KLOMANO', 'Manager Operasional', 'jatmiko@gmail.com', '0867789876', 'Jl. Maguwo NO.77', '2021-03-22 08:11:21'),
('2003221230005', '123212343', 'Tony', 'tony123', '07f28c60219266b46a04b61382e4aff1b8e4fb45', '1989-10-01 00:00:00', '1', 'Jl. ZMZagiwoo', '081228752019', '123212343', 'default.jpg', 'PT. DSAERH', 'SPV', 'tony667@gmail.com', '0867789876', 'Jl. Maguwo', '2021-03-22 08:06:34'),
('200322cob0005', 'coba002', 'coba002', 'coba002', '3e2b24d9eb4f6dfc2f840c283c46988b8c507159', '1989-06-22 00:00:00', '1', NULL, '08111112323', 'coba002@gmail.com', 'default.jpg', NULL, NULL, NULL, NULL, NULL, '2021-03-22 08:03:45'),
('2003238130005', '813894151032000', 'Bintang Setiawan', 'goukabs', '3cc1a8071fcc1daefb4256b6133b67dea5e386ff', '1978-03-23 00:00:00', '1', 'Tinggiran II, Tamban, Barito Kuala Regency, South Kalimantan 70582', '+628115004680', 'bintangsetiawan521@gmail.com', 'profil-210323-045cb03aa3.PNG', 'PT. GOUKA INDO ENERGY', 'Operations', 'bintangsetiawan521@gmail.com', '+628115004680', 'Tinggiran II, Tamban, Barito Kuala Regency, South Kalimantan 70582', '2021-03-22 23:47:40'),
('2003249870005', '9876789000122', 'Heru Wahyuy', 'heruwahyu21', 'a112cd2d65ab6a42ffce64e91236c383e0b38a4c', '1990-10-10 00:00:00', '1', 'Banjarbaru No 98', '087865766598', '9876789000122', 'default.jpg', 'PT KMNJO BAKTI', 'Manager Operasional', 'heruwahyu21@gmail.com', '087865676647', 'Banjarbaru NO 98', '2021-03-24 04:13:00'),
('2003251280005', '128987656009', 'Andi Harmena', 'andihar123', '9ba7281e17fee9435fffff12ba27c95449763bc2', '1989-10-10 00:00:00', '1', 'Jalan Bangau No 77', '081344567789', '128987656009', 'default.jpg', 'PT ABCDEFGH ', 'Manager', 'andihar123', '085789980990', 'Jalan Bangau No 77', '2021-03-25 03:20:47'),
('20032593.0005', '93.324.713.2-731.000', 'V. Talenta', 'talenta', '8cb2237d0679ca88db6464eac60da96345513964', '1964-04-24 00:00:00', '2', 'Banjarbaru', '082156616686', '93.324.713.2-731.000', 'default.jpg', 'PT. Cordelia Bara Utama', 'Direktur', 'operation@cordeliagroup.co', '082156616686', 'Banjarbaru', '2021-03-25 03:21:27'),
('2012281230001', '1234567', 'rahmat kumanegara', 'client1', 'd642fef420c5baa4c72f53de9426f1ed699899e2', '2020-12-28 00:00:00', 'laki-laki', 'jl. kusuma negara', '0812345566', 'rahmat@gmail.com', NULL, 'PT. Jaya Kusuma', 'Manager', 'jayakusuma@gmail.com', '08123456', 'jl, kusuma negara', '2020-12-28 21:07:35'),
('2012281240004', '12454665767', 'alberto xfaianes', 'client3', 'cfab47a21798390d18aff84a6a5e4a510f2fed93', '2020-12-28 00:00:00', 'laki-laki', NULL, '08235345', 'dfsdgdfg', NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-28 21:24:49'),
('2012282460004', '24634564576', 'sdgdfghdfh', 'client2', '0cf3a452af4baf920c5e381be5f542007639a275', '2020-12-28 00:00:00', 'laki-laki', 'rrhrh', '08235345', '24634564576', 'profil-201229-bca31f7843.png', 'rrhrh', 'rrhrh', 'rrhrh', 'rrhrh', 'rrhrh', '2020-12-29 01:44:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_clientproject`
--

CREATE TABLE `tb_clientproject` (
  `projectID` varchar(50) NOT NULL,
  `projectclientID` varchar(50) DEFAULT NULL,
  `projectbidangID` int(11) DEFAULT NULL,
  `project_statusID` varchar(11) DEFAULT NULL,
  `projectFile` varchar(255) DEFAULT NULL,
  `projectStatusKonf` varchar(255) DEFAULT NULL,
  `komentar` text,
  `waktu` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_clientproject`
--

INSERT INTO `tb_clientproject` (`projectID`, `projectclientID`, `projectbidangID`, `project_statusID`, `projectFile`, `projectStatusKonf`, `komentar`, `waktu`) VALUES
('PRJMAR2001020001', '2001021230005', 1, 'SC1', 'projectClient-210102-999721edaa.pdf', 'read', 'coba 123', '2021-01-02 07:25:22'),
('PRJMAR2001280002', '2001271230005', 1, 'PR1', 'projectClient-210128-04b26a4a7f.pdf', 'read', 'fdf', '2021-01-28 00:18:05'),
('PRJMAR2002040003', '2001021230005', 1, 'SC1', 'projectClient-210204-1e2a949543.pdf', 'read', 'fdfd', '2021-02-03 22:50:01'),
('PRJMAR2002080004', '2001021230005', 1, 'SC1', 'projectClient-210208-34733c2e6d.pdf', 'read', '', '2021-02-08 01:55:27'),
('PRJMAR2002090005', '2001021230005', 1, 'PR1', 'projectClient-210209-b6cbc9680d.pdf', 'read', 'data 1', '2021-02-08 23:58:39'),
('PRJMAR2002260006', '2002261230005', 1, 'SC1', 'projectClient-210226-426ee4439a.pdf', 'read', 'file uji coba', '2021-02-25 21:59:23'),
('PRJMAR2003100007', '2002261230005', 1, 'PR1', 'projectClient-210310-f325b64022.pdf', 'send', '', '2021-03-10 09:00:56'),
('PRJMAR2003100008', '2003109870005', 1, 'PR1', 'projectClient-210310-cea73f3d29.pdf', 'read', 'the third revolution', '2021-03-10 10:31:49'),
('PRJMAR2003210009', '2003211230005', 1, 'PR1', 'projectClient-210321-727886a5fc.pdf', 'read', 'coba data1', '2021-03-21 09:41:13'),
('PRJMAR2003210010', '2003211230005', 1, 'PR1', 'projectClient-210321-5263263a66.pdf', 'read', 'coba1', '2021-03-21 09:45:35'),
('PRJMAR2003210011', '2003211230005', 1, 'SC1', 'projectClient-210321-0ce338d517.pdf', 'read', '', '2021-03-21 11:21:53'),
('PRJMAR2003220012', '2003221230005', 1, 'PR1', 'projectClient-210322-dc26996eff.pdf', 'send', 'Samaan', '2021-03-22 08:02:25'),
('PRJMAR2003220013', '2003221230005', 1, 'PR1', 'projectClient-210322-64ce0cd218.pdf', 'send', 'Samaan', '2021-03-22 08:02:26'),
('PRJMAR2003220014', '2003221230005', 1, 'PR1', 'projectClient-210322-9bdf3131be.pdf', 'send', 'Samaan', '2021-03-22 08:02:26'),
('PRJMAR2003220015', '2003221230005', 1, 'PR1', 'projectClient-210322-c5415791d1.pdf', 'send', 'Samaan', '2021-03-22 08:02:27'),
('PRJMAR2003220016', '2003221230005', 1, 'PR1', 'projectClient-210322-9a12660ce7.pdf', 'send', 'Tes 23/03', '2021-03-22 08:03:34'),
('PRJMAR2003230017', '2003238130005', 1, 'PR1', 'projectClient-210323-c2d831d9aa.pdf', 'read', 'Hold Cleanliness Inspection and Draft Survey on 7 March 2021 at Taboneo Port, South Kalimantan – Indonesia ', '2021-03-22 23:18:15'),
('PRJMIN2001020001', '2001021230005', 2, 'SC1', 'projectClient-210102-2b5bb6070a.pdf', 'read', '', '2021-01-02 07:36:19'),
('PRJMIN2002080002', '2001021230005', 2, 'SC1', 'projectClient-210208-63c8b835ba.pdf', 'read', 'fgf', '2021-02-08 01:09:41'),
('PRJMIN2002270003', '2002261230005', 2, 'SC1', 'projectClient-210227-602f29529c.pdf', 'read', 'Minerba ', '2021-02-27 00:20:38'),
('PRJMIN2003210004', '2003211230005', 2, 'SC1', 'projectClient-210321-67cd9b8877.pdf', 'read', '', '2021-03-21 11:38:30'),
('PRJMIN2003220005', '2003220980005', 2, 'PR1', 'projectClient-210322-848f0fef69.pdf', 'read', '', '2021-03-22 08:11:59'),
('PRJMIN2003240006', '2003249870005', 2, 'PR1', 'projectClient-210324-6d950158cb.pdf', 'read', '', '2021-03-24 04:17:43'),
('PRJMIN2003240007', '2003249870005', 2, 'PR1', 'projectClient-210324-32e7911214.pdf', 'read', 'BARU02', '2021-03-24 04:37:16'),
('PRJMIN2003240008', '2003249870005', 2, 'PR1', 'projectClient-210324-090aef322a.pdf', 'read', '', '2021-03-24 04:58:54'),
('PRJMIN2003240009', '2003249870005', 2, 'PR1', 'projectClient-210324-f85e9edd7c.pdf', 'read', '', '2021-03-24 05:00:26'),
('PRJMIN2003250010', '2003251280005', 2, 'PR1', 'projectClient-210325-6d6cb64c46.pdf', 'read', '', '2021-03-25 02:56:43'),
('PRJMIN2003250011', '2003251280005', 2, 'PR1', 'projectClient-210325-51119c327b.pdf', 'read', '', '2021-03-25 02:56:52'),
('PRJMIN2003250012', '20032593.0005', 2, 'PR1', 'projectClient-210325-6b6490815b.pdf', 'read', '', '2021-03-25 02:58:34'),
('PRJMIN2003250013', '20032593.0005', 2, 'PR1', 'projectClient-210325-37260d376f.pdf', 'read', '', '2021-03-25 03:15:44'),
('PRJMIN2003250014', '2003251280005', 2, 'PR1', 'projectClient-210325-68306f5601.pdf', 'read', '', '2021-03-25 03:17:25'),
('PRJMIN2003250015', '2003251280005', 2, 'PR1', 'projectClient-210325-d5c4908bf1.pdf', 'read', '', '2021-03-25 03:21:10'),
('PRJMIN2003250016', '20032593.0005', 2, 'PR1', 'projectClient-210325-09c026317e.pdf', 'read', '', '2021-03-25 03:22:15');

-- --------------------------------------------------------

--
-- Table structure for table `tb_int_administrasi_suratkeluar`
--

CREATE TABLE `tb_int_administrasi_suratkeluar` (
  `skID` int(11) NOT NULL,
  `suratkeluarNo` varchar(50) DEFAULT NULL,
  `sk_smID` int(11) DEFAULT NULL,
  `sk_petugasID` int(11) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `waktu` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_int_administrasi_suratmasuk`
--

CREATE TABLE `tb_int_administrasi_suratmasuk` (
  `smID` int(11) NOT NULL,
  `suratmasukNo` varchar(50) DEFAULT NULL,
  `sm_petugasID` int(11) DEFAULT NULL,
  `sm_pengirimID` varchar(50) DEFAULT NULL,
  `sm_penerimaID` varchar(50) DEFAULT NULL,
  `suratmasukFile` varchar(255) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `sm_statusID` varchar(11) DEFAULT NULL,
  `statusKonfirmasi` varchar(255) DEFAULT NULL,
  `waktu` datetime DEFAULT CURRENT_TIMESTAMP,
  `waktu_start` datetime DEFAULT NULL,
  `waktu_end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_int_administrasi_suratmasuk`
--

INSERT INTO `tb_int_administrasi_suratmasuk` (`smID`, `suratmasukNo`, `sm_petugasID`, `sm_pengirimID`, `sm_penerimaID`, `suratmasukFile`, `jumlah`, `sm_statusID`, `statusKonfirmasi`, `waktu`, `waktu_start`, `waktu_end`) VALUES
(29, 'SM-006', 17, 'HR', 'FM', 'smFile-NW1-210117-6521a68452.pdf', 0, 'NW1', 'send', '2021-01-17 16:25:05', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_int_honorarium_approval`
--

CREATE TABLE `tb_int_honorarium_approval` (
  `approvDetailID` int(11) NOT NULL,
  `pengeluaranID` varchar(11) DEFAULT NULL,
  `approv_budgethonorID` int(11) DEFAULT NULL,
  `aproval_petugasID` int(255) DEFAULT NULL,
  `aproval_pengirimID` varchar(11) DEFAULT NULL,
  `aproval_penerimaID` varchar(11) DEFAULT NULL,
  `aproval_statusID` varchar(11) DEFAULT NULL,
  `aprovalFile` varchar(255) DEFAULT NULL,
  `aprovalStatusKonf` varchar(255) DEFAULT NULL,
  `approvalComment` text,
  `aprovalWaktu` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_int_honorarium_approval`
--

INSERT INTO `tb_int_honorarium_approval` (`approvDetailID`, `pengeluaranID`, `approv_budgethonorID`, `aproval_petugasID`, `aproval_pengirimID`, `aproval_penerimaID`, `aproval_statusID`, `aprovalFile`, `aprovalStatusKonf`, `approvalComment`, `aprovalWaktu`) VALUES
(14, 'REF-002', 36, 16, 'FM', 'HR', 'NW1', 'approvalFile-file-201222-985f78f1cc.pdf', 'read', 'fefe', '2020-12-22 23:03:06'),
(15, 'REF-003', 37, 16, 'FM', 'HR', 'NW1', 'approvalFile-file-201223-f2395a48c3.pdf', 'read', 'fefe', '2020-12-23 00:00:11');

-- --------------------------------------------------------

--
-- Table structure for table `tb_int_honorarium_budgethonor`
--

CREATE TABLE `tb_int_honorarium_budgethonor` (
  `budgethonorID` int(11) NOT NULL,
  `budgethonorNo` varchar(50) DEFAULT NULL,
  `budgetH_petugasID` int(11) DEFAULT NULL,
  `budgetH_pengirimID` varchar(50) DEFAULT NULL,
  `budgetH_penerimaID` varchar(50) DEFAULT NULL,
  `budgetH_statusID` varchar(11) DEFAULT NULL,
  `budgetHFile` varchar(255) DEFAULT NULL,
  `budgetHJumlah` varchar(255) DEFAULT NULL,
  `budgetHStatusKonf` varchar(255) DEFAULT NULL,
  `budgetHComment` text,
  `budgetHWaktu` datetime DEFAULT CURRENT_TIMESTAMP,
  `budgetHWaktu_start` datetime DEFAULT NULL,
  `budgetHWaktu_end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_int_honorarium_budgethonor`
--

INSERT INTO `tb_int_honorarium_budgethonor` (`budgethonorID`, `budgethonorNo`, `budgetH_petugasID`, `budgetH_pengirimID`, `budgetH_penerimaID`, `budgetH_statusID`, `budgetHFile`, `budgetHJumlah`, `budgetHStatusKonf`, `budgetHComment`, `budgetHWaktu`, `budgetHWaktu_start`, `budgetHWaktu_end`) VALUES
(33, 'BDH2012220001', 17, 'HR', 'FM', 'NW1', 'budgetHFile-NW1-201222-bdcbb76cfc.pdf', '0', 'read', 'wsgfd', '2020-12-22 22:23:53', '2020-12-22 22:24:29', '2020-12-22 22:44:29'),
(34, 'BDH2012220001', 16, 'FM', 'HR', 'FD1', 'budgetHFile-FD1-201222-2db9c6fc0d.pdf', '0', 'read', 'dwdw', '2020-12-22 22:25:21', '2020-12-22 22:33:33', '2020-12-22 22:53:33'),
(35, 'BDH2012220001', 17, 'HR', 'FM', 'SC1', 'budgetHFile-RV1-201222-d18cbdb847.pdf', '1', 'read', 'fefe', '2020-12-22 22:34:23', '2020-12-22 22:34:35', '2020-12-22 22:54:35'),
(36, 'BDH2012220002', 17, 'HR', 'FM', 'SC1', 'budgetHFile-NW1-201222-076182b650.pdf', '0', 'read', 'fwfwf', '2020-12-22 23:02:45', '2020-12-22 23:02:57', '2020-12-22 23:22:57'),
(37, 'BDH2012220003', 17, 'HR', 'FM', 'SC1', 'budgetHFile-NW1-201222-b9e4d47508.pdf', '0', 'read', 'efe', '2020-12-22 23:59:47', '2020-12-23 00:00:02', '2020-12-23 00:20:02');

-- --------------------------------------------------------

--
-- Table structure for table `tb_int_honorarium_inventaris`
--

CREATE TABLE `tb_int_honorarium_inventaris` (
  `inventarisID` varchar(50) NOT NULL,
  `invent_approvDetailID` int(11) DEFAULT NULL,
  `invent_budgethonorID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_int_honorarium_inventaris`
--

INSERT INTO `tb_int_honorarium_inventaris` (`inventarisID`, `invent_approvDetailID`, `invent_budgethonorID`) VALUES
('INVT2012220001', 14, 36),
('INVT2012230002', 15, 37);

-- --------------------------------------------------------

--
-- Table structure for table `tb_int_honorarium_inventarisdetail`
--

CREATE TABLE `tb_int_honorarium_inventarisdetail` (
  `inventarisdetailID` int(11) NOT NULL,
  `inventD_inventarisID` varchar(50) DEFAULT NULL,
  `inventD_petugasID` int(11) DEFAULT NULL,
  `inventD_pengirimID` varchar(50) DEFAULT NULL,
  `inventD_penerimaID` varchar(50) DEFAULT NULL,
  `inventD_statusID` varchar(11) DEFAULT NULL,
  `inventDFile` varchar(255) DEFAULT NULL,
  `inventDJumlah` int(11) DEFAULT NULL,
  `inventDstatusKonf` varchar(255) DEFAULT NULL,
  `inventComment` text,
  `inventDWaktu` datetime DEFAULT CURRENT_TIMESTAMP,
  `inventDWaktu_start` datetime DEFAULT NULL,
  `inventDWaktu_end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_int_honorarium_inventarisdetail`
--

INSERT INTO `tb_int_honorarium_inventarisdetail` (`inventarisdetailID`, `inventD_inventarisID`, `inventD_petugasID`, `inventD_pengirimID`, `inventD_penerimaID`, `inventD_statusID`, `inventDFile`, `inventDJumlah`, `inventDstatusKonf`, `inventComment`, `inventDWaktu`, `inventDWaktu_start`, `inventDWaktu_end`) VALUES
(12, 'INVT2012220001', 17, 'HR', 'FM', 'RJ1', 'inventarisFile-NW1-201222-703b65bd2c.pdf', 0, 'read', 'undefined', '2020-12-22 23:31:01', '2020-12-22 23:45:04', '2020-12-22 23:46:04'),
(13, 'INVT2012230002', 17, 'HR', 'FM', 'NW1', 'inventarisFile-NW1-201223-4c1f54c0a1.pdf', 0, 'read', 'fdfd', '2020-12-23 00:00:39', '2020-12-23 00:00:56', '2020-12-23 00:19:56'),
(14, 'INVT2012230002', 16, 'FM', 'HR', 'FD1', 'inventarisFile-FD1-201223-a56fa3a7bb.pdf', 0, 'read', 'fef', '2020-12-23 00:03:06', '2020-12-23 00:15:45', '2020-12-23 00:34:45'),
(15, 'INVT2012230002', 17, 'HR', 'FM', 'RV1', 'inventarisFile-RV1-201223-9b72e751b8.pdf', 1, 'read', NULL, '2020-12-23 00:23:45', '2020-12-23 00:24:27', '2020-12-23 00:43:27');

-- --------------------------------------------------------

--
-- Table structure for table `tb_int_pengadaan_approval`
--

CREATE TABLE `tb_int_pengadaan_approval` (
  `approvPBlID` int(11) NOT NULL,
  `approvPB_lbdetailID` int(11) DEFAULT NULL,
  `approvPB_notadinasID` varchar(50) DEFAULT NULL,
  `approvPB_pencairanbudgetID` varchar(50) DEFAULT NULL,
  `approvPB_bdlDetailID` int(11) DEFAULT NULL,
  `approvPB_listbelanjaID` int(11) DEFAULT NULL,
  `approvPB_pattycashID` int(11) DEFAULT NULL,
  `approvPB_bidangID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_int_pengadaan_approval`
--

INSERT INTO `tb_int_pengadaan_approval` (`approvPBlID`, `approvPB_lbdetailID`, `approvPB_notadinasID`, `approvPB_pencairanbudgetID`, `approvPB_bdlDetailID`, `approvPB_listbelanjaID`, `approvPB_pattycashID`, `approvPB_bidangID`) VALUES
(1, 30, 'NDP2012230004', 'PBG2012230005', 54, 35, 101, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_int_pengadaan_laporanbelanja`
--

CREATE TABLE `tb_int_pengadaan_laporanbelanja` (
  `laporanbelanjaID` varchar(50) NOT NULL,
  `laporanb_notadinasID` varchar(50) DEFAULT NULL,
  `laporanb_pencairanbudgetID` varchar(50) DEFAULT NULL,
  `laporanb_bddetailID` int(11) DEFAULT NULL,
  `laporanb_listbelanjaID` int(11) DEFAULT NULL,
  `laporanb_pattycashID` int(11) DEFAULT NULL,
  `laporanb_bidangID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_int_pengadaan_laporanbelanja`
--

INSERT INTO `tb_int_pengadaan_laporanbelanja` (`laporanbelanjaID`, `laporanb_notadinasID`, `laporanb_pencairanbudgetID`, `laporanb_bddetailID`, `laporanb_listbelanjaID`, `laporanb_pattycashID`, `laporanb_bidangID`) VALUES
('PLB2012220001', 'NDP2012220001', 'PBG2012220002', 48, 32, 94, 1),
('PLB2012220002', 'NDP2012220002', 'PBG2012220003', 50, 33, 95, 1),
('PLB2012230003', 'NDP2012230004', 'PBG2012230005', 54, 35, 101, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_int_pengadaan_laporanbelanjadetail`
--

CREATE TABLE `tb_int_pengadaan_laporanbelanjadetail` (
  `lbDetailID` int(11) NOT NULL,
  `lbd_laporanbelanjaID` varchar(50) DEFAULT NULL,
  `lbd_petugasID` int(11) DEFAULT NULL,
  `lbd_pengirimID` varchar(50) DEFAULT NULL,
  `lbd_penerimaID` varchar(50) DEFAULT NULL,
  `lbd_statusID` varchar(11) DEFAULT NULL,
  `lbdFile` varchar(255) DEFAULT NULL,
  `lbdJumlah` int(11) DEFAULT NULL,
  `lbdStatusKonf` varchar(255) DEFAULT NULL,
  `lbdComment` text,
  `lbdWaktu` datetime DEFAULT CURRENT_TIMESTAMP,
  `lbdWaktu_start` datetime DEFAULT NULL,
  `lbdWaktu_end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_int_pengadaan_laporanbelanjadetail`
--

INSERT INTO `tb_int_pengadaan_laporanbelanjadetail` (`lbDetailID`, `lbd_laporanbelanjaID`, `lbd_petugasID`, `lbd_pengirimID`, `lbd_penerimaID`, `lbd_statusID`, `lbdFile`, `lbdJumlah`, `lbdStatusKonf`, `lbdComment`, `lbdWaktu`, `lbdWaktu_start`, `lbdWaktu_end`) VALUES
(19, 'PLB2012220001', 18, 'GA', 'HR', 'RJ1', 'lbFile-NW1-201222-f307db42c8.pdf', 0, 'read', 'dwdwd', '2020-12-22 15:40:10', '2020-12-22 15:43:21', '2020-12-22 15:44:21'),
(20, 'PLB2012220002', 18, 'GA', 'HR', 'NW1', 'lbFile-NW1-201222-066d5ef61a.pdf', 0, 'read', 'asss', '2020-12-22 16:15:28', '2020-12-22 16:15:44', '2020-12-22 16:35:44'),
(24, 'PLB2012220002', 17, 'HR', 'FM', 'NW1', 'lbFile-NW1-201222-066d5ef61a.pdf', 0, 'read', 'dwd', '2020-12-22 16:30:18', '2020-12-22 16:30:40', '2020-12-22 16:50:40'),
(25, 'PLB2012220002', 16, 'FM', 'HR', 'FD1', 'lbFile-FD1-201222-603266fe9c.pdf', 0, 'read', NULL, '2020-12-22 16:31:17', '2020-12-22 16:35:40', '2020-12-22 16:55:40'),
(26, 'PLB2012220002', 17, 'HR', 'GA', 'FD1', 'lbFile-FD1-201222-603266fe9c.pdf', 0, 'read', 'dwdw', '2020-12-22 16:49:26', '2020-12-22 16:50:05', '2020-12-22 17:10:05'),
(27, 'PLB2012220002', 18, 'GA', 'HR', 'RV1', 'lbFile-RV1-201222-6949865112.pdf', 1, 'read', NULL, '2020-12-22 16:50:17', '2020-12-22 16:50:33', '2020-12-22 17:10:33'),
(28, 'PLB2012220002', 17, 'HR', 'FM', 'RJ1', 'lbFile-RV1-201222-6949865112.pdf', 1, 'read', 'ffef', '2020-12-22 16:50:37', '2020-12-22 16:50:52', '2020-12-22 17:10:52'),
(29, 'PLB2012230003', 18, 'GA', 'HR', 'NW1', 'lbFile-NW1-201223-60dbcfdc93.pdf', 0, 'read', 'grsg', '2020-12-23 20:06:41', '2020-12-23 20:07:09', '2020-12-23 20:27:09'),
(30, 'PLB2012230003', 17, 'HR', 'FM', 'NW1', 'lbFile-NW1-201223-60dbcfdc93.pdf', 0, 'read', 'fghfg', '2020-12-23 20:07:27', '2020-12-23 20:07:55', '2020-12-23 20:57:55');

-- --------------------------------------------------------

--
-- Table structure for table `tb_int_pengadaan_listbelanja`
--

CREATE TABLE `tb_int_pengadaan_listbelanja` (
  `listbelanjaID` int(11) NOT NULL,
  `listbelanjaNo` varchar(50) DEFAULT NULL,
  `lb_pattycashID` int(11) DEFAULT NULL,
  `lb_bidangID` int(11) DEFAULT NULL,
  `lb_petugasID` int(11) DEFAULT NULL,
  `lb_pengirimID` varchar(50) DEFAULT NULL,
  `lb_penerimaID` varchar(50) DEFAULT NULL,
  `lb_statusID` varchar(11) DEFAULT NULL,
  `lbPeriodicFile` varchar(255) DEFAULT NULL,
  `lbInsidentilFile` varchar(255) DEFAULT NULL,
  `lbStatusKonf` varchar(255) DEFAULT NULL,
  `lbComment` text,
  `lbWaktu` datetime DEFAULT CURRENT_TIMESTAMP,
  `lbWaktu_start` datetime DEFAULT NULL,
  `lbWaktu_end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_int_pengadaan_listbelanja`
--

INSERT INTO `tb_int_pengadaan_listbelanja` (`listbelanjaID`, `listbelanjaNo`, `lb_pattycashID`, `lb_bidangID`, `lb_petugasID`, `lb_pengirimID`, `lb_penerimaID`, `lb_statusID`, `lbPeriodicFile`, `lbInsidentilFile`, `lbStatusKonf`, `lbComment`, `lbWaktu`, `lbWaktu_start`, `lbWaktu_end`) VALUES
(31, 'LBP2012220001', 91, 1, 17, 'HR', 'GA', 'SC1', 'filePeriodic-file-201222-cc55e5f335.pdf', 'fileInsidentil-file-201222-52de6e6d90.pdf', 'read', 'dw', '2020-12-22 09:08:23', '2020-12-22 09:08:42', '2020-12-22 09:18:42'),
(32, 'LBP2012220002', 94, 1, 17, 'HR', 'GA', 'SC1', 'filePeriodic-file-201222-460429853d.pdf', 'fileInsidentil-file-201222-5ecde9e881.pdf', 'read', 'dw', '2020-12-22 09:19:44', '2020-12-22 09:20:03', '2020-12-22 09:30:03'),
(33, 'LBP2012220003', 95, 1, 17, 'HR', 'GA', 'SC1', 'filePeriodic-file-201222-b06b0f717a.pdf', 'fileInsidentil-file-201222-deff018263.pdf', 'read', 'fff', '2020-12-22 16:09:45', '2020-12-22 16:09:59', '2020-12-22 16:19:59'),
(34, 'LBP2012230004', 100, 1, 17, 'HR', 'GA', 'SC1', 'filePeriodic-file-201223-bf1f4a1a1f.pdf', 'fileInsidentil-file-201223-18a192c105.pdf', 'read', 'grgrg', '2020-12-23 17:28:03', '2020-12-23 17:47:19', '2020-12-23 17:57:19'),
(35, 'LBP2012230005', 101, 1, 17, 'HR', 'GA', 'SC1', 'filePeriodic-file-201223-4028301b25.pdf', 'fileInsidentil-file-201223-2e5d6a319b.pdf', 'read', 'grg', '2020-12-23 20:04:36', '2020-12-23 20:04:50', '2020-12-23 20:14:50');

-- --------------------------------------------------------

--
-- Table structure for table `tb_int_pengadaan_listbreakdown`
--

CREATE TABLE `tb_int_pengadaan_listbreakdown` (
  `breakdownlistID` varchar(50) DEFAULT NULL,
  `bdl_listbelanjaID` int(11) DEFAULT NULL,
  `bdl_pattycashID` int(11) DEFAULT NULL,
  `bdl_bidangID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_int_pengadaan_listbreakdown`
--

INSERT INTO `tb_int_pengadaan_listbreakdown` (`breakdownlistID`, `bdl_listbelanjaID`, `bdl_pattycashID`, `bdl_bidangID`) VALUES
('BDL2012220001', 31, 91, 1),
('BDL2012220002', 32, 94, 1),
('BDL2012220003', 33, 95, 1),
('BDL2012230004', 34, 100, 1),
('BDL2012230005', 35, 101, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_int_pengadaan_listbreakdowndetail`
--

CREATE TABLE `tb_int_pengadaan_listbreakdowndetail` (
  `bdlDetailID` int(11) NOT NULL,
  `bdlD_breakdownlistID` varchar(50) DEFAULT NULL,
  `bdlD_petugasID` int(11) DEFAULT NULL,
  `bdlD_pengirimID` varchar(50) DEFAULT NULL,
  `bdlD_penerimaID` varchar(50) DEFAULT NULL,
  `bdlD_statusID` varchar(11) DEFAULT NULL,
  `bdlDFile` varchar(255) DEFAULT NULL,
  `bdlDJumlah` int(255) DEFAULT NULL,
  `bdlDStatusKonf` varchar(255) DEFAULT NULL,
  `bdlComment` text,
  `bdlDWaktu` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_int_pengadaan_listbreakdowndetail`
--

INSERT INTO `tb_int_pengadaan_listbreakdowndetail` (`bdlDetailID`, `bdlD_breakdownlistID`, `bdlD_petugasID`, `bdlD_pengirimID`, `bdlD_penerimaID`, `bdlD_statusID`, `bdlDFile`, `bdlDJumlah`, `bdlDStatusKonf`, `bdlComment`, `bdlDWaktu`) VALUES
(37, 'BDL2012220001', 18, 'GA', 'HR', 'NW1', 'breakdownFile-NW1-201222-a1e8878c00.pdf', 0, 'read', 'dw', '2020-12-22 09:08:52'),
(38, 'BDL2012220001', 17, 'HR', 'FM', 'NW1', 'breakdownFile-NW1-201222-a1e8878c00.pdf', 0, 'read', 'dw', '2020-12-22 09:09:39'),
(39, 'BDL2012220002', 18, 'GA', 'HR', 'NW1', 'breakdownFile-NW1-201222-48a09dcbb6.pdf', 0, 'read', 'fwfw', '2020-12-22 09:20:29'),
(40, 'BDL2012220002', 17, 'HR', 'GA', 'FD1', 'breakdownFile-FD1-201222-d794e1ce28.pdf', 0, 'read', 'dw', '2020-12-22 09:21:32'),
(41, 'BDL2012220002', 18, 'GA', 'HR', 'RV1', 'breakdownFile-RV1-201222-51ea9b32e8.pdf', 1, 'read', 'dwdw', '2020-12-22 14:50:12'),
(42, 'BDL2012220002', 17, 'HR', 'FM', 'NW1', 'breakdownFile-RV1-201222-51ea9b32e8.pdf', 0, 'read', 'dfg', '2020-12-22 14:50:39'),
(43, 'BDL2012220002', 16, 'FM', 'HR', 'FD1', 'breakdownFile-FD1-201222-44cac88654.pdf', 0, 'read', 'dwd', '2020-12-22 14:51:08'),
(44, 'BDL2012220002', 17, 'HR', 'GA', 'FD1', 'breakdownFile-FD1-201222-44cac88654.pdf', 1, 'read', 'dwd', '2020-12-22 15:03:46'),
(45, 'BDL2012220002', 18, 'GA', 'HR', 'RV1', 'breakdownFile-RV1-201222-3a9817339b.pdf', 2, 'read', 'dwd', '2020-12-22 15:04:28'),
(46, 'BDL2012220002', 17, 'HR', 'FM', 'RV1', 'breakdownFile-RV1-201222-3a9817339b.pdf', 1, 'read', 'dwd', '2020-12-22 15:04:57'),
(47, 'BDL2012220002', 16, 'FM', 'HR', 'FD1', 'breakdownFile-FD1-201222-6be2d1bcd7.pdf', 1, 'read', 'dwdwd', '2020-12-22 15:05:18'),
(48, 'BDL2012220002', 17, 'HR', 'FM', 'RV1', 'breakdownFile-RV1-201222-244742afec.pdf', 2, 'read', 'dwdw', '2020-12-22 15:05:40'),
(49, 'BDL2012220003', 18, 'GA', 'HR', 'NW1', 'breakdownFile-NW1-201222-a84cb3468f.pdf', 0, 'read', 'fggf', '2020-12-22 16:10:45'),
(50, 'BDL2012220003', 17, 'HR', 'FM', 'NW1', 'breakdownFile-NW1-201222-a84cb3468f.pdf', 0, 'read', 'asss', '2020-12-22 16:12:50'),
(51, 'BDL2012230004', 18, 'GA', 'HR', 'NW1', 'breakdownFile-NW1-201223-c0cdf81345.pdf', 0, 'read', 'grgr', '2020-12-23 17:50:23'),
(52, 'BDL2012230004', 17, 'HR', 'FM', 'NW1', 'breakdownFile-NW1-201223-c0cdf81345.pdf', 0, 'read', 'efdf', '2020-12-23 18:31:22'),
(53, 'BDL2012230005', 18, 'GA', 'HR', 'NW1', 'breakdownFile-NW1-201223-37ab0a7d44.pdf', 0, 'read', 'fef', '2020-12-23 20:04:58'),
(54, 'BDL2012230005', 17, 'HR', 'FM', 'NW1', 'breakdownFile-NW1-201223-37ab0a7d44.pdf', 0, 'read', 'gddg', '2020-12-23 20:05:16');

-- --------------------------------------------------------

--
-- Table structure for table `tb_int_pengadaan_notadinas`
--

CREATE TABLE `tb_int_pengadaan_notadinas` (
  `notadinasID` varchar(50) NOT NULL,
  `nd_pencairanbudgetID` varchar(50) DEFAULT NULL,
  `nd_bdlDetailID` int(11) DEFAULT NULL,
  `nd_listbelanjaID` int(11) DEFAULT NULL,
  `nd_pattycashID` int(11) DEFAULT NULL,
  `nd_bidangID` int(11) DEFAULT NULL,
  `nd_petugasID` int(11) DEFAULT NULL,
  `nd_pengirimID` varchar(50) DEFAULT NULL,
  `nd_penerimaID` varchar(50) DEFAULT NULL,
  `nd_statusID` varchar(11) DEFAULT NULL,
  `ndFile` varchar(255) DEFAULT NULL,
  `ndStatusKonf` varchar(255) DEFAULT NULL,
  `ndComment` text,
  `ndWaktu` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_int_pengadaan_notadinas`
--

INSERT INTO `tb_int_pengadaan_notadinas` (`notadinasID`, `nd_pencairanbudgetID`, `nd_bdlDetailID`, `nd_listbelanjaID`, `nd_pattycashID`, `nd_bidangID`, `nd_petugasID`, `nd_pengirimID`, `nd_penerimaID`, `nd_statusID`, `ndFile`, `ndStatusKonf`, `ndComment`, `ndWaktu`) VALUES
('NDP2012220001', 'PBG2012220002', 48, 32, 94, 1, 17, 'HR', 'GA', 'NW1', 'ndFile-file-201222-9378383dcc.pdf', 'read', 'fwfw', '2020-12-22 15:21:38'),
('NDP2012220002', 'PBG2012220003', 50, 33, 95, 1, 17, 'HR', 'GA', 'NW1', 'ndFile-file-201222-a263c889a7.pdf', 'read', 'dsd', '2020-12-22 16:14:44'),
('NDP2012230003', 'PBG2012230004', 52, 34, 100, 1, 17, 'HR', 'GA', 'NW1', 'ndFile-file-201223-0aa01fb55f.pdf', 'read', 'feef', '2020-12-23 18:57:47'),
('NDP2012230004', 'PBG2012230005', 54, 35, 101, 1, 17, 'HR', 'GA', 'NW1', 'ndFile-file-201223-c9edbbb13a.pdf', 'read', 'gr', '2020-12-23 20:06:21');

-- --------------------------------------------------------

--
-- Table structure for table `tb_int_pengadaan_pattycash`
--

CREATE TABLE `tb_int_pengadaan_pattycash` (
  `pattycashID` int(11) NOT NULL,
  `pattycashNo` varchar(50) DEFAULT NULL,
  `pc_bidangID` int(11) DEFAULT NULL,
  `pc_petugasID` int(11) DEFAULT NULL,
  `pc_pengirimID` varchar(50) DEFAULT NULL,
  `pc_penerimaID` varchar(50) DEFAULT NULL,
  `pc_statusID` varchar(11) DEFAULT NULL,
  `pcFile` varchar(255) DEFAULT NULL,
  `pcJumlah` int(11) DEFAULT NULL,
  `pcStatusKonf` varchar(255) DEFAULT NULL,
  `pcComment` text,
  `pcWaktu` datetime DEFAULT CURRENT_TIMESTAMP,
  `pcWaktu_start` datetime DEFAULT NULL,
  `pcWaktu_end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_int_pengadaan_pattycash`
--

INSERT INTO `tb_int_pengadaan_pattycash` (`pattycashID`, `pattycashNo`, `pc_bidangID`, `pc_petugasID`, `pc_pengirimID`, `pc_penerimaID`, `pc_statusID`, `pcFile`, `pcJumlah`, `pcStatusKonf`, `pcComment`, `pcWaktu`, `pcWaktu_start`, `pcWaktu_end`) VALUES
(67, 'BDH2012180001', 1, 5, 'AM1', 'HR', 'SC1', 'pattycashFile-NW1-201218-95db46da6b.pdf', 0, 'read', NULL, '2020-12-18 21:03:29', '2020-12-18 21:03:42', '2020-12-18 21:04:42'),
(68, 'BDH2012180002', 1, 5, 'AM1', 'HR', 'SC1', 'pattycashFile-NW1-201218-0969c9be82.pdf', 0, 'read', NULL, '2020-12-18 21:39:43', '2020-12-18 21:39:55', '2020-12-18 21:40:55'),
(69, 'BDH2012180003', 1, 5, 'AM1', 'HR', 'SC1', 'pattycashFile-NW1-201218-91ea71c695.pdf', 0, 'read', NULL, '2020-12-18 23:30:37', '2020-12-18 23:30:48', '2020-12-18 23:31:48'),
(70, 'BDH2012220004', 1, 5, 'AM1', 'HR', 'RJ1', 'pattycashFile-NW1-201222-1c0fbb4a2e.pdf', 0, 'read', NULL, '2020-12-22 01:30:50', '2020-12-22 01:38:38', '2020-12-22 01:39:38'),
(71, 'BDH2012220005', 1, 5, 'AM1', 'HR', 'RJ1', 'pattycashFile-NW1-201222-91887f46ce.pdf', 0, 'read', NULL, '2020-12-22 01:48:17', '2020-12-22 01:48:30', '2020-12-22 01:49:30'),
(72, 'BDH2012220006', 1, 5, 'AM1', 'HR', 'RJ1', 'pattycashFile-NW1-201222-592206f911.pdf', 0, 'read', 'sdsd', '2020-12-22 01:52:10', '2020-12-22 01:52:21', '2020-12-22 01:53:21'),
(73, 'BDH2012220007', 1, 5, 'AM1', 'HR', 'RJ1', 'pattycashFile-NW1-201222-7b56b96466.pdf', 0, 'read', 'dsds', '2020-12-22 01:53:46', '2020-12-22 01:53:59', '2020-12-22 02:13:59'),
(75, 'BDH2012220009', 1, 5, 'AM1', 'HR', 'NW1', 'pattycashFile-NW1-201222-3e26a284ef.pdf', 0, 'read', 'adad', '2020-12-22 02:30:14', '2020-12-22 02:31:18', '2020-12-22 02:51:18'),
(76, 'BDH2012220009', 1, 17, 'HR', 'AM1', 'FD1', 'pattycashFile-FD1-201222-09a71771df.pdf', 0, 'read', NULL, '2020-12-22 02:34:20', '2020-12-22 02:56:56', '2020-12-22 03:16:56'),
(77, 'BDH2012220009', 1, 5, 'AM1', 'HR', 'SC1', 'pattycashFile-RV1-201222-af948a1e69.pdf', 1, 'read', 'dw', '2020-12-22 03:09:06', '2020-12-22 03:10:29', '2020-12-22 03:30:29'),
(78, 'BDH2012220010', 1, 5, 'AM1', 'HR', 'SC1', 'pattycashFile-NW1-201222-c45f4504da.pdf', 0, 'read', 'dadad', '2020-12-22 03:35:50', '2020-12-22 03:36:02', '2020-12-22 03:56:02'),
(91, 'BDH2012220011', 1, 5, 'AM1', 'HR', 'SC1', 'pattycashFile-NW1-201222-0a43951bb3.pdf', 0, 'read', 'dw', '2020-12-22 09:06:58', '2020-12-22 09:08:12', '2020-12-22 09:28:12'),
(92, 'BDH2012220012', 1, 5, 'AM1', 'HR', 'NW1', 'pattycashFile-NW1-201222-8ce9f0a24c.pdf', 0, 'read', 'dw', '2020-12-22 09:17:46', '2020-12-22 09:17:58', '2020-12-22 09:37:58'),
(93, 'BDH2012220012', 1, 17, 'HR', 'AM1', 'FD1', 'pattycashFile-FD1-201222-1ab86070e9.pdf', 0, 'read', 'dw', '2020-12-22 09:18:05', '2020-12-22 09:18:27', '2020-12-22 09:38:27'),
(94, 'BDH2012220012', 1, 5, 'AM1', 'HR', 'SC1', 'pattycashFile-RV1-201222-d51eed60f4.pdf', 1, 'read', 'fwf', '2020-12-22 09:19:17', '2020-12-22 09:19:30', '2020-12-22 09:39:30'),
(95, 'BDH2012220013', 1, 5, 'AM1', 'HR', 'SC1', 'pattycashFile-NW1-201222-38e29efec4.pdf', 0, 'read', 'dfg', '2020-12-22 16:09:20', '2020-12-22 16:09:35', '2020-12-22 16:29:35'),
(96, 'BDH2012230014', 1, 5, 'AM1', 'HR', 'NW1', 'pattycashFile-NW1-201223-3baec4a2f5.pdf', 0, 'read', 'fefe', '2020-12-23 17:23:39', '2020-12-23 17:23:55', '2020-12-23 17:43:55'),
(97, 'BDH2012230014', 1, 17, 'HR', 'AM1', 'FD1', 'pattycashFile-FD1-201223-6f83887b33.pdf', 0, 'read', 'fef', '2020-12-23 17:24:00', '2020-12-23 17:24:12', '2020-12-23 17:44:12'),
(98, 'BDH2012230014', 1, 5, 'AM1', 'HR', 'RV1', 'pattycashFile-RV1-201223-569d526a3e.pdf', 1, 'read', 'grgr', '2020-12-23 17:24:20', '2020-12-23 17:24:30', '2020-12-23 17:44:30'),
(99, 'BDH2012230014', 1, 17, 'HR', 'AM1', 'FD1', 'pattycashFile-FD1-201223-b7f7997214.pdf', 1, 'read', 'fef', '2020-12-23 17:24:35', '2020-12-23 17:25:03', '2020-12-23 17:45:03'),
(100, 'BDH2012230014', 1, 5, 'AM1', 'HR', 'SC1', 'pattycashFile-RV1-201223-9f49bf206e.pdf', 2, 'read', 'gr', '2020-12-23 17:25:10', '2020-12-23 17:27:49', '2020-12-23 17:47:49'),
(101, 'BDH2012230015', 1, 5, 'AM1', 'HR', 'SC1', 'pattycashFile-NW1-201223-795e8bdb7c.pdf', 0, 'read', 'fefsgsg', '2020-12-23 20:04:16', '2020-12-23 20:04:27', '2020-12-23 20:24:27'),
(102, 'BDH2002040016', 1, 5, 'AM1', 'HR', 'NW1', 'pattycashFile-NW1-210204-25518450fb.pdf', 0, 'send', '', '2021-02-03 23:18:12', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_int_pengadaan_pencairanbudget`
--

CREATE TABLE `tb_int_pengadaan_pencairanbudget` (
  `pencairanbudgetID` varchar(50) NOT NULL,
  `pbPengeluaranNo` varchar(50) DEFAULT NULL,
  `pb_bddetailID` int(11) DEFAULT NULL,
  `pb_pattycashID` int(11) DEFAULT NULL,
  `pb_listbelanjaID` int(11) DEFAULT NULL,
  `pb_bidangID` int(11) DEFAULT NULL,
  `pb_petugasID` int(11) DEFAULT NULL,
  `pb_pengirimID` varchar(50) DEFAULT NULL,
  `pb_penerimaID` varchar(50) DEFAULT NULL,
  `pb_statusID` varchar(11) DEFAULT NULL,
  `pbFile` varchar(255) DEFAULT NULL,
  `pbStatusKonf` varchar(255) DEFAULT NULL,
  `pbComment` text,
  `pbWaktu` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_int_pengadaan_pencairanbudget`
--

INSERT INTO `tb_int_pengadaan_pencairanbudget` (`pencairanbudgetID`, `pbPengeluaranNo`, `pb_bddetailID`, `pb_pattycashID`, `pb_listbelanjaID`, `pb_bidangID`, `pb_petugasID`, `pb_pengirimID`, `pb_penerimaID`, `pb_statusID`, `pbFile`, `pbStatusKonf`, `pbComment`, `pbWaktu`) VALUES
('PBG2012220002', 'PB-002', 48, 94, 32, 1, 16, 'FM', 'HR', 'NW1', 'pbFile-file-201222-b7c85cdc85.pdf', 'read', 'fefe', '2020-12-22 15:06:05'),
('PBG2012220003', 'PB-003', 50, 95, 33, 1, 16, 'FM', 'HR', 'NW1', 'pbFile-file-201222-0c730b0dba.pdf', 'read', 'fdsd', '2020-12-22 16:13:19'),
('PBG2012230004', 'PB-004', 52, 100, 34, 1, 16, 'FM', 'HR', 'NW1', 'pbFile-file-201223-854d9866ae.pdf', 'read', 'fefe', '2020-12-23 18:31:54'),
('PBG2012230005', 'PB-005', 54, 101, 35, 1, 16, 'FM', 'HR', 'NW1', 'pbFile-file-201223-0263227464.pdf', 'read', 'fefef', '2020-12-23 20:05:44');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jobd_approvaldetail`
--

CREATE TABLE `tb_jobd_approvaldetail` (
  `jobdaDetailID` int(11) NOT NULL,
  `jobdaD_jobdApprovID` varchar(50) DEFAULT NULL,
  `jobdaD_petugasID` int(11) DEFAULT NULL,
  `jobdaD_pengirimID` varchar(50) DEFAULT NULL,
  `jobdaD_penerimaID` varchar(50) DEFAULT NULL,
  `jobdaDFile` varchar(255) DEFAULT NULL,
  `jobdaD_statusID` varchar(50) DEFAULT NULL,
  `statusKonfirmasi` varchar(255) DEFAULT NULL,
  `waktu` datetime DEFAULT CURRENT_TIMESTAMP,
  `waktu_start` datetime DEFAULT NULL,
  `waktu_end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_jobd_approvaldetail`
--

INSERT INTO `tb_jobd_approvaldetail` (`jobdaDetailID`, `jobdaD_jobdApprovID`, `jobdaD_petugasID`, `jobdaD_pengirimID`, `jobdaD_penerimaID`, `jobdaDFile`, `jobdaD_statusID`, `statusKonfirmasi`, `waktu`, `waktu_start`, `waktu_end`) VALUES
(270, 'JOBMAR2001020001', 16, 'FM', 'MDM1', 'JOBDFile-Marine-210102-538560c24d.pdf', 'NW1', 'read', '2021-01-02 07:27:57', '2021-01-02 07:28:10', '2021-01-02 07:38:10'),
(271, 'JOBMAR2001020001', 9, 'MDM1', 'OMM1', 'JOBDFile-Marine-210102-538560c24d.pdf', 'NW1', 'read', '2021-01-02 07:28:14', '2021-01-02 07:28:26', '2021-01-02 07:38:26'),
(272, 'JOBMAR2001020001', 7, 'OMM1', 'AM1', 'JOBDFile-Marine-210102-538560c24d.pdf', 'SC1', 'read', '2021-01-02 07:28:29', '2021-01-02 07:28:47', '2021-01-02 07:38:47'),
(273, 'JOBMIN2001020001', 16, 'FM', 'MDM2', 'JOBDFile-Minerba-210102-2a481b19a6.pdf', 'NW1', 'read', '2021-01-02 07:37:55', '2021-01-02 07:38:08', '2021-01-02 07:48:08'),
(274, 'JOBMIN2001020001', 10, 'MDM2', 'AM2', 'JOBDFile-Minerba-210102-2a481b19a6.pdf', 'SC1', 'read', '2021-01-02 07:38:11', '2021-01-02 07:38:22', '2021-01-02 07:48:22'),
(275, 'JOBMAR2002080002', 16, 'FM', 'MDM1', 'JOBDFile-Marine-210208-205b0263ba.pdf', 'NW1', 'read', '2021-02-08 00:16:28', '2021-02-08 13:16:53', '2021-02-08 13:26:53'),
(276, 'JOBMAR2002080002', 9, 'MDM1', 'OMM1', 'JOBDFile-Marine-210208-205b0263ba.pdf', 'NW1', 'read', '2021-02-08 00:17:03', '2021-02-08 13:17:27', '2021-02-08 13:27:27'),
(277, 'JOBMAR2002080002', 7, 'OMM1', 'AM1', 'JOBDFile-Marine-210208-205b0263ba.pdf', 'SC1', 'read', '2021-02-08 00:17:33', '2021-02-08 13:17:58', '2021-02-08 13:27:58'),
(278, 'JOBMIN2002080002', 16, 'FM', 'MDM2', 'JOBDFile-Minerba-210208-c54296e717.pdf', 'NW1', 'read', '2021-02-08 01:12:01', '2021-02-08 14:12:23', '2021-02-08 14:22:23'),
(279, 'JOBMIN2002080002', 10, 'MDM2', 'AM2', 'JOBDFile-Minerba-210208-c54296e717.pdf', 'SC1', 'read', '2021-02-08 01:12:29', '2021-02-08 14:12:54', '2021-02-08 14:22:54'),
(280, 'JOBMAR2002090003', 16, 'FM', 'MDM1', 'JOBDFile-Marine-210209-61a0143d34.pdf', 'NW1', 'read', '2021-02-09 00:14:33', '2021-02-09 13:15:35', '2021-02-09 13:25:35'),
(281, 'JOBMAR2002090003', 9, 'MDM1', 'OMM1', 'JOBDFile-Marine-210209-61a0143d34.pdf', 'NW1', 'read', '2021-02-09 00:16:02', '2021-02-09 13:16:33', '2021-02-09 13:26:33'),
(282, 'JOBMAR2002090003', 7, 'OMM1', 'AM1', 'JOBDFile-Marine-210209-61a0143d34.pdf', 'SC1', 'read', '2021-02-09 00:16:41', '2021-02-09 13:17:17', '2021-02-09 13:27:17'),
(283, 'JOBMAR2002260004', 16, 'FM', 'MDM1', 'JOBDFile-Marine-210226-ea9a2bcd75.pdf', 'NW1', 'read', '2021-02-25 22:11:52', '2021-02-26 11:20:23', '2021-02-26 11:30:23'),
(284, 'JOBMAR2002260004', 9, 'MDM1', 'OMM1', 'JOBDFile-Marine-210226-ea9a2bcd75.pdf', 'NW1', 'read', '2021-02-25 22:20:37', '2021-02-26 11:21:05', '2021-02-26 11:31:05'),
(285, 'JOBMAR2002260004', 7, 'OMM1', 'AM1', 'JOBDFile-Marine-210226-ea9a2bcd75.pdf', 'SC1', 'read', '2021-02-25 22:21:19', '2021-02-26 11:21:48', '2021-02-26 11:31:48'),
(286, 'JOBMIN2002270003', 16, 'FM', 'MDM2', 'JOBDFile-Minerba-210227-3918b71e29.pdf', 'NW1', 'read', '2021-02-27 00:50:06', '2021-02-27 13:50:37', '2021-02-27 14:00:37'),
(287, 'JOBMIN2002270003', 10, 'MDM2', 'AM2', 'JOBDFile-Minerba-210227-3918b71e29.pdf', 'SC1', 'read', '2021-02-27 00:50:47', '2021-02-27 13:51:17', '2021-02-27 14:01:17'),
(288, 'JOBMAR2003210005', 16, 'FM', 'MDM1', 'JOBDFile-Marine-210321-fc52eb192b.pdf', 'NW1', 'read', '2021-03-21 11:26:51', '2021-03-21 23:27:18', '2021-03-21 23:57:18'),
(289, 'JOBMAR2003210005', 9, 'MDM1', 'OMM1', 'JOBDFile-Marine-210321-fc52eb192b.pdf', 'NW1', 'read', '2021-03-21 11:27:26', '2021-03-21 23:27:57', '2021-03-21 23:57:57'),
(290, 'JOBMAR2003210005', 7, 'OMM1', 'AM1', 'JOBDFile-Marine-210321-fc52eb192b.pdf', 'SC1', 'read', '2021-03-21 11:28:06', '2021-03-21 23:28:38', '2021-03-21 23:58:38'),
(291, 'JOBMIN2003210004', 16, 'FM', 'MDM2', 'JOBDFile-Minerba-210321-ef77be1435.pdf', 'NW1', 'read', '2021-03-21 11:50:55', '2021-03-21 23:51:23', '2021-03-22 00:21:23'),
(292, 'JOBMIN2003210004', 10, 'MDM2', 'AM2', 'JOBDFile-Minerba-210321-ef77be1435.pdf', 'SC1', 'read', '2021-03-21 11:51:33', '2021-03-21 23:52:05', '2021-03-22 00:22:05'),
(293, 'JOBMIN2003220005', 16, 'FM', 'MDM2', 'JOBDFile-Minerba-210322-c4c1dc7c46.pdf', 'NW1', 'read', '2021-03-22 08:34:43', '2021-03-22 20:40:20', '2021-03-22 21:10:20'),
(294, 'JOBMIN2003220005', 10, 'MDM2', 'AM2', 'JOBDFile-Minerba-210322-c4c1dc7c46.pdf', 'RJ1', 'read', '2021-03-22 08:40:52', '2021-03-25 11:36:31', '2021-03-25 12:06:31');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jobd_aproval`
--

CREATE TABLE `tb_jobd_aproval` (
  `jobdApprovID` varchar(50) NOT NULL,
  `jobdApprovNo` varchar(50) DEFAULT NULL,
  `jobdA_quoDetailID` int(11) DEFAULT NULL,
  `jobdA_orderID` varchar(50) DEFAULT NULL,
  `jobdA_bidangID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_jobd_aproval`
--

INSERT INTO `tb_jobd_aproval` (`jobdApprovID`, `jobdApprovNo`, `jobdA_quoDetailID`, `jobdA_orderID`, `jobdA_bidangID`) VALUES
('JOBMAR2001020001', 'JOB-MAR-001', 1463, 'ORDMAR2001020001', 1),
('JOBMAR2002080002', 'JOB-MAR-004', 1479, 'ORDMAR2002080008', 1),
('JOBMAR2002090003', 'JOB-MAR-007', 1490, 'ORDMAR2002080012', 1),
('JOBMAR2002260004', 'JOB-MAR-017', 1493, 'ORDMAR2002260018', 1),
('JOBMAR2003210005', 'JOB-MAR-020', 1502, 'ORDMAR2003210024', 1),
('JOBMAR2003230006', 'JOBD-06/JKT/MARINE/OOWLI/III/2021', 1516, 'ORDMAR2003230026', 1),
('JOBMIN2001020001', 'JOB-MIN-001', 1465, 'ORDMIN2001020001', 2),
('JOBMIN2002080002', 'JOB-MIN-004', 1481, 'ORDMIN2002080002', 2),
('JOBMIN2002270003', 'JOB-MIN-015', 1495, 'ORDMIN2002270003', 2),
('JOBMIN2003210004', 'JOB-MIN-21', 1508, 'ORDMIN2003210004', 2),
('JOBMIN2003220005', 'SVY-0111', 1510, 'ORDMIN2003220005', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_marine_finalreport`
--

CREATE TABLE `tb_marine_finalreport` (
  `frMarID` varchar(50) NOT NULL,
  `frMar_spkID` varchar(50) DEFAULT NULL,
  `frMar_jobdaDetailID` int(11) DEFAULT NULL,
  `frMar_quoDetailID` int(11) DEFAULT NULL,
  `frMar_orderID` varchar(50) DEFAULT NULL,
  `frMar_bidangID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_marine_finalreport`
--

INSERT INTO `tb_marine_finalreport` (`frMarID`, `frMar_spkID`, `frMar_jobdaDetailID`, `frMar_quoDetailID`, `frMar_orderID`, `frMar_bidangID`) VALUES
('FRDMAR2001020001', 'SPKMAR2001020001', 272, 1463, 'ORDMAR2001020001', 1),
('FRDMAR2002080002', 'SPKMAR2002080002', 277, 1479, 'ORDMAR2002080008', 1),
('FRDMAR2002080003', 'SPKMAR2002080002', 277, 1479, 'ORDMAR2002080008', 1),
('FRDMAR2002090004', 'SPKMAR2002090003', 282, 1490, 'ORDMAR2002080012', 1),
('FRDMAR2002260005', 'SPKMAR2002260004', 285, 1493, 'ORDMAR2002260018', 1),
('FRDMAR2002270006', 'SPKMAR2002260004', 285, 1493, 'ORDMAR2002260018', 1),
('FRDMAR2003210007', 'SPKMAR2003210005', 290, 1502, 'ORDMAR2003210024', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_marine_finalreportdetail`
--

CREATE TABLE `tb_marine_finalreportdetail` (
  `frMarDetailID` int(11) NOT NULL,
  `frMarD_frID` varchar(50) DEFAULT NULL,
  `frMarD_petugasID` int(11) DEFAULT NULL,
  `frMarD_pengirimID` varchar(50) DEFAULT NULL,
  `frMarD_penerimaID` varchar(50) DEFAULT NULL,
  `frMarD_statusID` varchar(50) DEFAULT NULL,
  `frInternalFile` varchar(255) DEFAULT NULL,
  `frSurveyFile` varchar(255) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `statusKonfirmasi` varchar(255) DEFAULT NULL,
  `frMarDComment` text,
  `waktu` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `waktu_start` datetime DEFAULT NULL,
  `waktu_end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_marine_finalreportdetail`
--

INSERT INTO `tb_marine_finalreportdetail` (`frMarDetailID`, `frMarD_frID`, `frMarD_petugasID`, `frMarD_pengirimID`, `frMarD_penerimaID`, `frMarD_statusID`, `frInternalFile`, `frSurveyFile`, `jumlah`, `statusKonfirmasi`, `frMarDComment`, `waktu`, `waktu_start`, `waktu_end`) VALUES
(727, 'FRDMAR2001020001', 13, 'SM1', 'AM1', 'NW1', 'fr_internal-NW1-210102-625f416de7.pdf', 'fr_survey-NW1-210102-dd8a0676a8.pdf', 0, 'read', '', '2021-01-02 07:29:53', '2021-01-02 07:29:53', '2021-01-02 07:30:53'),
(728, 'FRDMAR2001020001', 5, 'AM1', 'OMM1', 'NW1', 'fr_internal-NW1-210102-625f416de7.pdf', 'fr_survey-NW1-210102-dd8a0676a8.pdf', 0, 'read', '', '2021-01-02 07:30:13', '2021-01-02 07:30:13', '2021-01-02 07:31:13'),
(729, 'FRDMAR2001020001', 7, 'OMM1', 'MDM1', 'SC1', 'fr_internal-NW1-210102-625f416de7.pdf', 'fr_survey-NW1-210102-dd8a0676a8.pdf', 0, 'read', '', '2021-01-02 07:30:57', '2021-01-02 07:30:36', '2021-01-02 07:31:36'),
(730, 'FRDMAR2002080002', 13, 'SM1', 'AM1', 'NW1', 'fr_internal-NW1-210208-04b26577da.pdf', 'fr_survey-NW1-210208-77a8d8d623.pdf', 0, 'read', '', '2021-02-08 01:28:58', '2021-02-08 14:28:58', '2021-02-08 14:29:58'),
(731, 'FRDMAR2002080002', 5, 'AM1', 'OMM1', 'NW1', 'fr_internal-NW1-210208-04b26577da.pdf', 'fr_survey-NW1-210208-77a8d8d623.pdf', 0, 'read', '', '2021-02-08 01:29:36', '2021-02-08 14:29:36', '2021-02-08 14:30:36'),
(732, 'FRDMAR2002080002', 7, 'OMM1', 'MDM1', 'RJ1', 'fr_internal-NW1-210208-04b26577da.pdf', 'fr_survey-NW1-210208-77a8d8d623.pdf', 0, 'read', '', '2021-02-08 01:39:38', '2021-02-08 14:30:42', '2021-02-08 14:31:42'),
(733, 'FRDMAR2002080003', 13, 'SM1', 'AM1', 'NW1', 'fr_internal-NW1-210208-78aaa64c6c.pdf', 'fr_survey-NW1-210208-c56f6279c3.pdf', 0, 'read', '', '2021-02-08 01:41:02', '2021-02-08 14:41:02', '2021-02-08 14:42:02'),
(734, 'FRDMAR2002080003', 5, 'AM1', 'OMM1', 'NW1', 'fr_internal-NW1-210208-78aaa64c6c.pdf', 'fr_survey-NW1-210208-c56f6279c3.pdf', 0, 'read', '', '2021-02-08 01:41:27', '2021-02-08 14:41:27', '2021-02-08 14:42:27'),
(735, 'FRDMAR2002080003', 7, 'OMM1', 'MDM1', 'SC1', 'fr_internal-NW1-210208-78aaa64c6c.pdf', 'fr_survey-NW1-210208-c56f6279c3.pdf', 0, 'read', '', '2021-02-08 01:42:36', '2021-02-08 14:42:01', '2021-02-08 14:43:01'),
(736, 'FRDMAR2002090004', 13, 'SM1', 'AM1', 'NW1', 'fr_internal-NW1-210209-16d62c129a.pdf', 'fr_survey-NW1-210209-a58d0aa380.pdf', 0, 'read', 'gddf', '2021-02-09 00:21:11', '2021-02-09 13:21:11', '2021-02-09 13:22:11'),
(737, 'FRDMAR2002090004', 5, 'AM1', 'OMM1', 'NW1', 'fr_internal-NW1-210209-16d62c129a.pdf', 'fr_survey-NW1-210209-a58d0aa380.pdf', 0, 'read', '', '2021-02-09 00:29:58', '2021-02-09 13:29:58', '2021-02-09 13:30:58'),
(738, 'FRDMAR2002090004', 7, 'OMM1', 'MDM1', 'SC1', 'fr_internal-NW1-210209-16d62c129a.pdf', 'fr_survey-NW1-210209-a58d0aa380.pdf', 0, 'read', '', '2021-02-09 00:31:43', '2021-02-09 13:31:12', '2021-02-09 13:32:12'),
(739, 'FRDMAR2002260005', 13, 'SM1', 'AM1', 'RJ1', 'fr_internal-NW1-210226-835e2b8453.pdf', 'fr_survey-NW1-210226-e64afdbb5a.pdf', 0, 'read', '', '2021-02-25 22:29:02', '2021-02-26 11:27:55', '2021-02-26 11:28:55'),
(740, 'FRDMAR2002270006', 13, 'SM1', 'AM1', 'NW1', 'fr_internal-NW1-210227-d954cd3628.pdf', 'fr_survey-NW1-210227-eb2c526bc7.pdf', 0, 'read', '', '2021-02-27 00:03:12', '2021-02-27 13:03:12', '2021-02-27 13:04:12'),
(741, 'FRDMAR2002270006', 5, 'AM1', 'OMM1', 'NW1', 'fr_internal-NW1-210227-d954cd3628.pdf', 'fr_survey-NW1-210227-eb2c526bc7.pdf', 0, 'read', '', '2021-02-27 00:04:01', '2021-02-27 13:04:01', '2021-02-27 13:05:01'),
(742, 'FRDMAR2002270006', 7, 'OMM1', 'MDM1', 'SC1', 'fr_internal-NW1-210227-d954cd3628.pdf', 'fr_survey-NW1-210227-eb2c526bc7.pdf', 0, 'read', '', '2021-02-27 00:05:39', '2021-02-27 13:04:52', '2021-02-27 13:05:52'),
(743, 'FRDMAR2003210007', 13, 'SM1', 'AM1', 'NW1', 'fr_internal-NW1-210321-c84090621b.pdf', 'fr_survey-NW1-210321-ba679f5538.pdf', 0, 'read', '', '2021-03-21 11:30:46', '2021-03-21 23:30:46', '2021-03-22 00:00:46'),
(744, 'FRDMAR2003210007', 5, 'AM1', 'OMM1', 'NW1', 'fr_internal-NW1-210321-c84090621b.pdf', 'fr_survey-NW1-210321-ba679f5538.pdf', 0, 'read', '', '2021-03-21 11:31:30', '2021-03-21 23:31:30', '2021-03-22 00:01:30'),
(745, 'FRDMAR2003210007', 7, 'OMM1', 'AM1', 'FD1', 'fr_internal-FD1-210321-ed173c5b34.pdf', 'fr_survey-NW1-210321-ba679f5538.pdf', 0, 'read', '', '2021-03-21 11:32:17', '2021-03-21 23:32:17', '2021-03-22 00:02:17'),
(746, 'FRDMAR2003210007', 5, 'AM1', 'OMM1', 'RV1', 'fr_internal-RV1-210321-07383446e6.pdf', 'fr_survey-NW1-210321-ba679f5538.pdf', 1, 'read', NULL, '2021-03-21 11:33:04', '2021-03-21 23:33:04', '2021-03-22 00:03:04'),
(747, 'FRDMAR2003210007', 7, 'OMM1', 'MDM1', 'SC1', 'fr_internal-RV1-210321-07383446e6.pdf', 'fr_survey-NW1-210321-ba679f5538.pdf', 0, 'read', '', '2021-03-21 11:34:44', '2021-03-21 23:33:44', '2021-03-22 00:03:44');

-- --------------------------------------------------------

--
-- Table structure for table `tb_marine_inv_draft`
--

CREATE TABLE `tb_marine_inv_draft` (
  `invMarID` varchar(50) NOT NULL,
  `invMarNo` varchar(50) DEFAULT NULL,
  `invMarRefNo` varchar(50) DEFAULT NULL,
  `invMar_frDetailID` int(11) DEFAULT NULL,
  `invMar_spkID` varchar(50) DEFAULT NULL,
  `invMar_jobdaDetailID` int(11) DEFAULT NULL,
  `invMar_quoDetailID` int(11) DEFAULT NULL,
  `invMar_orderID` varchar(50) DEFAULT NULL,
  `invMar_bidangID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_marine_inv_draft`
--

INSERT INTO `tb_marine_inv_draft` (`invMarID`, `invMarNo`, `invMarRefNo`, `invMar_frDetailID`, `invMar_spkID`, `invMar_jobdaDetailID`, `invMar_quoDetailID`, `invMar_orderID`, `invMar_bidangID`) VALUES
('INVMAR2001020001', 'INV-MAR-001', 'REF-MAR-001', 729, 'SPKMAR2001020001', 272, 1463, 'ORDMAR2001020001', 1),
('INVMAR2002080002', 'INV-MAR-006', 'REF-MAR-006', 735, 'SPKMAR2002080002', 277, 1479, 'ORDMAR2002080008', 1),
('INVMAR2002090003', 'INV-MAR-007', 'REF-MAR-007', 738, 'SPKMAR2002090003', 282, 1490, 'ORDMAR2002080012', 1),
('INVMAR2002270004', 'INV-MAR-017', 'REF-MAR-017', 742, 'SPKMAR2002260004', 285, 1493, 'ORDMAR2002260018', 1),
('INVMAR2003210005', 'INV-MAR-20', 'REF-MAR-20', 747, 'SPKMAR2003210005', 290, 1502, 'ORDMAR2003210024', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_marine_inv_draftdetail`
--

CREATE TABLE `tb_marine_inv_draftdetail` (
  `invMarDetailID` int(11) NOT NULL,
  `invMarD_invID` varchar(50) DEFAULT NULL,
  `invMarD_petugasID` int(11) DEFAULT NULL,
  `invMarD_pengirimID` varchar(50) DEFAULT NULL,
  `invMarD_penerimaID` varchar(50) DEFAULT NULL,
  `invMarD_statusID` varchar(50) DEFAULT NULL,
  `invMarFile` varchar(255) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `statusKonfirmasi` varchar(255) DEFAULT NULL,
  `comment` text,
  `waktu` datetime DEFAULT CURRENT_TIMESTAMP,
  `waktu_start` datetime DEFAULT NULL,
  `waktu_end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_marine_inv_draftdetail`
--

INSERT INTO `tb_marine_inv_draftdetail` (`invMarDetailID`, `invMarD_invID`, `invMarD_petugasID`, `invMarD_pengirimID`, `invMarD_penerimaID`, `invMarD_statusID`, `invMarFile`, `jumlah`, `statusKonfirmasi`, `comment`, `waktu`, `waktu_start`, `waktu_end`) VALUES
(118, 'INVMAR2001020001', 9, 'MDM1', 'FM', 'NW1', 'draftInvFile-NW1-210102-19f2ff1e1f.pdf', 0, 'read', '', '2021-01-02 07:30:57', '2021-01-02 07:31:12', '2021-01-02 08:01:12'),
(119, 'INVMAR2001020001', 16, 'FM', 'AM1', 'SC1', 'draftInvFile-NW1-210102-19f2ff1e1f.pdf', 0, 'read', '', '2021-01-02 07:31:16', '2021-01-02 07:31:28', '2021-01-02 08:01:28'),
(120, 'INVMAR2002080002', 9, 'MDM1', 'FM', 'NW1', 'draftInvFile-NW1-210208-70848201a4.pdf', 0, 'read', '', '2021-02-08 01:42:36', '2021-02-08 14:43:37', '2021-02-08 15:13:37'),
(121, 'INVMAR2002080002', 16, 'FM', 'AM1', 'SC1', 'draftInvFile-NW1-210208-70848201a4.pdf', 0, 'read', '', '2021-02-08 01:43:45', '2021-02-08 14:44:28', '2021-02-08 15:14:28'),
(122, 'INVMAR2002090003', 9, 'MDM1', 'FM', 'NW1', 'draftInvFile-NW1-210209-bc9a39db35.pdf', 0, 'read', '', '2021-02-09 00:31:43', '2021-02-09 13:34:44', '2021-02-09 14:04:44'),
(123, 'INVMAR2002090003', 16, 'FM', 'AM1', 'SC1', 'draftInvFile-NW1-210209-bc9a39db35.pdf', 0, 'read', '', '2021-02-09 00:35:11', '2021-02-09 13:38:29', '2021-02-09 14:08:29'),
(124, 'INVMAR2002270004', 9, 'MDM1', 'FM', 'NW1', 'draftInvFile-NW1-210227-e7a5e6d3ae.pdf', 0, 'read', '', '2021-02-27 00:05:39', '2021-02-27 13:06:12', '2021-02-27 13:36:12'),
(125, 'INVMAR2002270004', 16, 'FM', 'AM1', 'SC1', 'draftInvFile-NW1-210227-e7a5e6d3ae.pdf', 0, 'read', '', '2021-02-27 00:06:24', '2021-02-27 13:07:23', '2021-02-27 13:37:23'),
(126, 'INVMAR2003210005', 9, 'MDM1', 'FM', 'NW1', 'draftInvFile-NW1-210321-3837224c9b.pdf', 0, 'read', '', '2021-03-21 11:34:44', '2021-03-21 23:35:36', '2021-03-22 00:05:36'),
(127, 'INVMAR2003210005', 16, 'FM', 'MDM1', 'FD1', 'draftInvFile-FD1-210321-3123b36a8c.pdf', 0, 'read', '', '2021-03-21 11:35:52', '2021-03-21 23:36:24', '2021-03-22 00:06:24'),
(128, 'INVMAR2003210005', 9, 'MDM1', 'FM', 'RV1', 'draftInvFile-RV1-210321-0f4827b09b.pdf', 1, 'read', '', '2021-03-21 11:36:42', '2021-03-21 23:37:07', '2021-03-22 00:07:07'),
(129, 'INVMAR2003210005', 16, 'FM', 'AM1', 'SC1', 'draftInvFile-RV1-210321-0f4827b09b.pdf', 0, 'read', '', '2021-03-21 11:37:15', '2021-03-21 23:37:57', '2021-03-22 00:07:57');

-- --------------------------------------------------------

--
-- Table structure for table `tb_marine_inv_finalclient`
--

CREATE TABLE `tb_marine_inv_finalclient` (
  `invMarFinalID` varchar(50) NOT NULL,
  `invMarF_clientProjectID` varchar(50) DEFAULT NULL,
  `invMarF_clientID` varchar(50) DEFAULT NULL,
  `invMarF_invMarDetailID` int(11) DEFAULT NULL,
  `invMarF_frMarDetailID` int(11) DEFAULT NULL,
  `invMarF_spkID` varchar(50) DEFAULT NULL,
  `invMarF_jobdaDetailID` int(11) DEFAULT NULL,
  `invMarF_quoDetailID` int(11) DEFAULT NULL,
  `invMarF_orderID` varchar(50) DEFAULT NULL,
  `invMarF_petugasID` int(11) DEFAULT NULL,
  `invMarF_bidangID` int(11) DEFAULT NULL,
  `invMarF_statusID` varchar(11) DEFAULT NULL,
  `invMarStatusKonf` varchar(255) DEFAULT NULL,
  `invMarComment` text,
  `invMarFWaktu` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_marine_inv_finalclient`
--

INSERT INTO `tb_marine_inv_finalclient` (`invMarFinalID`, `invMarF_clientProjectID`, `invMarF_clientID`, `invMarF_invMarDetailID`, `invMarF_frMarDetailID`, `invMarF_spkID`, `invMarF_jobdaDetailID`, `invMarF_quoDetailID`, `invMarF_orderID`, `invMarF_petugasID`, `invMarF_bidangID`, `invMarF_statusID`, `invMarStatusKonf`, `invMarComment`, `invMarFWaktu`) VALUES
('FCPMAR2001020001', 'PRJMAR2001020001', '2001021230005', 119, 729, 'SPKMAR2001020001', 272, 1463, 'ORDMAR2001020001', 5, 1, 'SC1', 'read', '', '2021-01-02 07:31:31'),
('FCPMAR2002080002', 'PRJMAR2002040003', '2001021230005', 121, 735, 'SPKMAR2002080002', 277, 1479, 'ORDMAR2002080008', 5, 1, 'SC1', 'read', '', '2021-02-08 01:44:32'),
('FCPMAR2002090003', 'PRJMAR2002080004', '2001021230005', 123, 738, 'SPKMAR2002090003', 282, 1490, 'ORDMAR2002080012', 5, 1, 'SC1', 'read', '', '2021-02-09 00:38:36'),
('FCPMAR2002270004', 'PRJMAR2002260006', '2002261230005', 125, 742, 'SPKMAR2002260004', 285, 1493, 'ORDMAR2002260018', 5, 1, 'SC1', 'read', '', '2021-02-27 00:07:35'),
('FCPMAR2003210005', 'PRJMAR2003210011', '2003211230005', 129, 747, 'SPKMAR2003210005', 290, 1502, 'ORDMAR2003210024', 5, 1, 'SC1', 'send', '', '2021-03-21 11:38:05');

-- --------------------------------------------------------

--
-- Table structure for table `tb_minerba_finalreport`
--

CREATE TABLE `tb_minerba_finalreport` (
  `frMinID` varchar(50) NOT NULL,
  `frMinlhvNo` varchar(50) DEFAULT NULL,
  `frMin_spkID` varchar(50) DEFAULT NULL,
  `frMin_jobdaDetailID` int(11) DEFAULT NULL,
  `frMin_quoDetailID` int(11) DEFAULT NULL,
  `frMin_orderID` varchar(50) DEFAULT NULL,
  `frMin_bidangID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_minerba_finalreport`
--

INSERT INTO `tb_minerba_finalreport` (`frMinID`, `frMinlhvNo`, `frMin_spkID`, `frMin_jobdaDetailID`, `frMin_quoDetailID`, `frMin_orderID`, `frMin_bidangID`) VALUES
('FRDMIN2001020001', 'LHV-MIN-001', 'SPKMIN2001020001', 274, 1465, 'ORDMIN2001020001', 2),
('FRDMIN2002080002', 'LHV-MIN-004', 'SPKMIN2002080002', 279, 1481, 'ORDMIN2002080002', 2),
('FRDMIN2002270003', 'LHV-MIN-015', 'SPKMIN2002270003', 287, 1495, 'ORDMIN2002270003', 2),
('FRDMIN2003210004', 'LHV-MIN-21', 'SPKMIN2003210004', 292, 1508, 'ORDMIN2003210004', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_minerba_finalreportdetail`
--

CREATE TABLE `tb_minerba_finalreportdetail` (
  `frMinDetailID` int(11) NOT NULL,
  `frMinD_frID` varchar(50) DEFAULT NULL,
  `frMinD_petugasID` int(11) DEFAULT NULL,
  `frMinD_pengirimID` varchar(50) DEFAULT NULL,
  `frMinD_penerimaID` varchar(50) DEFAULT NULL,
  `frMinD_statusID` varchar(50) DEFAULT NULL,
  `lhvFile` varchar(255) DEFAULT NULL,
  `dsrFile` varchar(255) DEFAULT NULL,
  `coaFile` varchar(255) DEFAULT NULL,
  `cowFile` varchar(255) DEFAULT NULL,
  `cdsFile` varchar(255) DEFAULT NULL,
  `frInternalFile` varchar(255) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `statusKonfirmasi` varchar(255) DEFAULT NULL,
  `frMinDComment` text,
  `waktu` datetime DEFAULT CURRENT_TIMESTAMP,
  `waktu_start` datetime DEFAULT NULL,
  `waktu_end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_minerba_finalreportdetail`
--

INSERT INTO `tb_minerba_finalreportdetail` (`frMinDetailID`, `frMinD_frID`, `frMinD_petugasID`, `frMinD_pengirimID`, `frMinD_penerimaID`, `frMinD_statusID`, `lhvFile`, `dsrFile`, `coaFile`, `cowFile`, `cdsFile`, `frInternalFile`, `jumlah`, `statusKonfirmasi`, `frMinDComment`, `waktu`, `waktu_start`, `waktu_end`) VALUES
(156, 'FRDMIN2001020001', 14, 'SM2', 'AM2', 'NW1', 'fr_lhv-NW1-210102-eaa3c2fcee.pdf', 'fr_dsr-NW1-210102-b38dd1ddf6.pdf', 'fr_coa-NW1-210102-8d5147fc8e.pdf', 'fr_cow-NW1-210102-055d3e1633.pdf', 'fr_cds-NW1-210102-4bd5a70614.pdf', 'fr_internal-NW1-210102-d648ec465c.pdf', 0, 'read', '', '2021-01-02 07:39:24', '2021-01-02 07:39:38', '2021-01-02 07:40:38'),
(157, 'FRDMIN2001020001', 6, 'AM2', 'MDM2', 'NW1', 'fr_lhv-NW1-210102-eaa3c2fcee.pdf', 'fr_dsr-NW1-210102-b38dd1ddf6.pdf', 'fr_coa-NW1-210102-8d5147fc8e.pdf', 'fr_cow-NW1-210102-055d3e1633.pdf', 'fr_cds-NW1-210102-4bd5a70614.pdf', 'fr_internal-NW1-210102-d648ec465c.pdf', 0, 'read', '', '2021-01-02 07:39:42', '2021-01-02 07:40:16', '2021-01-02 07:41:16'),
(158, 'FRDMIN2001020001', 10, 'MDM2', 'FM', 'SC1', 'fr_lhv-NW1-210102-eaa3c2fcee.pdf', 'fr_dsr-NW1-210102-b38dd1ddf6.pdf', 'fr_coa-NW1-210102-8d5147fc8e.pdf', 'fr_cow-NW1-210102-055d3e1633.pdf', 'fr_cds-NW1-210102-4bd5a70614.pdf', 'fr_internal-NW1-210102-d648ec465c.pdf', 0, 'read', '', '2021-01-02 07:40:20', '2021-01-02 07:40:34', '2021-01-02 07:41:34'),
(159, 'FRDMIN2002080002', 14, 'SM2', 'AM2', 'NW1', 'fr_lhv-NW1-210208-7849b77f19.pdf', 'fr_dsr-NW1-210208-c4a93fb174.pdf', 'fr_coa-NW1-210208-c77a641e1b.pdf', 'fr_cow-NW1-210208-5abafc6f70.pdf', 'fr_cds-NW1-210208-bf916a7ec6.pdf', 'fr_internal-NW1-210208-7818342341.pdf', 0, 'read', '', '2021-02-08 01:14:18', '2021-02-08 14:14:58', '2021-02-08 14:15:58'),
(160, 'FRDMIN2002080002', 6, 'AM2', 'MDM2', 'NW1', 'fr_lhv-NW1-210208-7849b77f19.pdf', 'fr_dsr-NW1-210208-c4a93fb174.pdf', 'fr_coa-NW1-210208-c77a641e1b.pdf', 'fr_cow-NW1-210208-5abafc6f70.pdf', 'fr_cds-NW1-210208-bf916a7ec6.pdf', 'fr_internal-NW1-210208-7818342341.pdf', 0, 'read', '', '2021-02-08 01:15:04', '2021-02-08 14:15:27', '2021-02-08 14:16:27'),
(161, 'FRDMIN2002080002', 10, 'MDM2', 'FM', 'SC1', 'fr_lhv-NW1-210208-7849b77f19.pdf', 'fr_dsr-NW1-210208-c4a93fb174.pdf', 'fr_coa-NW1-210208-c77a641e1b.pdf', 'fr_cow-NW1-210208-5abafc6f70.pdf', 'fr_cds-NW1-210208-bf916a7ec6.pdf', 'fr_internal-NW1-210208-7818342341.pdf', 0, 'read', '', '2021-02-08 01:15:33', '2021-02-08 14:15:56', '2021-02-08 14:16:56'),
(162, 'FRDMIN2002270003', 14, 'SM2', 'AM2', 'NW1', 'fr_lhv-NW1-210227-695124f93a.pdf', 'fr_dsr-NW1-210227-9514f9e36c.pdf', 'fr_coa-NW1-210227-6198481ec8.pdf', 'fr_cow-NW1-210227-f2ca20b185.pdf', 'fr_cds-NW1-210227-38d1941182.pdf', 'fr_internal-NW1-210227-47d0f13f90.pdf', 0, 'read', '', '2021-02-27 00:53:59', '2021-02-27 13:54:46', '2021-02-27 13:55:46'),
(163, 'FRDMIN2002270003', 6, 'AM2', 'MDM2', 'NW1', 'fr_lhv-NW1-210227-695124f93a.pdf', 'fr_dsr-NW1-210227-9514f9e36c.pdf', 'fr_coa-NW1-210227-6198481ec8.pdf', 'fr_cow-NW1-210227-f2ca20b185.pdf', 'fr_cds-NW1-210227-38d1941182.pdf', 'fr_internal-NW1-210227-47d0f13f90.pdf', 0, 'read', '', '2021-02-27 00:55:28', '2021-02-27 13:55:54', '2021-02-27 13:56:54'),
(164, 'FRDMIN2002270003', 10, 'MDM2', 'FM', 'SC1', 'fr_lhv-NW1-210227-695124f93a.pdf', 'fr_dsr-NW1-210227-9514f9e36c.pdf', 'fr_coa-NW1-210227-6198481ec8.pdf', 'fr_cow-NW1-210227-f2ca20b185.pdf', 'fr_cds-NW1-210227-38d1941182.pdf', 'fr_internal-NW1-210227-47d0f13f90.pdf', 0, 'read', '', '2021-02-27 00:56:01', '2021-02-27 13:56:25', '2021-02-27 13:57:25'),
(165, 'FRDMIN2003210004', 14, 'SM2', 'AM2', 'NW1', 'fr_lhv-NW1-210321-6a0ab3e191.pdf', 'fr_dsr-NW1-210321-076d5f6713.pdf', 'fr_coa-NW1-210321-897c73913e.pdf', 'fr_cow-NW1-210321-d0f429fa3d.pdf', 'fr_cds-NW1-210321-bde41a1c80.pdf', 'fr_internal-NW1-210321-cb4c62ec95.pdf', 0, 'read', '', '2021-03-21 11:54:04', '2021-03-21 23:54:32', '2021-03-22 00:24:32'),
(166, 'FRDMIN2003210004', 6, 'AM2', 'MDM2', 'NW1', 'fr_lhv-NW1-210321-6a0ab3e191.pdf', 'fr_dsr-NW1-210321-076d5f6713.pdf', 'fr_coa-NW1-210321-897c73913e.pdf', 'fr_cow-NW1-210321-d0f429fa3d.pdf', 'fr_cds-NW1-210321-bde41a1c80.pdf', 'fr_internal-NW1-210321-cb4c62ec95.pdf', 0, 'read', '', '2021-03-21 11:54:42', '2021-03-21 23:55:11', '2021-03-22 00:25:11'),
(167, 'FRDMIN2003210004', 10, 'MDM2', 'AM2', 'FD1', 'fr_lhv-NW1-210321-6a0ab3e191.pdf', 'fr_dsr-NW1-210321-076d5f6713.pdf', 'fr_coa-NW1-210321-897c73913e.pdf', 'fr_cow-NW1-210321-d0f429fa3d.pdf', 'fr_cds-NW1-210321-bde41a1c80.pdf', 'fr_internal-FD1-210321-459fec069b.pdf', 0, 'read', NULL, '2021-03-21 11:55:26', '2021-03-21 23:56:24', '2021-03-22 00:26:24'),
(168, 'FRDMIN2003210004', 10, 'MDM2', 'AM2', 'FD1', 'fr_lhv-NW1-210321-6a0ab3e191.pdf', 'fr_dsr-NW1-210321-076d5f6713.pdf', 'fr_coa-NW1-210321-897c73913e.pdf', 'fr_cow-NW1-210321-d0f429fa3d.pdf', 'fr_cds-NW1-210321-bde41a1c80.pdf', 'fr_internal-FD1-210321-0f903e76d5.pdf', 1, 'read', NULL, '2021-03-21 11:55:37', '2021-03-21 23:56:37', '2021-03-22 00:26:37'),
(169, 'FRDMIN2003210004', 6, 'AM2', 'MDM2', 'RV1', 'fr_lhv-NW1-210321-6a0ab3e191.pdf', 'fr_dsr-NW1-210321-076d5f6713.pdf', 'fr_coa-NW1-210321-897c73913e.pdf', 'fr_cow-NW1-210321-d0f429fa3d.pdf', 'fr_cds-NW1-210321-bde41a1c80.pdf', 'fr_internal-RV1-210321-3f940b03cd.pdf', 1, 'read', '', '2021-03-21 11:56:54', '2021-03-21 23:57:43', '2021-03-22 00:27:43'),
(170, 'FRDMIN2003210004', 10, 'MDM2', 'FM', 'SC1', 'fr_lhv-NW1-210321-6a0ab3e191.pdf', 'fr_dsr-NW1-210321-076d5f6713.pdf', 'fr_coa-NW1-210321-897c73913e.pdf', 'fr_cow-NW1-210321-d0f429fa3d.pdf', 'fr_cds-NW1-210321-bde41a1c80.pdf', 'fr_internal-RV1-210321-3f940b03cd.pdf', 0, 'read', '', '2021-03-21 11:57:51', '2021-03-21 23:58:23', '2021-03-22 00:28:23');

-- --------------------------------------------------------

--
-- Table structure for table `tb_minerba_inv_draft`
--

CREATE TABLE `tb_minerba_inv_draft` (
  `invMinID` varchar(50) NOT NULL,
  `invMinNo` varchar(50) DEFAULT NULL,
  `invMinRefNo` varchar(50) DEFAULT NULL,
  `invMin_frDetailID` int(11) DEFAULT NULL,
  `invMin_spkID` varchar(50) DEFAULT NULL,
  `invMin_jobdaDetailID` int(11) DEFAULT NULL,
  `invMin_quoDetailID` int(11) DEFAULT NULL,
  `invMin_orderID` varchar(50) DEFAULT NULL,
  `invMin_bidangID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_minerba_inv_draft`
--

INSERT INTO `tb_minerba_inv_draft` (`invMinID`, `invMinNo`, `invMinRefNo`, `invMin_frDetailID`, `invMin_spkID`, `invMin_jobdaDetailID`, `invMin_quoDetailID`, `invMin_orderID`, `invMin_bidangID`) VALUES
('INVMIN2001020001', 'INV-MIN-001', 'REF-MIN-001', 158, 'SPKMIN2001020001', 274, 1465, 'ORDMIN2001020001', 2),
('INVMIN2002080002', 'INV-MIN-004', 'REF-MIN-004', 161, 'SPKMIN2002080002', 279, 1481, 'ORDMIN2002080002', 2),
('INVMIN2002270003', 'INV-MIN-015', 'REF-MIN-015', 164, 'SPKMIN2002270003', 287, 1495, 'ORDMIN2002270003', 2),
('INVMIN2003210004', 'INV-MIN-021', 'REF-MIN-021', 170, 'SPKMIN2003210004', 292, 1508, 'ORDMIN2003210004', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_minerba_inv_draftdetail`
--

CREATE TABLE `tb_minerba_inv_draftdetail` (
  `invMinDetailID` int(11) NOT NULL,
  `invMinD_invID` varchar(50) DEFAULT NULL,
  `invMinD_petugasID` int(11) DEFAULT NULL,
  `invMinD_pengirimID` varchar(50) DEFAULT NULL,
  `invMinD_penerimaID` varchar(50) DEFAULT NULL,
  `invMinFile` varchar(255) DEFAULT NULL,
  `invMinD_statusID` varchar(50) DEFAULT NULL,
  `statusKonfirmasi` varchar(255) DEFAULT NULL,
  `comment` text,
  `waktu` datetime DEFAULT CURRENT_TIMESTAMP,
  `waktu_start` datetime DEFAULT NULL,
  `waktu_end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_minerba_inv_draftdetail`
--

INSERT INTO `tb_minerba_inv_draftdetail` (`invMinDetailID`, `invMinD_invID`, `invMinD_petugasID`, `invMinD_pengirimID`, `invMinD_penerimaID`, `invMinFile`, `invMinD_statusID`, `statusKonfirmasi`, `comment`, `waktu`, `waktu_start`, `waktu_end`) VALUES
(79, 'INVMIN2001020001', 16, 'FM', 'MDM2', 'draftInvFile-NW1-210102-2c31e53abb.pdf', 'NW1', 'read', '', '2021-01-02 07:40:58', '2021-01-02 07:44:17', '2021-01-02 08:14:17'),
(80, 'INVMIN2001020001', 10, 'MDM2', 'AM2', 'draftInvFile-NW1-210102-2c31e53abb.pdf', 'SC1', 'read', '', '2021-01-02 07:44:21', '2021-01-02 07:44:32', '2021-01-02 08:14:32'),
(81, 'INVMIN2002080002', 16, 'FM', 'MDM2', 'draftInvFile-NW1-210208-ec7c83db46.pdf', 'NW1', 'read', '', '2021-02-08 01:16:33', '2021-02-08 14:17:43', '2021-02-08 14:47:43'),
(82, 'INVMIN2002080002', 10, 'MDM2', 'AM2', 'draftInvFile-NW1-210208-ec7c83db46.pdf', 'SC1', 'read', '', '2021-02-08 01:17:47', '2021-02-08 14:18:13', '2021-02-08 14:48:13'),
(83, 'INVMIN2002270003', 16, 'FM', 'MDM2', 'draftInvFile-NW1-210227-5ec84e76ee.pdf', 'NW1', 'read', '', '2021-02-27 00:57:01', '2021-02-27 13:57:31', '2021-02-27 14:27:31'),
(84, 'INVMIN2002270003', 10, 'MDM2', 'AM2', 'draftInvFile-NW1-210227-5ec84e76ee.pdf', 'SC1', 'read', '', '2021-02-27 00:57:44', '2021-02-27 13:58:09', '2021-02-27 14:28:09'),
(85, 'INVMIN2003210004', 16, 'FM', 'MDM2', 'draftInvFile-NW1-210321-b7f67937f4.pdf', 'NW1', 'read', '', '2021-03-21 11:59:11', '2021-03-21 23:59:36', '2021-03-22 00:29:36'),
(86, 'INVMIN2003210004', 10, 'MDM2', 'AM2', 'draftInvFile-NW1-210321-b7f67937f4.pdf', 'SC1', 'read', '', '2021-03-21 11:59:44', '2021-03-22 00:00:11', '2021-03-22 00:30:11');

-- --------------------------------------------------------

--
-- Table structure for table `tb_minerba_inv_finalclient`
--

CREATE TABLE `tb_minerba_inv_finalclient` (
  `invMinFinalID` varchar(50) NOT NULL,
  `invMinF_clientProjectID` varchar(50) DEFAULT NULL,
  `invMinF_clientID` varchar(50) DEFAULT NULL,
  `invMinF_invMinDetailID` int(11) DEFAULT NULL,
  `invMinF_frMinDetailID` int(11) DEFAULT NULL,
  `invMinF_spkID` varchar(50) DEFAULT NULL,
  `invMinF_jobdaDetailID` int(11) DEFAULT NULL,
  `invMinF_quoDetailID` int(11) DEFAULT NULL,
  `invMinF_orderID` varchar(50) DEFAULT NULL,
  `invMinF_petugasID` int(11) DEFAULT NULL,
  `invMinF_bidangID` int(11) DEFAULT NULL,
  `invMinF_statusID` varchar(11) DEFAULT NULL,
  `invMinFStatusKonf` varchar(255) DEFAULT NULL,
  `invMinFComment` text,
  `invMinFWaktu` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_minerba_inv_finalclient`
--

INSERT INTO `tb_minerba_inv_finalclient` (`invMinFinalID`, `invMinF_clientProjectID`, `invMinF_clientID`, `invMinF_invMinDetailID`, `invMinF_frMinDetailID`, `invMinF_spkID`, `invMinF_jobdaDetailID`, `invMinF_quoDetailID`, `invMinF_orderID`, `invMinF_petugasID`, `invMinF_bidangID`, `invMinF_statusID`, `invMinFStatusKonf`, `invMinFComment`, `invMinFWaktu`) VALUES
('FCPMIN2001020001', 'PRJMIN2001020001', '2001021230005', 80, 158, 'SPKMIN2001020001', 274, 1465, 'ORDMIN2001020001', 6, 2, 'SC1', 'read', '', '2021-01-02 07:44:37'),
('FCPMIN2002080002', 'PRJMIN2002080002', '2001021230005', 82, 161, 'SPKMIN2002080002', 279, 1481, 'ORDMIN2002080002', 6, 2, 'SC1', 'read', '', '2021-02-08 01:18:18'),
('FCPMIN2002270003', 'PRJMIN2002270003', '2002261230005', 84, 164, 'SPKMIN2002270003', 287, 1495, 'ORDMIN2002270003', 6, 2, 'SC1', 'read', '', '2021-02-27 00:58:22'),
('FCPMIN2003220004', 'PRJMIN2003210004', '2003211230005', 86, 170, 'SPKMIN2003210004', 292, 1508, 'ORDMIN2003210004', 6, 2, 'SC1', 'read', '', '2021-03-21 12:00:18');

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `orderID` varchar(50) NOT NULL,
  `order_projectID` varchar(50) DEFAULT NULL,
  `order_clientID` varchar(50) DEFAULT NULL,
  `order_bidangID` int(11) DEFAULT NULL,
  `order_petugasID` int(11) DEFAULT NULL,
  `order_subbidangID` varchar(50) DEFAULT NULL,
  `order_statusID` varchar(11) DEFAULT NULL,
  `waktu_start` datetime DEFAULT NULL,
  `waktu_end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`orderID`, `order_projectID`, `order_clientID`, `order_bidangID`, `order_petugasID`, `order_subbidangID`, `order_statusID`, `waktu_start`, `waktu_end`) VALUES
('ORDMAR2001020001', 'PRJMAR2001020001', '2001021230005', 1, 5, 'AM1', 'PR1', '2021-01-02 07:26:12', '2021-01-02 07:27:12'),
('ORDMAR2001280002', 'PRJMAR2001280002', '2001271230005', 1, 5, 'AM1', 'RJ1', '2021-01-28 00:22:10', '2021-01-28 00:23:10'),
('ORDMAR2001280003', 'PRJMAR2001280002', '2001271230005', 1, 5, 'AM1', 'RJ1', '2021-01-28 00:24:55', '2021-01-28 00:25:55'),
('ORDMAR2002040004', 'PRJMAR2002040003', '2001021230005', 1, 5, 'AM1', 'RJ1', '2021-02-04 11:53:00', '2021-02-04 11:54:00'),
('ORDMAR2002040005', 'PRJMAR2002040003', '2001021230005', 1, 5, 'AM1', 'RJ1', '2021-02-04 11:56:01', '2021-02-04 11:57:01'),
('ORDMAR2002040006', 'PRJMAR2002040003', '2001021230005', 1, 5, 'AM1', 'RJ1', '2021-02-04 12:08:19', '2021-02-04 12:09:19'),
('ORDMAR2002040007', 'PRJMAR2002040003', '2001021230005', 1, 5, 'AM1', 'RJ1', '2021-02-04 12:14:42', '2021-02-04 12:15:42'),
('ORDMAR2002080008', 'PRJMAR2002040003', '2001021230005', 1, 5, 'AM1', 'PR1', '2021-02-08 13:07:41', '2021-02-08 13:08:41'),
('ORDMAR2002080009', 'PRJMAR2002080004', '2001021230005', 1, 5, 'AM1', 'RJ1', '2021-02-08 14:56:01', '2021-02-08 14:57:01'),
('ORDMAR2002080010', 'PRJMAR2002080004', '2001021230005', 1, 5, 'AM1', 'RJ1', '2021-02-08 14:58:28', '2021-02-08 14:59:28'),
('ORDMAR2002080011', 'PRJMAR2002080004', '2001021230005', 1, 5, 'AM1', 'RJ1', '2021-02-08 15:01:59', '2021-02-08 15:02:59'),
('ORDMAR2002080012', 'PRJMAR2002080004', '2001021230005', 1, 5, 'AM1', 'PR1', '2021-02-08 15:02:06', '2021-02-08 15:03:06'),
('ORDMAR2002090013', 'PRJMAR2002090005', '2001021230005', 1, 5, 'AM1', 'RJ1', '2021-02-09 13:02:16', '2021-02-09 13:03:16'),
('ORDMAR2002090014', 'PRJMAR2002090005', '2001021230005', 1, 5, 'AM1', 'RJ1', '2021-02-09 13:03:56', '2021-02-09 13:04:56'),
('ORDMAR2002090015', 'PRJMAR2002090005', '2001021230005', 1, 5, 'AM1', 'RJ1', '2021-02-09 13:05:07', '2021-02-09 13:06:07'),
('ORDMAR2002090016', 'PRJMAR2002090005', '2001021230005', 1, 5, 'AM1', 'RJ1', '2021-02-09 13:06:25', '2021-02-09 13:07:25'),
('ORDMAR2002260017', 'PRJMAR2002260006', '2002261230005', 1, 5, 'AM1', 'RJ1', '2021-02-26 11:04:34', '2021-02-26 11:05:34'),
('ORDMAR2002260018', 'PRJMAR2002260006', '2002261230005', 1, 5, 'AM1', 'PR1', '2021-02-26 11:07:45', '2021-02-26 11:08:45'),
('ORDMAR2003210019', 'PRJMAR2003210010', '2003211230005', 1, 5, 'AM1', 'RJ1', '2021-03-21 21:46:23', '2021-03-21 21:47:23'),
('ORDMAR2003210020', 'PRJMAR2003210010', '2003211230005', 1, 5, 'AM1', 'RJ1', '2021-03-21 21:47:38', '2021-03-21 21:48:38'),
('ORDMAR2003210021', 'PRJMAR2003210010', '2003211230005', 1, 5, 'AM1', 'RJ1', '2021-03-21 21:48:51', '2021-03-21 21:49:51'),
('ORDMAR2003210022', 'PRJMAR2003210009', '2003211230005', 1, 5, 'AM1', 'RJ1', '2021-03-21 23:03:22', '2021-03-21 23:04:22'),
('ORDMAR2003210023', 'PRJMAR2003100008', '2003109870005', 1, 5, 'AM1', 'RJ1', '2021-03-21 23:09:15', '2021-03-21 23:39:15'),
('ORDMAR2003210024', 'PRJMAR2003210011', '2003211230005', 1, 5, 'AM1', 'PR1', '2021-03-21 23:22:09', '2021-03-21 23:52:09'),
('ORDMAR2003230025', 'PRJMAR2003230017', '2003238130005', 1, 5, 'AM1', 'RJ1', '2021-03-23 11:39:35', '2021-03-23 12:09:35'),
('ORDMAR2003230026', 'PRJMAR2003230017', '2003238130005', 1, 5, 'AM1', 'RJ1', '2021-03-23 12:44:42', '2021-03-23 13:14:42'),
('ORDMIN2001020001', 'PRJMIN2001020001', '2001021230005', 2, 6, 'AM2', 'PR1', '2021-01-02 07:36:48', '2021-01-02 07:37:48'),
('ORDMIN2002080002', 'PRJMIN2002080002', '2001021230005', 2, 6, 'AM2', 'PR1', '2021-02-08 14:10:10', '2021-02-08 14:11:10'),
('ORDMIN2002270003', 'PRJMIN2002270003', '2002261230005', 2, 6, 'AM2', 'PR1', '2021-02-27 13:47:39', '2021-02-27 13:48:39'),
('ORDMIN2003210004', 'PRJMIN2003210004', '2003211230005', 2, 6, 'AM2', 'RJ1', '2021-03-21 23:39:07', '2021-03-22 00:09:07'),
('ORDMIN2003220005', 'PRJMIN2003220005', '2003220980005', 2, 6, 'AM2', 'PR1', '2021-03-22 20:15:38', '2021-03-22 20:45:38'),
('ORDMIN2003240006', 'PRJMIN2003240006', '2003249870005', 2, 6, 'AM2', 'RJ1', '2021-03-24 16:20:02', '2021-03-24 16:50:02'),
('ORDMIN2003240007', 'PRJMIN2003240007', '2003249870005', 2, 6, 'AM2', 'PR1', '2021-03-24 16:37:39', '2021-03-24 17:07:39'),
('ORDMIN2003240008', 'PRJMIN2003240008', '2003249870005', 2, 6, 'AM2', 'RJ1', '2021-03-24 16:59:22', '2021-03-24 17:29:22'),
('ORDMIN2003240009', 'PRJMIN2003240009', '2003249870005', 2, 6, 'AM2', 'PR1', '2021-03-24 17:00:57', '2021-03-24 17:30:57'),
('ORDMIN2003250010', 'PRJMIN2003240006', '2003249870005', 2, 6, 'AM2', 'PR1', '2021-03-25 12:06:26', '2021-03-25 12:36:26'),
('ORDMIN2003250011', 'PRJMIN2003250010', '2003251280005', 2, 6, 'AM2', 'PR1', '2021-03-25 15:13:11', '2021-03-25 15:43:11'),
('ORDMIN2003250012', 'PRJMIN2003250011', '2003251280005', 2, 6, 'AM2', 'PR1', '2021-03-25 15:14:25', '2021-03-25 15:44:25'),
('ORDMIN2003250013', 'PRJMIN2003250012', '20032593.0005', 2, 6, 'AM2', 'PR1', '2021-03-25 15:14:44', '2021-03-25 15:44:44'),
('ORDMIN2003250014', 'PRJMIN2003250013', '20032593.0005', 2, 6, 'AM2', 'PR1', '2021-03-25 15:18:10', '2021-03-25 15:48:10'),
('ORDMIN2003250015', 'PRJMIN2003250014', '2003251280005', 2, 6, 'AM2', 'PR1', '2021-03-25 15:18:56', '2021-03-25 15:48:56'),
('ORDMIN2003250016', 'PRJMIN2003250015', '2003251280005', 2, 6, 'AM2', 'PR1', '2021-03-25 15:21:49', '2021-03-25 15:51:49'),
('ORDMIN2003250017', 'PRJMIN2003250016', '20032593.0005', 2, 6, 'AM2', 'PR1', '2021-03-25 15:22:38', '2021-03-25 15:52:38');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengaturan`
--

CREATE TABLE `tb_pengaturan` (
  `pengaturanID` int(11) NOT NULL,
  `waktu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_pengaturan`
--

INSERT INTO `tb_pengaturan` (`pengaturanID`, `waktu`) VALUES
(1, 30);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengelola`
--

CREATE TABLE `tb_pengelola` (
  `pengelolaID` int(11) NOT NULL,
  `pengelolaNama` varchar(255) DEFAULT NULL,
  `pengelolaUsername` varchar(255) DEFAULT NULL,
  `pengelolaPassword` varchar(255) DEFAULT NULL,
  `pengelolaEmail` varchar(255) DEFAULT NULL,
  `pengelolaGender` int(2) DEFAULT NULL,
  `pengelolaTelepon` varchar(255) DEFAULT NULL,
  `pengelolaAlamat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pengelola`
--

INSERT INTO `tb_pengelola` (`pengelolaID`, `pengelolaNama`, `pengelolaUsername`, `pengelolaPassword`, `pengelolaEmail`, `pengelolaGender`, `pengelolaTelepon`, `pengelolaAlamat`) VALUES
(1, 'Admin', 'admin', 'admin', 'coba@gmail.com', 2, '123', 'sfdsfsd'),
(4, 'xadmin', 'xadmin', 'xadmin', 'xadmin', 1, '123', 'xadmin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_petugas`
--

CREATE TABLE `tb_petugas` (
  `petugasID` int(11) NOT NULL,
  `petugasNPWP` varchar(255) DEFAULT NULL,
  `petugasNama` varchar(255) DEFAULT NULL,
  `petugasUsername` varchar(255) DEFAULT NULL,
  `petugasPassword` varchar(255) DEFAULT NULL,
  `petugasGender` int(2) DEFAULT NULL,
  `petugasTelepon` varchar(255) DEFAULT NULL,
  `petugasEmail` varchar(255) DEFAULT NULL,
  `petugasAlamat` varchar(255) DEFAULT NULL,
  `subbidangID` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_petugas`
--

INSERT INTO `tb_petugas` (`petugasID`, `petugasNPWP`, `petugasNama`, `petugasUsername`, `petugasPassword`, `petugasGender`, `petugasTelepon`, `petugasEmail`, `petugasAlamat`, `subbidangID`) VALUES
(5, '123', 'adminMarine', 'adminMarine', 'adminMarine', 1, '08123', 'adminMarine@gmail.com', 'jalan adminMarine', 'AM1'),
(6, '123', 'adminMinerba', 'adminMinerba', 'adminMinerba', 1, '081234566', 'adminMinerba@gmail.com', 'jalan adminMinerba', 'AM2'),
(7, '4454545', 'OMMarine', 'OMMarine', 'OMMarine', 1, '08123456', 'OMMarine@gmail.com', 'jalan OMMarine', 'OMM1'),
(9, '4343', 'MDMarine', 'MDMarine', 'MDMarine', 1, '078878', 'MDMarine', 'alamat MDMarine ', 'MDM1'),
(10, '875656', 'MDMinerba', 'MDMinerba', 'MDMinerba', 1, '0787878', 'MDMinerba@gmail.com', 'alamat MDMinerba ', 'MDM2'),
(13, '234234', 'SurveyorMarine', 'SurveyorMarine', 'SurveyorMarine', 1, '8028434', 'SurveyorMarine@gmail.com', 'alamat SurveyorMarine', 'SM1'),
(14, '45756785', 'SurveyorMinerba', 'SurveyorMinerba', 'SurveyorMinerba', 1, '568787', 'SurveyorMinerba@gmail.com', 'alamat SurveyorMinerba', 'SM2'),
(16, '1234', 'FM', 'FM', 'FM', 1, '7456', 'fm@gmail.com', 'alamat fm', 'FM'),
(17, '123434', 'HR', 'HR', 'HR', 1, '63454', 'hr@gmail.com', 'alamat hr', 'HR'),
(18, '65345', 'GA', 'GA', 'GA', 1, '4656', 'ga@gmail.com', 'alamat GA', 'GA'),
(19, '534545', 'FMMarine', 'FMMarine', 'FMMarine', 1, '34545', 'fmmarine@gmail.com', 'alamat FM Marine', 'FMM1'),
(20, '56456', 'FMMinerba', 'FMMinerba', 'FMMinerba', 1, '45345', 'fmminerba@gmail.com', 'alamat FMMinerba', 'FMM2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_quotation`
--

CREATE TABLE `tb_quotation` (
  `quoID` varchar(50) NOT NULL,
  `quoNo` varchar(50) DEFAULT NULL,
  `quo_orderID` varchar(50) DEFAULT NULL,
  `quo_bidangID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_quotation`
--

INSERT INTO `tb_quotation` (`quoID`, `quoNo`, `quo_orderID`, `quo_bidangID`) VALUES
('QUOMAR2001020001', 'QUO-MAR-001', 'ORDMAR2001020001', 1),
('QUOMAR2001280002', 'QUO-MAR-008', 'ORDMAR2001280002', 1),
('QUOMAR2001280003', 'QUO-MAR-008', 'ORDMAR2001280003', 1),
('QUOMAR2002040004', 'QUO-MAR-011', 'ORDMAR2002040004', 1),
('QUOMAR2002080005', 'QUO-MAR-011', 'ORDMAR2002080008', 1),
('QUOMAR2002080006', 'QUO-MAR-013', 'ORDMAR2002080009', 1),
('QUOMAR2002080007', 'QUO-MAR-013', 'ORDMAR2002080010', 1),
('QUOMAR2002080008', 'QUO-MIN-013', 'ORDMAR2002080012', 1),
('QUOMAR2002090009', 'QUO-MAR-015', 'ORDMAR2002090016', 1),
('QUOMAR2002260010', 'QUO-MAR-017', 'ORDMAR2002260018', 1),
('QUOMAR2003210011', 'QUO-MAR-18', 'ORDMAR2003210020', 1),
('QUOMAR2003210012', 'QUO-MAR-18', 'ORDMAR2003210021', 1),
('QUOMAR2003210013', 'QUO-MAR-19', 'ORDMAR2003210022', 1),
('QUOMAR2003210014', 'QUO-MAR-20', 'ORDMAR2003210024', 1),
('QUOMAR2003230015', 'QUO-06.JKT.MARINE.OOWLI.III.2021', 'ORDMAR2003230025', 1),
('QUOMAR2003230016', 'QUO-06.JKT.MARINE.OOWLI.III.2021', 'ORDMAR2003230026', 1),
('QUOMIN2001020001', 'QUO-MIN-001', 'ORDMIN2001020001', 2),
('QUOMIN2002080002', 'QUO-MIN-012', 'ORDMIN2002080002', 2),
('QUOMIN2002270003', 'QUO-MIN-015', 'ORDMIN2002270003', 2),
('QUOMIN2003210004', 'QUO-MIN-21', 'ORDMIN2003210004', 2),
('QUOMIN2003220005', 'MINERB-004455', 'ORDMIN2003220005', 2),
('QUOMIN2003240006', 'MINERB-05555', 'ORDMIN2003240007', 2),
('QUOMIN2003240007', 'MINERB-09987', 'ORDMIN2003240009', 2),
('QUOMIN2003250008', 'QUO-002', 'ORDMIN2003250010', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_quotationdetail`
--

CREATE TABLE `tb_quotationdetail` (
  `quoDetailID` int(11) NOT NULL,
  `quoD_quoID` varchar(50) DEFAULT NULL,
  `quoD_petugasID` int(11) DEFAULT NULL,
  `quoD_pengirimID` varchar(50) DEFAULT NULL,
  `quoD_penerimaID` varchar(50) DEFAULT NULL,
  `quoDFile` varchar(255) DEFAULT NULL,
  `jumlah` int(2) DEFAULT NULL,
  `quoD_statusID` varchar(11) DEFAULT NULL,
  `statusKonfirmasi` varchar(50) DEFAULT NULL,
  `comment` text,
  `waktu` datetime DEFAULT CURRENT_TIMESTAMP,
  `waktu_start` datetime DEFAULT NULL,
  `waktu_end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_quotationdetail`
--

INSERT INTO `tb_quotationdetail` (`quoDetailID`, `quoD_quoID`, `quoD_petugasID`, `quoD_pengirimID`, `quoD_penerimaID`, `quoDFile`, `jumlah`, `quoD_statusID`, `statusKonfirmasi`, `comment`, `waktu`, `waktu_start`, `waktu_end`) VALUES
(1461, 'QUOMAR2001020001', 5, 'AM1', 'OMM1', 'quoFile-new-210102-f6b529936b.pdf', 0, 'NW1', 'read', '', '2021-01-02 07:26:37', '2021-01-02 07:27:01', '2021-01-02 07:28:01'),
(1462, 'QUOMAR2001020001', 7, 'OMM1', 'MDM1', 'quoFile-new-210102-f6b529936b.pdf', 0, 'NW1', 'read', '', '2021-01-02 07:27:05', '2021-01-02 07:27:22', '2021-01-02 07:28:22'),
(1463, 'QUOMAR2001020001', 9, 'MDM1', 'FM', 'quoFile-new-210102-f6b529936b.pdf', 0, 'SC1', 'read', '', '2021-01-02 07:27:25', '2021-01-02 07:27:41', '2021-01-02 07:28:41'),
(1464, 'QUOMIN2001020001', 6, 'AM2', 'MDM2', 'quoFile-new-210102-d7ea445753.pdf', 0, 'NW1', 'read', '', '2021-01-02 07:37:07', '2021-01-02 07:37:23', '2021-01-02 07:38:23'),
(1465, 'QUOMIN2001020001', 10, 'MDM2', 'FM', 'quoFile-new-210102-d7ea445753.pdf', 0, 'SC1', 'read', '', '2021-01-02 07:37:26', '2021-01-02 07:37:38', '2021-01-02 07:38:38'),
(1466, 'QUOMAR2001280002', 5, 'AM1', 'OMM1', 'quoFile-new-210128-f246a19147.pdf', 0, 'NW1', 'read', '', '2021-01-28 00:22:27', '2021-01-28 00:22:41', '2021-01-28 00:23:41'),
(1467, 'QUOMAR2001280002', 7, 'OMM1', 'MDM1', 'quoFile-new-210128-f246a19147.pdf', 0, 'NW1', 'read', '', '2021-01-28 00:22:45', '2021-01-28 00:22:59', '2021-01-28 00:23:59'),
(1468, 'QUOMAR2001280002', 9, 'MDM1', 'OMM1', 'quoFile-failed-210128-0d8242a2d7.pdf', 0, 'RJ1', 'read', 'fd', '2021-01-28 00:23:05', '2021-01-28 00:23:15', '2021-01-28 00:24:15'),
(1469, 'QUOMAR2001280003', 5, 'AM1', 'OMM1', 'quoFile-new-210128-5495a8b80f.pdf', 0, 'NW1', 'read', '', '2021-01-28 00:25:03', '2021-01-28 00:25:13', '2021-01-28 00:26:13'),
(1470, 'QUOMAR2001280003', 7, 'OMM1', 'MDM1', 'quoFile-new-210128-5495a8b80f.pdf', 0, 'NW1', 'read', '', '2021-01-28 00:25:17', '2021-01-28 00:25:28', '2021-01-28 00:26:28'),
(1471, 'QUOMAR2001280003', 9, 'MDM1', 'OMM1', 'quoFile-failed-210128-2309856cfa.pdf', 0, 'FD1', 'read', '', '2021-01-28 00:25:35', '2021-01-28 00:25:46', '2021-01-28 00:26:46'),
(1472, 'QUOMAR2001280003', 7, 'OMM1', 'AM1', 'quoFile-failed-210128-2309856cfa.pdf', 0, 'FD1', 'read', '', '2021-01-28 00:26:24', '2021-01-28 00:26:35', '2021-01-28 00:27:35'),
(1473, 'QUOMAR2001280003', 5, 'AM1', 'OMM1', 'quoFile-revisi-210128-3fa90425ad.pdf', 1, 'RV1', 'read', '', '2021-01-28 00:26:41', '2021-01-28 00:26:50', '2021-01-28 00:27:50'),
(1474, 'QUOMAR2001280003', 7, 'OMM1', 'MDM1', 'quoFile-revisi-210128-3fa90425ad.pdf', 1, 'RV1', 'read', '', '2021-01-28 00:26:53', '2021-01-28 00:27:04', '2021-01-28 00:28:04'),
(1475, 'QUOMAR2001280003', 9, 'MDM1', 'FM', 'quoFile-revisi-210128-3fa90425ad.pdf', 0, 'RJ1', 'read', '', '2021-01-28 00:27:08', '2021-02-08 14:43:00', '2021-02-08 14:44:00'),
(1476, 'QUOMAR2002040004', 5, 'AM1', 'OMM1', 'quoFile-new-210204-3310423db2.pdf', 0, 'RJ1', 'read', 'dfdf', '2021-02-03 22:53:35', '2021-02-04 11:54:08', '2021-02-04 11:55:08'),
(1477, 'QUOMAR2002080005', 5, 'AM1', 'OMM1', 'quoFile-new-210208-d4aa9e8e07.pdf', 0, 'NW1', 'read', '', '2021-02-08 00:08:10', '2021-02-08 13:08:36', '2021-02-08 13:09:36'),
(1478, 'QUOMAR2002080005', 7, 'OMM1', 'MDM1', 'quoFile-new-210208-d4aa9e8e07.pdf', 0, 'NW1', 'read', '', '2021-02-08 00:08:43', '2021-02-08 13:09:07', '2021-02-08 13:10:07'),
(1479, 'QUOMAR2002080005', 9, 'MDM1', 'FM', 'quoFile-new-210208-d4aa9e8e07.pdf', 0, 'SC1', 'read', '', '2021-02-08 00:09:13', '2021-02-08 13:15:56', '2021-02-08 13:16:56'),
(1480, 'QUOMIN2002080002', 6, 'AM2', 'MDM2', 'quoFile-new-210208-2718bd522b.pdf', 0, 'NW1', 'read', '', '2021-02-08 01:10:30', '2021-02-08 14:11:02', '2021-02-08 14:12:02'),
(1481, 'QUOMIN2002080002', 10, 'MDM2', 'FM', 'quoFile-new-210208-2718bd522b.pdf', 0, 'SC1', 'read', '', '2021-02-08 01:11:08', '2021-02-08 14:11:41', '2021-02-08 14:12:41'),
(1482, 'QUOMAR2002080006', 5, 'AM1', 'OMM1', 'quoFile-new-210208-d7d4d07af1.pdf', 0, 'RJ1', 'read', 'sfdf', '2021-02-08 01:56:19', '2021-02-08 14:56:39', '2021-02-08 14:57:39'),
(1483, 'QUOMAR2002080007', 5, 'AM1', 'OMM1', 'quoFile-new-210208-e3dc198507.pdf', 0, 'NW1', 'read', '', '2021-02-08 01:58:54', '2021-02-08 14:59:15', '2021-02-08 15:00:15'),
(1484, 'QUOMAR2002080007', 7, 'OMM1', 'AM1', 'quoFile-failed-210208-e06077c967.pdf', 0, 'RJ1', 'read', '', '2021-02-08 01:59:26', '2021-02-08 14:59:54', '2021-02-08 15:00:54'),
(1485, 'QUOMAR2002080008', 5, 'AM1', 'OMM1', 'quoFile-new-210208-58d8854497.pdf', 0, 'NW1', 'read', '', '2021-02-08 02:02:45', '2021-02-09 13:09:37', '2021-02-09 13:10:37'),
(1486, 'QUOMAR2002090009', 5, 'AM1', 'OMM1', 'quoFile-new-210209-b3379e022d.pdf', 0, 'RJ1', 'read', 'file 1', '2021-02-09 00:07:08', '2021-02-09 13:11:32', '2021-02-09 13:12:32'),
(1487, 'QUOMAR2002080008', 7, 'OMM1', 'AM1', 'quoFile-failed-210209-094c2d1913.pdf', 0, 'FD1', 'read', '', '2021-02-09 00:10:18', '2021-02-09 13:10:46', '2021-02-09 13:11:46'),
(1488, 'QUOMAR2002080008', 5, 'AM1', 'OMM1', 'quoFile-revisi-210209-055876f2a8.pdf', 1, 'RV1', 'read', '', '2021-02-09 00:11:05', '2021-02-09 13:11:41', '2021-02-09 13:12:41'),
(1489, 'QUOMAR2002080008', 7, 'OMM1', 'MDM1', 'quoFile-revisi-210209-055876f2a8.pdf', 0, 'NW1', 'read', '', '2021-02-09 00:11:50', '2021-02-09 13:12:24', '2021-02-09 13:13:24'),
(1490, 'QUOMAR2002080008', 9, 'MDM1', 'FM', 'quoFile-revisi-210209-055876f2a8.pdf', 0, 'SC1', 'read', '', '2021-02-09 00:12:32', '2021-02-09 13:14:04', '2021-02-09 13:15:04'),
(1491, 'QUOMAR2002260010', 5, 'AM1', 'OMM1', 'quoFile-new-210226-09450195e3.pdf', 0, 'NW1', 'read', 'file Quotation', '2021-02-25 22:08:39', '2021-02-26 11:09:23', '2021-02-26 11:10:23'),
(1492, 'QUOMAR2002260010', 7, 'OMM1', 'MDM1', 'quoFile-new-210226-09450195e3.pdf', 0, 'NW1', 'read', 'File Quotation', '2021-02-25 22:09:48', '2021-02-26 11:10:23', '2021-02-26 11:11:23'),
(1493, 'QUOMAR2002260010', 9, 'MDM1', 'FM', 'quoFile-new-210226-09450195e3.pdf', 0, 'SC1', 'read', '', '2021-02-25 22:10:37', '2021-02-26 11:11:08', '2021-02-26 11:12:08'),
(1494, 'QUOMIN2002270003', 6, 'AM2', 'MDM2', 'quoFile-new-210227-8e1606e482.pdf', 0, 'NW1', 'read', '', '2021-02-27 00:48:13', '2021-02-27 13:48:50', '2021-02-27 13:49:50'),
(1495, 'QUOMIN2002270003', 10, 'MDM2', 'FM', 'quoFile-new-210227-8e1606e482.pdf', 0, 'SC1', 'read', '', '2021-02-27 00:49:00', '2021-02-27 13:49:36', '2021-02-27 13:50:36'),
(1496, 'QUOMAR2003210012', 5, 'AM1', 'OMM1', 'quoFile-new-210321-b8e42ffa2c.pdf', 0, 'RJ1', 'read', '', '2021-03-21 09:49:21', '2021-03-23 11:54:36', '2021-03-23 12:24:36'),
(1497, 'QUOMAR2003210013', 5, 'AM1', 'OMM1', 'quoFile-new-210321-c004f759a5.pdf', 0, 'RJ1', 'read', '', '2021-03-21 11:03:44', '2021-03-21 23:04:21', '2021-03-21 23:34:21'),
(1498, 'QUOMAR2003210014', 5, 'AM1', 'OMM1', 'quoFile-new-210321-266806c4c7.pdf', 0, 'NW1', 'read', '', '2021-03-21 11:22:42', '2021-03-21 23:23:16', '2021-03-21 23:53:16'),
(1499, 'QUOMAR2003210014', 7, 'OMM1', 'MDM1', 'quoFile-new-210321-266806c4c7.pdf', 0, 'NW1', 'read', '', '2021-03-21 11:23:29', '2021-03-21 23:23:54', '2021-03-21 23:53:54'),
(1500, 'QUOMAR2003210014', 9, 'MDM1', 'OMM1', 'quoFile-failed-210321-0f0eca33f8.pdf', 0, 'FD1', 'read', '', '2021-03-21 11:24:11', '2021-03-21 23:24:40', '2021-03-21 23:54:40'),
(1501, 'QUOMAR2003210014', 7, 'OMM1', 'MDM1', 'quoFile-revisi-210321-73c9c3cdc7.pdf', 1, 'RV1', 'read', '', '2021-03-21 11:25:00', '2021-03-21 23:25:44', '2021-03-21 23:55:44'),
(1502, 'QUOMAR2003210014', 9, 'MDM1', 'FM', 'quoFile-revisi-210321-73c9c3cdc7.pdf', 0, 'SC1', 'read', '', '2021-03-21 11:25:53', '2021-03-21 23:26:23', '2021-03-21 23:56:23'),
(1503, 'QUOMIN2003210004', 6, 'AM2', 'MDM2', 'quoFile-new-210321-0f2234e9ce.pdf', 0, 'NW1', 'read', '', '2021-03-21 11:39:36', '2021-03-21 23:40:15', '2021-03-22 00:10:15'),
(1504, 'QUOMIN2003210004', 10, 'MDM2', 'AM2', 'quoFile-failed-210321-21794c04e8.pdf', 0, 'FD1', 'read', '', '2021-03-21 11:40:29', '2021-03-21 23:40:59', '2021-03-22 00:10:59'),
(1505, 'QUOMIN2003210004', 6, 'AM2', 'SM2', 'quoFile-failed-210321-21794c04e8.pdf', 0, 'FD1', 'send', '', '2021-03-21 11:41:20', NULL, NULL),
(1506, 'QUOMIN2003210004', 10, 'MDM2', 'FM', 'quoFile-new-210321-0f2234e9ce.pdf', 0, 'RJ1', 'read', '', '2021-03-21 11:47:02', '2021-03-23 10:34:29', '2021-03-23 11:04:29'),
(1507, 'QUOMIN2003210004', 6, 'AM2', 'MDM2', 'quoFile-revisi-210321-88b9b59797.pdf', 1, 'RV1', 'read', '', '2021-03-21 11:49:15', '2021-03-21 23:49:46', '2021-03-22 00:19:46'),
(1508, 'QUOMIN2003210004', 10, 'MDM2', 'FM', 'quoFile-revisi-210321-88b9b59797.pdf', 1, 'SC1', 'read', '', '2021-03-21 11:49:53', '2021-03-21 23:50:27', '2021-03-22 00:20:27'),
(1509, 'QUOMIN2003220005', 6, 'AM2', 'MDM2', 'quoFile-new-210322-07d4cc6e86.pdf', 0, 'NW1', 'read', '', '2021-03-22 08:22:34', '2021-03-22 20:26:40', '2021-03-22 20:56:40'),
(1510, 'QUOMIN2003220005', 10, 'MDM2', 'FM', 'quoFile-new-210322-07d4cc6e86.pdf', 0, 'SC1', 'read', 'Apik', '2021-03-22 08:28:20', '2021-03-22 20:30:58', '2021-03-22 21:00:58'),
(1511, 'QUOMAR2003230015', 5, 'AM1', 'OMM1', 'quoFile-new-210323-270ce965a9.pdf', 0, 'RJ1', 'read', 'APPROVED QUOTATION PT. GOUKA INDO ENERGY - Draft and Hold Cleanliness Survey at Taboneo', '2021-03-22 23:41:46', '2021-03-23 11:50:49', '2021-03-23 12:20:49'),
(1512, 'QUOMAR2003230016', 5, 'AM1', 'OMM1', 'quoFile-new-210323-f2ff953980.pdf', 0, 'NW1', 'read', '', '2021-03-23 00:45:26', '2021-03-23 12:45:50', '2021-03-23 13:15:50'),
(1513, 'QUOMAR2003230016', 7, 'OMM1', 'MDM1', 'quoFile-new-210323-f2ff953980.pdf', 0, 'NW1', 'read', 'ok please proceed', '2021-03-23 00:47:23', '2021-03-23 12:47:53', '2021-03-23 13:17:53'),
(1514, 'QUOMAR2003230016', 9, 'MDM1', 'OMM1', 'quoFile-failed-210323-62626ab4ca.pdf', 0, 'FD1', 'read', 'coba revisi', '2021-03-23 00:49:05', '2021-03-23 12:49:26', '2021-03-23 13:19:26'),
(1515, 'QUOMAR2003230016', 7, 'OMM1', 'MDM1', 'quoFile-revisi-210323-2404908d65.pdf', 1, 'RV1', 'read', 'revised', '2021-03-23 00:51:26', '2021-03-23 12:51:44', '2021-03-23 13:21:44'),
(1516, 'QUOMAR2003230016', 9, 'MDM1', 'FM', 'quoFile-revisi-210323-2404908d65.pdf', 0, 'RJ1', 'read', 'Please check untuk dikirim ke client ////test', '2021-03-23 00:52:33', '2021-03-23 13:43:22', '2021-03-23 14:13:22'),
(1517, 'QUOMIN2003240006', 6, 'AM2', 'MDM2', 'quoFile-new-210324-3c43ebd9ed.pdf', 0, 'NW1', 'read', '', '2021-03-24 04:38:44', '2021-03-24 16:40:23', '2021-03-24 17:10:23'),
(1518, 'QUOMIN2003240007', 6, 'AM2', 'MDM2', 'quoFile-new-210324-68f89e56e3.pdf', 0, 'NW1', 'read', '', '2021-03-24 05:01:49', '2021-03-24 17:02:35', '2021-03-24 17:32:35'),
(1519, 'QUOMIN2003240007', 10, 'MDM2', 'FM', 'quoFile-new-210324-68f89e56e3.pdf', 0, 'NW1', 'send', '', '2021-03-24 05:03:18', NULL, NULL),
(1520, 'QUOMIN2003250008', 6, 'AM2', 'MDM2', 'quoFile-new-210325-5a36521463.pdf', 0, 'NW1', 'send', '', '2021-03-25 00:09:46', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_spk`
--

CREATE TABLE `tb_spk` (
  `spkID` varchar(50) NOT NULL,
  `spkNo` varchar(50) DEFAULT NULL,
  `spk_jobdaDetailID` int(11) DEFAULT NULL,
  `spk_quoDetailID` int(11) DEFAULT NULL,
  `spk_orderID` varchar(50) DEFAULT NULL,
  `spk_petugasID` int(11) DEFAULT NULL,
  `spk_bidangID` int(11) DEFAULT NULL,
  `spk_statusID` varchar(50) DEFAULT NULL,
  `fileSpk` varchar(255) DEFAULT NULL,
  `fileBiayaSurvey` varchar(255) DEFAULT NULL,
  `statusKonfirmasi` varchar(255) DEFAULT NULL,
  `waktu` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_spk`
--

INSERT INTO `tb_spk` (`spkID`, `spkNo`, `spk_jobdaDetailID`, `spk_quoDetailID`, `spk_orderID`, `spk_petugasID`, `spk_bidangID`, `spk_statusID`, `fileSpk`, `fileBiayaSurvey`, `statusKonfirmasi`, `waktu`) VALUES
('SPKMAR2001020001', 'SPK-MAR-001', 272, 1463, 'ORDMAR2001020001', 5, 1, 'PR1', 'fileSpk-Marine210102-60f2ab16bb.pdf', 'filebiayasurvey-Marine210102-dcf30e105c.pdf', 'send', '2021-01-02 07:29:06'),
('SPKMAR2002080002', 'SPK-MAR-003', 277, 1479, 'ORDMAR2002080008', 5, 1, 'RJ1', 'fileSpk-Marine210208-e50660bb6d.pdf', 'filebiayasurvey-Marine210208-5612eebecf.pdf', 'send', '2021-02-08 00:18:46'),
('SPKMAR2002090003', 'SPK-MAR-007', 282, 1490, 'ORDMAR2002080012', 5, 1, 'PR1', 'fileSpk-Marine210209-39a7f216f0.pdf', 'filebiayasurvey-Marine210209-19ee8d7c4e.pdf', 'send', '2021-02-09 00:19:06'),
('SPKMAR2002260004', 'SPK-MAR-017', 285, 1493, 'ORDMAR2002260018', 5, 1, 'RJ1', 'fileSpk-Marine210226-f346939ed4.pdf', 'filebiayasurvey-Marine210226-b69ba9d2bc.pdf', 'send', '2021-02-25 22:22:19'),
('SPKMAR2003210005', 'SPK-MAR-20', 290, 1502, 'ORDMAR2003210024', 5, 1, 'PR1', 'fileSpk-Marine210321-7e42232e8a.pdf', 'filebiayasurvey-Marine210321-80f52a6530.pdf', 'send', '2021-03-21 11:29:11'),
('SPKMIN2001020001', 'SPK-MIN-001', 274, 1465, 'ORDMIN2001020001', 6, 2, 'PR1', 'fileSpk-Minerba210102-8653564bc4.pdf', 'filebiayasurvey-Minerba210102-bb6a0219ed.pdf', 'send', '2021-01-02 07:38:38'),
('SPKMIN2002080002', 'SPK-MIN-003', 279, 1481, 'ORDMIN2002080002', 6, 2, 'PR1', 'fileSpk-Minerba210208-d2fcbe604b.pdf', 'filebiayasurvey-Minerba210208-e92d5b62a7.pdf', 'send', '2021-02-08 01:13:10'),
('SPKMIN2002270003', 'SPK-MIN-015', 287, 1495, 'ORDMIN2002270003', 6, 2, 'PR1', 'fileSpk-Minerba210227-4e6cb8489a.pdf', 'filebiayasurvey-Minerba210227-e4bd5a737f.pdf', 'send', '2021-02-27 00:51:43'),
('SPKMIN2003210004', 'SPK-MIN-21', 292, 1508, 'ORDMIN2003210004', 6, 2, 'PR1', 'fileSpk-Minerba210321-bd716c3488.pdf', 'filebiayasurvey-Minerba210321-ee29d1c5f2.pdf', 'send', '2021-03-21 11:52:30');

-- --------------------------------------------------------

--
-- Table structure for table `tb_status`
--

CREATE TABLE `tb_status` (
  `statusID` varchar(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `Keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_status`
--

INSERT INTO `tb_status` (`statusID`, `status`, `Keterangan`) VALUES
('FD1', 'failed', 'Failed, Data Ada yang Salah'),
('NW1', 'new', 'New, Data Baru'),
('PR1', 'proses', 'Proses, Data Sedang Di Proses'),
('RJ1', 'reject', 'Reject, Karna Waktu Telah Selesai'),
('RJ2', 'reject', 'Reject, Karena 3x Pengiriman'),
('RV1', 'revisi', 'Revisi, Data Telah Di Revisi'),
('SC1', 'success', 'Sukses, Data Berhasil Di Buat');

-- --------------------------------------------------------

--
-- Table structure for table `tb_subbidang`
--

CREATE TABLE `tb_subbidang` (
  `subbidangID` varchar(50) NOT NULL,
  `subbidangNama` varchar(255) DEFAULT NULL,
  `bidangID` int(11) DEFAULT NULL,
  `subidangrules` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_subbidang`
--

INSERT INTO `tb_subbidang` (`subbidangID`, `subbidangNama`, `bidangID`, `subidangrules`) VALUES
('AM1', 'Admin Marine', 1, 1),
('AM2', 'Admin Minerba', 2, 1),
('FM', 'Finance Manager', 3, 4),
('FMM1', 'Finance Manager', 1, 2),
('FMM2', 'Finance Manager', 2, 2),
('GA', 'GA', 3, 4),
('HR', 'Human Resource', 3, 4),
('MDM1', 'Managing Directory', 1, 2),
('MDM2', 'Managing Directory', 2, 2),
('OMM1', 'Operational Manager', 1, 2),
('SM1', 'Surveyor', 1, 3),
('SM2', 'Surveyor', 2, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_bidang`
--
ALTER TABLE `tb_bidang`
  ADD PRIMARY KEY (`bidangID`);

--
-- Indexes for table `tb_client`
--
ALTER TABLE `tb_client`
  ADD PRIMARY KEY (`clientID`);

--
-- Indexes for table `tb_clientproject`
--
ALTER TABLE `tb_clientproject`
  ADD PRIMARY KEY (`projectID`),
  ADD KEY `projectclientID` (`projectclientID`),
  ADD KEY `projectbidangID` (`projectbidangID`),
  ADD KEY `project_statusID` (`project_statusID`);

--
-- Indexes for table `tb_int_administrasi_suratkeluar`
--
ALTER TABLE `tb_int_administrasi_suratkeluar`
  ADD PRIMARY KEY (`skID`) USING BTREE,
  ADD KEY `sk_smID` (`sk_smID`),
  ADD KEY `sk_petugasID` (`sk_petugasID`);

--
-- Indexes for table `tb_int_administrasi_suratmasuk`
--
ALTER TABLE `tb_int_administrasi_suratmasuk`
  ADD PRIMARY KEY (`smID`) USING BTREE,
  ADD KEY `sm_petugasID` (`sm_petugasID`),
  ADD KEY `sm_pengirimID` (`sm_pengirimID`),
  ADD KEY `sm_penerimaID` (`sm_penerimaID`),
  ADD KEY `sm_statusID` (`sm_statusID`);

--
-- Indexes for table `tb_int_honorarium_approval`
--
ALTER TABLE `tb_int_honorarium_approval`
  ADD PRIMARY KEY (`approvDetailID`) USING BTREE,
  ADD KEY `aproval_petugasID` (`aproval_petugasID`),
  ADD KEY `aproval_pengirimID` (`aproval_pengirimID`),
  ADD KEY `aproval_penerimaID` (`aproval_penerimaID`),
  ADD KEY `approv_budgethonorID` (`approv_budgethonorID`),
  ADD KEY `aproval_statusID` (`aproval_statusID`);

--
-- Indexes for table `tb_int_honorarium_budgethonor`
--
ALTER TABLE `tb_int_honorarium_budgethonor`
  ADD PRIMARY KEY (`budgethonorID`) USING BTREE,
  ADD KEY `budgetH_pengirimID` (`budgetH_pengirimID`),
  ADD KEY `budgetH_petugasID` (`budgetH_petugasID`),
  ADD KEY `budgetH_penerimaID` (`budgetH_penerimaID`),
  ADD KEY `budgetH_statusID` (`budgetH_statusID`);

--
-- Indexes for table `tb_int_honorarium_inventaris`
--
ALTER TABLE `tb_int_honorarium_inventaris`
  ADD PRIMARY KEY (`inventarisID`) USING BTREE,
  ADD KEY `invent_approvDetailID` (`invent_approvDetailID`);

--
-- Indexes for table `tb_int_honorarium_inventarisdetail`
--
ALTER TABLE `tb_int_honorarium_inventarisdetail`
  ADD PRIMARY KEY (`inventarisdetailID`) USING BTREE,
  ADD KEY `inventD_petugasID` (`inventD_petugasID`),
  ADD KEY `inventD_pengirimID` (`inventD_pengirimID`),
  ADD KEY `inventD_penerimaID` (`inventD_penerimaID`),
  ADD KEY `inventD_statusID` (`inventD_statusID`),
  ADD KEY `inventD_inventarisID` (`inventD_inventarisID`);

--
-- Indexes for table `tb_int_pengadaan_approval`
--
ALTER TABLE `tb_int_pengadaan_approval`
  ADD PRIMARY KEY (`approvPBlID`) USING BTREE,
  ADD KEY `approvPB_lbdetailID` (`approvPB_lbdetailID`),
  ADD KEY `approvPB_notadinasID` (`approvPB_notadinasID`),
  ADD KEY `approvPB_pencairanbudgetID` (`approvPB_pencairanbudgetID`),
  ADD KEY `approvPB_bdlDetailID` (`approvPB_bdlDetailID`),
  ADD KEY `approvPB_listbelanjaID` (`approvPB_listbelanjaID`),
  ADD KEY `approvPB_pattycashID` (`approvPB_pattycashID`),
  ADD KEY `approvPB_bidangID` (`approvPB_bidangID`);

--
-- Indexes for table `tb_int_pengadaan_laporanbelanja`
--
ALTER TABLE `tb_int_pengadaan_laporanbelanja`
  ADD PRIMARY KEY (`laporanbelanjaID`) USING BTREE,
  ADD KEY `laporanb_bidangID` (`laporanb_bidangID`),
  ADD KEY `laporanb_pencairanbudgetID` (`laporanb_pencairanbudgetID`),
  ADD KEY `laporanb_bddetailID` (`laporanb_bddetailID`),
  ADD KEY `laporanb_pattycashID` (`laporanb_pattycashID`),
  ADD KEY `laporanb_notadinasID` (`laporanb_notadinasID`),
  ADD KEY `laporanb_listbelanjaID` (`laporanb_listbelanjaID`);

--
-- Indexes for table `tb_int_pengadaan_laporanbelanjadetail`
--
ALTER TABLE `tb_int_pengadaan_laporanbelanjadetail`
  ADD PRIMARY KEY (`lbDetailID`) USING BTREE,
  ADD KEY `lbd_petugasID` (`lbd_petugasID`),
  ADD KEY `lbd_pengirimID` (`lbd_pengirimID`),
  ADD KEY `lbd_penerimaID` (`lbd_penerimaID`),
  ADD KEY `lbd_laporanbelanjaID` (`lbd_laporanbelanjaID`),
  ADD KEY `lbd_statusID` (`lbd_statusID`);

--
-- Indexes for table `tb_int_pengadaan_listbelanja`
--
ALTER TABLE `tb_int_pengadaan_listbelanja`
  ADD PRIMARY KEY (`listbelanjaID`) USING BTREE,
  ADD KEY `lb_petugasID` (`lb_petugasID`),
  ADD KEY `lb_pengirimID` (`lb_pengirimID`),
  ADD KEY `lb_penerimaID` (`lb_penerimaID`),
  ADD KEY `lb_bidangID` (`lb_bidangID`),
  ADD KEY `lb_pattycashID` (`lb_pattycashID`),
  ADD KEY `lb_statusID` (`lb_statusID`);

--
-- Indexes for table `tb_int_pengadaan_listbreakdown`
--
ALTER TABLE `tb_int_pengadaan_listbreakdown`
  ADD KEY `bdl_listbelanjaID` (`bdl_listbelanjaID`),
  ADD KEY `bdl_bidangID` (`bdl_bidangID`),
  ADD KEY `breakdownlistID` (`breakdownlistID`),
  ADD KEY `bdl_pattycashID` (`bdl_pattycashID`);

--
-- Indexes for table `tb_int_pengadaan_listbreakdowndetail`
--
ALTER TABLE `tb_int_pengadaan_listbreakdowndetail`
  ADD PRIMARY KEY (`bdlDetailID`) USING BTREE,
  ADD KEY `bdlD_petugasID` (`bdlD_petugasID`),
  ADD KEY `bdlD_pengirimID` (`bdlD_pengirimID`),
  ADD KEY `bdlD_penerimaID` (`bdlD_penerimaID`),
  ADD KEY `bdlD_breakdownlistID` (`bdlD_breakdownlistID`),
  ADD KEY `bdlD_statusID` (`bdlD_statusID`);

--
-- Indexes for table `tb_int_pengadaan_notadinas`
--
ALTER TABLE `tb_int_pengadaan_notadinas`
  ADD PRIMARY KEY (`notadinasID`) USING BTREE,
  ADD KEY `nd_bidangID` (`nd_bidangID`),
  ADD KEY `nd_petugasID` (`nd_petugasID`),
  ADD KEY `nd_pengirimID` (`nd_pengirimID`),
  ADD KEY `nd_penerimaID` (`nd_penerimaID`),
  ADD KEY `nd_pencairanbudgetID` (`nd_pencairanbudgetID`),
  ADD KEY `nd_statusID` (`nd_statusID`),
  ADD KEY `nd_bdlDetailID` (`nd_bdlDetailID`),
  ADD KEY `nd_listbelanjaID` (`nd_listbelanjaID`),
  ADD KEY `nd_pattycashID` (`nd_pattycashID`);

--
-- Indexes for table `tb_int_pengadaan_pattycash`
--
ALTER TABLE `tb_int_pengadaan_pattycash`
  ADD PRIMARY KEY (`pattycashID`) USING BTREE,
  ADD KEY `pcd_pattycashID` (`pattycashNo`),
  ADD KEY `pcd_petugasID` (`pc_petugasID`),
  ADD KEY `pcd_pengirimID` (`pc_pengirimID`),
  ADD KEY `pcd_penerimaID` (`pc_penerimaID`),
  ADD KEY `pattycash_bidangID` (`pc_bidangID`),
  ADD KEY `pattycash_statusID` (`pc_statusID`);

--
-- Indexes for table `tb_int_pengadaan_pencairanbudget`
--
ALTER TABLE `tb_int_pengadaan_pencairanbudget`
  ADD PRIMARY KEY (`pencairanbudgetID`) USING BTREE,
  ADD KEY `pb_bddetailID` (`pb_bddetailID`),
  ADD KEY `pb_bidangID` (`pb_bidangID`),
  ADD KEY `pb_petugasID` (`pb_petugasID`),
  ADD KEY `pb_pengirimID` (`pb_pengirimID`),
  ADD KEY `pb_penerimaID` (`pb_penerimaID`),
  ADD KEY `pb_pattycashID` (`pb_pattycashID`),
  ADD KEY `pb_statusID` (`pb_statusID`),
  ADD KEY `pb_listbelanjaID` (`pb_listbelanjaID`);

--
-- Indexes for table `tb_jobd_approvaldetail`
--
ALTER TABLE `tb_jobd_approvaldetail`
  ADD PRIMARY KEY (`jobdaDetailID`) USING BTREE,
  ADD KEY `jobdaD_jobdApprovID` (`jobdaD_jobdApprovID`),
  ADD KEY `jobdaD_petugasID` (`jobdaD_petugasID`),
  ADD KEY `jobdaD_pengirimID` (`jobdaD_pengirimID`),
  ADD KEY `jobdaD_penerimaID` (`jobdaD_penerimaID`),
  ADD KEY `jobdaD_statusID` (`jobdaD_statusID`);

--
-- Indexes for table `tb_jobd_aproval`
--
ALTER TABLE `tb_jobd_aproval`
  ADD PRIMARY KEY (`jobdApprovID`) USING BTREE,
  ADD KEY `jobd_quoDetailID` (`jobdA_quoDetailID`),
  ADD KEY `jobdA_bidangID` (`jobdA_bidangID`),
  ADD KEY `jobdA_orderID` (`jobdA_orderID`);

--
-- Indexes for table `tb_marine_finalreport`
--
ALTER TABLE `tb_marine_finalreport`
  ADD PRIMARY KEY (`frMarID`) USING BTREE,
  ADD KEY `frMar_bidangID` (`frMar_bidangID`),
  ADD KEY `frMar_spkID` (`frMar_spkID`),
  ADD KEY `frMar_jobdaDetailID` (`frMar_jobdaDetailID`),
  ADD KEY `frMar_quoDetailID` (`frMar_quoDetailID`),
  ADD KEY `frMar_orderID` (`frMar_orderID`);

--
-- Indexes for table `tb_marine_finalreportdetail`
--
ALTER TABLE `tb_marine_finalreportdetail`
  ADD PRIMARY KEY (`frMarDetailID`) USING BTREE,
  ADD KEY `frMarD_penerimaID` (`frMarD_penerimaID`),
  ADD KEY `frMarD_pengirimID` (`frMarD_pengirimID`),
  ADD KEY `frMarD_petugasID` (`frMarD_petugasID`),
  ADD KEY `frMarD_frID` (`frMarD_frID`),
  ADD KEY `frMarD_statusID` (`frMarD_statusID`);

--
-- Indexes for table `tb_marine_inv_draft`
--
ALTER TABLE `tb_marine_inv_draft`
  ADD PRIMARY KEY (`invMarID`) USING BTREE,
  ADD KEY `invMar_bidangID` (`invMar_bidangID`),
  ADD KEY `invMar_orderID` (`invMar_orderID`),
  ADD KEY `invMar_spkID` (`invMar_spkID`),
  ADD KEY `invMar_frDetailID` (`invMar_frDetailID`),
  ADD KEY `invMar_quoDetailID` (`invMar_quoDetailID`);

--
-- Indexes for table `tb_marine_inv_draftdetail`
--
ALTER TABLE `tb_marine_inv_draftdetail`
  ADD PRIMARY KEY (`invMarDetailID`) USING BTREE,
  ADD KEY `invD_petugasID` (`invMarD_petugasID`),
  ADD KEY `invD_pengirimID` (`invMarD_pengirimID`),
  ADD KEY `invD_penerimaID` (`invMarD_penerimaID`),
  ADD KEY `invMarD_invID` (`invMarD_invID`),
  ADD KEY `invMarD_statusID` (`invMarD_statusID`);

--
-- Indexes for table `tb_marine_inv_finalclient`
--
ALTER TABLE `tb_marine_inv_finalclient`
  ADD PRIMARY KEY (`invMarFinalID`) USING BTREE,
  ADD KEY `invF_bidangID` (`invMarF_bidangID`),
  ADD KEY `invMarF_clientProjectID` (`invMarF_clientProjectID`),
  ADD KEY `invMarF_clientID` (`invMarF_clientID`),
  ADD KEY `invMarF_invMarDetailID` (`invMarF_invMarDetailID`),
  ADD KEY `invMarF_frMarDetailID` (`invMarF_frMarDetailID`),
  ADD KEY `invMarF_spkID` (`invMarF_spkID`),
  ADD KEY `invMarF_jobdaDetailID` (`invMarF_jobdaDetailID`),
  ADD KEY `invMarF_quoDetailID` (`invMarF_quoDetailID`),
  ADD KEY `invMarF_petugasID` (`invMarF_petugasID`),
  ADD KEY `invMarF_statusID` (`invMarF_statusID`),
  ADD KEY `invMarF_orderID` (`invMarF_orderID`);

--
-- Indexes for table `tb_minerba_finalreport`
--
ALTER TABLE `tb_minerba_finalreport`
  ADD PRIMARY KEY (`frMinID`) USING BTREE,
  ADD KEY `frMin_spkID` (`frMin_spkID`),
  ADD KEY `frMin_bidangID` (`frMin_bidangID`),
  ADD KEY `frMin_orderID` (`frMin_orderID`),
  ADD KEY `frMin_jobdaDetailID` (`frMin_jobdaDetailID`),
  ADD KEY `frMin_quoDetailID` (`frMin_quoDetailID`);

--
-- Indexes for table `tb_minerba_finalreportdetail`
--
ALTER TABLE `tb_minerba_finalreportdetail`
  ADD PRIMARY KEY (`frMinDetailID`) USING BTREE,
  ADD KEY `frMinD_frID` (`frMinD_frID`),
  ADD KEY `frMinD_statusID` (`frMinD_statusID`),
  ADD KEY `frMinD_penerimaID` (`frMinD_penerimaID`),
  ADD KEY `frMinD_pengirimID` (`frMinD_pengirimID`),
  ADD KEY `frMinD_petugasID` (`frMinD_petugasID`);

--
-- Indexes for table `tb_minerba_inv_draft`
--
ALTER TABLE `tb_minerba_inv_draft`
  ADD PRIMARY KEY (`invMinID`) USING BTREE,
  ADD KEY `invMin_frDetailID` (`invMin_frDetailID`),
  ADD KEY `invMin_spkID` (`invMin_spkID`),
  ADD KEY `invMin_bidangID` (`invMin_bidangID`),
  ADD KEY `invMin_orderID` (`invMin_orderID`),
  ADD KEY `invMin_jobdaDetailID` (`invMin_jobdaDetailID`),
  ADD KEY `invMin_quoDetailID` (`invMin_quoDetailID`);

--
-- Indexes for table `tb_minerba_inv_draftdetail`
--
ALTER TABLE `tb_minerba_inv_draftdetail`
  ADD PRIMARY KEY (`invMinDetailID`),
  ADD KEY `invMinD_invID` (`invMinD_invID`),
  ADD KEY `invMinD_petugasID` (`invMinD_petugasID`),
  ADD KEY `invMinD_pengirimID` (`invMinD_pengirimID`),
  ADD KEY `invMinD_penerimaID` (`invMinD_penerimaID`),
  ADD KEY `invMinD_statusID` (`invMinD_statusID`);

--
-- Indexes for table `tb_minerba_inv_finalclient`
--
ALTER TABLE `tb_minerba_inv_finalclient`
  ADD PRIMARY KEY (`invMinFinalID`) USING BTREE,
  ADD KEY `invMinF_clientProjectID` (`invMinF_clientProjectID`),
  ADD KEY `invMinF_clientID` (`invMinF_clientID`),
  ADD KEY `invMinF_frMinDetailID` (`invMinF_frMinDetailID`),
  ADD KEY `invMinF_spkID` (`invMinF_spkID`),
  ADD KEY `invMinF_jobdaDetailID` (`invMinF_jobdaDetailID`),
  ADD KEY `invMinF_quoDetailID` (`invMinF_quoDetailID`),
  ADD KEY `invMinF_petugasID` (`invMinF_petugasID`),
  ADD KEY `invMinF_bidangID` (`invMinF_bidangID`),
  ADD KEY `invMinF_statusID` (`invMinF_statusID`),
  ADD KEY `invMinF_orderID` (`invMinF_orderID`),
  ADD KEY `invMinF_invMinDetailID` (`invMinF_invMinDetailID`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `order_projectID` (`order_projectID`),
  ADD KEY `order_clientID` (`order_clientID`),
  ADD KEY `order_bidangID` (`order_bidangID`),
  ADD KEY `order_petugasID` (`order_petugasID`),
  ADD KEY `order_subbidangID` (`order_subbidangID`),
  ADD KEY `order_statusID` (`order_statusID`);

--
-- Indexes for table `tb_pengaturan`
--
ALTER TABLE `tb_pengaturan`
  ADD PRIMARY KEY (`pengaturanID`);

--
-- Indexes for table `tb_pengelola`
--
ALTER TABLE `tb_pengelola`
  ADD PRIMARY KEY (`pengelolaID`) USING BTREE;

--
-- Indexes for table `tb_petugas`
--
ALTER TABLE `tb_petugas`
  ADD PRIMARY KEY (`petugasID`) USING BTREE,
  ADD KEY `petugas_subbidangID` (`subbidangID`);

--
-- Indexes for table `tb_quotation`
--
ALTER TABLE `tb_quotation`
  ADD PRIMARY KEY (`quoID`) USING BTREE,
  ADD KEY `quo_bidangID` (`quo_bidangID`),
  ADD KEY `quo_orderID` (`quo_orderID`);

--
-- Indexes for table `tb_quotationdetail`
--
ALTER TABLE `tb_quotationdetail`
  ADD PRIMARY KEY (`quoDetailID`) USING BTREE,
  ADD KEY `quoD_petugasID` (`quoD_petugasID`),
  ADD KEY `quoD_pengirimID` (`quoD_pengirimID`),
  ADD KEY `quoD_penerimaID` (`quoD_penerimaID`),
  ADD KEY `quoD_quoID` (`quoD_quoID`),
  ADD KEY `quoD_statusID` (`quoD_statusID`);

--
-- Indexes for table `tb_spk`
--
ALTER TABLE `tb_spk`
  ADD PRIMARY KEY (`spkID`),
  ADD KEY `spk_petugasID` (`spk_petugasID`),
  ADD KEY `spk_bidangID` (`spk_bidangID`),
  ADD KEY `spk_jobdaDetailID` (`spk_jobdaDetailID`),
  ADD KEY `spk_quoDetailID` (`spk_quoDetailID`),
  ADD KEY `spk_orderID` (`spk_orderID`),
  ADD KEY `spk_statusID` (`spk_statusID`);

--
-- Indexes for table `tb_status`
--
ALTER TABLE `tb_status`
  ADD PRIMARY KEY (`statusID`);

--
-- Indexes for table `tb_subbidang`
--
ALTER TABLE `tb_subbidang`
  ADD PRIMARY KEY (`subbidangID`) USING BTREE,
  ADD KEY `bidangID` (`bidangID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_bidang`
--
ALTER TABLE `tb_bidang`
  MODIFY `bidangID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_int_administrasi_suratkeluar`
--
ALTER TABLE `tb_int_administrasi_suratkeluar`
  MODIFY `skID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_int_administrasi_suratmasuk`
--
ALTER TABLE `tb_int_administrasi_suratmasuk`
  MODIFY `smID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tb_int_honorarium_approval`
--
ALTER TABLE `tb_int_honorarium_approval`
  MODIFY `approvDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_int_honorarium_budgethonor`
--
ALTER TABLE `tb_int_honorarium_budgethonor`
  MODIFY `budgethonorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tb_int_honorarium_inventarisdetail`
--
ALTER TABLE `tb_int_honorarium_inventarisdetail`
  MODIFY `inventarisdetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_int_pengadaan_approval`
--
ALTER TABLE `tb_int_pengadaan_approval`
  MODIFY `approvPBlID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_int_pengadaan_laporanbelanjadetail`
--
ALTER TABLE `tb_int_pengadaan_laporanbelanjadetail`
  MODIFY `lbDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tb_int_pengadaan_listbelanja`
--
ALTER TABLE `tb_int_pengadaan_listbelanja`
  MODIFY `listbelanjaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tb_int_pengadaan_listbreakdowndetail`
--
ALTER TABLE `tb_int_pengadaan_listbreakdowndetail`
  MODIFY `bdlDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tb_int_pengadaan_pattycash`
--
ALTER TABLE `tb_int_pengadaan_pattycash`
  MODIFY `pattycashID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `tb_jobd_approvaldetail`
--
ALTER TABLE `tb_jobd_approvaldetail`
  MODIFY `jobdaDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=295;

--
-- AUTO_INCREMENT for table `tb_marine_finalreportdetail`
--
ALTER TABLE `tb_marine_finalreportdetail`
  MODIFY `frMarDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=748;

--
-- AUTO_INCREMENT for table `tb_marine_inv_draftdetail`
--
ALTER TABLE `tb_marine_inv_draftdetail`
  MODIFY `invMarDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `tb_minerba_finalreportdetail`
--
ALTER TABLE `tb_minerba_finalreportdetail`
  MODIFY `frMinDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `tb_minerba_inv_draftdetail`
--
ALTER TABLE `tb_minerba_inv_draftdetail`
  MODIFY `invMinDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `tb_pengelola`
--
ALTER TABLE `tb_pengelola`
  MODIFY `pengelolaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_petugas`
--
ALTER TABLE `tb_petugas`
  MODIFY `petugasID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tb_quotationdetail`
--
ALTER TABLE `tb_quotationdetail`
  MODIFY `quoDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1521;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_clientproject`
--
ALTER TABLE `tb_clientproject`
  ADD CONSTRAINT `project_statusID` FOREIGN KEY (`project_statusID`) REFERENCES `tb_status` (`statusID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `projectbidangID` FOREIGN KEY (`projectbidangID`) REFERENCES `tb_bidang` (`bidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `projectclientID` FOREIGN KEY (`projectclientID`) REFERENCES `tb_client` (`clientID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_int_administrasi_suratkeluar`
--
ALTER TABLE `tb_int_administrasi_suratkeluar`
  ADD CONSTRAINT `sk_petugasID` FOREIGN KEY (`sk_petugasID`) REFERENCES `tb_petugas` (`petugasID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sk_smID` FOREIGN KEY (`sk_smID`) REFERENCES `tb_int_administrasi_suratmasuk` (`smID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_int_administrasi_suratmasuk`
--
ALTER TABLE `tb_int_administrasi_suratmasuk`
  ADD CONSTRAINT `sm_penerimaID` FOREIGN KEY (`sm_penerimaID`) REFERENCES `tb_subbidang` (`subbidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sm_pengirimID` FOREIGN KEY (`sm_pengirimID`) REFERENCES `tb_subbidang` (`subbidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sm_petugasID` FOREIGN KEY (`sm_petugasID`) REFERENCES `tb_petugas` (`petugasID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sm_statusID` FOREIGN KEY (`sm_statusID`) REFERENCES `tb_status` (`statusID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_int_honorarium_approval`
--
ALTER TABLE `tb_int_honorarium_approval`
  ADD CONSTRAINT `approv_budgethonorID` FOREIGN KEY (`approv_budgethonorID`) REFERENCES `tb_int_honorarium_budgethonor` (`budgethonorID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `aproval_penerimaID` FOREIGN KEY (`aproval_penerimaID`) REFERENCES `tb_subbidang` (`subbidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `aproval_pengirimID` FOREIGN KEY (`aproval_pengirimID`) REFERENCES `tb_subbidang` (`subbidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `aproval_petugasID` FOREIGN KEY (`aproval_petugasID`) REFERENCES `tb_petugas` (`petugasID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `aproval_statusID` FOREIGN KEY (`aproval_statusID`) REFERENCES `tb_status` (`statusID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_int_honorarium_budgethonor`
--
ALTER TABLE `tb_int_honorarium_budgethonor`
  ADD CONSTRAINT `budgetH_penerimaID` FOREIGN KEY (`budgetH_penerimaID`) REFERENCES `tb_subbidang` (`subbidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `budgetH_pengirimID` FOREIGN KEY (`budgetH_pengirimID`) REFERENCES `tb_subbidang` (`subbidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `budgetH_petugasID` FOREIGN KEY (`budgetH_petugasID`) REFERENCES `tb_petugas` (`petugasID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `budgetH_statusID` FOREIGN KEY (`budgetH_statusID`) REFERENCES `tb_status` (`statusID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_int_honorarium_inventaris`
--
ALTER TABLE `tb_int_honorarium_inventaris`
  ADD CONSTRAINT `invent_approvDetailID` FOREIGN KEY (`invent_approvDetailID`) REFERENCES `tb_int_honorarium_approval` (`approvDetailID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_int_honorarium_inventarisdetail`
--
ALTER TABLE `tb_int_honorarium_inventarisdetail`
  ADD CONSTRAINT `inventD_inventarisID` FOREIGN KEY (`inventD_inventarisID`) REFERENCES `tb_int_honorarium_inventaris` (`inventarisID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `inventD_penerimaID` FOREIGN KEY (`inventD_penerimaID`) REFERENCES `tb_subbidang` (`subbidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `inventD_pengirimID` FOREIGN KEY (`inventD_pengirimID`) REFERENCES `tb_subbidang` (`subbidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `inventD_petugasID` FOREIGN KEY (`inventD_petugasID`) REFERENCES `tb_petugas` (`petugasID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `inventD_statusID` FOREIGN KEY (`inventD_statusID`) REFERENCES `tb_status` (`statusID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_int_pengadaan_approval`
--
ALTER TABLE `tb_int_pengadaan_approval`
  ADD CONSTRAINT `approvPB_bdlDetailID` FOREIGN KEY (`approvPB_bdlDetailID`) REFERENCES `tb_int_pengadaan_listbreakdowndetail` (`bdlDetailID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `approvPB_bidangID` FOREIGN KEY (`approvPB_bidangID`) REFERENCES `tb_bidang` (`bidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `approvPB_lbdetailID` FOREIGN KEY (`approvPB_lbdetailID`) REFERENCES `tb_int_pengadaan_laporanbelanjadetail` (`lbDetailID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `approvPB_listbelanjaID` FOREIGN KEY (`approvPB_listbelanjaID`) REFERENCES `tb_int_pengadaan_listbelanja` (`listbelanjaID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `approvPB_notadinasID` FOREIGN KEY (`approvPB_notadinasID`) REFERENCES `tb_int_pengadaan_notadinas` (`notadinasID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `approvPB_pattycashID` FOREIGN KEY (`approvPB_pattycashID`) REFERENCES `tb_int_pengadaan_pattycash` (`pattycashID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `approvPB_pencairanbudgetID` FOREIGN KEY (`approvPB_pencairanbudgetID`) REFERENCES `tb_int_pengadaan_pencairanbudget` (`pencairanbudgetID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_int_pengadaan_laporanbelanja`
--
ALTER TABLE `tb_int_pengadaan_laporanbelanja`
  ADD CONSTRAINT `laporanb_bddetailID` FOREIGN KEY (`laporanb_bddetailID`) REFERENCES `tb_int_pengadaan_listbreakdowndetail` (`bdlDetailID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `laporanb_bidangID` FOREIGN KEY (`laporanb_bidangID`) REFERENCES `tb_bidang` (`bidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `laporanb_listbelanjaID` FOREIGN KEY (`laporanb_listbelanjaID`) REFERENCES `tb_int_pengadaan_listbelanja` (`listbelanjaID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `laporanb_notadinasID` FOREIGN KEY (`laporanb_notadinasID`) REFERENCES `tb_int_pengadaan_notadinas` (`notadinasID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `laporanb_pattycashID` FOREIGN KEY (`laporanb_pattycashID`) REFERENCES `tb_int_pengadaan_pattycash` (`pattycashID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `laporanb_pencairanbudgetID` FOREIGN KEY (`laporanb_pencairanbudgetID`) REFERENCES `tb_int_pengadaan_pencairanbudget` (`pencairanbudgetID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_int_pengadaan_laporanbelanjadetail`
--
ALTER TABLE `tb_int_pengadaan_laporanbelanjadetail`
  ADD CONSTRAINT `lbd_laporanbelanjaID` FOREIGN KEY (`lbd_laporanbelanjaID`) REFERENCES `tb_int_pengadaan_laporanbelanja` (`laporanbelanjaID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `lbd_penerimaID` FOREIGN KEY (`lbd_penerimaID`) REFERENCES `tb_subbidang` (`subbidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `lbd_pengirimID` FOREIGN KEY (`lbd_pengirimID`) REFERENCES `tb_subbidang` (`subbidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `lbd_petugasID` FOREIGN KEY (`lbd_petugasID`) REFERENCES `tb_petugas` (`petugasID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `lbd_statusID` FOREIGN KEY (`lbd_statusID`) REFERENCES `tb_status` (`statusID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_int_pengadaan_listbelanja`
--
ALTER TABLE `tb_int_pengadaan_listbelanja`
  ADD CONSTRAINT `lb_bidangID` FOREIGN KEY (`lb_bidangID`) REFERENCES `tb_bidang` (`bidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `lb_pattycashID` FOREIGN KEY (`lb_pattycashID`) REFERENCES `tb_int_pengadaan_pattycash` (`pattycashID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `lb_penerimaID` FOREIGN KEY (`lb_penerimaID`) REFERENCES `tb_subbidang` (`subbidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `lb_pengirimID` FOREIGN KEY (`lb_pengirimID`) REFERENCES `tb_subbidang` (`subbidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `lb_petugasID` FOREIGN KEY (`lb_petugasID`) REFERENCES `tb_petugas` (`petugasID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `lb_statusID` FOREIGN KEY (`lb_statusID`) REFERENCES `tb_status` (`statusID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_int_pengadaan_listbreakdown`
--
ALTER TABLE `tb_int_pengadaan_listbreakdown`
  ADD CONSTRAINT `bdl_bidangID` FOREIGN KEY (`bdl_bidangID`) REFERENCES `tb_bidang` (`bidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bdl_listbelanjaID` FOREIGN KEY (`bdl_listbelanjaID`) REFERENCES `tb_int_pengadaan_listbelanja` (`listbelanjaID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bdl_pattycashID` FOREIGN KEY (`bdl_pattycashID`) REFERENCES `tb_int_pengadaan_pattycash` (`pattycashID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_int_pengadaan_listbreakdowndetail`
--
ALTER TABLE `tb_int_pengadaan_listbreakdowndetail`
  ADD CONSTRAINT `bdlD_breakdownlistID` FOREIGN KEY (`bdlD_breakdownlistID`) REFERENCES `tb_int_pengadaan_listbreakdown` (`breakdownlistID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bdlD_penerimaID` FOREIGN KEY (`bdlD_penerimaID`) REFERENCES `tb_subbidang` (`subbidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bdlD_pengirimID` FOREIGN KEY (`bdlD_pengirimID`) REFERENCES `tb_subbidang` (`subbidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bdlD_petugasID` FOREIGN KEY (`bdlD_petugasID`) REFERENCES `tb_petugas` (`petugasID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bdlD_statusID` FOREIGN KEY (`bdlD_statusID`) REFERENCES `tb_status` (`statusID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_int_pengadaan_notadinas`
--
ALTER TABLE `tb_int_pengadaan_notadinas`
  ADD CONSTRAINT `nd_bdlDetailID` FOREIGN KEY (`nd_bdlDetailID`) REFERENCES `tb_int_pengadaan_listbreakdowndetail` (`bdlDetailID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `nd_bidangID` FOREIGN KEY (`nd_bidangID`) REFERENCES `tb_bidang` (`bidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `nd_listbelanjaID` FOREIGN KEY (`nd_listbelanjaID`) REFERENCES `tb_int_pengadaan_listbelanja` (`listbelanjaID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `nd_pattycashID` FOREIGN KEY (`nd_pattycashID`) REFERENCES `tb_int_pengadaan_pattycash` (`pattycashID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `nd_pencairanbudgetID` FOREIGN KEY (`nd_pencairanbudgetID`) REFERENCES `tb_int_pengadaan_pencairanbudget` (`pencairanbudgetID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `nd_penerimaID` FOREIGN KEY (`nd_penerimaID`) REFERENCES `tb_subbidang` (`subbidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `nd_pengirimID` FOREIGN KEY (`nd_pengirimID`) REFERENCES `tb_subbidang` (`subbidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `nd_petugasID` FOREIGN KEY (`nd_petugasID`) REFERENCES `tb_petugas` (`petugasID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `nd_statusID` FOREIGN KEY (`nd_statusID`) REFERENCES `tb_status` (`statusID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_int_pengadaan_pattycash`
--
ALTER TABLE `tb_int_pengadaan_pattycash`
  ADD CONSTRAINT `pattycash_bidangID` FOREIGN KEY (`pc_bidangID`) REFERENCES `tb_bidang` (`bidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pattycash_statusID` FOREIGN KEY (`pc_statusID`) REFERENCES `tb_status` (`statusID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pcd_penerimaID` FOREIGN KEY (`pc_penerimaID`) REFERENCES `tb_subbidang` (`subbidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pcd_pengirimID` FOREIGN KEY (`pc_pengirimID`) REFERENCES `tb_subbidang` (`subbidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pcd_petugasID` FOREIGN KEY (`pc_petugasID`) REFERENCES `tb_petugas` (`petugasID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_int_pengadaan_pencairanbudget`
--
ALTER TABLE `tb_int_pengadaan_pencairanbudget`
  ADD CONSTRAINT `pb_bddetailID` FOREIGN KEY (`pb_bddetailID`) REFERENCES `tb_int_pengadaan_listbreakdowndetail` (`bdlDetailID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pb_bidangID` FOREIGN KEY (`pb_bidangID`) REFERENCES `tb_bidang` (`bidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pb_listbelanjaID` FOREIGN KEY (`pb_listbelanjaID`) REFERENCES `tb_int_pengadaan_listbelanja` (`listbelanjaID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pb_pattycashID` FOREIGN KEY (`pb_pattycashID`) REFERENCES `tb_int_pengadaan_pattycash` (`pattycashID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pb_penerimaID` FOREIGN KEY (`pb_penerimaID`) REFERENCES `tb_subbidang` (`subbidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pb_pengirimID` FOREIGN KEY (`pb_pengirimID`) REFERENCES `tb_subbidang` (`subbidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pb_petugasID` FOREIGN KEY (`pb_petugasID`) REFERENCES `tb_petugas` (`petugasID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pb_statusID` FOREIGN KEY (`pb_statusID`) REFERENCES `tb_status` (`statusID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_jobd_approvaldetail`
--
ALTER TABLE `tb_jobd_approvaldetail`
  ADD CONSTRAINT `jobdaD_jobdApprovID` FOREIGN KEY (`jobdaD_jobdApprovID`) REFERENCES `tb_jobd_aproval` (`jobdApprovID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `jobdaD_penerimaID` FOREIGN KEY (`jobdaD_penerimaID`) REFERENCES `tb_subbidang` (`subbidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `jobdaD_pengirimID` FOREIGN KEY (`jobdaD_pengirimID`) REFERENCES `tb_subbidang` (`subbidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `jobdaD_petugasID` FOREIGN KEY (`jobdaD_petugasID`) REFERENCES `tb_petugas` (`petugasID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `jobdaD_statusID` FOREIGN KEY (`jobdaD_statusID`) REFERENCES `tb_status` (`statusID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_jobd_aproval`
--
ALTER TABLE `tb_jobd_aproval`
  ADD CONSTRAINT `jobdA_bidangID` FOREIGN KEY (`jobdA_bidangID`) REFERENCES `tb_bidang` (`bidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `jobdA_orderID` FOREIGN KEY (`jobdA_orderID`) REFERENCES `tb_order` (`orderID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `jobd_quoDetailID` FOREIGN KEY (`jobdA_quoDetailID`) REFERENCES `tb_quotationdetail` (`quoDetailID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_marine_finalreport`
--
ALTER TABLE `tb_marine_finalreport`
  ADD CONSTRAINT `frMar_bidangID` FOREIGN KEY (`frMar_bidangID`) REFERENCES `tb_bidang` (`bidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `frMar_jobdaDetailID` FOREIGN KEY (`frMar_jobdaDetailID`) REFERENCES `tb_jobd_approvaldetail` (`jobdaDetailID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `frMar_orderID` FOREIGN KEY (`frMar_orderID`) REFERENCES `tb_order` (`orderID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `frMar_quoDetailID` FOREIGN KEY (`frMar_quoDetailID`) REFERENCES `tb_quotationdetail` (`quoDetailID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `frMar_spkID` FOREIGN KEY (`frMar_spkID`) REFERENCES `tb_spk` (`spkID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_marine_finalreportdetail`
--
ALTER TABLE `tb_marine_finalreportdetail`
  ADD CONSTRAINT `frMarD_frID` FOREIGN KEY (`frMarD_frID`) REFERENCES `tb_marine_finalreport` (`frMarID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `frMarD_penerimaID` FOREIGN KEY (`frMarD_penerimaID`) REFERENCES `tb_subbidang` (`subbidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `frMarD_pengirimID` FOREIGN KEY (`frMarD_pengirimID`) REFERENCES `tb_subbidang` (`subbidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `frMarD_petugasID` FOREIGN KEY (`frMarD_petugasID`) REFERENCES `tb_petugas` (`petugasID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `frMarD_statusID` FOREIGN KEY (`frMarD_statusID`) REFERENCES `tb_status` (`statusID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_marine_inv_draft`
--
ALTER TABLE `tb_marine_inv_draft`
  ADD CONSTRAINT `invMar_bidangID` FOREIGN KEY (`invMar_bidangID`) REFERENCES `tb_bidang` (`bidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invMar_frDetailID` FOREIGN KEY (`invMar_frDetailID`) REFERENCES `tb_marine_finalreportdetail` (`frMarDetailID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invMar_orderID` FOREIGN KEY (`invMar_orderID`) REFERENCES `tb_order` (`orderID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invMar_quoDetailID` FOREIGN KEY (`invMar_quoDetailID`) REFERENCES `tb_quotationdetail` (`quoDetailID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invMar_spkID` FOREIGN KEY (`invMar_spkID`) REFERENCES `tb_spk` (`spkID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_marine_inv_draftdetail`
--
ALTER TABLE `tb_marine_inv_draftdetail`
  ADD CONSTRAINT `invD_penerimaID` FOREIGN KEY (`invMarD_penerimaID`) REFERENCES `tb_subbidang` (`subbidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invD_pengirimID` FOREIGN KEY (`invMarD_pengirimID`) REFERENCES `tb_subbidang` (`subbidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invD_petugasID` FOREIGN KEY (`invMarD_petugasID`) REFERENCES `tb_petugas` (`petugasID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invMarD_invID` FOREIGN KEY (`invMarD_invID`) REFERENCES `tb_marine_inv_draft` (`invMarID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invMarD_statusID` FOREIGN KEY (`invMarD_statusID`) REFERENCES `tb_status` (`statusID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_marine_inv_finalclient`
--
ALTER TABLE `tb_marine_inv_finalclient`
  ADD CONSTRAINT `invMarF_clientID` FOREIGN KEY (`invMarF_clientID`) REFERENCES `tb_client` (`clientID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invMarF_clientProjectID` FOREIGN KEY (`invMarF_clientProjectID`) REFERENCES `tb_clientproject` (`projectID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invMarF_frMarDetailID` FOREIGN KEY (`invMarF_frMarDetailID`) REFERENCES `tb_marine_finalreportdetail` (`frMarDetailID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invMarF_invMarDetailID` FOREIGN KEY (`invMarF_invMarDetailID`) REFERENCES `tb_marine_inv_draftdetail` (`invMarDetailID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invMarF_jobdaDetailID` FOREIGN KEY (`invMarF_jobdaDetailID`) REFERENCES `tb_jobd_approvaldetail` (`jobdaDetailID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invMarF_orderID` FOREIGN KEY (`invMarF_orderID`) REFERENCES `tb_order` (`orderID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invMarF_petugasID` FOREIGN KEY (`invMarF_petugasID`) REFERENCES `tb_petugas` (`petugasID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invMarF_quoDetailID` FOREIGN KEY (`invMarF_quoDetailID`) REFERENCES `tb_quotationdetail` (`quoDetailID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invMarF_spkID` FOREIGN KEY (`invMarF_spkID`) REFERENCES `tb_spk` (`spkID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invMarF_statusID` FOREIGN KEY (`invMarF_statusID`) REFERENCES `tb_status` (`statusID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_minerba_finalreport`
--
ALTER TABLE `tb_minerba_finalreport`
  ADD CONSTRAINT `frMin_bidangID` FOREIGN KEY (`frMin_bidangID`) REFERENCES `tb_bidang` (`bidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `frMin_jobdaDetailID` FOREIGN KEY (`frMin_jobdaDetailID`) REFERENCES `tb_jobd_approvaldetail` (`jobdaDetailID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `frMin_orderID` FOREIGN KEY (`frMin_orderID`) REFERENCES `tb_order` (`orderID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `frMin_quoDetailID` FOREIGN KEY (`frMin_quoDetailID`) REFERENCES `tb_quotationdetail` (`quoDetailID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `frMin_spkID` FOREIGN KEY (`frMin_spkID`) REFERENCES `tb_spk` (`spkID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_minerba_finalreportdetail`
--
ALTER TABLE `tb_minerba_finalreportdetail`
  ADD CONSTRAINT `frMinD_frID` FOREIGN KEY (`frMinD_frID`) REFERENCES `tb_minerba_finalreport` (`frMinID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `frMinD_penerimaID` FOREIGN KEY (`frMinD_penerimaID`) REFERENCES `tb_subbidang` (`subbidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `frMinD_pengirimID` FOREIGN KEY (`frMinD_pengirimID`) REFERENCES `tb_subbidang` (`subbidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `frMinD_petugasID` FOREIGN KEY (`frMinD_petugasID`) REFERENCES `tb_petugas` (`petugasID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `frMinD_statusID` FOREIGN KEY (`frMinD_statusID`) REFERENCES `tb_status` (`statusID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_minerba_inv_draft`
--
ALTER TABLE `tb_minerba_inv_draft`
  ADD CONSTRAINT `invMin_bidangID` FOREIGN KEY (`invMin_bidangID`) REFERENCES `tb_bidang` (`bidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invMin_frDetailID` FOREIGN KEY (`invMin_frDetailID`) REFERENCES `tb_minerba_finalreportdetail` (`frMinDetailID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invMin_jobdaDetailID` FOREIGN KEY (`invMin_jobdaDetailID`) REFERENCES `tb_jobd_approvaldetail` (`jobdaDetailID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invMin_orderID` FOREIGN KEY (`invMin_orderID`) REFERENCES `tb_order` (`orderID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invMin_quoDetailID` FOREIGN KEY (`invMin_quoDetailID`) REFERENCES `tb_quotationdetail` (`quoDetailID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invMin_spkID` FOREIGN KEY (`invMin_spkID`) REFERENCES `tb_spk` (`spkID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_minerba_inv_draftdetail`
--
ALTER TABLE `tb_minerba_inv_draftdetail`
  ADD CONSTRAINT `invMinD_invID` FOREIGN KEY (`invMinD_invID`) REFERENCES `tb_minerba_inv_draft` (`invMinID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invMinD_penerimaID` FOREIGN KEY (`invMinD_penerimaID`) REFERENCES `tb_subbidang` (`subbidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invMinD_pengirimID` FOREIGN KEY (`invMinD_pengirimID`) REFERENCES `tb_subbidang` (`subbidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invMinD_petugasID` FOREIGN KEY (`invMinD_petugasID`) REFERENCES `tb_petugas` (`petugasID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invMinD_statusID` FOREIGN KEY (`invMinD_statusID`) REFERENCES `tb_status` (`statusID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_minerba_inv_finalclient`
--
ALTER TABLE `tb_minerba_inv_finalclient`
  ADD CONSTRAINT `invMinF_bidangID` FOREIGN KEY (`invMinF_bidangID`) REFERENCES `tb_bidang` (`bidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invMinF_clientID` FOREIGN KEY (`invMinF_clientID`) REFERENCES `tb_client` (`clientID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invMinF_clientProjectID` FOREIGN KEY (`invMinF_clientProjectID`) REFERENCES `tb_clientproject` (`projectID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invMinF_frMinDetailID` FOREIGN KEY (`invMinF_frMinDetailID`) REFERENCES `tb_minerba_finalreportdetail` (`frMinDetailID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invMinF_invMinDetailID` FOREIGN KEY (`invMinF_invMinDetailID`) REFERENCES `tb_minerba_inv_draftdetail` (`invMinDetailID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invMinF_jobdaDetailID` FOREIGN KEY (`invMinF_jobdaDetailID`) REFERENCES `tb_jobd_approvaldetail` (`jobdaDetailID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invMinF_orderID` FOREIGN KEY (`invMinF_orderID`) REFERENCES `tb_order` (`orderID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invMinF_petugasID` FOREIGN KEY (`invMinF_petugasID`) REFERENCES `tb_petugas` (`petugasID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invMinF_quoDetailID` FOREIGN KEY (`invMinF_quoDetailID`) REFERENCES `tb_quotationdetail` (`quoDetailID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invMinF_spkID` FOREIGN KEY (`invMinF_spkID`) REFERENCES `tb_spk` (`spkID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invMinF_statusID` FOREIGN KEY (`invMinF_statusID`) REFERENCES `tb_status` (`statusID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD CONSTRAINT `order_bidangID` FOREIGN KEY (`order_bidangID`) REFERENCES `tb_bidang` (`bidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `order_clientID` FOREIGN KEY (`order_clientID`) REFERENCES `tb_client` (`clientID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `order_petugasID` FOREIGN KEY (`order_petugasID`) REFERENCES `tb_petugas` (`petugasID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `order_projectID` FOREIGN KEY (`order_projectID`) REFERENCES `tb_clientproject` (`projectID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `order_statusID` FOREIGN KEY (`order_statusID`) REFERENCES `tb_status` (`statusID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `order_subbidangID` FOREIGN KEY (`order_subbidangID`) REFERENCES `tb_subbidang` (`subbidangID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_petugas`
--
ALTER TABLE `tb_petugas`
  ADD CONSTRAINT `petugas_subbidangID` FOREIGN KEY (`subbidangID`) REFERENCES `tb_subbidang` (`subbidangID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_quotation`
--
ALTER TABLE `tb_quotation`
  ADD CONSTRAINT `quo_bidangID` FOREIGN KEY (`quo_bidangID`) REFERENCES `tb_bidang` (`bidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `quo_orderID` FOREIGN KEY (`quo_orderID`) REFERENCES `tb_order` (`orderID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_quotationdetail`
--
ALTER TABLE `tb_quotationdetail`
  ADD CONSTRAINT `quoD_penerimaID` FOREIGN KEY (`quoD_penerimaID`) REFERENCES `tb_subbidang` (`subbidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `quoD_pengirimID` FOREIGN KEY (`quoD_pengirimID`) REFERENCES `tb_subbidang` (`subbidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `quoD_petugasID` FOREIGN KEY (`quoD_petugasID`) REFERENCES `tb_petugas` (`petugasID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `quoD_quoID` FOREIGN KEY (`quoD_quoID`) REFERENCES `tb_quotation` (`quoID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `quoD_statusID` FOREIGN KEY (`quoD_statusID`) REFERENCES `tb_status` (`statusID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_spk`
--
ALTER TABLE `tb_spk`
  ADD CONSTRAINT `spk_bidangID` FOREIGN KEY (`spk_bidangID`) REFERENCES `tb_bidang` (`bidangID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `spk_jobdaDetailID` FOREIGN KEY (`spk_jobdaDetailID`) REFERENCES `tb_jobd_approvaldetail` (`jobdaDetailID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `spk_orderID` FOREIGN KEY (`spk_orderID`) REFERENCES `tb_order` (`orderID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `spk_petugasID` FOREIGN KEY (`spk_petugasID`) REFERENCES `tb_petugas` (`petugasID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `spk_quoDetailID` FOREIGN KEY (`spk_quoDetailID`) REFERENCES `tb_quotationdetail` (`quoDetailID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `spk_statusID` FOREIGN KEY (`spk_statusID`) REFERENCES `tb_status` (`statusID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_subbidang`
--
ALTER TABLE `tb_subbidang`
  ADD CONSTRAINT `bidangID` FOREIGN KEY (`bidangID`) REFERENCES `tb_bidang` (`bidangID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
