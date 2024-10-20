-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 25, 2024 lúc 07:24 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlychamcong`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `yeu_cau_ung_luong`
--

CREATE TABLE `yeu_cau_ung_luong` (
  `id_ung` int(11) NOT NULL,
  `ma_nv` varchar(50) NOT NULL,
  `ngay` date NOT NULL,
  `so_tien` int(11) NOT NULL,
  `li_do` varchar(50) NOT NULL,
  `trang_thai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `yeu_cau_ung_luong`
--

INSERT INTO `yeu_cau_ung_luong` (`id_ung`, `ma_nv`, `ngay`, `so_tien`, `li_do`, `trang_thai`) VALUES
(4, 'NV02', '2024-05-25', 200000, 'mua đồ', 'Đã duyệt'),
(5, 'NV02', '2024-05-25', 70707070, 'thích', 'Từ chối'),
(6, 'NV02', '2024-05-25', 3948348, 'okoko ', 'Từ chối');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `yeu_cau_ung_luong`
--
ALTER TABLE `yeu_cau_ung_luong`
  ADD PRIMARY KEY (`id_ung`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `yeu_cau_ung_luong`
--
ALTER TABLE `yeu_cau_ung_luong`
  MODIFY `id_ung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
