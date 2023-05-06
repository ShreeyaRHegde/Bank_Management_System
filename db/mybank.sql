-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2023 at 10:31 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mybank`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `displayTransaction` (IN `others` VARCHAR(111))   SELECT transactionId,action,credit,debit,balance,date from transaction where other=others$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `displayUsers` ()   SELECT * FROM useraccounts$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branchId` int(11) NOT NULL,
  `branchNo` varchar(111) NOT NULL,
  `branchName` varchar(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branchId`, `branchNo`, `branchName`) VALUES
(1, '100', 'Vijayanagar'),
(2, '101', 'Jayanagar'),
(3, '102', 'Basavanagudi'),
(4, '103', 'Koramangala'),
(5, '104', 'Uttarahalli');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `name` varchar(111) NOT NULL,
  `empid` int(11) NOT NULL,
  `email` varchar(111) NOT NULL,
  `salary` int(11) NOT NULL,
  `number` int(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`name`, `empid`, `email`, `salary`, `number`, `password`, `date`) VALUES
('aa', 6, 'some@gmail.com', 12345, 1234567899, 'some', '2023-01-19 17:34:24'),
('Employee2', 7, 'employee@emp.com', 50000, 2147483647, 'employee', '2023-01-20 14:48:58');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedbackId` int(11) NOT NULL,
  `message` text NOT NULL,
  `userId` double NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedbackId`, `message`, `userId`, `date`) VALUES
(1, 'This is testing message to admin or manager by fk', 1, '2017-12-15 04:30:48'),
(3, 'This is testing message to admin or manager by fk', 2, '2017-12-15 04:30:48'),
(5, 'This is an example help card message\r\n', 1, '2023-01-18 18:34:01');

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `loanid` int(11) NOT NULL,
  `loantype` varchar(20) NOT NULL,
  `amt` int(11) NOT NULL,
  `duration` varchar(10) NOT NULL,
  `c_id` int(11) NOT NULL,
  `dateofloan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`loanid`, `loantype`, `amt`, `duration`, `c_id`, `dateofloan`) VALUES
(1674201216, 'Education Loan-4%', 25000, '2 years', 1674064925, '2023-01-20 07:54:04'),
(1674364281, 'Home Loan-5%', 250000, '4 yrs', 1674110975, '2023-01-22 05:11:58');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `email` varchar(111) NOT NULL,
  `password` varchar(111) NOT NULL,
  `type` varchar(111) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `email`, `password`, `type`, `date`) VALUES
(2, 'manager@manager.com', 'manager', 'manager', '2017-12-15 04:36:27');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `id` int(11) NOT NULL,
  `userId` varchar(111) NOT NULL,
  `notice` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`id`, `userId`, `notice`, `date`) VALUES
(15, '1', 'This is notice example\r\n', '2023-01-18 18:48:33'),
(16, '1', 'This is notice example\r\n', '2023-01-19 05:35:38'),
(17, '1', 'notice example\r\n', '2023-02-01 14:25:29'),
(18, '1', 'exam', '2023-02-02 10:10:09');

-- --------------------------------------------------------

--
-- Table structure for table `otheraccounts`
--

CREATE TABLE `otheraccounts` (
  `id` int(11) NOT NULL,
  `accountNo` varchar(111) NOT NULL,
  `bankName` varchar(111) NOT NULL,
  `holderName` varchar(111) NOT NULL,
  `balance` varchar(111) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `otheraccounts`
--

INSERT INTO `otheraccounts` (`id`, `accountNo`, `bankName`, `holderName`, `balance`, `date`) VALUES
(1, '123', 'HDCFC', 'asdf', '500000', '2023-01-21 14:49:30');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transactionId` int(11) NOT NULL,
  `action` varchar(111) NOT NULL,
  `credit` varchar(111) NOT NULL,
  `debit` varchar(111) NOT NULL,
  `balance` varchar(111) NOT NULL,
  `other` varchar(111) NOT NULL,
  `userId` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transactionId`, `action`, `credit`, `debit`, `balance`, `other`, `userId`, `date`) VALUES
(237, 'withdraw', '', '500', '48915', '123', 1, '2023-01-21 09:43:21'),
(238, 'withdraw', '', '500', '48415', '123', 1, '2023-01-21 10:30:26'),
(239, 'transfer', '', '123', '44813', '1674064925', 31, '2023-01-21 17:13:43'),
(240, 'withdraw', '', '123', '48415', '1', 1, '2023-01-21 17:14:03'),
(241, 'transfer', '', '100', '48315', '1674110975', 1, '2023-02-01 14:24:13'),
(242, 'deposit', '100', '', '48415', '2', 1, '2023-02-01 14:26:39'),
(243, 'transfer', '', '100', '48315', '1674064925', 1, '2023-02-01 14:37:24'),
(244, 'transfer', '', '150', '44763', '1674064925', 31, '2023-02-01 17:32:02');

-- --------------------------------------------------------

--
-- Table structure for table `useraccounts`
--

CREATE TABLE `useraccounts` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `name` varchar(111) NOT NULL,
  `balance` varchar(111) NOT NULL,
  `cnic` varchar(111) NOT NULL,
  `number` varchar(111) NOT NULL,
  `city` varchar(111) NOT NULL,
  `address` varchar(111) NOT NULL,
  `source` varchar(111) NOT NULL,
  `accountNo` varchar(111) NOT NULL,
  `branch` varchar(111) NOT NULL,
  `accountType` varchar(111) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `panNo` varchar(10) NOT NULL,
  `nationName` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `useraccounts`
--

INSERT INTO `useraccounts` (`id`, `email`, `password`, `name`, `balance`, `cnic`, `number`, `city`, `address`, `source`, `accountNo`, `branch`, `accountType`, `date`, `panNo`, `nationName`) VALUES
(1, 'customer@cus.com', 'customer', 'Shreeya ', '48565', '1001', '9876543316', 'BENGALURU', '80/101, navami Akash apartment', 'scholarship', '1674064925', '1', 'recurring deposit', '2023-01-18 18:03:33', 'AAAA118B12', 'Indian'),
(31, 'customer1@cus.com', 'manager', 'Supriya', '44763', '1002', '9286745319', 'BENGALURU', '101/56,Revati Nivas', 'scholarship', '1674110975', '2', 'recurring deposit', '2023-01-19 06:51:42', 'DDDD234S12', 'Indian'),
(32, 'manager@manager.com', 'manager', 'Shreeya R', '501', '1', '1234567899', 'BENGALURU', '80/101, navami Akash apartment', 'scholarship', '1675332665', '3', 'recurring deposit', '2023-02-02 10:12:12', 'DDDD234S12', 'Indian');

--
-- Triggers `useraccounts`
--
DELIMITER $$
CREATE TRIGGER `balance_update_tr` AFTER UPDATE ON `useraccounts` FOR EACH ROW update transaction set balance=new.balance WHERE balance=''
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branchId`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`empid`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedbackId`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`loanid`),
  ADD KEY `c_id_fk` (`c_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otheraccounts`
--
ALTER TABLE `otheraccounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transactionId`),
  ADD KEY `userId_fk` (`userId`);

--
-- Indexes for table `useraccounts`
--
ALTER TABLE `useraccounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch_fk` (`branch`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branchId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `empid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedbackId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `loanid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1674364282;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transactionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- AUTO_INCREMENT for table `useraccounts`
--
ALTER TABLE `useraccounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
