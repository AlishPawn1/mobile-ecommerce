-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2024 at 04:44 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mobile`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminId` int(11) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminUser` varchar(255) NOT NULL,
  `adminEmail` varchar(255) NOT NULL,
  `adminPassword` varchar(32) NOT NULL,
  `level` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminId`, `adminName`, `adminUser`, `adminEmail`, `adminPassword`, `level`) VALUES
(1, 'Samita KC', 'nayem', 'nayemhowlader77@gmail.com', '850721dea834fe36b29083291509c7ad', 0),
(2, 'Samita Khatri', 'samita', 'samita123@gmail.com', 'samita', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brandId` int(11) NOT NULL,
  `brandName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brandId`, `brandName`) VALUES
(2, 'SAMSUNG'),
(3, 'ONE PLUS'),
(4, 'IPHONE'),
(5, 'REDMI'),
(6, 'OPPO');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cartId` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `sId` varchar(255) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `catId` int(11) NOT NULL,
  `catName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`catId`, `catName`) VALUES
(13, 'Mobile Phone');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_compare`
--

CREATE TABLE `tbl_compare` (
  `id` int(11) NOT NULL,
  `cmrId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact`
--

CREATE TABLE `tbl_contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_contact`
--

INSERT INTO `tbl_contact` (`id`, `name`, `email`, `contact`, `message`, `status`, `date`) VALUES
(3, 'sssss', 'samita123@gmail.com', '9876543210', 'sdfyguhijokpl', 1, '2024-11-20 11:07:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `zip` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `is_verified` tinyint(1) DEFAULT 0,
  `verification_code` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(11) NOT NULL,
  `cmrId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `catId` int(11) NOT NULL,
  `brandId` int(11) NOT NULL,
  `body` text NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`productId`, `productName`, `catId`, `brandId`, `body`, `price`, `image`, `type`) VALUES
(11, 'Apple iPhone X 64GB', 3, 4, '<p>iPhone Display Size: 5.8 inches,Display Resolution: 1125 x 2436 pixels</p>\r\n<p>Rear Camera: Dual 12 MP</p>\r\n<p>Front Camera: 7 MP</p>\r\n<p>Video Quality : 4K video recording at 24 fps, 30 fps, or 60 fps</p>\r\n<p>Face ID: Enabled by TrueDepth camera for facial recognition<br />Splash, Water, and Dust Resistant: Rated IP67 under IEC standard 60529<br />Battery Capacity: Up to 21h (3G) talk time; Up to 60 h music play<br />Phone Sensors: Face ID, accelerometer, gyro, proximity, compass, barometer<br />Apple iPhone X Smartphone: Design &amp; Display</p>', 99990.00, 'uploads/9588c6f782.jpg', 1),
(16, 'iPhone X - Smartphone', 3, 4, '<p>5.8 inchi old multi touched display.Hexa-core 2.39ghz processor.</p>\r\n<p>3GB RAM And 256GB ROM</p>\r\n<p>12MP Dual Rear and 7MP front camera</p>\r\n<p>Nano Sim</p>', 120500.00, 'uploads/ac7385aa6d.jpeg', 1),
(17, ' iPhone 6 - Smartphone', 3, 4, '<p>Apple iPhone 6 comes with 1GB of RAM. The phone packs 16GB of internal storage that cannot be expanded. As far as the cameras are concerned, the Apple iPhone 6 packs a 8-megapixel primary camera on the rear and a 1.2-megapixel front shooter for selfies. The Apple iPhone 6 is powered by a 1810mAh non removable battery.</p>', 34999.00, 'uploads/dd277d68bd.jpg', 1),
(18, 'iPhone 8 Plus', 3, 4, '<p>iPhone XR comes with new chip<br />64GB and 256GB storage options on all models<br />128GB on XR only <br />Battery improvements on iPhone XR<br />The Apple iPhone 8 and 8 Plus both come with the A11 Bionic chip with 64-bit architecture, a neural engine and embedded M11 motion coprocessor. They also both come in 64GB and 256GB storage capacities, neither of which offer microSD support.</p>', 109999.00, 'uploads/33ce6b99f4.jpg', 1),
(22, 'REDMI', 3, 5, '<p>Xiaomi Red 12 polar silver</p>', 85000.00, 'uploads/7f3b219d09.jpg', 0),
(23, 'One Plus', 3, 3, '<p>One plus - 10 pro</p>', 100000.00, 'uploads/87c28c06a3.png', 0),
(24, 'Iphone 15 Pro Max', 13, 4, '<p><span style=\"font-family: \'times new roman\', times; font-size: medium;\">Black Titanium</span></p>\r\n<div>\r\n<div class=\"binkies-color-swatch selected\" style=\"box-sizing: border-box; margin: 0px; padding: 0.5em 0.5em 0.5em 4px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-variant-alternates: inherit; font-variant-position: inherit; font-variant-emoji: inherit; font-stretch: inherit; font-size: 16px; line-height: inherit; font-family: Google-Oswald; font-optical-sizing: inherit; font-size-adjust: inherit; font-kerning: inherit; font-feature-settings: inherit; font-variation-settings: inherit; vertical-align: baseline; color: #616161; cursor: pointer; display: inline-flex; align-items: center; height: 2em; background-color: #eeeeee;\" data-binkies-content-id=\"apple-iphone-15-pro-max-black-titanium\">&nbsp;</div>\r\n</div>', 200000.00, 'uploads/2a54e332ce.jpg', 0),
(25, 'Iphone16 Pro Max', 13, 4, '<p><span style=\"font-family: \'times new roman\', times; font-size: medium;\">iPhone 16 Pro Max is the highest offering from Apple for the year 2024. This phone brings incremental upgrades over the last year&rsquo;s offering. The screen has grown larger reaching 6.9-inches. However, the rest of the display tech is the same. Similarly, it has the new A18 Pro chipset with increased performance capability. It bakes Apple Intelligence into the system, offering wide usability. The iPhone 16 Pro is available in three storage options starting from 256GB and going all the way up to 1TB. It has a triple camera setup including 48MP Fusion, 48MP Ultrawide, and 12MP 5X Telephoto. The front camera is also a 12MP unit. One of the key highlights of this phone is the new Camera Control button offering digital camera-like controls.</span></p>', 232000.00, 'uploads/200d429ada.jpg', 0),
(26, 'S9+', 13, 2, '<ul>\r\n<li><strong>Display</strong>: 5.8 inches&nbsp;<a href=\"https://www.gadgetbytenepal.com/smartphones-screen-technology/\" rel=\"noopener\" target=\"_blank\">Super AMOLED</a>&nbsp;with Gorilla glass 5 (front and back) protection</li>\r\n<li><strong>Resolution</strong>: 1440 x 2960 pixels, 18.5:9 aspect ratio @ 570PPI pixel density</li>\r\n<li><strong>OS</strong>:&nbsp;<a href=\"https://www.gadgetbytenepal.com/android-8-oreo-features-official/\" rel=\"noopener\" target=\"_blank\">Android Oreo</a>&nbsp;with Experience 9 UI on the top</li>\r\n<li><strong>Chipset</strong>:&nbsp;<a href=\"https://www.gadgetbytenepal.com/qualcomm-snapdragon-845-goes-official/\" rel=\"noopener\" target=\"_blank\">Snapdragon 845</a>&nbsp;/ Exynos 9810</li>\r\n<li><strong>RAM</strong>: 4GB</li>\r\n<li><strong>Storage</strong>: 64/128/256GB internal storage, Expandable up to 256GB (Uses SIM2 slot)</li>\r\n<li><strong>Rear Camera</strong>: 12MP, f/1.5 &ndash; f/2.4, 26mm focal length, 1/2.5&Prime; sensor size, 1.4 &micro;m pixel size, Dual Pixel PDAF, OIS, LED flash</li>\r\n<li><strong>Front Camera</strong>: 8 MP, f/1.7</li>\r\n<li><strong>Connectivity</strong>: Wi-Fi a/b/g/n/ac,&nbsp;<a href=\"https://www.gadgetbytenepal.com/bluetooth-5-launched/\" rel=\"noopener\" target=\"_blank\">Bluetooth 5.0</a>, A-GPS, 3G, 4G LTE, USB Type C 3.1 reversible connector</li>\r\n<li><strong>Sensors</strong>: Iris scanner, fingerprint (rear-mounted), accelerometer, gyro, proximity, compass, barometer, heart rate, SpO2</li>\r\n<li><strong>Battery:</strong>&nbsp;3000mAh non-removable battery</li>\r\n<li><strong>Other Features</strong>: AKG tuned stereo speakers, Intelligent Scan, Samsung DeX, AR Emojis, 3.5mm Headphone Jack, IP68 Certified (Water and Dust resistant), Fast Charging (QC 2.0), Wireless Fast charging, Super Slo-mo HD video recording up to 960fps &amp; 1080P video recording up to 240fps</li>\r\n<li><strong>Color Variants</strong>: Midnight Black, Titanium Gray, Lilac Purple, Coral Blue</li>\r\n<li><strong>Price</strong>: Rs. 87,900 (4GB/64GB)&nbsp;</li>\r\n</ul>', 87900.00, 'uploads/1945102326.png', 1),
(27, 'One Plus', 13, 3, '<h1 class=\"indIKd q23Yce fA1vYb cS4Vcb-pGL6qe-fwJd0c\"><span style=\"font-family: \'times new roman\', times; font-size: medium;\">OnePlus 12,12GB RAM+256GB,Dual-SIM,Unlocked Android Smartphone,Supports Fastest 50W</span></h1>', 50000.00, 'uploads/459c6a0ce1.jpg', 0),
(28, 'Iphone', 13, 4, '<p>Iphone</p>', 1234567.00, 'uploads/e6578f1069.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wlist`
--

CREATE TABLE `tbl_wlist` (
  `id` int(11) NOT NULL,
  `cmrId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brandId`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cartId`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`catId`);

--
-- Indexes for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `tbl_wlist`
--
ALTER TABLE `tbl_wlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brandId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_wlist`
--
ALTER TABLE `tbl_wlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
