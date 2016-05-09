-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: May 08, 2016 at 08:05 AM
-- Server version: 5.6.29
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `raja7466_sm`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(11) NOT NULL,
  `branch` int(11) NOT NULL,
  `rollno` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `gcm`
--

CREATE TABLE IF NOT EXISTS `gcm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reg_id` text NOT NULL,
  `branch` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `rollno` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE IF NOT EXISTS `notices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` longblob NOT NULL,
  `year` int(11) NOT NULL,
  `branch` int(11) NOT NULL,
  `rollno` varchar(255) NOT NULL,
  `postedby` varchar(255) NOT NULL,
  `postedbyusername` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `title`, `content`, `year`, `branch`, `rollno`, `postedby`, `postedbyusername`, `time`) VALUES
(19, 'TechFest INVITATION', 0x3c703e3c656d3e3c7374726f6e673e596f7520616c6c2061726520696e766974656420666f7220416e6e75616c207465636846657374206f662052434557202e5374617274732066726f6d20323120446563203230313620746f2032352044656320323031362e3c2f7374726f6e673e3c2f656d3e3c2f703e0d0a0d0a3c703e3c7374726f6e673e3235266e6273703b4465632032303136202c2077696c6c2062652074686520416e6e75616c20646179202c20416c6c2073747564656e7473206d757374207765617220436f6c6c65676520756e69666f726d206f6e2074686973204461793c2f7374726f6e673e202c266e6273703b3c2f703e0d0a0d0a3c626c6f636b71756f74653e0d0a3c703e3c7374726f6e673e3c74743e43686965662067756573742077696c6c206265206f7572204368696566206d696e6973746572204d732e566173756e64686172612052616a652053696e64686979613c2f74743e3c2f7374726f6e673e202e3c696d6720616c743d225243455720546563684665737422207372633d2268747470733a2f2f692e7974696d672e636f6d2f76692f5f47305530745476397a342f687164656661756c742e6a706722207374796c653d226865696768743a33363070783b2077696474683a343830707822202f3e266e6273703b3c2f703e0d0a3c2f626c6f636b71756f74653e0d0a, 0, 0, '0', 'ADMINISTRATOR', 'admin', 1462699615),
(20, 'Dance Compitition', 0x3c703e3c656d3e3c7374726f6e673e54686572652077696c6c20626520696e74726120436f6c6c656765266e6273703b44616e636520436f6d7069746974696f6e2068656c64206f6e203230204a756c7920323031362c3c2f7374726f6e673e3c2f656d3e3c2f703e0d0a0d0a3c703e3c656d3e3c7374726f6e673e496e74657265737465642073747564656e7473206d757374207265676973746572206265666f7265203135206a756c7920323031362e3c2f7374726f6e673e3c2f656d3e3c2f703e0d0a0d0a3c703e3c656d3e3c7374726f6e673e266e6273703b3c696d6720616c743d2222207372633d2268747470733a2f2f7974696d672e676f6f676c6575736572636f6e74656e742e636f6d2f76692f64626752682d784e33596b2f6d7164656661756c742e6a706722202f3e3c2f7374726f6e673e3c2f656d3e3c2f703e0d0a, 0, 0, '0', 'ADMINISTRATOR', 'admin', 1462700056);

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE IF NOT EXISTS `parents` (
  `rollno` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `parentname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `branch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`rollno`, `name`, `parentname`, `password`, `year`, `branch`) VALUES
('12ESKEC062', 'Rajat', 'Rajat Parents', '5f4dcc3b5aa765d61d8327deb882cf99', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE IF NOT EXISTS `teachers` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_pwd` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`user_id`, `user_name`, `name`, `user_pwd`) VALUES
(1, 'admin', 'ADMINISTRATOR', '5f4dcc3b5aa765d61d8327deb882cf99');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
