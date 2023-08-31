-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 27, 2023 at 04:04 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminid` int NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminEmail` varchar(150) NOT NULL,
  `adminUser` varchar(255) NOT NULL,
  `adminPass` varchar(255) NOT NULL,
  `level` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminid`, `adminName`, `adminEmail`, `adminUser`, `adminPass`, `level`) VALUES
(1, 'Khoa', 'Khoa@gmail.com', 'khoa-admin', 'e10adc3949ba59abbe56e057f20f883e', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brandId` int UNSIGNED NOT NULL,
  `brandName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brandId`, `brandName`) VALUES
(1, 'Razer'),
(2, 'Akko'),
(3, 'JBL'),
(4, 'Dareu'),
(5, 'Sony'),
(6, 'Cosair'),
(7, 'Logitech');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cartId` int NOT NULL,
  `productId` int UNSIGNED NOT NULL,
  `sId` varchar(255) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` varchar(200) NOT NULL,
  `quantity` int NOT NULL,
  `image` varchar(200) NOT NULL,
  `stock` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `catId` int UNSIGNED NOT NULL,
  `catName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`catId`, `catName`) VALUES
(9, 'Bàn phím cơ'),
(10, 'Chuột không dây'),
(11, 'Chuột có dây'),
(12, 'Tai nghe'),
(13, 'Loa không dây'),
(14, 'Loa có dây');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cmt`
--

