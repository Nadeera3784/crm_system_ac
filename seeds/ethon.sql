-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2020 at 06:07 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ethon`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_attendance`
--

CREATE TABLE `app_attendance` (
  `attendance_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `in_time` datetime NOT NULL,
  `out_time` datetime DEFAULT NULL,
  `hours` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_attendance`
--

INSERT INTO `app_attendance` (`attendance_id`, `user_id`, `in_time`, `out_time`, `hours`) VALUES
(9, 2, '2019-10-12 00:00:00', '2019-10-12 09:00:00', '9'),
(10, 5, '2019-10-13 00:00:00', '2019-10-13 07:00:00', '7'),
(18, 2, '2019-10-13 01:00:54', '2019-10-13 05:00:44', '3'),
(21, 2, '2019-10-14 01:00:15', '2019-10-14 05:00:27', '4'),
(22, 2, '2019-10-15 02:09:00', '2019-10-15 04:00:34', '1'),
(23, 2, '2019-10-20 08:00:09', '2019-10-20 02:00:25', '7'),
(24, 5, '2019-09-12 00:00:00', '2019-09-13 00:00:00', '5'),
(26, 2, '2020-03-15 09:40:49', '2020-03-15 02:00:57', '7');

-- --------------------------------------------------------

--
-- Table structure for table `app_client`
--

CREATE TABLE `app_client` (
  `client_id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_general` varchar(50) NOT NULL,
  `contact_person` varchar(50) NOT NULL,
  `designation` int(11) NOT NULL,
  `contact_mob` varchar(100) NOT NULL,
  `contact_fixed` varchar(100) NOT NULL,
  `ext` varchar(100) NOT NULL,
  `vat_no` varchar(100) NOT NULL,
  `svat_no` varchar(100) NOT NULL,
  `web` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_client`
--

INSERT INTO `app_client` (`client_id`, `company_name`, `address`, `contact_general`, `contact_person`, `designation`, `contact_mob`, `contact_fixed`, `ext`, `vat_no`, `svat_no`, `web`, `email`, `location`, `remarks`) VALUES
(1, 'ABC company Pvt Ltd.', '32. strre, CA', '0387498374', 'Bill Bertz', 0, '3848736873', '8511156373', '34', '-', '-', 'www.abcome.lk', 'info@abccom.com', 'CA south', '-'),
(2, 'BT Technology', 'dfdfdfdf', '56566', 'Hossein Shams', 0, '454545454', '454545454354', '4545', '454545', '45454', 'www.ggole.om', 'hosseinhams@gmail.com', 'canada', '-'),
(3, 'Carlson Software', 'dfdfgfgfg', '56465656', 'Frank Camly', 0, '454543545', '454545435', 'dfdg', '4545', '45454', 'www.yahol.com', 'frankcamly@info.com', 'usa', '-'),
(6, 'Gemba studio', 'negagoda', '56465656', 'kamal rathanaweera', 0, '0836333245', '3118373', 'dfdg', '44555', '45454', 'www.gemac.info', 'frankcamly@info.com', 'kandy', '-');

-- --------------------------------------------------------

--
-- Table structure for table `app_configure`
--

CREATE TABLE `app_configure` (
  `conf_id` int(11) NOT NULL,
  `conf_key` varchar(100) NOT NULL,
  `conf_value` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='app hotel configurations';

--
-- Dumping data for table `app_configure`
--

INSERT INTO `app_configure` (`conf_id`, `conf_key`, `conf_value`) VALUES
(1, 'conf_hotel_name', 'beachhotel'),
(2, 'conf_hotel_streetaddr', '99 xxxxx Road'),
(3, 'conf_hotel_city', 'Your City'),
(4, 'conf_hotel_state', 'Your State'),
(5, 'conf_hotel_country', 'USA'),
(6, 'conf_hotel_zipcode', '11211'),
(7, 'conf_hotel_phone', '+187788889777'),
(8, 'conf_hotel_fax', '+18778888972'),
(9, 'conf_hotel_email', 'myhotel@yahoo.com'),
(20, 'conf_tax_amount', '10'),
(21, 'conf_dateformat', 'mm/dd/yy'),
(22, 'conf_booking_exptime', '1000'),
(25, 'conf_enabled_deposit', '0'),
(26, 'conf_hotel_timezone', 'Asia/Calcutta'),
(27, 'conf_booking_turn_off', '0'),
(28, 'conf_min_night_booking', '1'),
(30, 'conf_notification_email', 'sales@info.com'),
(31, 'conf_price_with_tax', '0'),
(32, 'conf_maximum_global_years', '730'),
(33, 'conf_payment_currency', '0'),
(34, 'conf_invoice_currency', '0'),
(35, 'conf_currency_update_time', '1550930918');

-- --------------------------------------------------------

--
-- Table structure for table `app_estimates`
--

CREATE TABLE `app_estimates` (
  `estimates_id` int(11) NOT NULL,
  `company` varchar(255) NOT NULL,
  `estimate_no` varchar(255) NOT NULL,
  `job_no` int(11) NOT NULL,
  `tax` varchar(255) NOT NULL,
  `srcharges` varchar(255) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `estimate_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_estimates`
--

INSERT INTO `app_estimates` (`estimates_id`, `company`, `estimate_no`, `job_no`, `tax`, `srcharges`, `total_amount`, `estimate_date`) VALUES
(1, 'ice_technologies', 'EST0003', 5, '0', '', '7500.00', '2019-10-15 02:00:56'),
(2, 'abc_trade_investments', 'EST8273', 6, '12', '', '713.44', '2019-10-16 09:00:20'),
(3, 'ice_technologies', 'EST78272', 7, '15', '20', '623.00', '2019-10-18 09:00:38');

-- --------------------------------------------------------

--
-- Table structure for table `app_estimates_data`
--

CREATE TABLE `app_estimates_data` (
  `estimates_data_id` int(11) NOT NULL,
  `estimates_id` int(11) NOT NULL,
  `part_no` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `unit_price` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `discount` varchar(100) NOT NULL,
  `price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_estimates_data`
--

INSERT INTO `app_estimates_data` (`estimates_data_id`, `estimates_id`, `part_no`, `description`, `unit_price`, `quantity`, `discount`, `price`) VALUES
(1, 1, 'RC1282', 'Service Station Flex Cable', '3500', '1', '0', '3500'),
(2, 1, 'RBK0866', 'Paper Feed Flex Cable', '2500', '1', '0', '2500'),
(3, 1, 'PRI8987', 'Prime Pump Flex Cable', '1500', '1', '0', '1500'),
(4, 2, 'RCH0383', 'Internal motor replacement', '245', '1', '', '245'),
(5, 3, 'CRXd8282', 'North pole deduction', '175', '3', '', '525');

-- --------------------------------------------------------

--
-- Table structure for table `app_groups`
--

CREATE TABLE `app_groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_groups`
--

INSERT INTO `app_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(3, 'technician', 'Technicians'),
(4, 'client', 'Client ');

-- --------------------------------------------------------

--
-- Table structure for table `app_jobs`
--

CREATE TABLE `app_jobs` (
  `job_id` int(11) NOT NULL,
  `company` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `job_category` varchar(100) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `service_type` varchar(100) NOT NULL,
  `job_type` varchar(100) NOT NULL,
  `product_type` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `model_no` varchar(255) NOT NULL,
  `serial_no` varchar(255) NOT NULL,
  `fault_description` varchar(255) NOT NULL,
  `accessories` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL,
  `sales_person` varchar(200) NOT NULL,
  `remarks` text NOT NULL,
  `estimate_charges` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_jobs`
--

INSERT INTO `app_jobs` (`job_id`, `company`, `start_date`, `end_date`, `job_category`, `client_id`, `service_type`, `job_type`, `product_type`, `brand`, `model_no`, `serial_no`, `fault_description`, `accessories`, `status`, `sales_person`, `remarks`, `estimate_charges`) VALUES
(5, 'ice_technologies', '2019-10-07', '2019-10-09', 'onsite', '1', 'warranty', 'repair', 'printer', 'hp', '3483734', '30934734324', 'paper_not_feeding', 'usb_cable', 'started', 'FS Jeramy', '-', '8300'),
(6, 'abc_trade_investments', '2019-10-08', '2019-10-17', 'onsite', '2', 'free-of-charge', 'service', 'plotter', 'canon', '954565', '0003243', 'noise', 'consumables', 'in_progress', 'james sathom', '-', '6600'),
(7, 'ice_technologies', '2019-10-07', '2019-10-09', 'onsite', '1', 'warranty', 'repair', 'printer', 'hp', '3483734', '30934734324', 'paper_not_feeding', 'usb_cable', 'started', 'FS Jeramy', '-', '4500'),
(8, 'ice_technologies', '2019-10-07', '2019-10-09', 'onsite', '3', 'warranty', 'repair', 'printer', 'hp', '3483734', '30934734324', 'paper_not_feeding', 'usb_cable', 'completed', 'FS Jeramy', '-', '7200'),
(9, 'abc_trade_investments', '2020-03-15', '2020-03-16', 'inhouse', '1', 'warranty', 'repair', 'repair', 'hp', '4545', '6576767676', 'no_power', 'usb_cable', 'started', 'fff', 'fgfg', '45454');

-- --------------------------------------------------------

--
-- Table structure for table `app_jobs_relation`
--

CREATE TABLE `app_jobs_relation` (
  `jobs_relation_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `jobs_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_jobs_relation`
--

INSERT INTO `app_jobs_relation` (`jobs_relation_id`, `users_id`, `jobs_id`) VALUES
(9, 3, 6),
(10, 4, 6),
(11, 5, 6),
(14, 2, 5),
(15, 3, 7),
(22, 3, 8),
(23, 4, 8),
(24, 2, 7),
(25, 2, 9);

-- --------------------------------------------------------

--
-- Table structure for table `app_login_attempts`
--

CREATE TABLE `app_login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `app_progress`
--

CREATE TABLE `app_progress` (
  `progress_id` int(11) NOT NULL,
  `job_no` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `estimate_no` varchar(255) NOT NULL,
  `estimate_date` date NOT NULL,
  `estimate_value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_progress`
--

INSERT INTO `app_progress` (`progress_id`, `job_no`, `status`, `estimate_no`, `estimate_date`, `estimate_value`) VALUES
(1, 5, 'In process', 'EST0003', '2019-10-18', '9000'),
(2, 6, 'Waiting for Approval', 'EST8273', '2019-10-29', '54657');

-- --------------------------------------------------------

--
-- Table structure for table `app_users`
--

CREATE TABLE `app_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `avatar` varchar(255) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `employee_no` varchar(255) NOT NULL,
  `vehicle_no` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_users`
--

INSERT INTO `app_users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `full_name`, `phone`, `avatar`, `designation`, `employee_no`, `vehicle_no`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1584292010, 1, 'Admin', '0', 'default.png', 'Head', '8776654', 'KTC797334'),
(2, '::1', 'johndoe@gmail.com', '$2y$08$YQzUJdDWMGB9DgNEwg6nmel2/tZ7xBJZg7AevdmiA9wsjbKppLhxG', NULL, 'johndoe@gmail.com', NULL, NULL, NULL, NULL, 1570202352, 1584291789, 1, 'john doe', '59869565', 'avatar-1.jpg', 'cum tech', '3347934', 'ESKH8464'),
(3, '::1', 'kurafire@dummy.com', '$2y$08$PBjSXHRyf0AgH2aFYJXTMOGxrdrMdOSDAMouj80cJtVyr25xH3sT6', NULL, 'kurafire@dummy.com', NULL, NULL, NULL, NULL, 1570346428, NULL, 1, 'Kurafire Doony', '5696805965', 'avatar-2.jpg', 'QA', '409474', 'SHT485464'),
(4, '::1', 'adhamdannaway@dummy.com', '$2y$08$K9i.8Q4ZzwympI8pQ2eIseX.QC5UCTA6Upd5BBEyZGjDwdOfIRojm', NULL, 'adhamdannaway@dummy.com', NULL, NULL, NULL, NULL, 1570347015, NULL, 1, 'Adhamdannaway ', '5673242343', 'avatar-3.jpg', 'Tester', '936393', 'OND78372'),
(5, '::1', 'joshaustin@yahoo.con', '$2y$08$chvIh8H.nn7t9MI5a290vuSNzQhgwrZFRXQ6ThFiQ9KiOLdJZahyW', NULL, 'joshaustin@yahoo.con', NULL, NULL, NULL, NULL, 1570347273, NULL, 1, 'Joshaustin ', '0873638374', 'b4dd8d07ebc799ad77ece82187f601bd.jpg', 'DeveOps', '9363093', 'BHS63843');

-- --------------------------------------------------------

--
-- Table structure for table `app_users_groups`
--

CREATE TABLE `app_users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_users_groups`
--

INSERT INTO `app_users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(4, 2, 3),
(5, 3, 3),
(6, 4, 3),
(7, 5, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_attendance`
--
ALTER TABLE `app_attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `app_client`
--
ALTER TABLE `app_client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `app_estimates`
--
ALTER TABLE `app_estimates`
  ADD PRIMARY KEY (`estimates_id`);

--
-- Indexes for table `app_estimates_data`
--
ALTER TABLE `app_estimates_data`
  ADD PRIMARY KEY (`estimates_data_id`);

--
-- Indexes for table `app_groups`
--
ALTER TABLE `app_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_jobs`
--
ALTER TABLE `app_jobs`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `app_jobs_relation`
--
ALTER TABLE `app_jobs_relation`
  ADD PRIMARY KEY (`jobs_relation_id`);

--
-- Indexes for table `app_login_attempts`
--
ALTER TABLE `app_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_progress`
--
ALTER TABLE `app_progress`
  ADD PRIMARY KEY (`progress_id`);

--
-- Indexes for table `app_users`
--
ALTER TABLE `app_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_users_groups`
--
ALTER TABLE `app_users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_attendance`
--
ALTER TABLE `app_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `app_client`
--
ALTER TABLE `app_client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `app_estimates`
--
ALTER TABLE `app_estimates`
  MODIFY `estimates_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `app_estimates_data`
--
ALTER TABLE `app_estimates_data`
  MODIFY `estimates_data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `app_groups`
--
ALTER TABLE `app_groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `app_jobs`
--
ALTER TABLE `app_jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `app_jobs_relation`
--
ALTER TABLE `app_jobs_relation`
  MODIFY `jobs_relation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `app_login_attempts`
--
ALTER TABLE `app_login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `app_progress`
--
ALTER TABLE `app_progress`
  MODIFY `progress_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `app_users`
--
ALTER TABLE `app_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `app_users_groups`
--
ALTER TABLE `app_users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `app_users_groups`
--
ALTER TABLE `app_users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `app_groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
