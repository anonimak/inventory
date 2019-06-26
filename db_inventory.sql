-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 16, 2019 at 04:33 AM
-- Server version: 5.7.24
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `id_login` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` tinyint(1) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_login`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `username`, `password`, `level`, `date_creation`) VALUES
(1, 'admin@admin.com', '0b1e50e1fd71c96bac94144cc59cff40', 1, '2019-04-27 11:57:45'),
(2, 'admin@gmail.com', '0b1e50e1fd71c96bac94144cc59cff40', 2, '2019-05-25 05:08:26');

-- --------------------------------------------------------

--
-- Table structure for table `part`
--

DROP TABLE IF EXISTS `part`;
CREATE TABLE IF NOT EXISTS `part` (
  `id_part` int(4) NOT NULL AUTO_INCREMENT,
  `id_supplier` int(4) NOT NULL,
  `uniq_no` varchar(5) NOT NULL,
  `model` varchar(25) NOT NULL,
  `part_number` varchar(50) NOT NULL,
  `part_name` varchar(100) NOT NULL,
  `stock` int(3) NOT NULL,
  `stock_min` int(3) NOT NULL,
  `qty` int(5) NOT NULL,
  `image` varchar(100) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_part`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `part`
--

INSERT INTO `part` (`id_part`, `id_supplier`, `uniq_no`, `model`, `part_number`, `part_name`, `stock`, `stock_min`, `qty`, `image`, `date_creation`) VALUES
(4, 3, '1', 'Futura', 'kjhkhk', 'Baut 43', 0, 1, 12, '', '2019-06-16 04:14:40');

-- --------------------------------------------------------

--
-- Table structure for table `part_d_pengambilan`
--

DROP TABLE IF EXISTS `part_d_pengambilan`;
CREATE TABLE IF NOT EXISTS `part_d_pengambilan` (
  `id_d_pengambilan` int(4) NOT NULL AUTO_INCREMENT,
  `id_part` int(4) NOT NULL,
  `qty` int(5) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_d_pengambilan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `part_d_request`
--

DROP TABLE IF EXISTS `part_d_request`;
CREATE TABLE IF NOT EXISTS `part_d_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_part_request` int(4) NOT NULL,
  `id_part` int(4) NOT NULL,
  `stock` int(4) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `part_d_request`
--

INSERT INTO `part_d_request` (`id`, `id_part_request`, `id_part`, `stock`, `date_creation`) VALUES
(1, 1, 4, 5, '2019-05-25 03:18:17'),
(3, 2, 4, 5, '2019-05-25 16:35:47'),
(10, 13, 4, 5, '2019-06-16 04:13:33');

-- --------------------------------------------------------

--
-- Table structure for table `part_t_pengambilan`
--

DROP TABLE IF EXISTS `part_t_pengambilan`;
CREATE TABLE IF NOT EXISTS `part_t_pengambilan` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `tgl` datetime NOT NULL,
  `deskripsi` text NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `part_t_request`
--

DROP TABLE IF EXISTS `part_t_request`;
CREATE TABLE IF NOT EXISTS `part_t_request` (
  `id_part_request` int(11) NOT NULL AUTO_INCREMENT,
  `deskripsi` text NOT NULL,
  `status` enum('edit','submit','approve','reject') NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_part_request`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `part_t_request`
--

INSERT INTO `part_t_request` (`id_part_request`, `deskripsi`, `status`, `date_creation`) VALUES
(1, 'test', 'approve', '2019-05-25 02:41:03'),
(8, 'sf', 'submit', '2019-05-27 14:33:37'),
(9, 'sdas', 'approve', '2019-05-27 14:33:42'),
(10, 'hgjhg', 'edit', '2019-06-16 04:01:09'),
(13, 'test request sekarang', 'approve', '2019-06-16 04:13:19');

-- --------------------------------------------------------

--
-- Table structure for table `part_workcenter`
--

DROP TABLE IF EXISTS `part_workcenter`;
CREATE TABLE IF NOT EXISTS `part_workcenter` (
  `id_part` int(4) NOT NULL AUTO_INCREMENT,
  `id_supplier` int(4) NOT NULL,
  `uniq_no` varchar(5) NOT NULL,
  `model` varchar(25) NOT NULL,
  `part_number` varchar(50) NOT NULL,
  `part_name` varchar(100) NOT NULL,
  `stock` int(3) NOT NULL,
  `stock_min` int(3) NOT NULL,
  `qty` int(5) NOT NULL,
  `image` varchar(100) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_part`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `part_workcenter`
--

INSERT INTO `part_workcenter` (`id_part`, `id_supplier`, `uniq_no`, `model`, `part_number`, `part_name`, `stock`, `stock_min`, `qty`, `image`, `date_creation`) VALUES
(4, 3, '1', 'Futura', 'kjhkhk', 'Baut 43', 130, 1, 12, '', '2019-06-16 04:14:40');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `id_supplier` int(4) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `detail` text NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_supplier`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama`, `detail`, `date_creation`) VALUES
(1, 'test haha', 'yuhu', '2019-05-21 13:43:52'),
(3, 'yuhu', 'jnkn\r\n', '2019-05-21 13:52:58');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
