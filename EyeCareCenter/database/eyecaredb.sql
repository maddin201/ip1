SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(10) NOT NULL AUTO_INCREMENT,
  `branch_id` int(10) NOT NULL,
  `admin_name` varchar(25) NOT NULL,
  `login_id` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `email_id` varchar(25) NOT NULL,
  `lastlogin` datetime DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `branch_id`, `admin_name`, `login_id`, `password`, `email_id`, `lastlogin`) VALUES
(1, 1, 'mike', 'mike', 'mike123', 'mike@gmail.com', '2017-06-08 01:56:44'),
(8, 1, 'admin', 'admin', 'adminadmin', 'mahesh@gmail.om', '2017-06-08 11:22:17');


-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE IF NOT EXISTS `appointment` (
  `app_id` int(10) NOT NULL AUTO_INCREMENT,
  `branch_id` int(10) NOT NULL,
  `pat_id` int(10) NOT NULL,
  `doc_id` int(10) NOT NULL,
  `app_date` varchar(12) NOT NULL,
  `app_time` varchar(6) NOT NULL,
  `created_at` datetime NOT NULL,
  `status` varchar(30) NOT NULL,
  PRIMARY KEY (`app_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;


--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`app_id`, `branch_id`, `pat_id`, `doc_id`, `app_date`, `app_time`, `created_at`, `status`) VALUES
(10, 1, 15, 16, '2013-03-18', '00:00:00', '2017-03-19 06:52:19', 'Done\r\n'),
(18, 1, 17, 14, '2017-05-30', '07:45:00', '2017-05-30 11:24:04', 'Done'),
(20, 1, 15, 14, '2017-06-09', '00:00:00', '2017-06-01 08:54:00', 'Done'),
(21, 2, 15, 16, '2017-06-06', '00:00:00', '2017-06-05 08:03:58', 'pending'),
(22, 2, 15, 16, '2017-06-05', '00:00:00', '2017-06-05 08:48:05', 'pending'),
(23, 1, 15, 14, '2017-06-08', '05:15:00', '2017-06-06 11:15:01', 'Done'),
(24, 1, 15, 14, '2017-06-07', '05:15:00', '2017-06-06 11:28:59', 'Done'),
(25, 1, 17, 14, '2017-06-07', '05:30:00', '2017-06-06 11:45:03', 'Done'),
(26, 1, 17, 14, '2017-06-09', '05:15:00', '2017-06-06 12:01:14', 'Done');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE IF NOT EXISTS `branch` (
  `branch_id` int(10) NOT NULL AUTO_INCREMENT,
  `branch_name` varchar(30) NOT NULL,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`branch_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `branch_name`, `description`) VALUES
(1, 'KodialBail, Albany', 'Main Branch'),
(2, 'Capital House, Albany', 'Sub Branch'),
(7, 'Western Ave,Albany', 'Sub branch');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE IF NOT EXISTS `doctor` (
  `doc_id` int(10) NOT NULL AUTO_INCREMENT,
  `branch_id` int(10) NOT NULL,
  `doc_name` varchar(25) NOT NULL,
  `clinic_name` varchar(25) NOT NULL,
  `email_id` varchar(25) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `mobile` varchar(25) NOT NULL,
  `login_id` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `created_at` date NOT NULL,
  `image` varchar(70) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`doc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doc_id`, `branch_id`, `doc_name`, `clinic_name`, `email_id`, `phone`, `mobile`, `login_id`, `password`, `created_at`, `image`, `last_login`) VALUES
(14, 1, 'jhonson', 'Johnson clinic', 'john@gmail.com', '987456321234', '98745631134543', 'John', 'general', '2017-06-16', 'johnson.jpg', '2017-06-22 09:46:56'),
(16, 2, 'peterking', 'pk', 'pgk@gmail.com', '98745632140', '78964541230', 'pk', '9876543210', '2017-06-22', 'peterking.jpg', '2017-06-22 05:35:07');


-- --------------------------------------------------------

--
-- Table structure for table `doctor_bill`
--

CREATE TABLE IF NOT EXISTS `doctor_bill` (
  `bill_id` int(10) NOT NULL AUTO_INCREMENT,
  `test_id` int(10) NOT NULL,
  `test_fee` double(10,2) NOT NULL,
  `consultation_fee` double(10,2) NOT NULL,
  `others` double(10,2) NOT NULL,
  `date` date NOT NULL,
  `remarks` text NOT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `doctor_bill`
--

INSERT INTO `doctor_bill` (`bill_id`, `test_id`, `test_fee`, `consultation_fee`, `others`, `date`, `remarks`) VALUES
(1, 9, 125.00, 75.00, 100.00, '2017-06-12', ''),
(2, 23, 100.00, 200.00, 300.00, '2017-06-22', 'this is doctor bil;l'),
(5, 24, 100.00, 200.00, 50.00, '2017-06-22', 'bnvnfchf'),
(6, 30, 30.00, 5.00, 5.00, '2017-06-06', 'good'),
(7, 30, 30.00, 5.00, 5.00, '2017-06-06', 'good'),
(8, 30, 30.00, 5.00, 5.00, '2017-06-06', 'good'),
(9, 30, 5.00, 6.00, 3.00, '2017-06-06', 'good'),
(10, 31, 30.00, 5.00, 5.00, '2017-06-06', 'good'),
(11, 32, 45.00, 5.00, 15.00, '2017-06-07', 'good'),
(12, 33, 40.00, 5.00, 5.00, '2017-06-07', 'good');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(10) NOT NULL AUTO_INCREMENT,
  `admin_id` int(10) NOT NULL,
  `test_id` int(10) NOT NULL,
  `prod_id` int(10) NOT NULL,
  `order_date` date NOT NULL,
  `total` double(10,2) NOT NULL,
  `dispatch_date` date NOT NULL,
  `payment` double(10,2) NOT NULL,
  `status` varchar(30) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `admin_id`, `test_id`, `prod_id`, `order_date`, `total`, `dispatch_date`, `payment`, `status`) VALUES
(59, 8, 0, 8, '2017-06-08', 750.00, '2017-06-08', 450.00, 'Delivered'),
(60, 8, 33, 2, '2017-06-08', 200.00, '2017-06-15', 100.00, 'Pending'),
(61, 8, 33, 2, '2017-06-08', 200.00, '2017-06-16', 100.00, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE IF NOT EXISTS `patient` (
  `pat_id` int(10) NOT NULL AUTO_INCREMENT,
  `admin_id` int(10) NOT NULL DEFAULT '1',
  `pat_name` varchar(30) NOT NULL,
  `email_id` varchar(25),
  `password` varchar(25)   DEFAULT NULL,
  `dob` varchar(15) NOT NULL DEFAULT '1901-01-01',
  `gender` varchar(10) NOT NULL,
  `address` varchar(50) DEFAULT NULL,
  `contact` varchar(25) NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`pat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;


--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`pat_id`, `admin_id`, `pat_name`, `email_id`, `password`, `dob`, `gender`, `address`, `contact`, `created_at`) VALUES
(15, 8, 'veronica', 'vn@gmail.com', 'veronica', '1970-01-01', 'Female', 'Baloor, Albany', '8971887236', '2017-06-14'),
(17, 8, 'alia', 'alia5@gmail.com', 'alia123', '1999-06-14', 'Female', 'bakon street', '8050304447', '2017-04-00'),


-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE IF NOT EXISTS `prescription` (
  `sl_no` int(10) NOT NULL AUTO_INCREMENT,
  `test_id` int(10) NOT NULL,
  `no_of_days` text NOT NULL,
  `medicines` text NOT NULL,
  `mg` text NOT NULL,
  `dosage` text NOT NULL,
  `remarks` text NOT NULL,
  PRIMARY KEY (`sl_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`sl_no`, `test_id`, `no_of_days`, `medicines`, `mg`, `dosage`, `remarks`) VALUES
(1, 1, '2', '5', '6', '3', '3'),

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `prod_id` int(10) NOT NULL AUTO_INCREMENT,
  `branch_id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `product_type` varchar(50) NOT NULL,
  `sub_type` varchar(25) NOT NULL,
  `image` varchar(100) NOT NULL,
  `color` varchar(20) NOT NULL,
  `cost` double(10,2) NOT NULL,
  `quantity` int(10) NOT NULL,
  PRIMARY KEY (`prod_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prod_id`, `branch_id`, `name`, `product_type`, `sub_type`, `image`, `color`, `cost`, `quantity`) VALUES
(2, 1, 'Clear d', 'Contact Lens', 'Disposable', 'disposable.jpg', 'FFFFFF', 200.00, 100);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `test_id` int(10) NOT NULL AUTO_INCREMENT,
  `app_id` int(10) NOT NULL,
  `sph` varchar(100) NOT NULL,
  `cyl` varchar(100) NOT NULL,
  `axis` varchar(100) NOT NULL,
  `remarks` text NOT NULL,
  `specs_req` varchar(10) NOT NULL,
  PRIMARY KEY (`test_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;






