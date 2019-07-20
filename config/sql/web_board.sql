-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2019 at 07:39 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_board`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(10) UNSIGNED NOT NULL,
  `web_board_id` int(10) UNSIGNED NOT NULL,
  `member_id` int(10) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `web_board_id`, `member_id`, `comment`, `date_time`) VALUES
(1, 1, 1, 'testttt', '2017-05-14 00:00:00'),
(2, 1, 1, 'testttt2222', '2017-05-14 00:00:00'),
(3, 3, 1, 'ทดสอบ comment', '2017-05-14 23:58:53'),
(4, 2, 1, 'นั่นสิ ง่วง', '2017-05-14 23:59:17'),
(5, 3, 2, 'hi..', '2017-05-15 00:00:39');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date_time` datetime NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('admin','user') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `fname`, `lname`, `date_time`, `username`, `password`, `status`) VALUES
(1, 'mix', 'abcprintf', '2017-05-14 00:00:00', 'mix', '81dc9bdb52d04dc20036dbd8313ed055', 'admin'),
(2, 'ทองดี', 'ทองคำ', '2017-05-15 00:00:00', 'mix', 'e10adc3949ba59abbe56e057f20f883e', 'user'),
(4, 'dsaf', 'dsaf', '2019-07-20 12:33:04', 'sdaf', '81dc9bdb52d04dc20036dbd8313ed055', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `web_board`
--

CREATE TABLE `web_board` (
  `web_board_id` int(10) UNSIGNED NOT NULL,
  `web_board_title` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'หัวข้อเรื่อง',
  `web_board_details` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'รายละเอียด',
  `member_id` int(10) UNSIGNED NOT NULL COMMENT 'id คนที่สร้างโพส',
  `date_time` datetime NOT NULL COMMENT 'เวลาที่ตั้งกระทู้'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `web_board`
--

INSERT INTO `web_board` (`web_board_id`, `web_board_title`, `web_board_details`, `member_id`, `date_time`) VALUES
(1, 'ทำไมคนไทยไม่ชอบเขียนโปรแกรม ?', 'ตามหัวข้อเลยครับ xD;', 1, '2017-05-14 22:35:00'),
(2, 'ง่วงจัง', 'ง่วงคืออะไร หรอครับ ?', 1, '2017-05-14 22:37:00'),
(3, 'สวัสดีคับบบ ', 'ทดสอบรอบที่ 3', 1, '2017-05-14 23:34:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `web_board_id` (`web_board_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `web_board`
--
ALTER TABLE `web_board`
  ADD PRIMARY KEY (`web_board_id`),
  ADD KEY `member_id` (`member_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `web_board`
--
ALTER TABLE `web_board`
  MODIFY `web_board_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`web_board_id`) REFERENCES `web_board` (`web_board_id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`);

--
-- Constraints for table `web_board`
--
ALTER TABLE `web_board`
  ADD CONSTRAINT `web_board_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
