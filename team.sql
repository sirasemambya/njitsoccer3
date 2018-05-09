-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: sql2.njit.edu
-- Generation Time: Mar 03, 2018 at 10:35 PM
-- Server version: 5.5.29-log
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sbs43`
--

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE IF NOT EXISTS `team` (
`ID` int(4) NOT NULL,
  `teamname` varchar(50) NOT NULL,
  `Coach` varchar(50) NOT NULL,
  `gk` varchar(50) NOT NULL,
  `def1` varchar(50) NOT NULL,
  `def2` varchar(50) NOT NULL,
  `def3` varchar(50) NOT NULL,
  `mid1` varchar(50) NOT NULL,
  `mid2` varchar(50) NOT NULL,
  `mid3` varchar(50) NOT NULL,
  `for1` varchar(50) NOT NULL,
  `for2` varchar(50) NOT NULL,
  `fr` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`ID`, `teamname`, `Coach`, `gk`, `def1`, `def2`, `def3`, `mid1`, `mid2`, `mid3`, `for1`, `for2`, `fr`) VALUES
(1, 'AC Milan', 'Richard Jefferson', 'Hazard', 'Pogba', 'Ronaldinho', 'Carlos', 'Ronaldo', 'Rivaldo', 'Henry', 'Berkamp', 'Zidane', 'Kroos'),
(2, 'Chelsea FC', 'Sam Mitchell', 'Vince', 'Kobe', 'Bryant', 'Jeff', 'Chris', 'Sommo', 'Silva', 'Costa', 'Jerrey', 'Tom'),
(3, 'Inter Milan', 'Richard Carter', 'Dan', 'Phil', 'Chris', 'Jake', 'Jeff', 'Yorel', 'Leroy', 'Tyler', 'Glinder', 'Sean'),
(4, 'Liverpool', 'Rafa Ben', 'Klopp', 'Pep', 'Jose', 'Jacob', 'rashad', 'rory', 'djani', 'rony', 'jethro ', 'george'),
(5, 'Real Madrid', 'Sergio', 'Ramos', 'Bakayoko', 'Danny', 'Drinkwater', 'Ruben', 'Loftus', 'Cheeks', 'Lewis', 'Baker', 'Boga');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `team`
--
ALTER TABLE `team`
 ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
