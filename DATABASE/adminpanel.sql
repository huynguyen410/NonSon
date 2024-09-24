-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: May 06, 2023 at 09:33 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adminpanel`
--

-- --------------------------------------------------------

--
-- Table structure for table `chitiet_hoadon`
--

CREATE TABLE `chitiet_hoadon` (
  `MA_HD` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `MA_SP` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `GIA` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `SOLUONG` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

CREATE TABLE `hoadon` (
  `MA_HD` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `NGAY_TAO_HD` datetime DEFAULT NULL,
  `USERNAME` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `TEN_NGUOI_NHAN` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `DIA_CHI_NHAN` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `THANH_TIEN` double NOT NULL,
  `TRANG_THAI` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loai_sanpham`
--

CREATE TABLE `loai_sanpham` (
  `MA_LOAI` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `TEN_LOAI` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `CHI_TIET` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `loai_sanpham`
--

INSERT INTO `loai_sanpham` (`MA_LOAI`, `TEN_LOAI`, `CHI_TIET`) VALUES
('12F', 'Nón 1/2 Đầu', NULL),
('34F', 'Nón 3/4 Đầu', NULL),
('FF', 'Nón FULLFACE', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `MA_SP` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `MA_LOAI` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `TEN_SP` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `MAU` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `GIA` double NOT NULL,
  `SO_LUONG` int(11) NOT NULL,
  `TINH_TRANG_SP` tinyint(4) NOT NULL,
  `HINH_ANH` varchar(45) NOT NULL,
  `CHI_TIET` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`MA_SP`, `MA_LOAI`, `TEN_SP`, `MAU`, `GIA`, `SO_LUONG`, `TINH_TRANG_SP`, `HINH_ANH`, `CHI_TIET`) VALUES
('12F1', '12F', 'MŨ NỬA ĐẦU SUNDA 135D ĐEN NHÁM', 'Đen', 350000, 27, 1, 'img/12F1.jpg', 'Công ty TNHH Longhuei với bề dày kinh nghiệm  gần 30 năm trong ngành nón, cơ sở hạ tầng hiện đại, quy trình kiểm nghiệm đạt chuẩn quốc tế. Hãng đã cho ra mắt nón bảo hiểm nửa đầu Sunda 135D Đen Nhám,  với mong muốn đáp ứng mọi kì vọng cho những khách hàng đang tìm cho mình một chiêc mũ bảo hiểm an toàn, tiện dụng.'),
('12F2', '12F', 'MŨ NỬA ĐẦU NAPOLI PUG VÀNG NGHỆ', 'Vàng', 200000, 30, 1, 'img/12F2.jpg', 'Napoli Pug là chiếc mũ bảo hiểm 1/2 dành riêng cho những bạn trẻ đang tìm cho mình một chiếc mũ cool ngầu, cá tính với vô vàn tùy biến theo sở thích cá nhân đi kèm mức giá không vô cùng hấp dẫn.'),
('12F3', '12F', 'MŨ NỬA ĐẦU NAPOLI PUG TRẮNG', 'Trắng', 200000, 3, 1, 'img/12F3.jpg', 'Napoli Pug là chiếc mũ bảo hiểm 1/2 dành riêng cho những bạn trẻ đang tìm cho mình một chiếc mũ cool ngầu, cá tính với vô vàn tùy biến theo sở thích cá nhân đi kèm mức giá không vô cùng hấp dẫn.'),
('12F4', '12F', 'MŨ NỬA ĐẦU ASIA MT-106K ĐEN NHÁM', 'Đen', 330000, 15, 1, 'img/12F4.jpg', 'ASIA MT-106K được sản xuất bởi công ty Á Châu. Nón thích hợp với những người yêu thích sự gọn nhẹ, thuận tiện cho những chuyến đi ngắn hay di chuyển trong đô thị.'),
('12F5', '12F', 'MŨ NỬA ĐẦU NAPOLI PUG ĐEN BÓNG', 'Đen', 200000, 16, 1, 'img/12F5.jpg', 'Napoli Pug là chiếc mũ bảo hiểm 1/2 dành riêng cho những bạn trẻ đang tìm cho mình một chiếc mũ cool ngầu, cá tính với vô vàn tùy biến theo sở thích cá nhân đi kèm mức giá không vô cùng hấp dẫn.'),
('12F6', '12F', 'MŨ NỬA ĐẦU NAPOLI PUG ĐEN NHÁM', 'Đen', 200000, 15, 1, 'img/12F6.jpg', 'Napoli Pug là chiếc mũ bảo hiểm 1/2 dành riêng cho những bạn trẻ đang tìm cho mình một chiếc mũ cool ngầu, cá tính với vô vàn tùy biến theo sở thích cá nhân đi kèm mức giá không vô cùng hấp dẫn.'),
('34F1', '34F', 'MŨ 3/4 ROYAL M787', 'Đen', 470000, 21, 1, 'img/34F1.jpg', 'Mũ bảo hiểm Royal M787 là mũ 3/4 một kính mới nhất của Royal Helmet, được thiết kế dựa theo khuôn của ROC 06 và YOHE 851 nhưng có giá thành rẻ hơn nhiều.'),
('34F2', '34F', 'MŨ 3/4 ZEUS 205 TRẮNG', 'Trắng', 1300000, 12, 1, 'img/34F2.jpg', 'Zeus 205 Trắng đến từ một thương hiệu trứ danh từ Đài Loan, chiếc mũ bảo hiểm mang trong mình tất cả những gì tinh túy nhất của hãng với thiết kế đẳng cấp cùng công nghệ tiên tiến nhất.'),
('34F3', '34F', 'MŨ 3/4 HAI KÍNH YOHE 852 ĐEN BÓNG', 'Đen', 1400000, 5, 1, 'img/34F3.jpg', 'Hòa cùng sự nhộn nhịp của thị trường mũ bảo hiểm cuối năm, Yohe cũng vừa kịp cho ra mắt sản phẩm mũ 3/4 mới mang mã Yohe 852. Liệu đây có phải là phiên bản nâng cấp của Yohe 851? Cùng điểm qua các chi tiết của chiếc mũ này nhé.'),
('34F4', '34F', 'MŨ 3/4 HAI KÍNH YOHE 852 ĐEN NHÁM', 'Đen', 1400000, 3, 1, 'img/34F4.jpg', 'Hòa cùng sự nhộn nhịp của thị trường mũ bảo hiểm cuối năm, Yohe cũng vừa kịp cho ra mắt sản phẩm mũ 3/4 mới mang mã Yohe 852. Liệu đây có phải là phiên bản nâng cấp của Yohe 851? Cùng điểm qua các chi tiết của chiếc mũ này nhé.'),
('34F5', '34F', 'MŨ 3/4 NAPOLI N189', 'Đen', 400000, 10, 1, 'img/34F5.jpg', 'Chất lượng sản phẩm đã được cục kiêm định chất lượng mũ bảo hiểm Việt Nam kiểm định, với thương hiệu NAPOLI đã được người tiêu dùng Việt Nam tin dùng nên khi người dùng lựa chọn mua sản phẩm này hoàn toàn có thể yên tâm về chất lượng sản phẩm.'),
('34F6', '34F', 'MŨ 3/4 HAI KÍNH YOHE 852 TRẮNG BÓNG', 'Trắng', 1400000, 6, 1, 'img/34F6.jpg', 'Yohe 852 được ra đời như là sự thay thế cho người đàn em Yohe 878 của Yohe Helmet tại thị trường Việt Nam. Với những tính năng được cải tiến hơn, form nón nhỏ gọn và hai ốp tai linh hoạt mềm mại hơn, Yohe 852 là đối thủ đáng gờm đối với dòng mũ 3/4 hai kính trong phân khúc hơn 1 triệu đồng.'),
('FF1', 'FF', 'MŨ FULLFACE ROC 03 TRẮNG BÓNG', 'Trắng', 1050000, 20, 1, 'img/FF1.jpg', 'Mũ bảo hiểm fullface Roc 03 là phiên bản được nâng cấp và cải tiến nhằm thay thế đàn em Roc M137. Vẫn là form nón nguyên bản, đuôi gió Pista quen thuộc nhưng được khoác lên mình bộ cánh mới với các mẫu tem cá tính và nổi bật hơn. Cùng với đó là nhưng cải tiến về chất liệu cũng như tính năng vốn đã rất tốt từ phiên bản trước.'),
('FF2', 'FF', 'MŨ FULLFACE ROYAL M141K VÀNG BÓNG', 'Vàng', 860000, 23, 1, 'img/FF2.jpg', 'Mũ bảo hiểm Royal M141K với kiểu dáng fullsize cùng phong cách Retro của những năm 60s của thế kỉ trước, rất phù hợp với những ai tìm kiếm sự hoài cổ. Royal M141K là sự tổng hòa của thiết kế cổ điển kết hợp với công nghệ hiện đại với đầy đủ yếu tố thời trang, phong cách cũng như đảm bảo an toàn cao nhất cho người đội.'),
('FF3', 'FF', 'MŨ FULLFACE ROYAL M141K ĐEN NHÁM', 'Đen', 860000, 10, 1, 'img/FF3.jpg', 'Mũ bảo hiểm Royal M141K với kiểu dáng fullsize cùng phong cách Retro của những năm 60s của thế kỉ trước, rất phù hợp với những ai tìm kiếm sự hoài cổ. Royal M141K là sự tổng hòa của thiết kế cổ điển kết hợp với công nghệ hiện đại với đầy đủ yếu tố thời trang, phong cách cũng như đảm bảo an toàn cao nhất cho người đội.'),
('FF4', 'FF', 'MŨ FULLFACE ROYAL M141K ĐEN BÓNG', 'Đen', 860000, 8, 1, 'img/FF4.jpg', 'Mũ Bảo Hiểm Fullface Vintage Royal M141K kính âm chắc chắn sẽ là một trong những dòng nón bảo hiểm sẽ làm thỏa mãn cho những người chơi xe theo phong cách cổ điển, giá thành và chất lượng hợp lý là lựa chọn hàng đầu.'),
('FF5', 'FF', 'MŨ FULLFACE ROYAL M266 HAI KÍNH', 'Đen', 620000, 6, 1, 'img/FF5.jpg', 'Mũ bảo hiểm Fullface Royal M266 2 Kính là sản phẩm của Royal Helmet – Thương hiệu cao cấp của Á Châu Group, nhà sản xuất mũ bảo hiểm hàng đầu Việt Nam với hơn 10 năm kinh nghiệm. Được làm từ nhựa ABS nguyên sinh, đạt chuẩn QCVN của Tổng Cục Tiêu Chuẩn Đo Lường Chất Lượng Việt Nam. Bảo hành chính hãng 2 năm.'),
('FF6', 'FF', 'MŨ FULLFACE ROC 05 ĐEN BÓNG', 'Đen', 1040000, 18, 1, 'img/FF6.jpg', 'ROC 05 được đánh giá là một trong những mẫu nón fullface hai kính đáng được sở hữu nhất trong phân khúc dưới 1 triệu đồng. Với thiết kế có những đường cong rất khác biệt so với các mẫu nón fullface khác dựa theo kiểu dáng của AGV K3SV – Thương hiệu mũ bảo hiểm hàng đầu thế giới.');

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `USERNAME` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `PASSWORD` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `NAME` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `PHONE_NUMBER` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `EMAIL` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ADDRESS` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ROLE` tinyint(4) NOT NULL,
  `STATUS` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`USERNAME`, `PASSWORD`, `NAME`, `PHONE_NUMBER`, `EMAIL`, `ADDRESS`, `ROLE`, `STATUS`) VALUES