CREATE TABLE `tbl_cmt` (
  `cmt_id` int NOT NULL,
  `tenbinhluan` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `binhluan` text COLLATE utf8mb4_general_ci NOT NULL,
  `productId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `cccd` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `zipcode` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `name`, `address`, `cccd`, `country`, `zipcode`, `phone`, `email`, `password`) VALUES
(13, 'Khoa', '242/31/2 Bà Hom P13 Q6', '000111222', 'HCM', '700000', '00008888', 'Khoa@gmail.com', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int NOT NULL,
  `productId` int UNSIGNED NOT NULL,
  `order_code` varchar(20) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `customer_id` int UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `date_order` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_placed`
--

CREATE TABLE `tbl_placed` (
  `id_placed` int NOT NULL,
  `order_code` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  `customer_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `productId` int UNSIGNED NOT NULL,
  `productName` tinytext NOT NULL,
  `product_quantity` int NOT NULL,
  `catId` int UNSIGNED NOT NULL,
  `brandId` int UNSIGNED NOT NULL,
  `product_desc` text NOT NULL,
  `type` int NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`productId`, `productName`, `product_quantity`, `catId`, `brandId`, `product_desc`, `type`, `price`, `image`) VALUES
(7, 'Bàn phím cơ G512 GX RGB G512 GX RGB', 12, 9, 7, '<p><span>G512 GX được thiết kế hướng đến hiệu suất và tích hợp công nghệ chơi game mạnh mẽ. Từ các chi tiết tinh tế nhất như kết cấu mờ phủ vân tay và dây cáp có độ bền cao, tới chi tiết phức tạp nhất, mỗi khía cạnh được thiết kế chính xác bởi công nghệ dẫn đầu ngành của Logitech G cùng chất lượng vào kiểu dáng được chế tạo độc đáo.</span></p>', 1, '2190000', '29cbc81fb1.webp'),
(8, 'Bàn phím không dây Logitech POP Keys Blast Yelow', 15, 9, 7, '<p><span>BPOP Keys Blast Yellow là một sản phẩm bàn phím không dây mới. Bạn sẽ thoải mái thể hiện cá tính trên bàn làm việc với POP Keys, tự tin khoe cá tính với kiểu bàn làm việc đầy phong cách và các phím emoji vui nhộn có thể tùy chỉnh. Logitech POP Keys sở hữu thiết kế màu bạc hà, tím tử đinh hương, trắng và vàng kết hợp đầy tính thẩm mỹ, ngọt ngào gợi ra một chút mojito tươi mát.</span></p>', 1, '2490000', '481496cf8f.webp'),
(9, 'Bàn phím Logitech G PRO KDA', 10, 9, 7, '<p><span>Thiết kế không có bàn phím số lấy cảm hứng từ chuyên gia,Các phím switch cơ Tactile GX Brown,Chiếu sáng LIGHTSYNC RGB,Cấu hình chiếu sáng tích hợp, Dây 1,8 m có thể tháo rời được, 12 phím F có thể lập trình, Tốc độ báo cáo 1 ms.</span></p>', 0, '4390000', '0e588379ed.webp'),
(11, 'Bàn phím Razer Blackwidow Green Switch', 23, 9, 1, '<p><span>Razer BlackWidow V3 - Green Switch - Quartz là một trong những phiên bản bàn phím máy tính màu hồng cá tính, được thiết kế để chơi game và đã được tối ưu hóa để mang lại hiệu suất và độ bền cấp chuyên nghiệp. </span></p>', 1, '2890000', '25f00b2cb7.webp'),
(12, 'Bàn phím Razer Ornata Expert Pikachu Limited Edition', 12, 9, 1, '<p><span>Bàn phím giả cơ Razer Ornata Expert Pikachu Limited Edition với các phím có đèn nền riêng lẻ, ánh sáng màu vàng năng động của bàn phím có thể được tùy chỉnh thông qua Razer Synapse, trong khi Công tắc Màng cơ học Razer ™ của nó mang lại trải nghiệm đánh máy hài lòng, kết hợp cảm giác mềm mại, êm ái của các phím màng cao su với tiếng nhấp xúc giác rõ ràng của công tắc cơ.</span></p>', 0, '2990000', '9b76448c0e.webp'),
(13, 'Chuột Razer Deathadder Essential', 5, 11, 1, '<p><span>Thiết kế công thái học, thoải mái khi cầm, Cảm biến quang học với độ phân giải 6400 DPI, 5 nút bấm, tuổi thọ 10 triệu lần nhấp, Hỗ trợ phần mềm điều khiển Razer Synapse 3 (Beta)</span></p>', 1, '590000', 'fa108976b9.webp'),
(14, 'Chuột Logitech G203 LightSync Lila', 15, 10, 7, '<p><span>Chuột Gaming có dây Logitech G203 Màu Tím Lilac (910-005853) được thiết kế dạng đối xứng nên người dùng có thể sử dụng bằng tay phải hoặc tay trái rất tiện lợi. Bạn có thể chỉnh mức thiết lập DPI, từ siêu chính xác ở 200 DPI hoặc cực nhanh ở 6.000 DPI cho bạn những cú click chuột cực kỳ ấn tượng.</span></p>', 0, '400000', '06d97c1ec2.webp'),
(15, 'Chuột Logitech G Pro Wireless League Of Legends', 13, 11, 7, '<p><span>Logitech G Pro Wireless là một trong những dòng chuột máy tính chơi game sở hữu trọng lượng vô cùng nhẹ, điều này giúp cho người chơi có những pha xử lý nhanh chóng, chính xác chiếm ưu thế trong mọi tựa game. Đặc biệt, với phối màu League Of Legends độc đáo, đây sẽ là dòng chuột gaming bạn không nên bỏ qua.</span></p>', 0, '165000', '911bca0acb.webp'),
(17, 'Tai Nghe Sony MDR - ZX110AP', 7, 12, 5, '<p><span>Tai nghe Sony MDR-ZX110AP kể từ khi ra mắt đã thu hút được rất nhiều sự quan tâm tới từ người dùng bởi những gì tuyệt vời mà chiếc tai nghe này mang lại, từ thiết kế sang trọng cho tới chất âm cực đỉnh. </span></p>', 0, '540000', 'a837453850.webp'),
(18, 'Tai nghe DAREU EH469 7.1 RGB PINK	', 8, 12, 4, '<p><span>DareU EH469 là chiếc tai nghe gaming mà chúng tôi cho rằng, ở phân khúc giá 500k không có đối thủ về thiết kế. Phần chụp tai với kích thước lớn hình Oval chụp kín tai, phần ệm đầu có thể co dãn cho cảm giác đeo rất thoải mái. Gọng của tai nghe được làm bằng thép cho độ chắc chắn bền bỉ cao. Ngoài ra, phiên bản màu HỒNG còn đi kèm tai mèo rất đẹp.</span></span><span>.</span></p>', 0, '440000', '33e6b5edb8.webp'),
(19, 'Loa Bluetooth Sony SRS - XB23	', 12, 13, 5, '<p><span><Với thiết kế tinh tế, kích thước nhỏ gọn, những chiếc loa Bluetooth mang thương hiệu Sony vô cùng tiện lợi để bạn mang theo. Trong đó, chiếc loa Bluetooth Sony SRS-XB23 là sản phẩm được nhiều người dùng ưa chuộng. Nếu bạn đang tìm kiếm một chiếc loa Bluetooth thì đừng bỏ qua sản phẩm đến từ nhà Sony nhé.</span></p>', 1, '2190000', '66cbf987e4.webp'),
(20, 'Tai nghe Bluetooth Sony WI - 1000XM2', 3, 12, 5, '<p><span>Sony đã cho ra mắt mẫu tai nghe in-ear chống ồn chủ động có tên gọi Sony WI-1000XM2. Đây là phiên bản nâng cấp của WI-1000X đã được ra mắt cách đây 2 năm với chip xử lý chống ồn QN1, bộ xử lý âm thanh 32-bit DSP với thời lượng pin liên tục 10 tiếng và thiết kế neckband dạng mới mềm mại, dễ chịu hơn.</span></p>', 0, '440000', '9467c13b76.webp'),
(21, 'Tai nghe True Wireless Sony WF-1000XM3', 6, 12, 5, '<p><span>Không tiếng ồn, không dây nối, WF-1000XM3 sẽ giúp bạn bỏ qua mọi bộn bề hàng ngày với chất lượng âm thanh hàng đầu bởi công nghệ Nhật Bản của Sony.</span></p>', 0, '399000', 'd3cd583d60.webp'),
(22, 'Loa Thonet & Vander SPIEL BT', 0, 14, 5, '<p><span>Loa Thonet & Vander này đã có mặt và sẵn sàng để vượt qua ranh giới. Với kết nối Bluetooth, loa 2.1 sẽ kết nối bạn với âm nhạc trong các hoạt động hàng ngày của bạn, cho dù bạn ở văn phòng hay làm việc tại nhà. </span></p>', 0, '990000', '921026c4c0.webp'),
(23, 'Bàn phím AKKO PC75B Plus Black & Silver', 10, 9, 2, '<p><span>Akko cuối cùng đã phát hành bàn phím 75% - AKKO PC75B Plus Black & Silver mang lại sự thoải mái khi đánh máy và cảm giác không gian. Với ba phương tiện kết nối: Bluetooth 5.0, 2.4 GHz và đầu ra có dây USB-C, mẫu máy này chắc chắn sẽ là lựa chọn tốt nhất cho những ai thích thay đổi mọi thứ. Nhờ các ổ cắm có thể thay thế nóng, nó có thể chứa nhiều loại công tắc, cả 3 và 5 chân.</span></p>', 1, '2190000', '8244b31c36.webp'),
(24, 'Chuột Razer Deathadder V2 Halo Infinite Edition', 2, 11, 1, '<p><span>Chuột Razer DeathAdder V2 được biết đến là mẫu chuột chơi game thế hệ mới nhất của Razer. Với thiết kế với công thái học đặc biệt cho người dùng tay phải, cùng với đó là cảm biến quang học Razer 5G chính xác nhất. Đây là một trong những mẫu chuột gaming được đánh giá cao khi mang lại sự hài lòng tuyệt đối cho các game thủ.</span></p>', 1, '2090000', 'fa8f4ead40.webp'),
(25, 'Chuột gaming DareU A960 Yellow Ultralight', 3, 11, 4, '<p><span>DareU A960 Yellow Ultralight bất ngờ nổi lên khi là chuột máy tính chơi game giá rẻ đầu tiên đạt được trọng lượng siêu nhẹ (chỉ 65 gram) mà không cần dùng vỏ lỗ. Đây là một bước tiến vượt bậc mà có sẽ các nhà sản xuất chuột gaming khác phải ganh tị với DareU.</span></p>', 0, '740000', '85d7888c4d.webp'),
(26, 'Bàn phím cơ DareU EK807G Wireless Brown switch', 5, 9, 4, '<p><span>Chơi game, làm việc không gò bó về không gian, không sợ chập chờn đứt gãy dây cáp với bàn phím cơ DareU EK807G Wireless, kết nối không dây tốc độ cao.</span></p>', 0, '640000', '4b7889f4a9.webp');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `sliderId` int NOT NULL,
  `sliderName` varchar(255) NOT NULL,
  `slider_image` varchar(255) NOT NULL,
  `type` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tbl_slider`
--

INSERT INTO `tbl_slider` (`sliderId`, `sliderName`, `slider_image`, `type`) VALUES
(6, 'slider1', '6040eb22f6.jpg', 1),
(7, 'slider2', 'a7c5645c46.jpg', 1),
(8, 'slider3', '81a231f4e8.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brandId`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cartId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`catId`);

--
-- Indexes for table `tbl_cmt`
--
ALTER TABLE `tbl_cmt`
  ADD PRIMARY KEY (`cmt_id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productId` (`productId`,`customer_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `tbl_placed`
--
ALTER TABLE `tbl_placed`
  ADD PRIMARY KEY (`id_placed`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`productId`),
  ADD KEY `catId` (`catId`,`brandId`),
  ADD KEY `brandId` (`brandId`);

--
-- Indexes for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`sliderId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brandId` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cartId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `catId` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_cmt`
--
ALTER TABLE `tbl_cmt`
  MODIFY `cmt_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_placed`
--
ALTER TABLE `tbl_placed`
  MODIFY `id_placed` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `productId` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `sliderId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `tbl_cart_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `tbl_product` (`productId`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customer` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_order_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `tbl_product` (`productId`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `tbl_product_ibfk_1` FOREIGN KEY (`catId`) REFERENCES `tbl_category` (`catId`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_product_ibfk_2` FOREIGN KEY (`brandId`) REFERENCES `tbl_brand` (`brandId`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
