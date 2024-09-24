-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 06, 2023 at 09:30 AM
-- Server version: 8.0.30
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
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `MA_SP` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `MA_LOAI` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `TEN_SP` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `MAU` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `GIA` double NOT NULL,
  `SO_LUONG` int NOT NULL,
  `TINH_TRANG_SP` tinyint NOT NULL,
  `HINH_ANH` varchar(45) NOT NULL,
  `CHI_TIET` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`MA_SP`, `MA_LOAI`, `TEN_SP`, `MAU`, `GIA`, `SO_LUONG`, `TINH_TRANG_SP`, `HINH_ANH`, `CHI_TIET`) VALUES
('12F1', '12F', 'MŨ NỬA ĐẦU SUNDA 135D ĐEN NHÁM', 'Đen', 350000, 27, 1, '12F1.jpg', 'Công ty TNHH Longhuei với bề dày kinh nghiệm  gần 30 năm trong ngành nón, cơ sở hạ tầng hiện đại, qu'),
('12F2', '12F', 'MŨ NỬA ĐẦU NAPOLI PUG VÀNG NGHỆ', 'Vàng', 200000, 30, 1, '12F2.jpg', 'Napoli Pug là chiếc mũ bảo hiểm 1/2 dành riêng cho những bạn trẻ đang tìm cho mình một chiếc mũ cool'),
('12F3', '12F', 'MŨ NỬA ĐẦU NAPOLI PUG TRẮNG', 'Trắng', 200000, 3, 1, '12F3.jpg', 'Napoli Pug là chiếc mũ bảo hiểm 1/2 dành riêng cho những bạn trẻ đang tìm cho mình một chiếc mũ cool'),
('12F4', '12F', 'MŨ NỬA ĐẦU ASIA MT-106K ĐEN NHÁM', 'Đen', 330000, 15, 1, '12F4.jpg', 'ASIA MT-106K được sản xuất bởi công ty Á Châu. Nón thích hợp với những người yêu thích sự gọn nhẹ, t'),
('12F5', '12F', 'MŨ NỬA ĐẦU NAPOLI PUG ĐEN BÓNG', 'Đen', 200000, 16, 1, '12F5.jpg', 'Napoli Pug là chiếc mũ bảo hiểm 1/2 dành riêng cho những bạn trẻ đang tìm cho mình một chiếc mũ cool'),
('12F6', '12F', 'MŨ NỬA ĐẦU NAPOLI PUG ĐEN NHÁM', 'Đen', 200000, 15, 1, '12F6.jpg', 'Napoli Pug là chiếc mũ bảo hiểm 1/2 dành riêng cho những bạn trẻ đang tìm cho mình một chiếc mũ cool'),
('34F1', '34F', 'MŨ 3/4 ROYAL M787', 'Đen', 470000, 21, 1, '34F1.jpg', 'Mũ bảo hiểm Royal M787 là mũ 3/4 một kính mới nhất của Royal Helmet, được thiết kế dựa theo khuôn củ'),
('34F2', '34F', 'MŨ 3/4 ZEUS 205 TRẮNG', 'Trắng', 1300000, 12, 1, '34F2.jpg', 'Zeus 205 Trắng đến từ một thương hiệu trứ danh từ Đài Loan, chiếc mũ bảo hiểm mang trong mình tất cả'),
('34F3', '34F', 'MŨ 3/4 HAI KÍNH YOHE 852 ĐEN BÓNG', 'Đen', 1400000, 5, 1, '34F3.jpg', 'Hòa cùng sự nhộn nhịp của thị trường mũ bảo hiểm cuối năm, Yohe cũng vừa kịp cho ra mắt sản phẩm mũ '),
('34F4', '34F', 'MŨ 3/4 HAI KÍNH YOHE 852 ĐEN NHÁM', 'Đen', 1400000, 3, 1, '34F4.jpg', 'Hòa cùng sự nhộn nhịp của thị trường mũ bảo hiểm cuối năm, Yohe cũng vừa kịp cho ra mắt sản phẩm mũ '),
('34F5', '34F', 'MŨ 3/4 NAPOLI N189', 'Đen', 400000, 10, 1, '34F5.jpg', 'Chất lượng sản phẩm đã được cục kiêm định chất lượng mũ bảo hiểm Việt Nam kiểm định, với thương hiệu'),
('34F6', '34F', 'MŨ 3/4 HAI KÍNH YOHE 852 TRẮNG BÓNG', 'Trắng', 1400000, 6, 1, '34F6.jpg', 'Yohe 852 được ra đời như là sự thay thế cho người đàn em Yohe 878 của Yohe Helmet tại thị trường Việ'),
('FF1', 'FF', 'MŨ FULLFACE ROC 03 TRẮNG BÓNG', 'Trắng', 1050000, 20, 1, 'FF1.jpg', 'Mũ bảo hiểm fullface Roc 03 là phiên bản được nâng cấp và cải tiến nhằm thay thế đàn em Roc M137. Vẫ'),
('FF2', 'FF', 'MŨ FULLFACE ROYAL M141K VÀNG BÓNG', 'Vàng', 860000, 23, 1, 'FF2.jpg', 'Mũ bảo hiểm Royal M141K với kiểu dáng fullsize cùng phong cách Retro của những năm 60s của thế kỉ tr'),
('FF3', 'FF', 'MŨ FULLFACE ROYAL M141K ĐEN NHÁM', 'Đen', 860000, 10, 1, 'FF3.jpg', 'Mũ bảo hiểm Royal M141K với kiểu dáng fullsize cùng phong cách Retro của những năm 60s của thế kỉ tr'),
('FF4', 'FF', 'MŨ FULLFACE ROYAL M141K ĐEN BÓNG', 'Đen', 860000, 8, 1, 'FF4.jpg', 'Mũ Bảo Hiểm Fullface Vintage Royal M141K kính âm chắc chắn sẽ là một trong những dòng nón bảo hiểm s'),
('FF5', 'FF', 'MŨ FULLFACE ROYAL M266 HAI KÍNH', 'Đen', 620000, 6, 1, 'FF5.jpg', 'Mũ bảo hiểm Fullface Royal M266 2 Kính là sản phẩm của Royal Helmet – Thương hiệu cao cấp của Á Châu'),
('FF6', 'FF', 'MŨ FULLFACE ROC 05 ĐEN BÓNG', 'Đen', 1040000, 18, 1, 'FF6.jpg', 'ROC 05 được đánh giá là một trong những mẫu nón fullface hai kính đáng được sở hữu nhất trong phân k');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MA_SP`),
  ADD KEY `MA_LOAI` (`MA_LOAI`);

--
-- Constraints for dumped tables
--

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
