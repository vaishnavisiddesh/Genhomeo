-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2025 at 07:39 PM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `reglog`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `name`, `username`, `email`, `password`) VALUES
(1, 'abc', 'abc', 'abc@gmail.com', 'aaaaaaA1'),
(2, 'vai', 'vai', 'vai@gmail.com', 'vaishnaviU8'),
(3, 'nithya', 'nithya', 'nithya@gmail.com', '123456789Aa'),
(4, 'nanu', 'nanu', 'nanu@gmail.com', '12345678Aa'),
(5, 'abcd', 'ab', 'ab@gmail.com', '1Ul2345678'),
(6, 'nith', 'nith', 'n@gmail.com', '1Ul2345678'),
(7, 'aa', 'aa', 'aa@gmail.com', '123456789lU'),
(8, 'krishna', 'krishna', 'krishna@gmail.com', '123456Ul'),
(9, 'p', 'p', 'p@gmail.com', '123456Ul'),
(10, 'amma', 'amma', 'a@gmail.com', '123456Ul'),
(11, 'i', 'ii', 'i@gmail.com', '123456Ul'),
(12, 'd', 'd', 'd@gmail.com', '123456Ul');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
