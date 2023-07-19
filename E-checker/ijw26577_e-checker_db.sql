-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 10, 2023 at 08:29 PM
-- Server version: 10.4.24-MariaDB-cll-lve-log
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ijw26577_e-checker_db`
--
CREATE DATABASE IF NOT EXISTS `ijw26577echeckerdb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ijw26577echeckerdb`;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `class_id` int(11) NOT NULL,
  `class_teacher_id` int(11) NOT NULL,
  `class_name` varchar(3) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL,
  `school_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `class_teacher_id`, `class_name`, `school_id`) VALUES
(1, 1, 'R3B', 1);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `password` varchar(45) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `email`, `password`) VALUES
(1, 'admin@usdd.company', 'Idiotsi123!'),
(2, 'zan.skorja@sc-celje.si', 'Pakatimislisdasiprofesor?');

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `school_id` int(11) NOT NULL,
  `school_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL,
  `address_line_1` varchar(100) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL,
  `address_line_2` varchar(100) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL,
  `city` varchar(45) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL,
  `post_code` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`school_id`, `school_name`, `address_line_1`, `address_line_2`, `city`, `post_code`) VALUES
(1, 'Šolski center Celje, Srednja šola za kemijo, elektrotehniko in računalništvo', 'Pot na Lavo', '22', 'Celje', 3000);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `class` varchar(3) COLLATE utf8_slovenian_ci NOT NULL,
  `class_teacher` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `email`, `class`, `class_teacher`) VALUES
(1, 'zan.skorja@sc-celje.si', 'R3B', 1);

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `token_id` varchar(20) NOT NULL,
  `issued_at` int(11) NOT NULL,
  `expires_at` int(11) NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`token_id`, `issued_at`, `expires_at`, `email`) VALUES
('TID6453f825782ae', 1683224613, 1683224913, 'zan.skorja@sc-celje.si'),
('TID6454243d0792e', 1683235901, 1683236201, 'admin@usdd.company'),
('TID64542934b6c9d', 1683237172, 1683237472, 'admin@usdd.company'),
('TID64549afa6ef0c', 1683266298, 1683266598, 'admin@usdd.company'),
('TID64549e1ce3c96', 1683267100, 1683267400, 'zan.skorja@sc-celje.si'),
('TID64554594e4cb3', 1683309972, 1683310272, 'zan.skorja@sc-celje.si'),
('TID6456850bbd429', 1683391755, 1683392055, 'zan.skorja@sc-celje.si'),
('TID645686e8c9584', 1683392232, 1683392532, 'zan.skorja@sc-celje.si'),
('TID6456881a645c7', 1683392538, 1683392838, 'zan.skorja@sc-celje.si'),
('TID645a12e97d21b', 1683624681, 1683624981, 'admin@usdd.company'),
('TID645a12fd87dcc', 1683624701, 1683625001, 'zan.skorja@sc-celje.si'),
('TID645a147149d20', 1683625073, 1683625373, 'zan.skorja@sc-celje.si'),
('TID645a222e7e417', 1683628590, 1683628890, 'admin@usdd.company'),
('TID645a227bcd7f4', 1683628667, 1683628967, 'admin@usdd.company'),
('TID645a247b0d802', 1683629179, 1683629479, 'admin@usdd.company'),
('TID645a280d6490e', 1683630093, 1683630393, 'zan.skorja@sc-celje.si'),
('TID645a6fc6a27ab', 1683648454, 1683648754, 'zan.skorja@sc-celje.si'),
('TID645a7077d8c24', 1683648631, 1683648931, 'zan.skorja@sc-celje.si'),
('TID645a719b75fe5', 1683648923, 1683649223, 'zan.skorja@sc-celje.si'),
('TID645a73b344de6', 1683649459, 1683649759, 'zan.skorja@sc-celje.si'),
('TID645a73fb04302', 1683649531, 1683649831, 'zan.skorja@sc-celje.si'),
('TID645a750871621', 1683649800, 1683650100, 'zan.skorja@sc-celje.si'),
('TID645a76c1eee17', 1683650241, 1683650541, 'zan.skorja@sc-celje.si'),
('TID645a7a87202e1', 1683651207, 1683651507, 'zan.skorja@sc-celje.si'),
('TID645a7a873daab', 1683651207, 1683651507, 'zan.skorja@sc-celje.si'),
('TID645a7bc69e98a', 1683651526, 1683651826, 'zan.skorja@sc-celje.si'),
('TID645a7e081f13c', 1683652104, 1683652404, 'zan.skorja@sc-celje.si'),
('TID645a7e1f53f31', 1683652127, 1683652427, 'zan.skorja@sc-celje.si'),
('TID645a7f467b492', 1683652422, 1683652722, 'zan.skorja@sc-celje.si'),
('TID645a8029be811', 1683652649, 1683652949, 'zan.skorja@sc-celje.si'),
('TID645a81604da3d', 1683652960, 1683653260, 'zan.skorja@sc-celje.si'),
('TID645a81d6eac68', 1683653078, 1683653378, 'zan.skorja@sc-celje.si'),
('TID645a83be8b9dd', 1683653566, 1683653866, 'zan.skorja@sc-celje.si'),
('TID645a84fa7d9cd', 1683653882, 1683654182, 'zan.skorja@sc-celje.si'),
('TID645a86e0c02f8', 1683654368, 1683654668, 'zan.skorja@sc-celje.si'),
('TID645a88726945c', 1683654770, 1683655070, 'zan.skorja@sc-celje.si'),
('TID645a899d32740', 1683655069, 1683655369, 'zan.skorja@sc-celje.si'),
('TID645a8bce63c35', 1683655630, 1683655930, 'zan.skorja@sc-celje.si'),
('TID645a8d291d265', 1683655977, 1683656277, 'zan.skorja@sc-celje.si'),
('TID645a8e100d4db', 1683656208, 1683656508, 'zan.skorja@sc-celje.si'),
('TID645a8f0dcf93d', 1683656461, 1683656761, 'zan.skorja@sc-celje.si'),
('TID645a907ee716b', 1683656830, 1683657130, 'zan.skorja@sc-celje.si'),
('TID645a92627de65', 1683657314, 1683657614, 'zan.skorja@sc-celje.si'),
('TID645a93471db86', 1683657543, 1683657843, 'zan.skorja@sc-celje.si'),
('TID645a9470ea94a', 1683657840, 1683658140, 'zan.skorja@sc-celje.si'),
('TID645a95b786f00', 1683658167, 1683658467, 'zan.skorja@sc-celje.si'),
('TID645a972dc9db7', 1683658541, 1683658841, 'zan.skorja@sc-celje.si'),
('TID645a97aa6d5b4', 1683658666, 1683658966, 'zan.skorja@sc-celje.si'),
('TID645a97b3449e7', 1683658675, 1683658975, 'zan.skorja@sc-celje.si'),
('TID645a97b6d4ff2', 1683658678, 1683658978, 'zan.skorja@sc-celje.si'),
('TID645a97e5d4e72', 1683658725, 1683659025, 'zan.skorja@sc-celje.si'),
('TID645a97e7223cd', 1683658727, 1683659027, 'zan.skorja@sc-celje.si'),
('TID645a97e7a25e9', 1683658727, 1683659027, 'zan.skorja@sc-celje.si'),
('TID645a97e7ed1ae', 1683658727, 1683659027, 'zan.skorja@sc-celje.si'),
('TID645a97e8572a4', 1683658728, 1683659028, 'zan.skorja@sc-celje.si'),
('TID645a97e8cf528', 1683658728, 1683659028, 'zan.skorja@sc-celje.si'),
('TID645a97e8e180b', 1683658728, 1683659028, 'zan.skorja@sc-celje.si'),
('TID645a97e91561a', 1683658729, 1683659029, 'zan.skorja@sc-celje.si'),
('TID645a982545d99', 1683658789, 1683659089, 'zan.skorja@sc-celje.si'),
('TID645a983cd3c73', 1683658812, 1683659112, 'zan.skorja@sc-celje.si'),
('TID645a9843b77f3', 1683658819, 1683659119, 'zan.skorja@sc-celje.si'),
('TID645a986605bb5', 1683658854, 1683659154, 'zan.skorja@sc-celje.si'),
('TID645a9867cfd05', 1683658855, 1683659155, 'zan.skorja@sc-celje.si'),
('TID645a986a703fc', 1683658858, 1683659158, 'zan.skorja@sc-celje.si'),
('TID645a9872231a7', 1683658866, 1683659166, 'zan.skorja@sc-celje.si'),
('TID645a9876cc9e7', 1683658870, 1683659170, 'zan.skorja@sc-celje.si'),
('TID645a988908c94', 1683658889, 1683659189, 'zan.skorja@sc-celje.si'),
('TID645a9889e8973', 1683658889, 1683659189, 'zan.skorja@sc-celje.si'),
('TID645a98a16047e', 1683658913, 1683659213, 'zan.skorja@sc-celje.si'),
('TID645a98a21172c', 1683658914, 1683659214, 'zan.skorja@sc-celje.si'),
('TID645a98a23eebd', 1683658914, 1683659214, 'zan.skorja@sc-celje.si'),
('TID645a98a266328', 1683658914, 1683659214, 'zan.skorja@sc-celje.si'),
('TID645a98a28e688', 1683658914, 1683659214, 'zan.skorja@sc-celje.si'),
('TID645a98a3141e9', 1683658915, 1683659215, 'zan.skorja@sc-celje.si'),
('TID645a98b188724', 1683658929, 1683659229, 'zan.skorja@sc-celje.si'),
('TID645a98bf4ae2c', 1683658943, 1683659243, 'zan.skorja@sc-celje.si'),
('TID645a98bfcafea', 1683658943, 1683659243, 'zan.skorja@sc-celje.si'),
('TID645a98c697063', 1683658950, 1683659250, 'zan.skorja@sc-celje.si'),
('TID645a99384c25d', 1683659064, 1683659364, 'zan.skorja@sc-celje.si'),
('TID645a994e54cef', 1683659086, 1683659386, 'zan.skorja@sc-celje.si'),
('TID645a996b950e2', 1683659115, 1683659415, 'zan.skorja@sc-celje.si'),
('TID645a996d55eed', 1683659117, 1683659417, 'zan.skorja@sc-celje.si'),
('TID645a996d78336', 1683659117, 1683659417, 'zan.skorja@sc-celje.si'),
('TID645a996de1216', 1683659117, 1683659417, 'zan.skorja@sc-celje.si'),
('TID645a996e0a17c', 1683659118, 1683659418, 'zan.skorja@sc-celje.si'),
('TID645a997377f06', 1683659123, 1683659423, 'zan.skorja@sc-celje.si'),
('TID645a997b719f2', 1683659131, 1683659431, 'zan.skorja@sc-celje.si'),
('TID645a99b966978', 1683659193, 1683659493, 'zan.skorja@sc-celje.si'),
('TID645a99c25d26b', 1683659202, 1683659502, 'zan.skorja@sc-celje.si'),
('TID645a99c4d4a61', 1683659204, 1683659504, 'zan.skorja@sc-celje.si'),
('TID645a99e10d0dc', 1683659233, 1683659533, 'zan.skorja@sc-celje.si'),
('TID645a99e7dec35', 1683659239, 1683659539, 'zan.skorja@sc-celje.si'),
('TID645a99ec18ad2', 1683659244, 1683659544, 'zan.skorja@sc-celje.si'),
('TID645a99eeef2ba', 1683659246, 1683659546, 'zan.skorja@sc-celje.si'),
('TID645a99f4f0814', 1683659252, 1683659552, 'zan.skorja@sc-celje.si'),
('TID645a9a5116eb3', 1683659345, 1683659645, 'zan.skorja@sc-celje.si'),
('TID645a9a525817f', 1683659346, 1683659646, 'zan.skorja@sc-celje.si'),
('TID645a9a530d140', 1683659347, 1683659647, 'zan.skorja@sc-celje.si'),
('TID645a9a539edfa', 1683659347, 1683659647, 'zan.skorja@sc-celje.si'),
('TID645a9a8bedc6d', 1683659403, 1683659703, 'zan.skorja@sc-celje.si'),
('TID645a9a9544a91', 1683659413, 1683659713, 'zan.skorja@sc-celje.si'),
('TID645a9a95db8f9', 1683659413, 1683659713, 'zan.skorja@sc-celje.si'),
('TID645a9a9607128', 1683659414, 1683659714, 'zan.skorja@sc-celje.si'),
('TID645a9aa1d65ac', 1683659425, 1683659725, 'zan.skorja@sc-celje.si'),
('TID645a9aa2ceb0f', 1683659426, 1683659726, 'zan.skorja@sc-celje.si'),
('TID645a9aa32dbdf', 1683659427, 1683659727, 'zan.skorja@sc-celje.si'),
('TID645a9aa392eb9', 1683659427, 1683659727, 'zan.skorja@sc-celje.si'),
('TID645a9aa424900', 1683659428, 1683659728, 'zan.skorja@sc-celje.si'),
('TID645a9aaa9bca7', 1683659434, 1683659734, 'zan.skorja@sc-celje.si'),
('TID645a9addea836', 1683659485, 1683659785, 'zan.skorja@sc-celje.si'),
('TID645a9ae2941ba', 1683659490, 1683659790, 'zan.skorja@sc-celje.si'),
('TID645a9b01c1b5b', 1683659521, 1683659821, 'zan.skorja@sc-celje.si'),
('TID645a9b0a97fd7', 1683659530, 1683659830, 'zan.skorja@sc-celje.si'),
('TID645a9b34aaaa9', 1683659572, 1683659872, 'zan.skorja@sc-celje.si'),
('TID645a9b3a2b5cd', 1683659578, 1683659878, 'zan.skorja@sc-celje.si'),
('TID645a9b85843d1', 1683659653, 1683659953, 'zan.skorja@sc-celje.si'),
('TID645a9cab30a85', 1683659947, 1683660247, 'zan.skorja@sc-celje.si'),
('TID645a9e52bd85b', 1683660370, 1683660670, 'zan.skorja@sc-celje.si'),
('TID645aa013ccc51', 1683660819, 1683661119, 'zan.skorja@sc-celje.si'),
('TID645aa9e744de3', 1683663335, 1683663635, 'zan.skorja@sc-celje.si'),
('TID645aaba1e92e4', 1683663777, 1683664077, 'zan.skorja@sc-celje.si'),
('TID645ab18e3abb1', 1683665294, 1683665594, 'zan.skorja@sc-celje.si'),
('TID645ab1f7ded95', 1683665399, 1683665699, 'zan.skorja@sc-celje.si'),
('TID645ab2c3013e7', 1683665603, 1683665903, 'zan.skorja@sc-celje.si'),
('TID645ab4acc6e85', 1683666092, 1683666392, 'zan.skorja@sc-celje.si'),
('TID645ab5f170c14', 1683666417, 1683666717, 'zan.skorja@sc-celje.si'),
('TID645ab73bd3e03', 1683666747, 1683667047, 'zan.skorja@sc-celje.si'),
('TID645ab973de3c0', 1683667315, 1683667615, 'zan.skorja@sc-celje.si'),
('TID645abb6b2cde4', 1683667819, 1683668119, 'zan.skorja@sc-celje.si'),
('TID645abc516816f', 1683668049, 1683668349, 'zan.skorja@sc-celje.si'),
('TID645abe072e98e', 1683668487, 1683668787, 'zan.skorja@sc-celje.si'),
('TID645b13f988b27', 1683690489, 1683690789, 'zan.skorja@sc-celje.si'),
('TID645b4c5d7004d', 1683704925, 1683705225, 'zan.skorja@sc-celje.si'),
('TID645b4c75aa2e0', 1683704949, 1683705249, 'zan.skorja@sc-celje.si'),
('TID645b537a39777', 1683706746, 1683707046, 'admin@usdd.company'),
('TID645b54c572da1', 1683707077, 1683707377, 'admin@usdd.company'),
('TID645b58744f6ee', 1683708020, 1683708320, 'admin@usdd.company'),
('TID645b596e132cb', 1683708270, 1683708570, 'admin@usdd.company'),
('TID645b5bd0138e5', 1683708880, 1683709180, 'admin@usdd.company'),
('TID645b5de2deb21', 1683709410, 1683709710, 'admin@usdd.company'),
('TID645b60cd19c11', 1683710157, 1683710457, 'admin@usdd.company'),
('TID645b61ac0423c', 1683710380, 1683710680, 'admin@usdd.company'),
('TID645b6281c2409', 1683710593, 1683710893, 'admin@usdd.company'),
('TID645b63e671800', 1683710950, 1683711250, 'admin@usdd.company'),
('TID645b68e228955', 1683712226, 1683712526, 'admin@usdd.company'),
('TID645b6a61daf07', 1683712609, 1683712909, 'admin@usdd.company'),
('TID645b6bcc62581', 1683712972, 1683713272, 'admin@usdd.company'),
('TID645b70d33aacb', 1683714259, 1683714559, 'zan.skorja@sc-celje.si'),
('TID645b70da91550', 1683714266, 1683714566, 'zan.skorja@sc-celje.si'),
('TID645b711495433', 1683714324, 1683714624, 'zan.skorja@sc-celje.si'),
('TID645b7144121c6', 1683714372, 1683714672, 'zan.skorja@sc-celje.si'),
('TID645b714a19223', 1683714378, 1683714678, 'zan.skorja@sc-celje.si'),
('TID645b7165e415d', 1683714405, 1683714705, 'zan.skorja@sc-celje.si'),
('TID645b71854ae3a', 1683714437, 1683714737, 'zan.skorja@sc-celje.si'),
('TID645b78419d01b', 1683716161, 1683716461, 'admin@usdd.company'),
('TID645b81ce4bb60', 1683718606, 1683718906, 'zan.skorja@sc-celje.si'),
('TID645b844b3f801', 1683719243, 1683719543, 'zan.skorja@sc-celje.si'),
('TID645b85d1da72c', 1683719633, 1683719933, 'zan.skorja@sc-celje.si'),
('TID645b867744017', 1683719799, 1683720099, 'zan.skorja@sc-celje.si'),
('TID645b86e7733f8', 1683719911, 1683720211, 'zan.skorja@sc-celje.si'),
('TID645b878ca85b9', 1683720076, 1683720376, 'zan.skorja@sc-celje.si'),
('TID645b87a0c2fe0', 1683720096, 1683720396, 'admin@usdd.company'),
('TID645b8a2f3eecc', 1683720751, 1683721051, 'admin@usdd.company'),
('TID645b8aa314873', 1683720867, 1683721167, 'zan.skorja@sc-celje.si'),
('TID645b8bed7f87b', 1683721197, 1683721497, 'admin@usdd.company'),
('TID645b8f9db9b00', 1683722141, 1683722441, 'admin@usdd.company'),
('TID645b914090e6a', 1683722560, 1683722860, 'admin@usdd.company'),
('TID645b932e73d54', 1683723054, 1683723354, 'admin@usdd.company'),
('TID645b96b42c493', 1683723956, 1683724256, 'admin@usdd.company'),
('TID645b98991d824', 1683724441, 1683724741, 'admin@usdd.company'),
('TID645b9a1c937ac', 1683724828, 1683725128, 'admin@usdd.company'),
('TID645b9b1279bab', 1683725074, 1683725374, 'admin@usdd.company');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `email` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `name` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `surname` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `role` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `school_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`email`, `name`, `surname`, `role`, `school_id`) VALUES
('admin@usdd.company', 'Dominik', 'Brezovšek', 'admin', 1),
('zan.skorja@sc-celje.si', 'Žan', 'Škorja', 'profesor', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `class_teacher_id` (`class_teacher_id`),
  ADD KEY `class_school_id` (`school_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`),
  ADD KEY `Login_email_FK` (`email`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`school_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`),
  ADD KEY `teachers_email_FK` (`email`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`token_id`),
  ADD KEY `token_email_FK` (`email`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`),
  ADD KEY `user_school_FK` (`school_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `school_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_school_id` FOREIGN KEY (`school_id`) REFERENCES `school` (`school_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `class_teacher_id` FOREIGN KEY (`class_teacher_id`) REFERENCES `teachers` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `Login_email_FK` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_email_FK` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `token_email_FK` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_school_FK` FOREIGN KEY (`school_id`) REFERENCES `school` (`school_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
