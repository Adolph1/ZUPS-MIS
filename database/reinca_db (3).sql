-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 07, 2017 at 03:29 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reinca_db`
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
('admin', '1', NULL),
('purchasePerson', '3', 1493461650),
('salesPerson', '2', 1493460340);

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
('purchasePerson', 1, 'purchasePerson', NULL, NULL, 1493461630, 1493461630),
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
('admin', 'createUser'),
('admin', 'saleProduct'),
('purchasePerson', 'createProduct'),
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
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1493811397),
('m130524_201442_init', 1493811402),
('m140506_102106_rbac_init', 1493811402),
('m170113_151537_create_tbl_payment_method_table', 1493811402),
('m170113_155020_create_tbl_category_table', 1493811403),
('m170113_155021_create_tbl_product_type_table', 1493999953),
('m170113_155021_create_tbl_supplier_table', 1493811403),
('m170113_155843_create_tbl_purchase_master_table', 1493811403),
('m170113_155844_create_tbl_product_table', 1493811403),
('m170113_155845_create_tbl_purchase_invoice_table', 1493811403),
('m170113_155948_create_tbl_purchase_table', 1493811403),
('m170113_160057_create_tbl_product_attribute_table', 1493811403),
('m170113_160128_create_tbl_inventory_table', 1493811404),
('m170113_160151_create_tbl_sales_table', 1493811404),
('m170113_160236_create_tbl_cashbook_table', 1493811404),
('m170113_160317_create_tbl_price_maintanance_table', 1493811404),
('m170113_160359_create_tbl_stock_adjustment_table', 1493811404),
('m170113_160441_create_tbl_transaction_table', 1493811404),
('m170113_160533_create_tbl_system_module_table', 1493811404),
('m170113_160549_create_tbl_system_setup_table', 1493811404),
('m170115_104820_create_tbl_audit_table', 1493811404),
('m170117_073342_create_tbl_language_table', 1493811404),
('m170128_121225_create_tbl_sales_item_table', 1493811404),
('m170130_113234_create_tbl_cart_table', 1493811405),
('m170203_145721_create_tbl_product_return_table', 1493811405),
('m170207_044510_create_tbl_purchase_cost_table', 1493811405),
('m170207_111738_create_tbl_report_table', 1493811405),
('m170503_113153_create_tbl_branch_table', 1493811405),
('m170504_170608_create_tbl_store_table', 1493918613),
('m170504_181403_create_tbl_store_inventory_table', 1493922250),
('m170505_161321_create_tbl_transfered_good_table', 1494002403);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_audit`
--

