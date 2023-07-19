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
-- Database: `ijw26577_e-id`
--
CREATE DATABASE IF NOT EXISTS `ijw26577eid` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ijw26577eid`;

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `card_id` int(11) NOT NULL,
  `type` varchar(1000) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL,
  `date_of_expiration` date NOT NULL,
  `issued_at` int(11) NOT NULL,
  `issuer` int(11) NOT NULL,
  `owner` varchar(100) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`card_id`, `type`, `date_of_expiration`, `issued_at`, `issuer`, `owner`) VALUES
(6, 'Dijaška izkaznica ŠC Celje, SŠ KER', '2024-06-24', 1683630538, 1, 'zan.skorja@gmail.com'),
(7, 'Dijaška izkaznica ŠC Celje, SŠ KER', '2024-06-24', 1683630538, 1, 'mejaknik@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `card_types`
--

CREATE TABLE `card_types` (
  `id` int(11) NOT NULL,
  `card_type` varchar(1000) COLLATE utf8_slovenian_ci NOT NULL,
  `image` varchar(500) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `card_types`
--

INSERT INTO `card_types` (`id`, `card_type`, `image`) VALUES
(1, 'Dijaška izkaznica ŠC Celje, SŠ KER', 'student.png'),
(2, 'Test card', 'personal_id.png'),
(4, 'Test', '645aa01b5e862.png'),
(5, 'Zakapane', '645b598ae6228.png');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` int(11) NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL,
  `username` varchar(40) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `email`, `username`, `password`) VALUES
(1, 'zan.skorja@gmail.com', 'zanurban', 'Zankozan8!'),
(4, 'mejaknik@gmail.com', 'nikmejak18', 'Kr.en.ludek21'),
(5, 'sampleemail181@gmail.com', 'Dbrezovsek', 'Dominik2!'),
(10, 'dominikbe25@gmail.com', 'Dbrezovsek02', 'Dominik2!');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` int(11) NOT NULL,
  `organisation_id` int(11) NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL,
  `since` date NOT NULL,
  `until` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organisation`
--

CREATE TABLE `organisation` (
  `organisation_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `address_line_1` varchar(150) COLLATE utf8_slovenian_ci NOT NULL,
  `address_line_2` varchar(150) COLLATE utf8_slovenian_ci NOT NULL,
  `address_line_3` varchar(150) CHARACTER SET utf32 COLLATE utf32_slovenian_ci NOT NULL,
  `province` varchar(40) COLLATE utf8_slovenian_ci NOT NULL,
  `state` varchar(30) COLLATE utf8_slovenian_ci NOT NULL,
  `country` varchar(40) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `organisation`
--

INSERT INTO `organisation` (`organisation_id`, `name`, `address_line_1`, `address_line_2`, `address_line_3`, `province`, `state`, `country`) VALUES
(1, 'Šolski center Celje, Srednja šola za Kemijo, Elektrotehniko in Računalništvo', 'Pot na Lavo', '22', '', 'Savinjska', 'Celje', 'Slovenija');

-- --------------------------------------------------------

--
-- Table structure for table `pending_accounts`
--

CREATE TABLE `pending_accounts` (
  `acc_id` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `name` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `surname` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `expires` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qr_check`
--

CREATE TABLE `qr_check` (
  `link_id` varchar(100) NOT NULL,
  `card_id` int(11) NOT NULL,
  `token_id` varchar(100) NOT NULL,
  `issued_at` int(11) NOT NULL,
  `expries_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `token_id` varchar(100) NOT NULL,
  `issued_at` int(11) NOT NULL,
  `expires_at` int(11) NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `email` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `name` varchar(30) COLLATE utf8_slovenian_ci NOT NULL,
  `surname` varchar(40) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`email`, `name`, `surname`) VALUES
('dominikbe25@gmail.com', 'Dominik', 'Brezovšek'),
('mejaknik@gmail.com', 'Nik', 'Mejak'),
('sampleemail181@gmail.com', 'Neko', 'Ime'),
('zan.skorja@gmail.com', 'Žan', 'Škorja');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`card_id`),
  ADD KEY `card_issuer_FK` (`issuer`),
  ADD KEY `card_owner_FK` (`owner`),
  ADD KEY `card_type` (`type`);

--
-- Indexes for table `card_types`
--
ALTER TABLE `card_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `card_type_UQ` (`card_type`) USING BTREE;

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `login_email_FK` (`email`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`),
  ADD KEY `member_org-id_FK` (`organisation_id`),
  ADD KEY `member_email_FK` (`email`);

--
-- Indexes for table `organisation`
--
ALTER TABLE `organisation`
  ADD PRIMARY KEY (`organisation_id`),
  ADD KEY `organisation_name_IX` (`name`);

--
-- Indexes for table `pending_accounts`
--
ALTER TABLE `pending_accounts`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `qr_check`
--
ALTER TABLE `qr_check`
  ADD PRIMARY KEY (`link_id`),
  ADD KEY `qr_card-id_FK` (`card_id`),
  ADD KEY `qr_token-id_FK` (`token_id`),
  ADD KEY `qr_exp_at_IX` (`expries_at`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`token_id`),
  ADD KEY `token_email_FK` (`email`),
  ADD KEY `token_exp_at_IX` (`expires_at`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`),
  ADD KEY `user_name_IX` (`name`),
  ADD KEY `user_surname_IX` (`surname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `card`
--
ALTER TABLE `card`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `card_types`
--
ALTER TABLE `card_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `organisation`
--
ALTER TABLE `organisation`
  MODIFY `organisation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pending_accounts`
--
ALTER TABLE `pending_accounts`
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `card`
--
ALTER TABLE `card`
  ADD CONSTRAINT `card_issuer_FK` FOREIGN KEY (`issuer`) REFERENCES `organisation` (`organisation_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `card_owner_FK` FOREIGN KEY (`owner`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `card_type` FOREIGN KEY (`type`) REFERENCES `card_types` (`card_type`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_email_FK` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_email_FK` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `member_org-id_FK` FOREIGN KEY (`organisation_id`) REFERENCES `organisation` (`organisation_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `qr_check`
--
ALTER TABLE `qr_check`
  ADD CONSTRAINT `qr_card-id_FK` FOREIGN KEY (`card_id`) REFERENCES `card` (`card_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `qr_token-id_FK` FOREIGN KEY (`token_id`) REFERENCES `token` (`token_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `token_email_FK` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
