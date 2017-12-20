-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2017 at 07:57 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `design_club`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` int(11) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminUser` varchar(255) NOT NULL,
  `adminEmail` varchar(255) NOT NULL,
  `adminPass` varchar(32) NOT NULL,
  `level` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `adminName`, `adminUser`, `adminEmail`, `adminPass`, `level`) VALUES
(1, 'Asif Samy', 'admin', 'asifsamy@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartId` int(11) NOT NULL,
  `sId` varchar(255) NOT NULL,
  `catId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `s_size` int(11) NOT NULL DEFAULT '0',
  `m_size` int(11) NOT NULL DEFAULT '0',
  `l_size` int(11) NOT NULL DEFAULT '0',
  `image` varchar(255) NOT NULL,
  `pd_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `catId` int(11) NOT NULL,
  `catName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`catId`, `catName`) VALUES
(1, 'Hoody'),
(2, 'Half Sleeve Tshirt'),
(3, 'Full Sleeve Tshirt'),
(4, 'Mug'),
(5, 'Bag');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `body` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `subject`, `body`, `status`, `date`) VALUES
(1, 'Samy', 'asifsamy@gmail.com', 'Payment Query', 'Can I get product after payment', 1, '2017-11-24 18:31:48'),
(2, 'Sanjida', 'akter13sa@gmail.com', 'Security Purpose', 'With growing numbers of eCommerce and m-commerce transactions, there are new opportunities for cyber criminals. As a merchant, you need to ensure that you provide the best payment security and that your customers donâ€™t have to worry about their data. Are you sure payments on your website are processed in a secure way?', 0, '2017-11-24 22:51:11');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `fName` varchar(255) NOT NULL,
  `lName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(60) NOT NULL,
  `zip` varchar(30) NOT NULL,
  `country` varchar(60) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `code` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `fName`, `lName`, `email`, `pass`, `address`, `city`, `zip`, `country`, `phone`, `code`, `status`) VALUES
