-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2015 at 01:44 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `madjioni_hack_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `apps`
--

CREATE TABLE IF NOT EXISTS `apps` (
  `idjob` int(11) NOT NULL,
  `idworker` int(11) NOT NULL,
  `ewdone` int(11) NOT NULL DEFAULT '0',
  `ewcomm` varchar(200) DEFAULT NULL,
  `ewrate` int(11) NOT NULL DEFAULT '0',
  `wedone` int(11) NOT NULL DEFAULT '0',
  `wecomm` varchar(200) DEFAULT NULL,
  `werate` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apps`
--

INSERT INTO `apps` (`idjob`, `idworker`, `ewdone`, `ewcomm`, `ewrate`, `wedone`, `wecomm`, `werate`) VALUES
(9, 2, 1, 'dobar', 5, 1, 'g', 3),
(8, 2, 1, 'bedan', 2, 1, 'vg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employer`
--

CREATE TABLE IF NOT EXISTS `employer` (
  `id` int(11) NOT NULL,
  `firstname` varchar(60) NOT NULL,
  `lastname` varchar(60) NOT NULL,
  `location` varchar(60) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `pass` varchar(60) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `description` varchar(500) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employer`
--

INSERT INTO `employer` (`id`, `firstname`, `lastname`, `location`, `mail`, `pass`, `phone`, `description`, `active`) VALUES
(15, 'Gazda', 'Paja', 'Krnjaca', 'gazdapaja@gmail.com', 'f9a9d5ab51492ccfe9fc6a64fabea34dff086e88', '0112345699', 'Ja sam, bajo moj, gospodin covek, domacin, a pre svega u dusi patrijota. Posedujem 206 grla govda,  184 kokoske, ima jos...\r\nOd zemlje imam sledece,: 4,6Ha pod bukovom sumom, 80 ari jabuka, nesto malo oko 30 ari pod jagodom, a imam i lesnik.', 1),
(16, 'Zivojin', 'Zivojin', 'Vranje', 'zivojinzivojin@yahoo.com', '689b7323b174ab94a70c2272e299659d94d09d51', '+31863ZIVOJIN', 'Ja nemam nista od zemlje ali se zovem Zivojin. Zivojin znaci zivot!', 1),
(17, 'Zoran', 'Zlatkovic', 'Zemun', 'zoran@education.gov.rs', 'a38fecf6ae20d788abba8ee34b513be7b853b76e', '066989898', '', 1),
(18, 'Miso', 'Marjan', 'Tu i tamo', 'MisoM@hotmail.com', '002689e6cd6807f4f68d72ba0038cc9ed827550c', '06977MISO3', 'Sam svoj gazda.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE IF NOT EXISTS `job` (
  `id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `description` varchar(400) NOT NULL,
  `location` varchar(60) NOT NULL,
  `datestart` date NOT NULL,
  `dateend` date NOT NULL,
  `num` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `pricetype` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `transportation` varchar(250) NOT NULL,
  `activestart` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activeend` int(11) NOT NULL DEFAULT '7',
  `idemployer` int(11) NOT NULL,
  `idcat` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`id`, `title`, `description`, `location`, `datestart`, `dateend`, `num`, `price`, `pricetype`, `time`, `transportation`, `activestart`, `activeend`, `idemployer`, `idcat`) VALUES
(11, 'Potrebni uzgajivaci stoke!!', 'Potrebni uzgajivaci stoke za rad na mojoj farmi. Imam tipa 206 grla govda,  184 kokoske, a i ima jos...', 'Krnjaca', '2031-05-20', '2011-06-20', 4, 2000, 1, 0, 'Da', '2015-04-26 13:28:10', 7, 15, 3),
(12, 'Trazim profesionalne berace jagoda', 'Imam nesto malo oko 30 ari pod jagodom, verujem da ce biti dobra godina', 'Krnjaca', '2019-09-20', '2028-09-20', 6, 190, 2, 0, 'Da', '2015-04-26 13:30:39', 16, 15, 2),
(13, 'Basta za okopavanje', 'Treba da mi se okopa basta. Ja ne mogu da stignem jer sam vredan student.', 'Zemun', '2014-09-20', '2016-09-20', 3, 1400, 1, 0, '', '2015-04-26 13:32:42', 20, 17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `email` varchar(60) NOT NULL,
  `pass` varchar(60) NOT NULL,
  `active` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `worker`
--

CREATE TABLE IF NOT EXISTS `worker` (
  `id` int(11) NOT NULL,
  `firstname` varchar(60) NOT NULL,
  `lastname` varchar(60) NOT NULL,
  `location` varchar(60) NOT NULL,
  `mail` varchar(60) NOT NULL,
  `pass` varchar(60) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `age` int(11) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `worker`
--

INSERT INTO `worker` (`id`, `firstname`, `lastname`, `location`, `mail`, `pass`, `gender`, `age`, `phone`, `active`) VALUES
(4, 'Milovan', 'Gavrilivojevic', 'Backa Palanka', 'MilovanG@yahoo.com', 'b68c82054cdbdc6d05946bb578f22deecbd71673', 1, 24, '0604893412', 1),
(5, 'Dimitrije', 'Amyr', 'Surcin', 'Damyr@hotmail.com', '6afc8ed60b2bce2e2b1fd479fa2150b247a3236a', 1, 27, '069321808', 1),
(6, 'Hana', 'Uzilbegovic', 'Sabac', 'UHana@yahoo.com', 'abc5608c872e039ba374cfe0af01a41db07f8e7c', 1, 25, '0698787623', 1),
(7, 'Dragan', 'Kostadinovic', 'Vrsac', 'Dragank@hotmail.co.uk', '56b524c731f3c3145d7d4f691f6220aa51d8f04f', 1, 26, '0663453453', 1),
(8, 'Nikola', 'Nikolic', 'Beograd', 'NNikola@yahoo.com', '506f08f07f2b2bd4b18b51a8b2b159cb6a4fe40c', 1, 32, '0644566547', 1),
(9, 'Filip', 'Lovic', 'Beograd', 'FilipL@eunet.com', 'ea842d14c5b1b85002af9272e5eb23fa5409c643', 1, 29, '060123123', 1),
(10, 'Sanja', 'Sanjic', 'Vranje', 'SSanja@sbb.com', '9e09a6bfff2fba22f1ecb0c74874afc8dd610843', 1, 28, '0629988777', 1),
(11, 'Nikola', 'Hirosima', 'Uzice', 'NikolaH@gmail.com', '506f08f07f2b2bd4b18b51a8b2b159cb6a4fe40c', 1, 37, '060606060', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employer`
--
ALTER TABLE `employer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `worker`
--
ALTER TABLE `worker`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employer`
--
ALTER TABLE `employer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `worker`
--
ALTER TABLE `worker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