CREATE TABLE `tbl_audit` (
  `id` int(11) NOT NULL,
  `activity` varchar(200) DEFAULT NULL,
  `module` varchar(200) DEFAULT NULL,
  `action` varchar(200) DEFAULT NULL,
  `maker` varchar(200) DEFAULT NULL,
  `maker_time` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_audit`
--

INSERT INTO `tbl_audit` (`id`, `activity`, `module`, `action`, `maker`, `maker_time`) VALUES
(1, 'New Category is created (Mbao)', 'Category Details', 'create', 'admin', '2017-05-03:14:51:55'),
(2, 'New Product created', 'Product Details', 'create', 'admin', '2017-05-03:14:55:14'),
(3, 'New Product created', 'Product Details', 'create', 'admin', '2017-05-03:14:57:20'),
(4, 'New Product created', 'Product Details', 'create', 'admin', '2017-05-03:14:57:50'),
(5, 'New Product created', 'Product Details', 'create', 'admin', '2017-05-03:14:58:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_branch`
--

CREATE TABLE `tbl_branch` (
  `id` int(11) NOT NULL,
  `branch_name` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_branch`
--

INSERT INTO `tbl_branch` (`id`, `branch_name`, `location`) VALUES
(1, 'Njombe', 'Njombe'),
(2, 'Mafinga', 'Mafinga'),
(3, 'Kilolo', 'Kilolo');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `qty` decimal(10,0) DEFAULT NULL,
  `total` decimal(10,0) DEFAULT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `maker_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cashbook`
--

CREATE TABLE `tbl_cashbook` (
  `id` int(11) NOT NULL,
  `trn_dt` date NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `drcr_ind` char(1) NOT NULL,
  `description` varchar(200) NOT NULL,
  `maker_id` varchar(200) NOT NULL,
  `maker_time` datetime NOT NULL,
  `auth_status` char(1) DEFAULT NULL,
  `checker_id` varchar(200) NOT NULL,
  `checker_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_cashbook`
--

INSERT INTO `tbl_cashbook` (`id`, `trn_dt`, `amount`, `drcr_ind`, `description`, `maker_id`, `maker_time`, `auth_status`, `checker_id`, `checker_time`) VALUES
(1, '2017-05-03', '10000', 'C', 'Electricity expenses', 'admin', '2017-05-03 18:05:43', NULL, '', '0000-00-00 00:00:00'),
(2, '2017-05-03', '200000', 'D', 'Received to CRDB bank from Bosco', 'admin', '2017-05-03 18:19:05', NULL, '', '0000-00-00 00:00:00'),
(3, '2017-05-03', '300000', 'C', 'Salary to all employees', 'admin', '2017-05-03 18:20:19', NULL, '', '0000-00-00 00:00:00'),
(4, '2017-05-02', '4000000', 'C', 'Purchases', 'admin', '2017-05-03 18:33:56', NULL, '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) NOT NULL,
  `maker_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `parent`, `title`, `description`, `maker_id`, `maker_time`) VALUES
(1, NULL, 'Mbao', 'Mbao za Bati', 'admin', '2017-05-03 14:51:55');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory`
--

CREATE TABLE `tbl_inventory` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `buying_price` decimal(10,0) NOT NULL,
  `selling_price` decimal(10,0) NOT NULL,
  `qty` decimal(10,0) NOT NULL,
  `min_level` int(11) DEFAULT NULL,
  `last_updated` datetime DEFAULT NULL,
  `maker_id` varchar(200) NOT NULL,
  `maker_time` datetime NOT NULL,
  `auth_status` char(1) DEFAULT NULL,
  `checker_id` varchar(200) NOT NULL,
  `checker_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_inventory`
--

INSERT INTO `tbl_inventory` (`id`, `product_id`, `buying_price`, `selling_price`, `qty`, `min_level`, `last_updated`, `maker_id`, `maker_time`, `auth_status`, `checker_id`, `checker_time`) VALUES
(4, 1, '1200', '1200', '65', 5, '2017-05-07 00:29:13', 'admin', '2017-05-07 00:29:13', NULL, '', '0000-00-00 00:00:00'),
(5, 4, '2000', '2000', '0', 5, '2017-05-07 08:44:24', 'admin', '2017-05-07 08:44:24', NULL, '', '0000-00-00 00:00:00'),
(6, 2, '2000', '2000', '200', 5, '2017-05-07 10:21:57', 'admin', '2017-05-07 10:21:57', NULL, '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_language`
--

CREATE TABLE `tbl_language` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `langugae_code` char(5) DEFAULT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_language`
--

INSERT INTO `tbl_language` (`id`, `title`, `langugae_code`, `status`) VALUES
(1, 'English', 'en', 'default'),
(2, 'Swahili', 'sw', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_method`
--

CREATE TABLE `tbl_payment_method` (
  `id` int(11) NOT NULL,
  `method_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_payment_method`
--

INSERT INTO `tbl_payment_method` (`id`, `method_name`) VALUES
(1, 'Cash'),
(2, 'Credit');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_price_maintanance`
--

CREATE TABLE `tbl_price_maintanance` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price_type` int(11) NOT NULL,
  `old_price` decimal(10,0) NOT NULL,
  `new_price` decimal(10,0) NOT NULL,
  `reason` varchar(200) NOT NULL,
  `maker_id` varchar(200) NOT NULL,
  `maker_time` datetime NOT NULL,
  `auth_status` char(1) DEFAULT NULL,
  `checker_id` varchar(200) NOT NULL,
  `checker_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_price_maintanance`
--

INSERT INTO `tbl_price_maintanance` (`id`, `product_id`, `price_type`, `old_price`, `new_price`, `reason`, `maker_id`, `maker_time`, `auth_status`, `checker_id`, `checker_time`) VALUES
(1, 2, 0, '1500', '2000', 'TRA', 'admin', '2017-05-07 10:51:02', NULL, '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `description` text,
  `type_id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `maker_id` varchar(200) NOT NULL,
  `maker_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `product_name`, `description`, `type_id`, `category`, `status`, `maker_id`, `maker_time`) VALUES
(1, '1 x 10 Pines', 'Pines 1x10 ', 1, 1, 0, 'admin', '2017-05-05 19:03:06'),
(2, '1 x 8 Pines', 'Pines 1 by 8', 1, 1, 0, 'admin', '2017-05-05 19:02:54'),
(3, '2 x 6 Syprusses', 'Syprusses 2 by 6', 2, 1, 0, 'admin', '2017-05-05 19:02:09'),
(4, '2 x 4 Syprusses', 'Syprusses 2 by 4', 2, 1, 0, 'admin', '2017-05-05 19:02:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_attribute`
--

CREATE TABLE `tbl_product_attribute` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `attribute_name` varchar(20) NOT NULL,
  `quantity` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_return`
--

CREATE TABLE `tbl_product_return` (
  `id` int(11) NOT NULL,
  `trn_dt` date NOT NULL,
  `return_type` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `qty` decimal(10,0) DEFAULT NULL,
  `total` decimal(10,0) DEFAULT NULL,
  `source_ref_no` varchar(200) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  `maker_id` varchar(200) NOT NULL,
  `maker_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_type`
--

CREATE TABLE `tbl_product_type` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_product_type`
--

INSERT INTO `tbl_product_type` (`id`, `title`, `description`) VALUES
(1, 'Pines', 'Pines'),
(2, 'Syprusses', 'Syprusses');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase`
--

CREATE TABLE `tbl_purchase` (
  `id` int(11) NOT NULL,
  `prchs_dt` date NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `qty` decimal(10,0) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `purchase_invoice_id` int(11) NOT NULL,
  `selling_price` decimal(10,0) DEFAULT NULL,
  `previous_balance` decimal(10,0) DEFAULT NULL,
  `balance` decimal(10,0) DEFAULT NULL,
  `maker_id` varchar(200) NOT NULL,
  `maker_time` datetime NOT NULL,
  `auth_status` char(1) DEFAULT NULL,
  `checker_id` varchar(200) NOT NULL,
  `checker_time` datetime NOT NULL,
  `status` int(11) DEFAULT NULL,
  `delete_stat` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_purchase`
--

INSERT INTO `tbl_purchase` (`id`, `prchs_dt`, `product_id`, `price`, `qty`, `total`, `purchase_invoice_id`, `selling_price`, `previous_balance`, `balance`, `maker_id`, `maker_time`, `auth_status`, `checker_id`, `checker_time`, `status`, `delete_stat`) VALUES
(1, '2017-05-05', 1, '1200', '200', '240000', 10, '1500', NULL, NULL, 'admin', '2017-05-05 19:04:09', 'A', 'admin', '2017-05-05 19:04:13', 1, NULL),
(2, '2017-05-06', 3, '1200', '2000', '2400000', 11, '1500', NULL, NULL, 'admin', '2017-05-06 10:29:54', 'A', 'admin', '2017-05-06 10:29:57', 1, NULL),
(3, '2017-05-06', 3, '1200', '30', '36000', 12, '1500', '0', '30', 'admin', '2017-05-06 23:17:22', 'A', 'admin', '2017-05-06 23:17:26', 1, NULL),
(4, '2017-05-07', 2, '1200', '200', '240000', 13, '1500', NULL, NULL, 'admin', '2017-05-07 00:16:44', 'A', 'admin', '2017-05-07 00:16:47', 1, NULL),
(5, '2017-05-07', 1, '1200', '200', '240000', 14, '1500', NULL, NULL, 'admin', '2017-05-07 00:24:38', 'A', 'admin', '2017-05-07 00:24:41', 1, NULL),
(6, '2017-05-07', 1, '1200', '30', '36000', 15, '1500', NULL, NULL, 'admin', '2017-05-07 00:28:09', 'A', 'admin', '2017-05-07 00:28:11', 1, NULL),
(7, '2017-05-07', 3, '1200', '200', '240000', 16, '2500', NULL, NULL, 'admin', '2017-05-07 08:38:07', 'A', 'admin', '2017-05-07 08:38:12', 1, NULL),
(8, '2017-05-07', 2, '2000', '200', '400000', 16, '4000', NULL, NULL, 'admin', '2017-05-07 08:38:07', 'A', 'admin', '2017-05-07 08:38:12', 1, NULL),
(9, '2017-05-07', 1, '1200', '200', '240000', 17, '2500', NULL, NULL, 'admin', '2017-05-07 08:40:55', 'A', 'admin', '2017-05-07 08:41:13', 1, NULL),
(10, '2017-05-07', 2, '2000', '200', '400000', 17, '4000', NULL, NULL, 'admin', '2017-05-07 08:40:55', 'A', 'admin', '2017-05-07 08:41:13', 1, NULL),
(11, '2017-05-07', 3, '2500', '100', '250000', 17, '4000', NULL, NULL, 'admin', '2017-05-07 08:40:55', 'A', 'admin', '2017-05-07 08:41:13', 1, NULL),
(12, '2017-05-07', 4, '2000', '250', '500000', 17, '35000', NULL, NULL, 'admin', '2017-05-07 08:40:55', 'A', 'admin', '2017-05-07 08:41:13', 1, NULL),
(13, '2017-05-07', 2, '1200', '30', '36000', 18, '1500', '200', '230', 'admin', '2017-05-07 10:20:43', 'A', 'admin', '2017-05-07 10:20:47', 1, NULL),
(14, '2017-05-07', 4, '2000', '200', '400000', 19, '2500', NULL, NULL, 'admin', '2017-05-07 10:51:58', 'A', 'admin', '2017-05-07 10:52:01', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_cost`
--

CREATE TABLE `tbl_purchase_cost` (
  `id` int(11) NOT NULL,
  `purchase_master_id` int(11) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `description` varchar(200) NOT NULL,
  `maker_id` varchar(200) NOT NULL,
  `maker_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_invoice`
--

CREATE TABLE `tbl_purchase_invoice` (
  `id` int(11) NOT NULL,
  `invoice_number` varchar(20) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `supplier_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `purchase_master_id` int(11) NOT NULL,
  `total_purchase` decimal(10,0) DEFAULT NULL,
  `maker_id` varchar(200) NOT NULL,
  `maker_time` datetime NOT NULL,
  `checker_id` varchar(200) NOT NULL,
  `checker_time` datetime NOT NULL,
  `status` int(11) DEFAULT NULL,
  `delete_stat` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_purchase_invoice`
--

INSERT INTO `tbl_purchase_invoice` (`id`, `invoice_number`, `purchase_date`, `supplier_id`, `store_id`, `purchase_master_id`, `total_purchase`, `maker_id`, `maker_time`, `checker_id`, `checker_time`, `status`, `delete_stat`) VALUES
(10, '3455', '2017-05-05', 1, 1, 1, NULL, 'admin', '2017-05-05 19:04:09', 'admin', '2017-05-05 19:04:13', 1, NULL),
(11, '3455', '2017-05-06', 1, 2, 1, NULL, 'admin', '2017-05-06 10:29:54', 'admin', '2017-05-06 10:29:57', 1, NULL),
(12, '123', NULL, 1, 2, 1, NULL, 'admin', '2017-05-06 23:17:22', 'admin', '2017-05-06 23:17:26', 1, NULL),
(13, '123', '2017-05-07', 1, 3, 1, NULL, 'admin', '2017-05-07 00:16:44', 'admin', '2017-05-07 00:16:47', 1, NULL),
(14, '3455', '2017-05-07', 1, 1, 1, NULL, 'admin', '2017-05-07 00:24:38', 'admin', '2017-05-07 00:24:41', 1, NULL),
(15, '3455', '2017-05-07', 1, 1, 1, NULL, 'admin', '2017-05-07 00:28:09', 'admin', '2017-05-07 00:28:11', 1, NULL),
(16, '', '2017-05-07', 2, 1, 1, NULL, 'admin', '2017-05-07 08:38:07', 'admin', '2017-05-07 08:38:12', 1, NULL),
(17, '678', '2017-05-07', 4, 3, 1, NULL, 'admin', '2017-05-07 08:40:55', 'admin', '2017-05-07 08:41:13', 1, NULL),
(18, '6444', '2017-05-07', 4, 3, 1, NULL, 'admin', '2017-05-07 10:20:43', 'admin', '2017-05-07 10:20:47', 1, NULL),
(19, '3455', '2017-05-07', 2, 2, 1, NULL, 'admin', '2017-05-07 10:51:58', 'admin', '2017-05-07 10:52:01', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_master`
--

CREATE TABLE `tbl_purchase_master` (
  `id` int(11) NOT NULL,
  `description` varchar(200) NOT NULL,
  `period` char(3) NOT NULL,
  `financial_year` varchar(200) NOT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `maker_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_purchase_master`
--

INSERT INTO `tbl_purchase_master` (`id`, `description`, `period`, `financial_year`, `maker_id`, `maker_time`) VALUES
(1, 'Manunuzi ya mwez wa Tano', 'M05', 'FY2017', 'admin', '2017-05-03 15:11:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_report`
--

CREATE TABLE `tbl_report` (
  `id` int(11) NOT NULL,
  `report_name` varchar(200) NOT NULL,
  `module` int(11) DEFAULT NULL,
  `path` varchar(200) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_report`
--

INSERT INTO `tbl_report` (`id`, `report_name`, `module`, `path`, `status`) VALUES
(1, 'Today''s Sales summary report', 0, '', 0),
(2, 'Today''s Sales detailed report', 0, '', 0),
(3, 'Inventory In', 0, '', 0),
(4, 'Inventory Out', 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales`
--

CREATE TABLE `tbl_sales` (
  `id` int(11) NOT NULL,
  `trn_dt` date NOT NULL,
  `total_qty` decimal(10,0) NOT NULL,
  `total_amount` decimal(10,0) NOT NULL,
  `discount` decimal(10,0) DEFAULT NULL,
  `paid_amount` decimal(10,0) NOT NULL,
  `due_amount` decimal(10,0) NOT NULL,
  `payment_method` int(11) NOT NULL,
  `source_ref_number` varchar(200) DEFAULT NULL,
  `notes` varchar(200) DEFAULT NULL,
  `customer_name` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) NOT NULL,
  `maker_time` datetime NOT NULL,
  `status` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_sales`
--

INSERT INTO `tbl_sales` (`id`, `trn_dt`, `total_qty`, `total_amount`, `discount`, `paid_amount`, `due_amount`, `payment_method`, `source_ref_number`, `notes`, `customer_name`, `maker_id`, `maker_time`, `status`) VALUES
(1, '2017-05-03', '1', '2500', '0', '2500', '0', 1, NULL, '', 'Juma Sultan', 'admin', '2017-05-03 21:55:21', 'P'),
(2, '2017-05-03', '1', '2500', '0', '2000', '500', 1, NULL, '', 'James JJ', 'admin', '2017-05-03 22:01:54', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales_item`
--

CREATE TABLE `tbl_sales_item` (
  `id` int(11) NOT NULL,
  `trn_dt` date NOT NULL,
  `sales_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `selling_price` decimal(10,0) DEFAULT NULL,
  `qty` decimal(10,0) DEFAULT NULL,
  `total` decimal(10,0) DEFAULT NULL,
  `previous_balance` decimal(10,0) DEFAULT NULL,
  `balance` decimal(10,0) DEFAULT NULL,
  `maker_id` varchar(200) NOT NULL,
  `maker_time` datetime NOT NULL,
  `delete_stat` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_sales_item`
--

INSERT INTO `tbl_sales_item` (`id`, `trn_dt`, `sales_id`, `product_id`, `selling_price`, `qty`, `total`, `previous_balance`, `balance`, `maker_id`, `maker_time`, `delete_stat`) VALUES
(1, '2017-05-03', 1, 1, '2500', '1', '2500', '4000', '3999', 'admin', '2017-05-03 21:55:21', NULL),
(2, '2017-05-03', 2, 1, '2500', '1', '2500', '3999', '3998', 'admin', '2017-05-03 22:01:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock_adjustment`
--

CREATE TABLE `tbl_stock_adjustment` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `adjust_type` int(11) NOT NULL,
  `qty` decimal(10,0) NOT NULL,
  `stock_change` decimal(10,0) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `description` varchar(200) NOT NULL,
  `maker_id` varchar(200) NOT NULL,
  `maker_time` datetime NOT NULL,
  `delete_status` char(1) DEFAULT NULL,
  `auth_status` char(1) DEFAULT NULL,
  `checker_id` varchar(200) NOT NULL,
  `checker_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_store`
--

CREATE TABLE `tbl_store` (
  `id` int(11) NOT NULL,
  `store_name` varchar(200) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `store_keeper` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_store`
--

INSERT INTO `tbl_store` (`id`, `store_name`, `branch_id`, `store_keeper`) VALUES
(1, 'MZAM-MPEMBA - Njombe', 1, 'Jumanne'),
(2, 'MZAM-MPEMBA - Mafinga', 2, 'Andrew'),
(3, 'GARAGE-IPOGOLO', 3, 'Andrew');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_store_inventory`
--

CREATE TABLE `tbl_store_inventory` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `buying_price` decimal(10,0) NOT NULL,
  `selling_price` decimal(10,0) NOT NULL,
  `qty` decimal(10,0) NOT NULL,
  `store_id` int(11) NOT NULL,
  `last_updated` datetime DEFAULT NULL,
  `maker_id` varchar(200) NOT NULL,
  `maker_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_store_inventory`
--

INSERT INTO `tbl_store_inventory` (`id`, `product_id`, `buying_price`, `selling_price`, `qty`, `store_id`, `last_updated`, `maker_id`, `maker_time`) VALUES
(9, 1, '1200', '0', '5', 1, '2017-05-07 00:28:11', 'admin', '2017-05-07 00:28:09'),
(10, 3, '1200', '0', '200', 1, '2017-05-07 08:38:12', 'admin', '2017-05-07 08:38:07'),
(11, 2, '2000', '0', '200', 1, '2017-05-07 08:38:12', 'admin', '2017-05-07 08:38:07'),
(12, 1, '1200', '0', '200', 3, '2017-05-07 08:41:13', 'admin', '2017-05-07 08:40:55'),
(13, 2, '2000', '1500', '30', 3, '2017-05-07 08:41:13', 'admin', '2017-05-07 10:20:43'),
(14, 3, '2500', '0', '100', 3, '2017-05-07 08:41:13', 'admin', '2017-05-07 08:40:55'),
(15, 4, '2000', '0', '250', 3, '2017-05-07 08:41:13', 'admin', '2017-05-07 08:40:55'),
(16, 4, '2000', '2500', '200', 2, '2017-05-07 10:52:01', 'admin', '2017-05-07 10:51:58');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `id` int(11) NOT NULL,
  `supplier_name` varchar(200) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone_number` varchar(200) NOT NULL,
  `location` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`id`, `supplier_name`, `email`, `phone_number`, `location`) VALUES
(1, 'ERICK', 'erick@gmail.com', '0766335577/0625750147', 1),
(2, 'MCHINA', 'mchina@gmail.com', '0759226804', 1),
(3, 'BENNY', '', '0758351365', 2),
(4, 'BARAKA', '', '0755788875', 3),
(5, 'GEORGE', '', '0764280766', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_system_module`
--

CREATE TABLE `tbl_system_module` (
  `id` int(11) NOT NULL,
  `module_name` varchar(200) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `status` char(1) NOT NULL,
  `maker_id` varchar(200) NOT NULL,
  `maker_time` datetime NOT NULL,
  `auth_status` char(1) DEFAULT NULL,
  `checker_id` varchar(200) NOT NULL,
  `checker_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_system_setup`
--

CREATE TABLE `tbl_system_setup` (
  `id` int(11) NOT NULL,
  `tax` decimal(10,0) DEFAULT NULL,
  `discount` decimal(10,0) DEFAULT NULL,
  `currency` varchar(20) DEFAULT NULL,
  `shop_name` varchar(200) DEFAULT NULL,
  `shop_category` varchar(200) DEFAULT NULL,
  `maker_checker` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_system_setup`
--

INSERT INTO `tbl_system_setup` (`id`, `tax`, `discount`, `currency`, `shop_name`, `shop_category`, `maker_checker`) VALUES
(1, '18', '6', 'TZS', NULL, NULL, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction`
--

CREATE TABLE `tbl_transaction` (
  `id` int(11) NOT NULL,
  `trn_ref_no` int(11) NOT NULL,
  `trn_dt` date NOT NULL,
  `module` char(2) NOT NULL,
  `drcr_ind` char(1) NOT NULL,
  `account` varchar(20) NOT NULL,
  `period` varchar(3) NOT NULL,
  `year` varchar(10) NOT NULL,
  `delete_stat` char(1) DEFAULT NULL,
  `auth_status` char(1) DEFAULT NULL,
  `trn_event` char(3) DEFAULT NULL,
  `maker_id` varchar(200) NOT NULL,
  `maker_time` datetime NOT NULL,
  `checker_id` varchar(200) NOT NULL,
  `checker_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transfered_good`
--

CREATE TABLE `tbl_transfered_good` (
  `id` int(11) NOT NULL,
  `transfer_date` date NOT NULL,
  `store_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` decimal(10,0) NOT NULL,
  `balance` decimal(10,0) NOT NULL,
  `horse_number` varchar(200) NOT NULL,
  `trailer_number` varchar(200) DEFAULT NULL,
  `driver_name` varchar(200) DEFAULT NULL,
  `driver_phonenumber` varchar(200) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `maker_id` varchar(200) NOT NULL,
  `maker_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_transfered_good`
--

INSERT INTO `tbl_transfered_good` (`id`, `transfer_date`, `store_id`, `product_id`, `qty`, `balance`, `horse_number`, `trailer_number`, `driver_name`, `driver_phonenumber`, `status`, `maker_id`, `maker_time`) VALUES
(14, '2017-05-07', 1, 1, '15', '15', 'T  724 BTL', 'T  790 CVT', 'Andrew Laswai', '0753707979', -1, 'admin', '2017-05-07 00:28:45'),
(15, '2017-05-10', 1, 1, '10', '5', 'T  724 BTL', 'T  790 CVT', 'Andrew Laswai', '0753707979', -1, 'admin', '2017-05-07 00:30:27'),
(16, '2017-05-07', 1, 1, '5', '0', 'T  724 BTL', 'T  790 CVT', 'Andrew Laswai', '0753707979', -1, 'admin', '2017-05-07 08:21:54'),
(17, '2017-05-07', 1, 1, '5', '0', 'T  724 BTL', 'T  790 CVT', 'Andrew Laswai', '0753707979', -1, 'admin', '2017-05-07 08:23:34'),
(18, '2017-05-08', 3, 4, '230', '20', 'T  724 BTL', 'T  790 CVT', 'Andrew Laswai', '0753707979', -1, 'admin', '2017-05-07 08:43:36'),
(19, '2017-05-07', 3, 2, '200', '30', 'T  724 BTL', 'T  790 CVT', 'Andrew Laswai', '0753707979', -1, 'admin', '2017-05-07 10:21:44'),
(20, '2017-05-07', 3, 2, '200', '30', 'T  724 BTL', 'T  790 CVT', 'Andrew Laswai', '0753707979', 1, 'admin', '2017-05-07 10:23:47'),
(21, '2017-05-09', 2, 4, '150', '50', 'T  724 BTL', 'T  790 CVT', 'Andrew Laswai', '0753707979', -1, 'admin', '2017-05-07 10:52:50');

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
  `role` int(11) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$13$gHGuKmj0qnKCrW4hLz4RR.lJz', '$2y$13$d.8sculNcIpLYiQa6dRi0uiaAFDNUu8bmLxGnKUulj1AYORcqdazq', '', 'adolph.cm@gmail.com', 1, 10, 20170503, 20170503);

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
-- Indexes for table `tbl_audit`
--
ALTER TABLE `tbl_audit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_branch`
--
ALTER TABLE `tbl_branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-tbl_cart-product_id` (`product_id`);

--
-- Indexes for table `tbl_cashbook`
--
ALTER TABLE `tbl_cashbook`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id` (`product_id`),
  ADD KEY `idx-tbl_inventory-product_id` (`product_id`);

--
-- Indexes for table `tbl_language`
--
ALTER TABLE `tbl_language`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `tbl_payment_method`
--
ALTER TABLE `tbl_payment_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_price_maintanance`
--
ALTER TABLE `tbl_price_maintanance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-tbl_price_maintanance-product_id` (`product_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-tbl_product-category` (`category`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `tbl_product_attribute`
--
ALTER TABLE `tbl_product_attribute`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-tbl_product_attribute-product_id` (`product_id`);

--
-- Indexes for table `tbl_product_return`
--
ALTER TABLE `tbl_product_return`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-tbl_product_return-product_id` (`product_id`);

--
-- Indexes for table `tbl_product_type`
--
ALTER TABLE `tbl_product_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_purchase`
--
ALTER TABLE `tbl_purchase`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-tbl_purchase-product_id` (`product_id`),
  ADD KEY `idx-tbl_purchase-purchase_invoice_id` (`purchase_invoice_id`);

--
-- Indexes for table `tbl_purchase_cost`
--
ALTER TABLE `tbl_purchase_cost`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-tbl_purchase_cost-purchase_master_id` (`purchase_master_id`);

--
-- Indexes for table `tbl_purchase_invoice`
--
ALTER TABLE `tbl_purchase_invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-tbl_purchase_invoice-supplier_id` (`supplier_id`),
  ADD KEY `idx-tbl_purchase_invoice-purchase_master_id` (`purchase_master_id`);

--
-- Indexes for table `tbl_purchase_master`
--
ALTER TABLE `tbl_purchase_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_report`
--
ALTER TABLE `tbl_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-tbl_report-module` (`module`);

--
-- Indexes for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sales_item`
--
ALTER TABLE `tbl_sales_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-tbl_sales_item-product_id` (`product_id`),
  ADD KEY `idx-tbl_sales_item-sales_id` (`sales_id`);

--
-- Indexes for table `tbl_stock_adjustment`
--
ALTER TABLE `tbl_stock_adjustment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-tbl_stock_adjustment-product_id` (`product_id`);

--
-- Indexes for table `tbl_store`
--
ALTER TABLE `tbl_store`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-tbl_store-branch_id` (`branch_id`);

--
-- Indexes for table `tbl_store_inventory`
--
ALTER TABLE `tbl_store_inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-tbl_store_inventory-product_id` (`product_id`),
  ADD KEY `idx-tbl_store_inventory-store_id` (`store_id`),
  ADD KEY `product_id` (`product_id`) USING BTREE;

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_system_module`
--
ALTER TABLE `tbl_system_module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_system_setup`
--
ALTER TABLE `tbl_system_setup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_transfered_good`
--
ALTER TABLE `tbl_transfered_good`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-tbl_transfered_good-store_id` (`store_id`),
  ADD KEY `idx-tbl_transfered_good-product_id` (`product_id`);

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
-- AUTO_INCREMENT for table `tbl_audit`
--
ALTER TABLE `tbl_audit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_branch`
--
ALTER TABLE `tbl_branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_cashbook`
--
ALTER TABLE `tbl_cashbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_language`
--
ALTER TABLE `tbl_language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_payment_method`
--
ALTER TABLE `tbl_payment_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_price_maintanance`
--
ALTER TABLE `tbl_price_maintanance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_product_attribute`
--
ALTER TABLE `tbl_product_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_product_return`
--
ALTER TABLE `tbl_product_return`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_product_type`
--
ALTER TABLE `tbl_product_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_purchase`
--
ALTER TABLE `tbl_purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tbl_purchase_cost`
--
ALTER TABLE `tbl_purchase_cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_purchase_invoice`
--
ALTER TABLE `tbl_purchase_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `tbl_purchase_master`
--
ALTER TABLE `tbl_purchase_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_report`
--
ALTER TABLE `tbl_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_sales_item`
--
ALTER TABLE `tbl_sales_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_stock_adjustment`
--
ALTER TABLE `tbl_stock_adjustment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_store`
--
ALTER TABLE `tbl_store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_store_inventory`
--
ALTER TABLE `tbl_store_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_system_module`
--
ALTER TABLE `tbl_system_module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_system_setup`
--
ALTER TABLE `tbl_system_setup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_transfered_good`
--
ALTER TABLE `tbl_transfered_good`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `fk-tbl_cart-product_id` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  ADD CONSTRAINT `fk-tbl_inventory-product_id` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_price_maintanance`
--
ALTER TABLE `tbl_price_maintanance`
  ADD CONSTRAINT `fk-tbl_price_maintanance-product_id` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `fk-tbl_product-category` FOREIGN KEY (`category`) REFERENCES `tbl_category` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_product_attribute`
--
ALTER TABLE `tbl_product_attribute`
  ADD CONSTRAINT `fk-tbl_product_attribute-product_id` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_product_return`
--
ALTER TABLE `tbl_product_return`
  ADD CONSTRAINT `fk-tbl_product_return-product_id` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_purchase`
--
ALTER TABLE `tbl_purchase`
  ADD CONSTRAINT `fk-tbl_purchase-product_id` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-tbl_purchase-purchase_invoice_id` FOREIGN KEY (`purchase_invoice_id`) REFERENCES `tbl_purchase_invoice` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_purchase_cost`
--
ALTER TABLE `tbl_purchase_cost`
  ADD CONSTRAINT `fk-tbl_purchase_cost-purchase_master_id` FOREIGN KEY (`purchase_master_id`) REFERENCES `tbl_purchase_master` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_purchase_invoice`
--
ALTER TABLE `tbl_purchase_invoice`
  ADD CONSTRAINT `fk-tbl_purchase_invoice-purchase_master_id` FOREIGN KEY (`purchase_master_id`) REFERENCES `tbl_purchase_master` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-tbl_purchase_invoice-supplier_id` FOREIGN KEY (`supplier_id`) REFERENCES `tbl_supplier` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_sales_item`
--
ALTER TABLE `tbl_sales_item`
  ADD CONSTRAINT `fk-tbl_sales_item-product_id` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-tbl_sales_item-sales_id` FOREIGN KEY (`sales_id`) REFERENCES `tbl_sales` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_stock_adjustment`
--
ALTER TABLE `tbl_stock_adjustment`
  ADD CONSTRAINT `fk-tbl_stock_adjustment-product_id` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_store`
--
ALTER TABLE `tbl_store`
  ADD CONSTRAINT `fk-tbl_store-branch_id` FOREIGN KEY (`branch_id`) REFERENCES `tbl_branch` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_store_inventory`
--
ALTER TABLE `tbl_store_inventory`
  ADD CONSTRAINT `fk-tbl_store_inventory-product_id` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-tbl_store_inventory-store_id` FOREIGN KEY (`store_id`) REFERENCES `tbl_store` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_transfered_good`
--
ALTER TABLE `tbl_transfered_good`
  ADD CONSTRAINT `fk-tbl_transfered_good-product_id` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-tbl_transfered_good-store_id` FOREIGN KEY (`store_id`) REFERENCES `tbl_store` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
