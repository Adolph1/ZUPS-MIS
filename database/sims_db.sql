-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 07, 2017 at 03:30 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sims_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, 'Administrator', NULL, NULL, 1488263546, 1488263546),
('createProduct', 2, 'createProduct', NULL, NULL, NULL, NULL),
('createUser', 2, 'createUser', NULL, NULL, NULL, NULL),
('saleProduct', 2, 'saleProduct', NULL, NULL, NULL, NULL),
('salesPerson', 1, 'salesPerson', NULL, NULL, 1488263519, 1488263519);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'createProduct'),
('admin', 'saleProduct'),
('salesPerson', 'saleProduct');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1486757364),
('m130524_201442_init', 1486757368),
('m140506_102106_rbac_init', 1486757369),
('m170113_151537_create_tbl_payment_method_table', 1486757369),
('m170113_155020_create_tbl_category_table', 1486757369),
('m170113_155021_create_tbl_supplier_table', 1486757369),
('m170113_155843_create_tbl_purchase_master_table', 1486757369),
('m170113_155844_create_tbl_product_table', 1486757369),
('m170113_155845_create_tbl_purchase_invoice_table', 1486757369),
('m170113_155948_create_tbl_purchase_table', 1486757370),
('m170113_160057_create_tbl_product_attribute_table', 1486757370),
('m170113_160128_create_tbl_inventory_table', 1486757370),
('m170113_160151_create_tbl_sales_table', 1486757370),
('m170113_160236_create_tbl_cashbook_table', 1486757370),
('m170113_160317_create_tbl_price_maintanance_table', 1486757370),
('m170113_160359_create_tbl_stock_adjustment_table', 1486757370),
('m170113_160441_create_tbl_transaction_table', 1486757370),
('m170113_160533_create_tbl_system_module_table', 1486757371),
('m170113_160549_create_tbl_system_setup_table', 1486757371),
('m170115_104820_create_tbl_audit_table', 1486757371),
('m170117_073342_create_tbl_language_table', 1486757371),
('m170128_121225_create_tbl_sales_item_table', 1486757371),
('m170130_113234_create_tbl_cart_table', 1486757371),
('m170203_145721_create_tbl_product_return_table', 1486757371),
('m170207_044510_create_tbl_purchase_cost_table', 1486757371),
('m170207_111738_create_tbl_report_table', 1486757371),
('m170405_085653_create_tbl_academic_year_table', 1491383080),
('m170406_044845_create_tbl_academic_period_table', 1491455698);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_academic_period`
--

CREATE TABLE `tbl_academic_period` (
  `id` int(11) NOT NULL,
  `period_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `period_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) DEFAULT NULL,
  `maker_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `maker_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_academic_period`
--

INSERT INTO `tbl_academic_period` (`id`, `period_title`, `period_code`, `status`, `maker_id`, `maker_time`) VALUES
(1, 'START OF THE YEAR', 'SOY', 1, 'admin', '2017-04-06 08:56:00'),
(2, 'START OF FIRST TERM', 'SOFT', 1, 'admin', '2017-04-06 08:46:51'),
(3, 'FIRST TERM', 'FT', 1, 'admin', '2017-04-06 08:48:13'),
(4, 'END OF THE FIRST TERM', 'EOFT', 1, 'admin', '2017-04-06 08:49:30'),
(5, 'START OF SECOND TERM', 'SOST', 1, 'admin', '2017-04-06 08:50:18'),
(6, 'SECOND TERM', 'ST', 1, 'admin', '2017-04-06 08:51:29'),
(7, 'END OF THE SECOND TERM', 'EOST', 1, 'admin', '2017-04-06 08:51:54'),
(8, 'END OF THE YEAR', 'EOY', 1, 'admin', '2017-04-06 08:52:51');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_academic_year`
--

CREATE TABLE `tbl_academic_year` (
  `id` int(11) NOT NULL,
  `year_title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `maker_id` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maker_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_academic_year`
--

INSERT INTO `tbl_academic_year` (`id`, `year_title`, `status`, `maker_id`, `maker_time`) VALUES
(1, '2017-2018', 0, 'admin', '2017-04-16 08:00:33'),
(2, '2016-2017', 1, 'admin', '2017-04-16 10:20:34'),
(3, '2015-2016', 0, 'admin', '2017-04-16 07:59:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_audit`
--

CREATE TABLE `tbl_audit` (
  `id` int(11) NOT NULL,
  `activity` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `module` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maker` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maker_time` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_audit`
--

INSERT INTO `tbl_audit` (`id`, `activity`, `module`, `action`, `maker`, `maker_time`) VALUES
(1, 'New Category is created (Maziwa)', 'Category Details', 'create', 'admin', '2017-02-10:23:10:41'),
(2, 'New Category is created (Maziwa ya mtindi)', 'Category Details', 'create', 'admin', '2017-02-10:23:10:54'),
(3, 'New Product created', 'Product Details', 'create', 'admin', '2017-02-10:23:11:33'),
(4, 'New Category is created (Fekon)', 'Category Details', 'create', 'admin', '2017-02-28:20:00:42'),
(5, 'New Category is created (Pikipiki)', 'Category Details', 'create', 'admin', '2017-02-28:20:01:08'),
(6, 'New Category is created (Boxer)', 'Category Details', 'create', 'admin', '2017-02-28:20:03:09'),
(7, 'New Product created', 'Product Details', 'create', 'admin', '2017-02-28:20:05:51'),
(8, 'New Category is created (Rangi)', 'Category Details', 'create', 'admin', '2017-02-28:20:12:44'),
(9, 'New Category is created (Rangi ya maji)', 'Category Details', 'create', 'admin', '2017-02-28:20:13:11'),
(10, 'New Product created', 'Product Details', 'create', 'admin', '2017-02-28:20:14:22'),
(11, 'New Category is created (Vidonge)', 'Category Details', 'create', 'admin', '2017-02-28:20:36:54'),
(12, 'New Product created', 'Product Details', 'create', 'admin', '2017-02-28:20:37:35');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$13$sop4WqM1vTA6PXnDqXOAXO9Ka', '$2y$13$O4GJkDhmkoy4vSpfaeseD.bK4asz66E1MVqVNul5EGRyU1LNpBXIe', '', 'adolph.cm@gmail.com', 0, 10, 20170210, 20170210);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `tbl_academic_period`
--
ALTER TABLE `tbl_academic_period`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_academic_year`
--
ALTER TABLE `tbl_academic_year`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `year_title` (`year_title`);

--
-- Indexes for table `tbl_audit`
--
ALTER TABLE `tbl_audit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_academic_period`
--
ALTER TABLE `tbl_academic_period`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_academic_year`
--
ALTER TABLE `tbl_academic_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_audit`
--
ALTER TABLE `tbl_audit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
