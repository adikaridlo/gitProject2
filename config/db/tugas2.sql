-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 29 Mei 2017 pada 02.58
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 7.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tugas2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `book`
--

CREATE TABLE `book` (
  `id` int(45) NOT NULL,
  `title` varchar(225) NOT NULL,
  `category` varchar(225) NOT NULL,
  `user_id` int(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `city`
--

CREATE TABLE `city` (
  `id` int(45) NOT NULL,
  `country_id` int(45) NOT NULL,
  `code` varchar(225) NOT NULL,
  `name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `city`
--

INSERT INTO `city` (`id`, `country_id`, `code`, `name`) VALUES
(2, 5, 'AE', 'Madiun'),
(3, 5, 'JKT', 'DKI Jakarta'),
(4, 5, 'SRB', 'Surabaya'),
(5, 6, 'KL', 'Kuala Lumpur'),
(6, 6, 'GT', 'George Town'),
(7, 6, 'JB', 'Johor Bahru'),
(8, 7, 'BL', 'Buloh'),
(9, 7, 'SG', 'Sembawang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `country`
--

CREATE TABLE `country` (
  `id` int(45) NOT NULL,
  `code` varchar(225) NOT NULL,
  `name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `country`
--

INSERT INTO `country` (`id`, `code`, `name`) VALUES
(5, '+62', 'Indonesia'),
(6, '+60', 'Malaysia'),
(7, '+65', 'Singapore'),
(8, '+94', 'Sri Lanka');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `id` int(45) NOT NULL,
  `name` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `telp` varchar(225) NOT NULL,
  `address` varchar(225) NOT NULL,
  `country_id` int(45) NOT NULL,
  `city_id` int(45) NOT NULL,
  `status` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`id`, `name`, `email`, `telp`, `address`, `country_id`, `city_id`, `status`) VALUES
(30, 'ADIKA', 'arsuga02@gmail.com', '085790331421', 'Ginuk, Karas, Magetan, JATIM', 5, 2, 'YES'),
(31, 'RICKY', 'arsuga02@gmail.com', '085790331421', 'Ginuk, Karas, Magetan, JATIM', 5, 3, 'YES'),
(32, 'DINAR', 'arsuga02@gmail.com', '085790331421', 'Ginuk, Karas, Magetan, JATIM', 5, 4, 'YES'),
(33, 'SUDIR', 'arsuga02@gmail.com', '085790331421', 'Ginuk, Karas, Magetan, JATIM', 5, 2, 'YES');

-- --------------------------------------------------------

--
-- Struktur dari tabel `logs`
--

CREATE TABLE `logs` (
  `id` int(45) NOT NULL,
  `request` varchar(225) NOT NULL,
  `respons` varchar(225) NOT NULL,
  `ip_address` varchar(225) NOT NULL,
  `created_date` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `logs`
--

INSERT INTO `logs` (`id`, `request`, `respons`, `ip_address`, `created_date`) VALUES
(17, '{\"jurnal_no\":\"100000000\",\"customer_id\":\"2\",\"trans_name\":\"Langsung\",\"type\":\"c\",\"amount\":\"70000000\",\"currency\":\"IDR\",\"trans_date\":\"2017-05-31\"}', '{\"status\":true,\"data\":\"Service has been created\",\"id\":17}', '127.0.0.1', '2017-05-19 11:52:38.000000'),
(18, '{\"jurnal_no\":\"100000000\",\"customer_id\":\"2\",\"trans_name\":\"Langsung\",\"type\":\"c\",\"amount\":\"70000000\",\"currency\":\"IDR\",\"trans_date\":\"2017-05-31\"}', '{\"status\":true,\"data\":\"Service has been created\",\"id\":18}', '127.0.0.1', '2017-05-19 11:54:21.000000'),
(19, 'null', '', '127.0.0.1', '2017-05-19 12:11:16.000000'),
(20, 'null', '', '127.0.0.1', '2017-05-19 12:11:31.000000'),
(21, 'null', '', '127.0.0.1', '2017-05-19 12:11:40.000000'),
(22, 'null', '', '127.0.0.1', '2017-05-19 12:11:47.000000'),
(23, 'null', '', '127.0.0.1', '2017-05-19 12:12:08.000000'),
(24, 'null', '', '127.0.0.1', '2017-05-19 12:12:15.000000'),
(25, 'null', '', '127.0.0.1', '2017-05-19 12:12:18.000000'),
(26, 'null', '', '127.0.0.1', '2017-05-19 12:12:26.000000'),
(27, '{\"\'jurnal_no\'\":\"894982\",\"\'customer_id\'\":\"3\",\"\'trans_name\'\":\"Langsung\",\"\'type\'\":\"d\",\"\'amount\'\":\"1010101\",\"\'currency\'\":\"IDR\",\"\'trans_date\'\":\"2017-05-31\"}', '', '127.0.0.1', '2017-05-19 12:22:04.000000'),
(28, 'null', '', '127.0.0.1', '2017-05-19 12:23:25.000000'),
(29, '{\"\'jurnal_no\'\":\"3\",\"\'customer_id\'\":\"Langsung\",\"\'type\'\":\"d\",\"\'amount\'\":\"1010101\",\"\'currency\'\":\"IDR\",\"\'trans_date\'\":\"2017-05-31\"}', '', '127.0.0.1', '2017-05-19 12:24:25.000000'),
(30, '{\"jurnal_no\":\"3\",\"customer_id\":\"Langsung\",\"type\":\"d\",\"amount\":\"1010101\",\"currency\":\"IDR\",\"trans_date\":\"2017-05-31\"}', '', '127.0.0.1', '2017-05-19 12:25:26.000000'),
(31, '{\"\'jurnal_no\'\":\"894982\",\"\'customer_id\'\":\"3\",\"\'trans_name\'\":\"Langsung\",\"\'type\'\":\"d\",\"\'amount\'\":\"10101010\",\"\'currency\'\":\"IDR\",\"\'trans_date\'\":\"2017-05-31\"}', '', '127.0.0.1', '2017-05-19 12:30:47.000000'),
(32, 'null', '', '127.0.0.1', '2017-05-19 12:33:56.000000'),
(33, 'null', '', '127.0.0.1', '2017-05-22 08:03:45.000000'),
(34, 'null', '', '127.0.0.1', '2017-05-22 08:03:46.000000'),
(35, 'null', '', '127.0.0.1', '2017-05-22 08:03:46.000000'),
(36, 'null', '', '127.0.0.1', '2017-05-22 08:05:07.000000'),
(37, 'null', '', '127.0.0.1', '2017-05-22 08:08:32.000000'),
(39, 'null', '', '127.0.0.1', '2017-05-22 08:08:34.000000'),
(42, 'null', '', '127.0.0.1', '2017-05-22 08:08:35.000000'),
(43, 'null', '', '127.0.0.1', '2017-05-22 08:08:38.000000'),
(44, 'null', '', '127.0.0.1', '2017-05-22 08:22:53.000000'),
(45, 'null', '', '127.0.0.1', '2017-05-22 08:23:23.000000'),
(46, 'null', '', '127.0.0.1', '2017-05-22 08:23:35.000000'),
(47, 'null', '', '127.0.0.1', '2017-05-22 08:23:44.000000'),
(48, 'null', '', '127.0.0.1', '2017-05-22 08:24:58.000000'),
(49, 'null', '', '127.0.0.1', '2017-05-22 08:25:14.000000'),
(50, 'null', '', '127.0.0.1', '2017-05-22 08:25:19.000000'),
(51, 'null', '', '127.0.0.1', '2017-05-22 08:25:37.000000'),
(52, 'null', '', '127.0.0.1', '2017-05-22 08:25:58.000000'),
(53, '{\"jurnal_no\":\"100000000\",\"customer_id\":\"2\",\"trans_name\":\"Langsung\",\"type\":\"d\",\"amount\":\"70000000\",\"currency\":\"MYR\",\"trans_date\":\"2017-05-31\"}', '{\"status\":true,\"data\":\"Success...\",\"id\":53}', '127.0.0.1', '2017-05-22 08:26:29.000000'),
(54, 'null', '', '127.0.0.1', '2017-05-22 08:27:42.000000'),
(55, 'null', '', '127.0.0.1', '2017-05-22 08:29:05.000000'),
(56, 'null', '', '127.0.0.1', '2017-05-22 08:32:57.000000'),
(57, '{\"jurnal_no\":\"100000000\",\"customer_id\":\"3\",\"trans_name\":\"Langsung\",\"type\":\"c\",\"amount\":\"32423424\",\"currency\":\"MYR\",\"trans_date\":\"2017-05-31\"}', '{\"status\":true,\"data\":\"Success...\",\"id\":57}', '127.0.0.1', '2017-05-22 08:33:20.000000'),
(58, '{\"jurnal_no\":\"100000000\",\"customer_id\":\"2\",\"trans_name\":\"Langsung\",\"type\":\"c\",\"amount\":\"70000000\",\"currency\":\"IDR\"}', '', '127.0.0.1', '2017-05-23 04:04:57.000000'),
(59, '{\"jurnal_no\":\"100000000\",\"customer_id\":\"2\",\"trans_name\":\"Langsung\",\"type\":\"c\",\"amount\":\"70000000\",\"currency\":\"IDR\",\"trans_date\":\"2017-05-31\"}', '{\"status\":true,\"data\":\"Success...\",\"id\":59}', '127.0.0.1', '2017-05-23 04:05:37.000000'),
(60, '{\"jurnal_no\":\"100000000\",\"customer_id\":\"2\",\"trans_name\":\"Langsung\",\"type\":\"c\",\"amount\":\"70000000\",\"currency\":\"IDR\"}', '', '127.0.0.1', '2017-05-23 04:10:26.000000'),
(61, '{\"jurnal_no\":\"100000000\",\"customer_id\":\"2\",\"trans_name\":\"Langsung\",\"type\":\"c\",\"amount\":\"70000000\",\"currency\":\"IDR\"}', '', '127.0.0.1', '2017-05-23 04:11:27.000000'),
(62, '{\"jurnal_no\":\"454353\",\"customer_id\":\"3\",\"trans_name\":\"Langsung\",\"type\":\"c\",\"amount\":\"32423424\",\"currency\":\"IDR\"}', '', '127.0.0.1', '2017-05-23 04:12:40.000000'),
(63, '{\"jurnal_no\":\"454353\",\"customer_id\":\"3\",\"trans_name\":\"Langsung\",\"type\":\"c\",\"amount\":\"70000000\",\"currency\":\"MYR\"}', '', '127.0.0.1', '2017-05-23 04:13:39.000000'),
(64, '{\"jurnal_no\":\"100000000\",\"customer_id\":\"2\",\"trans_name\":\"Langsung\",\"type\":\"c\",\"amount\":\"70000000\",\"currency\":\"IDR\"}', '', '127.0.0.1', '2017-05-23 04:16:07.000000'),
(65, '{\"jurnal_no\":\"100000000\",\"customer_id\":\"2\",\"trans_name\":\"Langsung\",\"type\":\"c\",\"amount\":\"70000000\",\"currency\":\"IDR\"}', '', '127.0.0.1', '2017-05-23 04:16:43.000000'),
(66, '{\"jurnal_no\":\"100000000\",\"customer_id\":\"2\",\"trans_name\":\"Langsung\",\"type\":\"c\",\"amount\":\"32423424\",\"currency\":\"IDR\"}', '', '127.0.0.1', '2017-05-23 04:17:10.000000'),
(67, '{\"jurnal_no\":\"100000000\",\"customer_id\":\"4\",\"trans_name\":\"Utang\",\"type\":\"c\",\"amount\":\"70000000\",\"currency\":\"IDR\"}', '', '127.0.0.1', '2017-05-23 04:17:57.000000'),
(68, '{\"jurnal_no\":\"100000000\",\"customer_id\":\"2\",\"trans_name\":\"Langsung\",\"type\":\"d\",\"amount\":\"32423424\",\"currency\":\"IDR\"}', '', '127.0.0.1', '2017-05-23 04:19:10.000000'),
(69, '{\"jurnal_no\":\"10000001\",\"customer_id\":\"17\",\"trans_name\":\"Utang\",\"type\":\"c\",\"amount\":\"70000000\",\"currency\":\"IDR\"}', '', '127.0.0.1', '2017-05-23 04:20:40.000000'),
(70, '{\"jurnal_no\":\"100000000\",\"customer_id\":\"2\",\"trans_name\":\"Langsung\",\"type\":\"d\",\"amount\":\"70000000\",\"currency\":\"IDR\"}', '', '127.0.0.1', '2017-05-23 04:22:03.000000'),
(71, '{\"jurnal_no\":\"100000000\",\"customer_id\":\"3\",\"trans_name\":\"Langsung\",\"type\":\"d\",\"amount\":\"70000000\",\"currency\":\"IDR\"}', '', '127.0.0.1', '2017-05-23 04:23:16.000000'),
(72, '{\"jurnal_no\":\"10000001\",\"customer_id\":\"2\",\"trans_name\":\"Langsung\",\"type\":\"d\",\"amount\":\"70000000\",\"currency\":\"IDR\"}', '{\"status\":true,\"data\":\"Success...\",\"id\":72}', '127.0.0.1', '2017-05-23 04:24:05.000000'),
(73, '{\"jurnal_no\":\"100000000\",\"customer_id\":\"19\",\"trans_name\":\"Langsung\",\"type\":\"d\",\"amount\":\"32423424\",\"currency\":\"IDR\"}', '{\"status\":true,\"data\":\"Success...\",\"id\":73}', '127.0.0.1', '2017-05-23 04:25:27.000000'),
(74, '{\"jurnal_no\":\"10000001\",\"customer_id\":\"19\",\"trans_name\":\"Langsung\",\"type\":\"d\",\"amount\":\"32423424\",\"currency\":\"MYR\"}', '{\"status\":true,\"data\":\"Success...\",\"id\":74}', '127.0.0.1', '2017-05-23 04:26:56.000000'),
(75, '{\"jurnal_no\":\"10000001\",\"customer_id\":\"3\",\"trans_name\":\"Langsung\",\"type\":\"c\",\"amount\":\"32423424\",\"currency\":\"IDR\"}', '{\"status\":true,\"data\":\"Success...\",\"id\":75}', '127.0.0.1', '2017-05-23 04:27:47.000000'),
(76, '{\"jurnal_no\":\"454353\",\"customer_id\":\"3\",\"trans_name\":\"Langsung\",\"type\":\"c\",\"amount\":\"32423424\",\"currency\":\"IDR\"}', '{\"status\":true,\"data\":\"Success...\",\"id\":76}', '127.0.0.1', '2017-05-23 04:28:50.000000'),
(77, 'null', '', '127.0.0.1', '2017-05-23 05:01:43.000000'),
(78, 'null', '', '127.0.0.1', '2017-05-23 05:03:05.000000'),
(79, 'null', '', '127.0.0.1', '2017-05-23 05:03:59.000000'),
(80, 'null', '', '127.0.0.1', '2017-05-23 05:09:01.000000'),
(81, 'null', '', '127.0.0.1', '2017-05-23 05:09:59.000000'),
(82, 'null', '', '127.0.0.1', '2017-05-23 05:12:44.000000'),
(83, '{\"jurnal_no\":\"4324324224\",\"customer_id\":\"19\",\"trans_name\":\"Langsung\",\"type\":\"c\",\"amount\":\"70000000\",\"currency\":\"IDR\"}', '{\"status\":true,\"data\":\"Success...\",\"id\":83}', '127.0.0.1', '2017-05-23 10:06:53.000000'),
(84, 'null', '', '127.0.0.1', '2017-05-24 07:42:26.000000'),
(85, 'null', '', '127.0.0.1', '2017-05-24 07:44:53.000000'),
(86, 'null', '', '127.0.0.1', '2017-05-24 07:48:14.000000'),
(87, 'null', '', '127.0.0.1', '2017-05-24 07:48:15.000000'),
(88, 'null', '', '127.0.0.1', '2017-05-24 07:48:15.000000'),
(89, 'null', '', '127.0.0.1', '2017-05-24 07:48:16.000000'),
(90, 'null', '', '127.0.0.1', '2017-05-24 07:48:40.000000'),
(91, 'null', '', '127.0.0.1', '2017-05-24 07:48:40.000000'),
(92, 'null', '', '127.0.0.1', '2017-05-24 07:48:41.000000'),
(93, 'null', '', '127.0.0.1', '2017-05-24 07:51:31.000000'),
(94, 'null', '', '127.0.0.1', '2017-05-24 07:51:32.000000'),
(95, 'null', '', '127.0.0.1', '2017-05-24 07:51:32.000000'),
(96, 'null', '', '127.0.0.1', '2017-05-24 07:51:32.000000'),
(97, 'null', '', '127.0.0.1', '2017-05-24 07:51:33.000000'),
(98, 'null', '', '127.0.0.1', '2017-05-24 07:51:33.000000'),
(99, 'null', '', '127.0.0.1', '2017-05-24 07:51:34.000000'),
(100, 'null', '', '127.0.0.1', '2017-05-24 07:52:15.000000'),
(101, 'null', '', '127.0.0.1', '2017-05-24 07:52:26.000000'),
(102, 'null', '', '127.0.0.1', '2017-05-24 07:52:48.000000'),
(103, 'null', '', '127.0.0.1', '2017-05-24 07:52:49.000000'),
(104, 'null', '', '127.0.0.1', '2017-05-24 07:52:52.000000'),
(105, 'null', '', '127.0.0.1', '2017-05-24 07:54:14.000000'),
(106, 'null', '', '127.0.0.1', '2017-05-24 07:54:24.000000'),
(107, 'null', '', '127.0.0.1', '2017-05-24 07:54:47.000000'),
(108, 'null', '', '127.0.0.1', '2017-05-24 07:54:48.000000'),
(109, 'null', '', '127.0.0.1', '2017-05-24 07:54:48.000000'),
(110, 'null', '', '127.0.0.1', '2017-05-24 07:54:48.000000'),
(111, 'null', '', '127.0.0.1', '2017-05-24 08:01:34.000000'),
(112, '{\"jurnal_no\":\"100000000\",\"customer_id\":\"2\",\"trans_name\":\"Langsung\",\"type\":\"c\",\"amount\":\"70000000\",\"currency\":\"IDR\"}', '{\"status\":true,\"data\":\"Success...\",\"id\":112}', '127.0.0.1', '2017-05-24 10:01:15.000000'),
(113, '{\"jurnal_no\":\"10000001\",\"customer_id\":\"3\",\"trans_name\":\"Langsung\",\"type\":\"c\",\"amount\":\"70000000\",\"currency\":\"MYR\"}', '{\"status\":true,\"data\":\"Success...\",\"id\":113}', '127.0.0.1', '2017-05-24 10:04:41.000000'),
(114, '{\"jurnal_no\":\"454353\",\"customer_id\":\"4\",\"trans_name\":\"Langsung\",\"type\":\"d\",\"amount\":\"32423424\",\"currency\":\"IDR\"}', '{\"status\":true,\"data\":\"Success...\",\"id\":114}', '127.0.0.1', '2017-05-25 08:24:46.000000'),
(115, '{\"jurnal_no\":\"430000\",\"customer_id\":\"29\",\"trans_name\":\"Langsung\",\"type\":\"d\",\"amount\":\"3000\",\"currency\":\"MYR\"}', '{\"status\":true,\"data\":\"Success...\",\"id\":115}', '127.0.0.1', '2017-05-25 08:25:11.000000'),
(116, '{\"jurnal_no\":\"100000000\",\"customer_id\":\"2\",\"trans_name\":\"Langsung\",\"type\":\"d\",\"amount\":\"70000000\",\"currency\":\"IDR\"}', '{\"status\":true,\"data\":\"Success...\",\"id\":116}', '127.0.0.1', '2017-05-25 08:25:49.000000'),
(117, '{\"jurnal_no\":\"100000001\",\"customer_id\":\"2\",\"trans_name\":\"Langsung\",\"type\":\"d\",\"amount\":\"70000000\",\"currency\":\"MYR\"}', '{\"status\":true,\"data\":\"Success...\",\"id\":117}', '127.0.0.1', '2017-05-25 08:26:08.000000'),
(118, '{\"jurnal_no\":\"123\",\"customer_id\":\"30\",\"trans_name\":\"Langsung\",\"type\":\"d\",\"amount\":\"70000000\",\"currency\":\"IDR\"}', '{\"status\":true,\"data\":\"Success...\",\"id\":118}', '127.0.0.1', '2017-05-25 12:29:23.000000'),
(119, '{\"jurnal_no\":\"124\",\"customer_id\":\"31\",\"trans_name\":\"Langsung\",\"type\":\"d\",\"amount\":\"70000000\",\"currency\":\"IDR\"}', '{\"status\":true,\"data\":\"Success...\",\"id\":119}', '127.0.0.1', '2017-05-25 12:29:49.000000'),
(120, '{\"jurnal_no\":\"125\",\"customer_id\":\"32\",\"trans_name\":\"Langsung\",\"type\":\"d\",\"amount\":\"70000000\",\"currency\":\"IDR\"}', '{\"status\":true,\"data\":\"Success...\",\"id\":120}', '127.0.0.1', '2017-05-25 12:30:09.000000'),
(121, '{\"jurnal_no\":\"1236\",\"customer_id\":\"33\",\"trans_name\":\"Langsung\",\"type\":\"d\",\"amount\":\"70000000\",\"currency\":\"IDR\"}', '{\"status\":true,\"data\":\"Success...\",\"id\":121}', '127.0.0.1', '2017-05-26 05:24:30.000000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(45) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `comment` varchar(225) NOT NULL,
  `authKey` varchar(225) NOT NULL,
  `accessToken` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id`, `username`, `password`, `email`, `comment`, `authKey`, `accessToken`) VALUES
(1, 'Adika', '123', 'adika@gmail.com', 'Bla', 'ssaewq3', 'adsad');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction`
--

CREATE TABLE `transaction` (
  `id` int(45) NOT NULL,
  `jurnal_no` char(8) NOT NULL,
  `customer_id` int(45) NOT NULL,
  `trans_name` varchar(225) NOT NULL,
  `type` char(3) NOT NULL,
  `amount` int(45) NOT NULL,
  `currency` varchar(225) NOT NULL,
  `trans_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaction`
--

INSERT INTO `transaction` (`id`, `jurnal_no`, `customer_id`, `trans_name`, `type`, `amount`, `currency`, `trans_date`) VALUES
(75, '123', 30, 'Langsung', 'd', 70000000, 'IDR', '2017-05-25'),
(76, '124', 31, 'Langsung', 'd', 70000000, 'IDR', '2017-05-25'),
(77, '125', 32, 'Langsung', 'd', 70000000, 'IDR', '2017-05-25'),
(78, '1236', 33, 'Langsung', 'd', 70000000, 'IDR', '2017-05-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_id` (`country_id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(45) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;
--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `pengguna` (`id`);

--
-- Ketidakleluasaan untuk tabel `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `city_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);

--
-- Ketidakleluasaan untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`),
  ADD CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`);

--
-- Ketidakleluasaan untuk tabel `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