(11, 'Asif', 'Samy', 'akter13sa@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'Mirpur-10, Dhaka', 'Dhaka', '1000', 'Bangladesh', '01737887516', 'bdf4e58e217cda5cd742443e1d5034ac', 1),
(12, 'Sabit', 'Hossain', 'asifsamy@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'Aftabnagar, Dhaka', 'Dhaka', '1212', 'Bangladesh', '01737887516', '1885e40dbac77f5c8726730bb91fb5ff', 1),
(13, 'Momtaj', 'Rasel', 'momtazrasel8@gmail.com', 'e89028a83e8c0cfd45b54f3e96d52a16', 'Aftabnagar, Dhaka', 'Dhaka', '1212', 'Bangladesh', '01755240716', 'e3914d0cf876a1e8663273edc67e14c2', 2),
(14, 'Arif', 'Sany', 'alsany71@gmail.com', 'e89028a83e8c0cfd45b54f3e96d52a16', 'Aftabnagar, Dhaka', 'Dhaka', '1212', 'Bangladesh', '01717887516', '4fde36e36e6a9a648f0ef39fdc9c1f0d', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cus_order`
--

CREATE TABLE `cus_order` (
  `id` int(11) NOT NULL,
  `cmrId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `s_size` int(11) NOT NULL DEFAULT '0',
  `m_size` int(11) NOT NULL DEFAULT '0',
  `l_size` int(11) NOT NULL DEFAULT '0',
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `pd_type` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cus_order`
--

INSERT INTO `cus_order` (`id`, `cmrId`, `productId`, `productName`, `quantity`, `s_size`, `m_size`, `l_size`, `price`, `image`, `pd_type`, `date`, `status`) VALUES
(12, 12, 71, 'Customized Half-Sleeve T-Shirt', 7, 3, 2, 2, 350.00, 'uploads/0631ab5b80b76d49e9a0c75a607629fd.png', 0, '2017-11-26 16:45:08', 0),
(13, 14, 73, 'Customized Full-Sleeve T-Shirt', 8, 2, 2, 4, 450.00, 'uploads/acf57770d086ee6b298ca0b6ca829930.png', 0, '2017-11-26 22:32:41', 1),
(16, 14, 45, 'Customized Half-Sleeve T-Shirt', 6, 2, 2, 2, 350.00, 'uploads/bd2009b8e480f76293611f77210300ae.png', 1, '2017-11-27 00:37:45', 0),
(17, 12, 76, 'Customized Hoody', 6, 2, 2, 2, 550.00, 'uploads/a32c3dd89efd231ec0b4f554e24c40f0.png', 1, '2017-11-27 00:41:07', 1),
(18, 11, 76, 'Customized Hoody', 6, 2, 2, 2, 550.00, 'uploads/a32c3dd89efd231ec0b4f554e24c40f0.png', 1, '2017-11-27 00:45:09', 0);

-- --------------------------------------------------------

--
-- Table structure for table `others_product`
--

CREATE TABLE `others_product` (
  `product_address` varchar(660) NOT NULL,
  `product_image` varchar(660) NOT NULL,
  `product_name` varchar(660) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_catagory` varchar(660) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pd_sold`
--

CREATE TABLE `pd_sold` (
  `soldId` int(11) NOT NULL,
  `oId` int(11) NOT NULL,
  `cmrId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float(10,2) NOT NULL,
  `pd_type` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pd_sold`
--

INSERT INTO `pd_sold` (`soldId`, `oId`, `cmrId`, `productId`, `productName`, `quantity`, `price`, `pd_type`, `date`) VALUES
(3, 27, 2, 2, 'Red Half Sleeve', 1, 380.00, 0, '2017-10-30 19:56:52'),
(4, 28, 2, 4, 'Desined Bag', 3, 240.00, 0, '2017-10-30 19:58:29'),
(5, 31, 1, 4, 'Desined Bag', 1, 80.00, 0, '2017-10-30 19:59:21'),
(6, 29, 2, 3, 'White Designed', 2, 440.00, 0, '2017-10-31 09:44:10'),
(7, 1, 2, 2, 'Red Half Sleeve', 4, 1520.00, 0, '2017-10-31 12:57:37'),
(8, 5, 2, 40, 'Customized Half-Sleeve T-Shirt', 5, 1750.00, 1, '2017-11-01 13:18:03'),
(9, 4, 2, 36, 'Customized Half-Sleeve T-Shirt', 5, 1750.00, 1, '2017-11-01 13:18:15'),
(10, 5, 2, 27, 'Customized Half-Sleeve T-Shirt', 6, 2100.00, 1, '2017-11-03 12:21:31'),
(11, 8, 1, 3, 'White Designed', 1, 220.00, 0, '2017-11-03 13:01:18'),
(12, 7, 1, 33, 'Customized Half-Sleeve T-Shirt', 7, 2450.00, 0, '2017-11-03 13:01:20'),
(13, 6, 2, 29, 'Customized Half-Sleeve T-Shirt', 5, 1750.00, 1, '2017-11-03 14:23:47'),
(14, 9, 2, 4, 'Desined Bag', 2, 160.00, 0, '2017-11-03 14:26:53'),
(15, 10, 2, 2, 'Red Half Sleeve', 3, 1140.00, 0, '2017-11-03 15:48:09'),
(16, 11, 2, 2, 'Red Half Sleeve', 1, 380.00, 0, '2017-11-03 15:48:46'),
(17, 12, 2, 3, 'White Designed', 1, 220.00, 0, '2017-11-03 15:49:36'),
(18, 1, 1, 37, 'Customized Half-Sleeve T-Shirt', 10, 3500.00, 0, '2017-11-04 11:34:07'),
(19, 2, 1, 39, 'Customized Half-Sleeve T-Shirt', 5, 1750.00, 0, '2017-11-04 13:17:49'),
(20, 3, 1, 41, 'Customized Half-Sleeve T-Shirt', 6, 2100.00, 0, '2017-11-04 13:17:55'),
(21, 4, 2, 43, 'Customized Half-Sleeve T-Shirt', 5, 1750.00, 0, '2017-11-04 13:18:10'),
(22, 5, 1, 45, 'Customized Half-Sleeve T-Shirt', 10, 3500.00, 0, '2017-11-04 13:31:32'),
(23, 1, 1, 3, 'White Designed', 2, 440.00, 0, '2017-11-07 12:31:32'),
(25, 4, 3, 49, 'Customized Half-Sleeve T-Shirt', 8, 2800.00, 0, '2017-11-07 14:02:53'),
(26, 7, 3, 47, 'Customized Full-Sleeve T-Shirt', 5, 2250.00, 0, '2017-11-08 13:41:55'),
(27, 5, 3, 51, 'Customized Half-Sleeve T-Shirt', 5, 1750.00, 0, '2017-11-23 20:42:42'),
(28, 6, 3, 4, 'Desined Bag', 1, 80.00, 0, '2017-11-23 20:42:44'),
(29, 3, 3, 3, 'White Designed', 2, 440.00, 0, '2017-11-23 20:42:45'),
(30, 7, 2, 51, 'Customized Half-Sleeve T-Shirt', 100, 35000.00, 0, '2017-11-23 20:42:46'),
(31, 9, 11, 45, 'Customized Half-Sleeve T-Shirt', 1, 350.00, 1, '2017-11-24 19:19:06'),
(32, 11, 12, 65, 'Customized Full-Sleeve T-Shirt', 6, 2700.00, 0, '2017-11-26 14:16:14'),
(33, 8, 11, 47, 'Customized Full-Sleeve T-Shirt', 1, 450.00, 1, '2017-11-26 14:16:36'),
(34, 10, 12, 54, 'Customized Full-Sleeve T-Shirt', 6, 2700.00, 0, '2017-11-26 16:40:49'),
(35, 14, 14, 76, 'Customized Hoody', 9, 4950.00, 0, '2017-11-26 23:42:17'),
(36, 19, 14, 78, 'Customized Half-Sleeve T-Shirt', 6, 2100.00, 0, '2017-11-30 22:15:04');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `catId` int(11) NOT NULL,
  `body` text NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `pd_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `productName`, `catId`, `body`, `price`, `image`, `pd_type`) VALUES
(1, 'Pink Half Cool', 2, '<p>It\'s a half sleeve Tshirt with cool look and comfort fabric.</p>', 480.00, 'uploads/5d8513cc4f.png', 0),
(2, 'Red Half Sleeve', 2, '<p>It\'s a half sleeve Tshirt with cool look and comfort fabric. There is a logo of FC Byern Muchen.</p>', 380.00, 'uploads/9b51cba04a.jpg', 0),
(3, 'White Designed', 4, '<p>A white Designed Mug with.</p>', 220.00, 'uploads/8bb3286d79.png', 0),
(4, 'Desined Bag', 5, '<p>A designed Bag</p>', 80.00, 'uploads/67137f435b.jpg', 0),
(27, 'Customized Half-Sleeve T-Shirt', 2, 'High quality cut &amp; sew Designer Half Tshirt direct from the manufacturers. 100% Pure combed 155 - 160 GSM Cotton used. Gives you perfect fit, comfort feel and handsome look. Trusted brand online and no compromise on quality. Standard Indian size : S-36 , M-38 , L-40 , XL-42', 350.00, 'uploads/ae73425885dd1a413b0e8b45a87615d4.png', 1),
(33, 'Customized Half-Sleeve T-Shirt', 2, 'High quality cut &amp; sew Designer Half Tshirt direct from the manufacturers. 100% Pure combed 155 - 160 GSM Cotton used. Gives you perfect fit, comfort feel and handsome look. Trusted brand online and no compromise on quality. Standard Indian size : S-36 , M-38 , L-40 , XL-42', 350.00, 'uploads/ff0f07c209c2ec143e42ab3511c0d151.png', 1),
(41, 'Customized Half-Sleeve T-Shirt', 2, 'High quality cut &amp; sew Designer Half Tshirt direct from the manufacturers. 100% Pure combed 155 - 160 GSM Cotton used. Gives you perfect fit, comfort feel and handsome look. Trusted brand online and no compromise on quality. Standard Indian size : S-36 , M-38 , L-40 , XL-42', 350.00, 'uploads/c267f28ce4cdfb9ff72536953b505934.png', 1),
(43, 'Customized Half-Sleeve T-Shirt', 2, 'High quality cut &amp; sew Designer Half Tshirt direct from the manufacturers. 100% Pure combed 155 - 160 GSM Cotton used. Gives you perfect fit, comfort feel and handsome look. Trusted brand online and no compromise on quality. Standard Indian size : S-36 , M-38 , L-40 , XL-42', 350.00, 'uploads/592562716ae88f3fc68d800ca9fb64b2.png', 1),
(45, 'Customized Half-Sleeve T-Shirt', 2, '<p>High quality cut &amp; sew Designer Half Tshirt direct from the manufacturers. 100% Pure combed 155 - 160 GSM Cotton used. Gives you perfect fit, comfort feel and handsome look. Trusted brand online and no compromise on quality. Standard Indian size : S-36 , M-38 , L-40 , XL-42</p>', 350.00, 'uploads/bd2009b8e480f76293611f77210300ae.png', 1),
(47, 'Customized Full-Sleeve T-Shirt', 3, 'High quality cut &amp; sew Designer Half Tshirt direct from the manufacturers. 100% Pure combed 155 - 160 GSM Cotton used. Gives you perfect fit, comfort feel and handsome look. Trusted brand online and no compromise on quality. Standard Bangladeshi size : S-36 , M-38 , L-40 , XL-42', 450.00, 'uploads/3187a16c7bf30832e0a1038d441966ee.png', 1),
(49, 'Customized Half-Sleeve T-Shirt', 2, 'High quality cut &amp; sew Designer Half Tshirt direct from the manufacturers. 100% Pure combed 155 - 160 GSM Cotton used. Gives you perfect fit, comfort feel and handsome look. Trusted brand online and no compromise on quality. Standard Indian size : S-36 , M-38 , L-40 , XL-42', 350.00, 'uploads/76074e77d85751a748236194dad6cf34.png', 1),
(51, 'Customized Half-Sleeve T-Shirt', 2, 'High quality cut &amp; sew Designer Half Tshirt direct from the manufacturers. 100% Pure combed 155 - 160 GSM Cotton used. Gives you perfect fit, comfort feel and handsome look. Trusted brand online and no compromise on quality. Standard Indian size : S-36 , M-38 , L-40 , XL-42', 350.00, 'uploads/79ddaa7f6cd790716e9dbd79828aa4e6.png', 1),
(53, 'Customized Full-Sleeve T-Shirt', 3, 'High quality cut &amp; sew Designer Half Tshirt direct from the manufacturers. 100% Pure combed 155 - 160 GSM Cotton used. Gives you perfect fit, comfort feel and handsome look. Trusted brand online and no compromise on quality. Standard Bangladeshi size : S-36 , M-38 , L-40 , XL-42', 450.00, 'uploads/d647a751d3a04eb075a4eb8cbc9021bf.png', 1),
(62, 'Customized Half-Sleeve T-Shirt', 2, 'High quality cut &amp; sew Designer Half Tshirt direct from the manufacturers. 100% Pure combed 155 - 160 GSM Cotton used. Gives you perfect fit, comfort feel and handsome look. Trusted brand online and no compromise on quality. Standard Indian size : S-36 , M-38 , L-40 , XL-42', 350.00, 'uploads/3a4b6c2b58b13fbd75c0685435e8ef70.png', 1),
(63, 'Customized Half-Sleeve T-Shirt', 2, 'High quality cut &amp; sew Designer Half Tshirt direct from the manufacturers. 100% Pure combed 155 - 160 GSM Cotton used. Gives you perfect fit, comfort feel and handsome look. Trusted brand online and no compromise on quality. Standard Indian size : S-36 , M-38 , L-40 , XL-42', 350.00, 'uploads/04f28ebfee3e5d03aacb96884bbe5190.png', 1),
(64, 'Customized Full-Sleeve T-Shirt', 3, 'High quality cut &amp; sew Designer Half Tshirt direct from the manufacturers. 100% Pure combed 155 - 160 GSM Cotton used. Gives you perfect fit, comfort feel and handsome look. Trusted brand online and no compromise on quality. Standard Bangladeshi size : S-36 , M-38 , L-40 , XL-42', 450.00, 'uploads/af49ec8c0ccb3b5b97a5a61116883ebd.png', 1),
(65, 'Customized Full-Sleeve T-Shirt', 3, 'High quality cut &amp; sew Designer Half Tshirt direct from the manufacturers. 100% Pure combed 155 - 160 GSM Cotton used. Gives you perfect fit, comfort feel and handsome look. Trusted brand online and no compromise on quality. Standard Bangladeshi size : S-36 , M-38 , L-40 , XL-42', 450.00, 'uploads/d29507947591fe116c5ec221cf1ad359.png', 1),
(70, 'Customized Half-Sleeve T-Shirt', 2, 'High quality cut &amp; sew Designer Half Tshirt direct from the manufacturers. 100% Pure combed 155 - 160 GSM Cotton used. Gives you perfect fit, comfort feel and handsome look. Trusted brand online and no compromise on quality. Standard Indian size : S-36 , M-38 , L-40 , XL-42', 350.00, 'uploads/043a533712da5d9e81752eb6a7691730.png', 1),
(71, 'Customized Half-Sleeve T-Shirt', 2, 'High quality cut &amp; sew Designer Half Tshirt direct from the manufacturers. 100% Pure combed 155 - 160 GSM Cotton used. Gives you perfect fit, comfort feel and handsome look. Trusted brand online and no compromise on quality. Standard Indian size : S-36 , M-38 , L-40 , XL-42', 350.00, 'uploads/0631ab5b80b76d49e9a0c75a607629fd.png', 1),
(72, 'Customized Full-Sleeve T-Shirt', 3, 'High quality cut &amp; sew Designer Half Tshirt direct from the manufacturers. 100% Pure combed 155 - 160 GSM Cotton used. Gives you perfect fit, comfort feel and handsome look. Trusted brand online and no compromise on quality. Standard Bangladeshi size : S-36 , M-38 , L-40 , XL-42', 450.00, 'uploads/4b7702cd98ad67b08e4a7909bd6e81ab.png', 1),
(75, 'Customized Half-Sleeve T-Shirt', 2, 'High quality cut &amp; sew Designer Half Tshirt direct from the manufacturers. 100% Pure combed 155 - 160 GSM Cotton used. Gives you perfect fit, comfort feel and handsome look. Trusted brand online and no compromise on quality. Standard Indian size : S-36 , M-38 , L-40 , XL-42', 350.00, 'uploads/05888fed3833f903dd207998730697cc.png', 1),
(76, 'Customized Hoody', 1, 'High quality cut &amp; sew Designer Half Tshirt direct from the manufacturers. 100% Pure combed 155 - 160 GSM Cotton used. Gives you perfect fit, comfort feel and handsome look. Trusted brand online and no compromise on quality. Standard Bangladeshi size : S-36 , M-38 , L-40 , XL-42', 550.00, 'uploads/a32c3dd89efd231ec0b4f554e24c40f0.png', 1),
(77, 'Customized Half-Sleeve T-Shirt', 2, 'High quality cut &amp; sew Designer Half Tshirt direct from the manufacturers. 100% Pure combed 155 - 160 GSM Cotton used. Gives you perfect fit, comfort feel and handsome look. Trusted brand online and no compromise on quality. Standard Indian size : S-36 , M-38 , L-40 , XL-42', 350.00, 'uploads/3352624ad70457ebe421ec7c63ba503b.png', 1),
(78, 'Customized Half-Sleeve T-Shirt', 2, 'High quality cut &amp; sew Designer Half Tshirt direct from the manufacturers. 100% Pure combed 155 - 160 GSM Cotton used. Gives you perfect fit, comfort feel and handsome look. Trusted brand online and no compromise on quality. Standard Indian size : S-36 , M-38 , L-40 , XL-42', 350.00, 'uploads/cfe3a05568087144da9902778d1f85a2.png', 1),
(79, 'Customized Half-Sleeve T-Shirt', 2, 'High quality cut &amp; sew Designer Half Tshirt direct from the manufacturers. 100% Pure combed 155 - 160 GSM Cotton used. Gives you perfect fit, comfort feel and handsome look. Trusted brand online and no compromise on quality. Standard Indian size : S-36 , M-38 , L-40 , XL-42', 350.00, 'uploads/0f4e06d2e836e93a732f3e2d111dc6d2.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_req`
--

CREATE TABLE `product_req` (
  `PID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `url` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_req`
--

INSERT INTO `product_req` (`PID`, `name`, `email`, `url`) VALUES
(1, 'khmbnm', 'bnmbnm', 'bj');

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `date` date NOT NULL,
  `ip` text NOT NULL,
  `views` int(11) NOT NULL DEFAULT '1',
  `cnt_views` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`date`, `ip`, `views`, `cnt_views`) VALUES
('2017-11-25', '::1', 5, 8),
('2017-11-26', '::1', 1, 73),
('2017-11-28', '::1', 1, 11),
('2017-11-30', '::1', 1, 13),
('2017-12-01', '::1', 1, 7),
('2017-12-02', '::1', 1, 26),
('2017-12-03', '::1', 1, 17),
('2017-12-04', '::1', 1, 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`catId`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cus_order`
--
ALTER TABLE `cus_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pd_sold`
--
ALTER TABLE `pd_sold`
  ADD PRIMARY KEY (`soldId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `product_req`
--
ALTER TABLE `product_req`
  ADD PRIMARY KEY (`PID`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`date`),
  ADD UNIQUE KEY `date` (`date`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `cus_order`
--
ALTER TABLE `cus_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pd_sold`
--
ALTER TABLE `pd_sold`
  MODIFY `soldId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `product_req`
--
ALTER TABLE `product_req`
  MODIFY `PID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
