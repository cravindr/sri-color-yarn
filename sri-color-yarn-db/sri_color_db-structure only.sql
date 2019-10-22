-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2018 at 07:51 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sri_color_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_details`
--

CREATE TABLE `bank_details` (
  `bank_id` int(11) NOT NULL,
  `comp_id` int(11) DEFAULT NULL,
  `account_no` varchar(30) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `ifsc_code` varchar(30) DEFAULT NULL,
  `account_type` enum('current','savings') DEFAULT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `micr_code` int(30) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_details`
--

INSERT INTO `bank_details` (`bank_id`, `comp_id`, `account_no`, `bank_name`, `ifsc_code`, `account_type`, `branch`, `micr_code`, `status`) VALUES
(1, 1, '1206201004892', 'Karur Vysiya Bank', 'KVBB0001206', 'current', 'Ganthipuram', 641015005, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_desc` varchar(250) NOT NULL,
  `parent_category` int(11) DEFAULT NULL,
  `par_cat_order` varchar(50) DEFAULT NULL,
  `cdate` datetime NOT NULL,
  `status` varchar(8) NOT NULL DEFAULT 'active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_desc`, `parent_category`, `par_cat_order`, `cdate`, `status`) VALUES
(1, 'Yearn', NULL, NULL, '2018-03-20 13:10:54', 'active'),
(2, 'Cotton', 1, '1', '2018-03-20 13:11:12', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `comp_id` int(11) NOT NULL,
  `comp_name` varchar(255) NOT NULL,
  `comp_email` varchar(255) NOT NULL,
  `comp_mobile1` varchar(15) NOT NULL,
  `comp_mobile2` varchar(255) NOT NULL,
  `comp_phone` varchar(20) NOT NULL,
  `comp_address1` varchar(255) NOT NULL,
  `comp_address2` varchar(255) NOT NULL,
  `comp_place` varchar(255) NOT NULL,
  `comp_city` varchar(255) NOT NULL,
  `comp_state` varchar(255) NOT NULL,
  `comp_state_code` varchar(15) NOT NULL,
  `comp_country` varchar(255) NOT NULL,
  `comp_pin_code` varchar(10) NOT NULL,
  `comp_website` varchar(255) NOT NULL,
  `comp_gstin_code` varchar(20) NOT NULL,
  `comp_cdate` datetime NOT NULL,
  `comp_logo` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`comp_id`, `comp_name`, `comp_email`, `comp_mobile1`, `comp_mobile2`, `comp_phone`, `comp_address1`, `comp_address2`, `comp_place`, `comp_city`, `comp_state`, `comp_state_code`, `comp_country`, `comp_pin_code`, `comp_website`, `comp_gstin_code`, `comp_cdate`, `comp_logo`, `status`) VALUES