('admin', '$2y$10$wa6PFW92u0pBWAypHPCSC.6C14puU9800ibMcU4YAOfMVygZzEBcO', 'admin', '0388589911', 'admin@gmail.com', 'day la nha cua admin', 1, 1),
('asd', '$2y$10$2G0i3JbJvEaq/0/q2NWeUujcACHC29Vk98oG6jbvkwP2967vZ752q', 'asd', '0593666785', 'asd@gmail.com', 'asd', 0, 1),
('dd', '$2y$10$D7DhayzOM4WXK4z1txW9/O2omtz/FgnDPAm4B4wg93J1P26j4.puS', 'dd', '0388589911', 'dd@g', 'dd', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chitiet_hoadon`
--
ALTER TABLE `chitiet_hoadon`
  ADD KEY `MA_SP` (`MA_SP`),
  ADD KEY `MA_HD` (`MA_HD`);

--
-- Indexes for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`MA_HD`),
  ADD KEY `USERNAME` (`USERNAME`);

--
-- Indexes for table `loai_sanpham`
--
ALTER TABLE `loai_sanpham`
  ADD PRIMARY KEY (`MA_LOAI`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MA_SP`),
  ADD KEY `MA_LOAI` (`MA_LOAI`);

--
-- Indexes for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`USERNAME`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chitiet_hoadon`
--
ALTER TABLE `chitiet_hoadon`
  ADD CONSTRAINT `chitiet_hoadon_ibfk_1` FOREIGN KEY (`MA_SP`) REFERENCES `sanpham` (`MA_SP`),
  ADD CONSTRAINT `chitiet_hoadon_ibfk_2` FOREIGN KEY (`MA_HD`) REFERENCES `hoadon` (`MA_HD`);

--
-- Constraints for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `hoadon_ibfk_1` FOREIGN KEY (`USERNAME`) REFERENCES `taikhoan` (`USERNAME`);

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`MA_LOAI`) REFERENCES `loai_sanpham` (`MA_LOAI`),
  ADD CONSTRAINT `sanpham_ibfk_2` FOREIGN KEY (`MA_LOAI`) REFERENCES `loai_sanpham` (`MA_LOAI`),
  ADD CONSTRAINT `sanpham_ibfk_3` FOREIGN KEY (`MA_LOAI`) REFERENCES `loai_sanpham` (`MA_LOAI`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
