-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 29, 2015 at 10:48 AM
-- Server version: 5.5.25
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `BBTest_Transactions`
--

-- --------------------------------------------------------

--
-- Table structure for table `Client`
--

CREATE TABLE `Client` (
  `cid` int(3) NOT NULL,
  `First` varchar(30) NOT NULL,
  `Last` varchar(30) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Phone` varchar(10) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Child_Names` varchar(255) NOT NULL,
  PRIMARY KEY (`cid`),
  KEY `First` (`First`,`Last`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Client`
--

INSERT INTO `Client` (`cid`, `First`, `Last`, `Email`, `Phone`, `Address`, `Child_Names`) VALUES
(1, 'Sheryl', 'Walters', 'swalters@aol.com', '5553462683', '11 Sheep Hill Road, Jupiter', 'Franco'),
(2, 'Cathy', 'Hopkins', 'chopkins@optonline.net', '5555248260', '176 Bridge Road, Saturn', 'Cj, Paige'),
(3, 'Natalie', 'Garcia', 'ngarcia@optonline.net', '5558567904', '1 Ridge Road, Saturn', 'Gianna'),
(4, 'Rachel', 'Geico', 'rgeico@aol.com', '5554961474', '40 Adelston Road, Saturn', 'Martin'),
(5, 'Cherise', 'Deborahs', 'cdeborahs@optonline.net', '5555597657', '55 Strawberry Lane, Jupiter', 'Amanda');

-- --------------------------------------------------------

--
-- Table structure for table `Transactions`
--

CREATE TABLE `Transactions` (
  `IDNum` int(8) NOT NULL AUTO_INCREMENT,
  `tid` int(3) NOT NULL,
  `cid` int(3) NOT NULL,
  `BillingCycle` int(8) NOT NULL,
  `Time` time NOT NULL,
  `Date` date NOT NULL,
  `AmountCharged` float NOT NULL,
  `AmountPaidTutor` float NOT NULL,
  `PaymentReceived` varchar(1) NOT NULL,
  `PaidTutor` varchar(1) NOT NULL,
  `MoneyRequest` int(1) NOT NULL,
  `Status` varchar(1) NOT NULL,
  PRIMARY KEY (`IDNum`),
  KEY `tid` (`tid`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Tutoring Transactions' AUTO_INCREMENT=247 ;

--
-- Dumping data for table `Transactions`
--

INSERT INTO `Transactions` (`IDNum`, `tid`, `cid`, `BillingCycle`, `Time`, `Date`, `AmountCharged`, `AmountPaidTutor`, `PaymentReceived`, `PaidTutor`, `MoneyRequest`, `Status`) VALUES
(241, 2, 5, 1, '15:00:00', '2015-12-29', 40, 25, 'Y', 'Y', 0, 'C'),
(242, 1, 3, 1, '16:00:00', '2015-12-29', 40, 25, 'Y', 'Y', 0, 'C'),
(243, 3, 5, 1, '16:30:00', '2015-12-29', 40, 25, 'Y', 'Y', 0, 'C'),
(244, 3, 4, 1, '17:45:00', '2015-12-29', 40, 25, 'N', 'N', 0, 'C'),
(245, 5, 2, 1, '17:45:00', '2015-12-28', 40, 25, 'N', 'N', 0, 'C'),
(246, 3, 4, 1, '15:00:00', '2015-12-30', 40, 25, 'N', 'N', 0, 'B');

-- --------------------------------------------------------

--
-- Table structure for table `Tutor`
--

CREATE TABLE `Tutor` (
  `tid` int(3) NOT NULL AUTO_INCREMENT,
  `First` varchar(30) NOT NULL,
  `Last` varchar(30) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Phone` varchar(10) NOT NULL,
  PRIMARY KEY (`tid`),
  KEY `First` (`First`,`Last`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `Tutor`
--

INSERT INTO `Tutor` (`tid`, `First`, `Last`, `Email`, `Phone`) VALUES
(0, 'Other', '', '', ''),
(1, 'Brock', 'Andrews', 'brockandrews@gmail.com', '5559127625'),
(2, 'Austin', 'Nasso', 'austin@blackbirdtutoring.com', '5552181056'),
(3, 'Katherine', 'Gremco', 'katherinegremco@yahoo.com', '5559188002'),
(4, 'Carol', 'Stinder', 'carolstinder@aol.com', '5559621427'),
(5, 'Ryan', 'Luke', 'ryanluke@aim.com', '5555547493');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Transactions`
--
ALTER TABLE `Transactions`
  ADD CONSTRAINT `Transactions_ibfk_1` FOREIGN KEY (`tid`) REFERENCES `Tutor` (`tid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Transactions_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `Client` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE;