(1, 'SRI COLOURS', 'sricolours1976sri@gmail.com', '9942086891', '9994411785', '', 'Ganesh Gounder Thottam, Near Sundaram Colony', '128-H Anangoor Main Road', 'Kumarapalayam(Tk)', 'Namakkal(Dt)', 'TAMIL NADU', '33', 'India', '638183', '', '33AKCPA5908R1Z1', '2018-03-14 00:00:00', 'IMG-20180314-WA0105_21.jpg', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `company_branch`
--

CREATE TABLE `company_branch` (
  `bra_id` int(11) NOT NULL,
  `comp_id` varchar(100) NOT NULL,
  `bra_name` varchar(255) NOT NULL,
  `bra_email` varchar(255) NOT NULL,
  `bra_mobile1` varchar(15) NOT NULL,
  `bra_mobile2` varchar(255) NOT NULL,
  `bra_phone` varchar(20) NOT NULL,
  `bra_address1` varchar(255) NOT NULL,
  `bra_address2` varchar(255) NOT NULL,
  `bra_place` varchar(255) NOT NULL,
  `bra_city` varchar(255) NOT NULL,
  `bra_state` varchar(255) NOT NULL,
  `bra_state_code` varchar(50) NOT NULL,
  `bra_pin_code` int(11) NOT NULL,
  `bra_country` varchar(255) NOT NULL,
  `bra_gstin_code` varchar(20) NOT NULL,
  `bra_website` varchar(255) NOT NULL,
  `bra_cdate` datetime NOT NULL,
  `comp_logo` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cus_id` int(11) NOT NULL,
  `cus_name` varchar(255) NOT NULL,
  `cus_compnay_name` varchar(255) NOT NULL,
  `cus_email` varchar(255) NOT NULL,
  `cus_mobile1` varchar(15) NOT NULL,
  `cus_mobile2` varchar(255) NOT NULL,
  `cus_phone` varchar(100) NOT NULL,
  `cus_address1` varchar(255) NOT NULL,
  `cus_address2` varchar(255) NOT NULL,
  `cus_place` varchar(255) NOT NULL,
  `cus_city` varchar(255) NOT NULL,
  `cus_state` varchar(255) NOT NULL,
  `cus_state_code` varchar(15) NOT NULL,
  `cus_country` varchar(255) NOT NULL,
  `pin_code` int(10) NOT NULL,
  `website` varchar(255) NOT NULL,
  `cus_gstin_no` varchar(20) NOT NULL,
  `cus_cdate` datetime NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cus_id`, `cus_name`, `cus_compnay_name`, `cus_email`, `cus_mobile1`, `cus_mobile2`, `cus_phone`, `cus_address1`, `cus_address2`, `cus_place`, `cus_city`, `cus_state`, `cus_state_code`, `cus_country`, `pin_code`, `website`, `cus_gstin_no`, `cus_cdate`, `status`) VALUES
(6, '', 'AKSARA APPARALS', '', '9843332462', '', '', '1/55/5 DHARAPURAM ROAD V .THANNEERPANTHAL  VISWANATHAPURI  KARUR', '', 'KARUR', 'KARUR', 'TAMIL NADU', '33', 'India', 0, '', '33AABFA1702G1ZB', '2018-03-15 00:00:00', 'active'),
(7, '', 'A.B.L. EXPORTS', '', '9843020175', '7373720175', '', '9,loganathan street V.V.G Nagar Vengamadu Karur', '', 'karur', 'Karur', 'TAMIL NADU', '33', 'India', 0, '', '33AAATA9739Q1ZY', '2018-03-15 00:00:00', 'active'),
(8, '', 'ABHINAVASHREE EXPORT', '', '9047024776', '', '9047025776', '14-A Authur Road Vengappalayam', 'Kathapparai  [po]', 'Karur-6', 'KARUR', 'TAMIL NADU', '33', 'India', 0, '', '33AAKFA8749E1ZD', '2018-03-16 00:00:00', 'active'),
(9, '', 'ANNAMAR EXPORT', '', '8838879123', '', '9443356554', '68, Bhrathiyar st ', 'Vengamadu', 'Karur', 'Karur', 'TAMIL NADU', '33', 'India', 639006, '', '33AAKFA0969L1Z8', '2018-03-16 00:00:00', 'active'),
(10, '', 'ARUNGARAI GARMENTS', '', '9489150292', '', '04324 235408', '137-A Bharathi Nagar [West]', 'MG Road', 'Karur', 'Karur', 'TAMIL NADU', '33', 'India', 639002, '', '33AARFA4779R1', '2018-03-16 00:00:00', 'active'),
(11, '', 'ALL WEAVES EXPORT', '', '9047080995', '9043120575', '', 'NO 11-A J Nagar 1 St  VVC Nagar', 'Vengamadu', 'Karur', 'KARUR', 'TAMIL NADU', '33', 'India', 639006, '', '33ASNPP9416C1ZN', '2018-03-16 00:00:00', 'active'),
(12, '', 'BUSHNEST', '', '9952423679', '09952423689', '04324 230605', 'NO-7B-R.K.Puram', '', 'Karur', 'KARUR', 'TAMIL NADU', '33', 'India', 639001, '', '33AADFB1640E1Z7', '2018-03-16 00:00:00', 'active'),
(13, '', 'C,M,S,EXPORTS', '', '9843033420', '04324 237194', '', '2-Valluvar street', 'Karur', 'Karur', 'KARUR', 'TAMIL NADU', '33', 'India', 0, '', '33AAGPR8166A1ZS', '2018-03-16 00:00:00', 'active'),
(14, '', 'CHAKRA LIFE STYLE', '', '7871555632', '', '', '13,14,A Anna Nagar 2nd Cross', '', 'Karur', 'KARUR', 'TAMIL NADU', '33', 'India', 639002, '', '33AAHFC7416K1ZF', '2018-03-16 00:00:00', 'active'),
(15, '', 'CASTLE IMPEX', '', '9790544440', '', '', '31/23A, Velammal Lay out', 'Sengunthapuram', 'Karur', 'KARUR', 'TAMIL NADU', '33', 'India', 639002, '', '33AEHPV4534M1Z2', '2018-03-16 00:00:00', 'active'),
(16, '', 'DAKSHIN HOME FASHIONS', '', '9944472134', '04324 240434', '', '9/410 Vangaliappan Nagar', 'Chinna Andankovil Road', 'Karur', 'KARUR', 'TAMIL NADU', '33', 'India', 639001, '', '33AAEFD8193P1ZV', '2018-03-16 00:00:00', 'active'),
(17, '', 'HOME ZONE', '', '9843099000', '9843088183', '', '14-A  Bharathi Nagar [West]', '', 'Karur', 'Karur', 'TAMIL NADU', '33', 'India', 0, '', '33AAEFH9545F1ZE', '2018-03-16 00:00:00', 'active'),
(18, '', 'HOME APPARELS', '', '9789452905', '', '04324 235106', 'G-34,  50 Feet Road', 'Ramakrishnapuram', 'Karur', 'KARUR', 'TAMIL NADU', '33', 'India', 639001, '', '33AABFH2512F1Z4', '2018-03-16 00:00:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `customer_branch`
--

CREATE TABLE `customer_branch` (
  `shi_id` int(11) NOT NULL,
  `cus_id` varchar(100) NOT NULL,
  `shi_name` varchar(255) NOT NULL,
  `shi_compnay_name` varchar(255) NOT NULL,
  `shi_email` varchar(255) NOT NULL,
  `shi_mobile1` varchar(15) NOT NULL,
  `shi_mobile2` varchar(255) NOT NULL,
  `shi_phone` varchar(50) NOT NULL,
  `shi_address1` varchar(255) NOT NULL,
  `shi_address2` varchar(255) NOT NULL,
  `shi_place` varchar(255) NOT NULL,
  `shi_city` varchar(255) NOT NULL,
  `shi_state` varchar(255) NOT NULL,
  `shi_state_code` varchar(20) NOT NULL,
  `shi_country` varchar(255) NOT NULL,
  `pin_code` int(11) NOT NULL,
  `website` varchar(255) NOT NULL,
  `shi_gstin_code` varchar(20) NOT NULL,
  `shi_cdate` datetime NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_detail`
--

CREATE TABLE `delivery_detail` (
  `id` int(11) NOT NULL,
  `inv_id` int(11) NOT NULL,
  `inv_no` varchar(20) NOT NULL,
  `prod_id` int(11) DEFAULT NULL,
  `prod_desc` varchar(250) NOT NULL,
  `hsn_code` varchar(15) DEFAULT NULL,
  `qty` decimal(13,3) NOT NULL,
  `uom` varchar(50) NOT NULL DEFAULT 'unit',
  `price` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `taxable_value` decimal(10,2) NOT NULL,
  `cgst_rate` decimal(10,2) DEFAULT NULL,
  `cgst_amount` decimal(10,2) DEFAULT NULL,
  `sgst_rate` decimal(10,2) DEFAULT NULL,
  `sgst_amount` decimal(10,2) DEFAULT NULL,
  `igst_rate` decimal(10,2) DEFAULT NULL,
  `igst_amount` decimal(10,2) DEFAULT NULL,
  `tax_detail` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_master`
--

CREATE TABLE `delivery_master` (
  `dc_id` int(11) NOT NULL,
  `inv_no` varchar(20) DEFAULT NULL,
  `cus_id` int(11) NOT NULL,
  `cus_ship_id` int(11) NOT NULL,
  `rcm` varchar(5) DEFAULT NULL,
  `transport_mode` varchar(150) DEFAULT NULL,
  `vehicle_no` varchar(15) DEFAULT NULL,
  `date_of_supply` datetime DEFAULT NULL,
  `inv_date` datetime DEFAULT NULL,
  `place_of_supply` varchar(150) DEFAULT NULL,
  `inv_address` varchar(255) DEFAULT NULL,
  `inv_shipping_address` varchar(255) DEFAULT NULL,
  `total` decimal(12,2) DEFAULT NULL,
  `cgst` decimal(10,2) DEFAULT NULL,
  `sgst` decimal(10,2) DEFAULT NULL,
  `igst` decimal(10,2) DEFAULT NULL,
  `gst` decimal(10,2) DEFAULT NULL,
  `total_tax` decimal(10,2) DEFAULT NULL,
  `net_amount` decimal(10,2) DEFAULT NULL,
  `rcgst` decimal(10,2) DEFAULT NULL,
  `rsgst` decimal(10,2) DEFAULT NULL,
  `rigst` decimal(10,2) DEFAULT NULL,
  `rgst` decimal(10,2) DEFAULT NULL,
  `erf_no` varchar(50) DEFAULT NULL,
  `bill_generator_name` varchar(150) DEFAULT NULL,
  `auth_sign_name` varchar(150) DEFAULT NULL,
  `auth_sign_designation` varchar(150) DEFAULT NULL,
  `amount_in_words` varchar(255) DEFAULT NULL,
  `payment_type` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'g'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_detail`
--

CREATE TABLE `invoice_detail` (
  `id` int(11) NOT NULL,
  `inv_id` int(11) NOT NULL,
  `inv_no` varchar(20) NOT NULL,
  `dc_no` varchar(20) NOT NULL,
  `prod_id` int(11) DEFAULT NULL,
  `prod_desc` varchar(250) NOT NULL,
  `hsn_code` varchar(15) DEFAULT NULL,
  `qty` decimal(13,3) NOT NULL,
  `uom` varchar(50) NOT NULL DEFAULT 'unit',
  `price` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `taxable_value` decimal(10,2) NOT NULL,
  `cgst_rate` decimal(10,2) DEFAULT NULL,
  `cgst_amount` decimal(10,2) DEFAULT NULL,
  `sgst_rate` decimal(10,2) DEFAULT NULL,
  `sgst_amount` decimal(10,2) DEFAULT NULL,
  `igst_rate` decimal(10,2) DEFAULT NULL,
  `igst_amount` decimal(10,2) DEFAULT NULL,
  `tax_detail` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_master`
--

CREATE TABLE `invoice_master` (
  `inv_id` int(11) NOT NULL,
  `inv_no` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `cus_id` int(11) NOT NULL,
  `cus_ship_id` int(11) NOT NULL,
  `rcm` varchar(5) CHARACTER SET latin1 DEFAULT NULL,
  `transport_mode` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `vehicle_no` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `date_of_supply` datetime DEFAULT NULL,
  `inv_date` datetime DEFAULT NULL,
  `place_of_supply` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `inv_address` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `inv_shipping_address` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `total` decimal(12,2) DEFAULT NULL,
  `cgst` decimal(10,2) DEFAULT NULL,
  `sgst` decimal(10,2) DEFAULT NULL,
  `igst` decimal(10,2) DEFAULT NULL,
  `gst` decimal(10,2) DEFAULT NULL,
  `total_tax` decimal(10,2) DEFAULT NULL,
  `net_amount` decimal(10,2) DEFAULT NULL,
  `rcgst` decimal(10,2) DEFAULT NULL,
  `rsgst` decimal(10,2) DEFAULT NULL,
  `rigst` decimal(10,2) DEFAULT NULL,
  `rgst` decimal(10,2) DEFAULT NULL,
  `erf_no` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `bill_generator_name` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `auth_sign_name` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `auth_sign_designation` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `amount_in_words` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `payment_type` varchar(20) NOT NULL,
  `due_date` date NOT NULL,
  `doc_type` varchar(255) NOT NULL,
  `doc_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=big5;

-- --------------------------------------------------------

--
-- Table structure for table `ledger`
--

CREATE TABLE `ledger` (
  `trans_id` int(11) NOT NULL,
  `trans_date` datetime DEFAULT NULL,
  `cus_id` int(11) DEFAULT NULL,
  `desc` varchar(250) DEFAULT NULL,
  `inv_id` int(11) DEFAULT NULL,
  `inv_amount` decimal(13,2) DEFAULT NULL,
  `paid_amount` decimal(13,2) DEFAULT NULL,
  `trans_type` enum('credit','debit') DEFAULT 'credit',
  `amount` decimal(13,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_option`
--

CREATE TABLE `payment_option` (
  `pay_id` int(11) NOT NULL,
  `pay_name` varchar(255) DEFAULT NULL,
  `pay_cdate` datetime DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_option`
--

INSERT INTO `payment_option` (`pay_id`, `pay_name`, `pay_cdate`, `status`) VALUES
(1, 'cash', '2017-12-22 00:00:00', 'active'),
(2, 'credit', '2017-12-22 00:00:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `product_desc` varchar(500) NOT NULL,
  `hsncode` varchar(15) DEFAULT '52051130',
  `category_id` int(11) DEFAULT NULL,
  `uom` varchar(25) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `tax_group_id` int(11) NOT NULL,
  `reordered_level` decimal(10,0) DEFAULT NULL,
  `discount_amount` decimal(10,0) DEFAULT NULL,
  `discount_per` decimal(10,0) DEFAULT NULL,
  `discount` varchar(10) DEFAULT NULL,
  `status` varchar(8) NOT NULL DEFAULT 'active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_desc`, `hsncode`, `category_id`, `uom`, `price`, `tax_group_id`, `reordered_level`, `discount_amount`, `discount_per`, `discount`, `status`) VALUES
(17, 'CHARCOAL COUNT 2/20\'S', '', '52051130', 0, 'Pocket', '1120', 3, '0', '0', '0', '0', 'active'),
(18, 'BLACK COUNT 10', '', '52051130', 0, 'Pocket', '1500', 3, '0', '0', '0', '0', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `product_stock`
--

CREATE TABLE `product_stock` (
  `stock_id` int(11) NOT NULL,
  `prod_id` int(11) DEFAULT NULL,
  `inv_no` int(11) DEFAULT NULL,
  `pur_no` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_stock`
--

INSERT INTO `product_stock` (`stock_id`, `prod_id`, `inv_no`, `pur_no`, `stock`, `created_at`) VALUES
(1, 16, 0, 0, 1000, '2018-01-30 16:50:58'),
(2, 15, 0, 0, 500, '2018-02-02 13:57:57'),
(3, 15, 0, 0, 500, '2018-02-02 13:58:36'),
(4, 15, 0, 0, 1001, '2018-02-02 14:00:25'),
(5, 15, 0, 0, 9, '2018-02-02 14:17:41');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `product_desc` varchar(500) DEFAULT NULL,
  `hsncode` varchar(15) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `uom` varchar(25) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `tax_group_id` int(11) NOT NULL,
  `reordered_level` decimal(10,0) DEFAULT NULL,
  `discount_amount` decimal(10,0) DEFAULT NULL,
  `discount_per` decimal(10,0) DEFAULT NULL,
  `discount` varchar(10) DEFAULT NULL,
  `status` varchar(8) NOT NULL DEFAULT 'active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_detail`
--

CREATE TABLE `purchase_detail` (
  `id` int(11) NOT NULL,
  `inv_id` int(11) NOT NULL,
  `inv_no` varchar(20) NOT NULL,
  `prod_id` int(11) DEFAULT NULL,
  `prod_desc` varchar(250) NOT NULL,
  `hsn_code` varchar(15) DEFAULT NULL,
  `qty` decimal(13,3) NOT NULL,
  `uom` varchar(50) NOT NULL DEFAULT 'unit',
  `price` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `taxable_value` decimal(10,2) NOT NULL,
  `cgst_rate` decimal(10,2) DEFAULT NULL,
  `cgst_amount` decimal(10,2) DEFAULT NULL,
  `sgst_rate` decimal(10,2) DEFAULT NULL,
  `sgst_amount` decimal(10,2) DEFAULT NULL,
  `igst_rate` decimal(10,2) DEFAULT NULL,
  `igst_amount` decimal(10,2) DEFAULT NULL,
  `tax_detail` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_master`
--

CREATE TABLE `purchase_master` (
  `inv_id` int(11) NOT NULL,
  `inv_no` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `cus_id` int(11) NOT NULL,
  `cus_ship_id` int(11) NOT NULL,
  `rcm` varchar(5) CHARACTER SET latin1 DEFAULT NULL,
  `transport_mode` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `vehicle_no` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `date_of_supply` datetime DEFAULT NULL,
  `inv_date` datetime DEFAULT NULL,
  `place_of_supply` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `inv_address` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `inv_shipping_address` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `total` decimal(12,2) DEFAULT NULL,
  `cgst` decimal(10,2) DEFAULT NULL,
  `sgst` decimal(10,2) DEFAULT NULL,
  `igst` decimal(10,2) DEFAULT NULL,
  `gst` decimal(10,2) DEFAULT NULL,
  `total_tax` decimal(10,2) DEFAULT NULL,
  `net_amount` decimal(10,2) DEFAULT NULL,
  `rcgst` decimal(10,2) DEFAULT NULL,
  `rsgst` decimal(10,2) DEFAULT NULL,
  `rigst` decimal(10,2) DEFAULT NULL,
  `rgst` decimal(10,2) DEFAULT NULL,
  `erf_no` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `bill_generator_name` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `auth_sign_name` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `auth_sign_designation` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `amount_in_words` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `payment_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=big5;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `pur_id` int(11) NOT NULL,
  `prod_id` int(11) DEFAULT NULL,
  `vendar_name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `statecode` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `name`, `statecode`) VALUES
(1, 'JAMMU AND KASHMIR', '01'),
(2, 'HIMACHAL PRADESH', '02'),
(3, 'PUNJAB', '03'),
(4, 'CHANDIGARH', '04'),
(5, 'UTTARAKHAND', '05'),
(6, 'HARYANA', '06'),
(7, 'DELHI', '07'),
(8, 'RAJASTHAN', '08'),
(9, 'UTTAR  PRADESH', '09'),
(10, 'BIHAR', '10'),
(11, 'SIKKIM', '11'),
(12, 'ARUNACHAL PRADESH', '12'),
(13, 'NAGALAND', '13'),
(14, 'MANIPUR', '14'),
(15, 'MIZORAM', '15'),
(16, 'TRIPURA', '16'),
(17, 'MEGHLAYA', '17'),
(18, 'ASSAM', '18'),
(19, 'WEST BENGAL', '19'),
(20, 'JHARKHAND', '20'),
(21, 'ODISHA', '21'),
(22, 'CHATTISGARH', '22'),
(23, 'MADHYA PRADESH', '23'),
(24, 'GUJARAT', '24'),
(25, 'DAMAN AND DIU', '25'),
(26, 'DADRA AND NAGAR HAVELI', '26'),
(27, 'MAHARASHTRA', '27'),
(28, 'ANDHRA PRADESH(BEFORE DIVISION)', '28'),
(29, 'KARNATAKA', '29'),
(30, 'GOA', '30'),
(31, 'LAKSHWADEEP', '31'),
(32, 'KERALA', '32'),
(33, 'TAMIL NADU', '33'),
(34, 'PUDUCHERRY', '34'),
(35, 'ANDAMAN AND NICOBAR ISLANDS', '35'),
(36, 'TELANGANA', '36'),
(37, 'ANDHRA PRADESH (NEW)', '37');

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE `tax` (
  `tax_id` int(11) NOT NULL,
  `tax_name` varchar(255) DEFAULT NULL,
  `tax_value` varchar(255) DEFAULT NULL,
  `tax_zone_id` int(11) DEFAULT NULL,
  `tax_cdate` datetime DEFAULT NULL,
  `status` varchar(8) NOT NULL DEFAULT 'active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tax`
--

INSERT INTO `tax` (`tax_id`, `tax_name`, `tax_value`, `tax_zone_id`, `tax_cdate`, `status`) VALUES
(4, 'SGST 2.5 %', '2.5', 1, '2017-11-21 01:44:35', 'active'),
(25, 'CGST 2.5%', '2.5', 1, '2017-11-21 02:00:37', 'active'),
(26, 'IGST 5', '5', 2, '2017-12-12 00:00:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tax_details`
--

CREATE TABLE `tax_details` (
  `det_id` int(11) NOT NULL,
  `tax_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `det_cdate` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tax_group`
--

CREATE TABLE `tax_group` (
  `tax_group_id` int(11) NOT NULL,
  `tax_groups_desc` varchar(255) DEFAULT NULL,
  `tax_id_groups` varchar(255) DEFAULT NULL,
  `tax_group_cdate` datetime DEFAULT NULL,
  `status` varchar(8) NOT NULL DEFAULT 'active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tax_group`
--

INSERT INTO `tax_group` (`tax_group_id`, `tax_groups_desc`, `tax_id_groups`, `tax_group_cdate`, `status`) VALUES
(1, 'GST 3%', '1,2,3', '2017-12-14 00:00:00', 'active'),
(3, 'GST 5%', '4,25,26', '2017-12-15 00:00:00', 'active'),
(7, 'GST 18%', '41,40,39', '2017-12-15 11:48:02', 'active'),
(8, 'GST 28%', '42,43,44', '2018-01-12 12:18:14', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tax_zone`
--

CREATE TABLE `tax_zone` (
  `zone_id` int(11) NOT NULL,
  `zone_desc` varchar(50) NOT NULL,
  `zone_codes` varchar(200) NOT NULL,
  `status` varchar(8) NOT NULL DEFAULT 'active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tax_zone`
--

INSERT INTO `tax_zone` (`zone_id`, `zone_desc`, `zone_codes`, `status`) VALUES
(1, 'TN', '33', 'active'),
(2, 'Rest(TN)', '01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,34,35,36,37', 'active'),
(3, 'All India', '01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `terms_and_condition`
--

CREATE TABLE `terms_and_condition` (
  `term_id` int(11) NOT NULL,
  `comp_id` int(11) DEFAULT NULL,
  `term_name` varchar(255) DEFAULT NULL,
  `terms_desc` varchar(1500) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `uom`
--

CREATE TABLE `uom` (
  `id` int(11) NOT NULL,
  `uom_desc` varchar(100) NOT NULL,
  `status` varchar(8) NOT NULL DEFAULT 'active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uom`
--

INSERT INTO `uom` (`id`, `uom_desc`, `status`) VALUES
(1, 'Bundle', 'active'),
(2, 'Kg', 'active'),
(3, 'Litre', 'active'),
(4, 'grm', 'active'),
(5, 'Piece', 'active'),
(6, 'Pocket', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `user_role_id` int(11) NOT NULL,
  `u_name` varchar(255) NOT NULL,
  `u_email` varchar(255) NOT NULL,
  `u_password` varchar(255) NOT NULL,
  `u_mobile` varchar(15) NOT NULL,
  `u_cdate` datetime NOT NULL,
  `u_udate` datetime NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `user_role_id`, `u_name`, `u_email`, `u_password`, `u_mobile`, `u_cdate`, `u_udate`, `status`) VALUES
(1, 1, 'Ayyappyan', 'sricolours1976sri@gmail.com', 'f66b4f61380104a7089320a22be8d75f', '9842086891', '2017-12-12 00:00:00', '2017-12-12 00:00:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `user_forms`
--

CREATE TABLE `user_forms` (
  `user_form_id` int(11) NOT NULL,
  `user_form_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `user_role_id` int(11) NOT NULL,
  `user_role_name` varchar(255) NOT NULL,
  `user_role_desc` varchar(255) NOT NULL,
  `user_role_cdate` datetime NOT NULL,
  `user_role_mdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_role_id`, `user_role_name`, `user_role_desc`, `user_role_cdate`, `user_role_mdate`) VALUES
(1, 'Adminstrator', 'Admin', '2017-12-12 00:00:00', '2017-12-12 00:00:00'),
(2, 'Employee', 'Employee', '2017-12-12 00:00:00', '2017-12-12 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_role_access`
--

CREATE TABLE `user_role_access` (
  `acc_id` int(11) NOT NULL,
  `user_role_id` int(11) NOT NULL,
  `user_form_id` int(11) NOT NULL,
  `c` int(11) NOT NULL,
  `r` int(11) NOT NULL,
  `u` int(11) NOT NULL,
  `d` int(11) NOT NULL,
  `acc_cdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role_access`
--

INSERT INTO `user_role_access` (`acc_id`, `user_role_id`, `user_form_id`, `c`, `r`, `u`, `d`, `acc_cdate`) VALUES
(1, 1, 0, 1, 1, 1, 1, '2017-12-12 00:00:00'),
(2, 2, 0, 0, 1, 0, 0, '2017-12-12 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_details`
--
ALTER TABLE `bank_details`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`comp_id`);

--
-- Indexes for table `company_branch`
--
ALTER TABLE `company_branch`
  ADD PRIMARY KEY (`bra_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `customer_branch`
--
ALTER TABLE `customer_branch`
  ADD PRIMARY KEY (`shi_id`);

--
-- Indexes for table `delivery_detail`
--
ALTER TABLE `delivery_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_master`
--
ALTER TABLE `delivery_master`
  ADD PRIMARY KEY (`dc_id`);

--
-- Indexes for table `invoice_detail`
--
ALTER TABLE `invoice_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_master`
--
ALTER TABLE `invoice_master`
  ADD PRIMARY KEY (`inv_id`);

--
-- Indexes for table `ledger`
--
ALTER TABLE `ledger`
  ADD PRIMARY KEY (`trans_id`);

--
-- Indexes for table `payment_option`
--
ALTER TABLE `payment_option`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_stock`
--
ALTER TABLE `product_stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `purchase_detail`
--
ALTER TABLE `purchase_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_master`
--
ALTER TABLE `purchase_master`
  ADD PRIMARY KEY (`inv_id`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`pur_id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax`
--
ALTER TABLE `tax`
  ADD PRIMARY KEY (`tax_id`);

--
-- Indexes for table `tax_details`
--
ALTER TABLE `tax_details`
  ADD PRIMARY KEY (`det_id`);

--
-- Indexes for table `tax_group`
--
ALTER TABLE `tax_group`
  ADD PRIMARY KEY (`tax_group_id`);

--
-- Indexes for table `tax_zone`
--
ALTER TABLE `tax_zone`
  ADD PRIMARY KEY (`zone_id`);

--
-- Indexes for table `terms_and_condition`
--
ALTER TABLE `terms_and_condition`
  ADD PRIMARY KEY (`term_id`);

--
-- Indexes for table `uom`
--
ALTER TABLE `uom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`user_role_id`);

--
-- Indexes for table `user_role_access`
--
ALTER TABLE `user_role_access`
  ADD PRIMARY KEY (`acc_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_details`
--
ALTER TABLE `bank_details`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `comp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `company_branch`
--
ALTER TABLE `company_branch`
  MODIFY `bra_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `customer_branch`
--
ALTER TABLE `customer_branch`
  MODIFY `shi_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `delivery_detail`
--
ALTER TABLE `delivery_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `delivery_master`
--
ALTER TABLE `delivery_master`
  MODIFY `dc_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoice_detail`
--
ALTER TABLE `invoice_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoice_master`
--
ALTER TABLE `invoice_master`
  MODIFY `inv_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ledger`
--
ALTER TABLE `ledger`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment_option`
--
ALTER TABLE `payment_option`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `product_stock`
--
ALTER TABLE `product_stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `purchase_detail`
--
ALTER TABLE `purchase_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `purchase_master`
--
ALTER TABLE `purchase_master`
  MODIFY `inv_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `pur_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
  MODIFY `tax_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `tax_details`
--
ALTER TABLE `tax_details`
  MODIFY `det_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tax_group`
--
ALTER TABLE `tax_group`
  MODIFY `tax_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tax_zone`
--
ALTER TABLE `tax_zone`
  MODIFY `zone_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `terms_and_condition`
--
ALTER TABLE `terms_and_condition`
  MODIFY `term_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `uom`
--
ALTER TABLE `uom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `user_role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_role_access`
--
ALTER TABLE `user_role_access`
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
