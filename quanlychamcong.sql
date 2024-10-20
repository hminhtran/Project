-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 20, 2024 lúc 08:00 AM
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
-- Cấu trúc bảng cho bảng `bo_phan`
--

CREATE TABLE `bo_phan` (
  `ID` int(11) NOT NULL,
  `Ten` varchar(50) NOT NULL,
  `Luong_theo_gio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `bo_phan`
--

INSERT INTO `bo_phan` (`ID`, `Ten`, `Luong_theo_gio`) VALUES
(1, 'Quản trị', 19000),
(2, 'Thu ngân', 17000),
(3, 'Pha chế', 18000),
(4, 'Phục vụ', 17000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ca_lam_viec`
--

CREATE TABLE `ca_lam_viec` (
  `ID` int(11) NOT NULL,
  `Gio_bat_dau` time NOT NULL,
  `Gio_ket_thuc` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `ca_lam_viec`
--

INSERT INTO `ca_lam_viec` (`ID`, `Gio_bat_dau`, `Gio_ket_thuc`) VALUES
(1, '06:30:00', '14:30:00'),
(2, '14:30:00', '22:30:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cham_cong`
--

CREATE TABLE `cham_cong` (
  `ID_cham_cong` int(11) NOT NULL COMMENT 'ID chấm công',
  `Ma_nv` varchar(50) NOT NULL COMMENT 'Mã nhân viên',
  `Ngay` date NOT NULL COMMENT 'Ngày tháng năm chấm công',
  `gio_vao` varchar(15) DEFAULT NULL,
  `Tinh_trang` varchar(10) NOT NULL DEFAULT 'Đi làm' COMMENT 'Tình trạng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietban`
--

CREATE TABLE `chitietban` (
  `Id` int(11) NOT NULL,
  `IdDonBan` int(11) DEFAULT NULL,
  `IdSP` int(11) DEFAULT NULL,
  `GiaMua` int(11) DEFAULT NULL,
  `GiaBan` int(11) DEFAULT NULL,
  `SoLuong` int(11) DEFAULT NULL,
  `ThanhTien` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietmua`
--

CREATE TABLE `chitietmua` (
  `Id` int(11) NOT NULL,
  `IdDonMua` int(11) DEFAULT NULL,
  `TenSP` varchar(100) DEFAULT NULL,
  `IdDVT` int(11) DEFAULT NULL,
  `GiaMua` int(11) DEFAULT NULL,
  `SoLuong` int(11) DEFAULT NULL,
  `ThanhTien` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhsachquyen`
--

CREATE TABLE `danhsachquyen` (
  `Id` int(11) NOT NULL,
  `IdNV` int(11) DEFAULT NULL,
  `IdQuyen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `danhsachquyen`
--

INSERT INTO `danhsachquyen` (`Id`, `IdNV`, `IdQuyen`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donban`
--

CREATE TABLE `donban` (
  `Id` int(11) NOT NULL,
  `NgayBan` datetime DEFAULT NULL,
  `IdNV` int(11) DEFAULT NULL,
  `IdKH` int(11) DEFAULT NULL,
  `Tong` int(11) DEFAULT NULL,
  `TrangThai` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `donban`
--

INSERT INTO `donban` (`Id`, `NgayBan`, `IdNV`, `IdKH`, `Tong`, `TrangThai`) VALUES
(1, '2021-03-14 00:00:00', 1, 1, 250000, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donmua`
--

CREATE TABLE `donmua` (
  `Id` int(11) NOT NULL,
  `NgayMua` datetime DEFAULT NULL,
  `IdNV` int(11) DEFAULT NULL,
  `IdNCC` int(11) DEFAULT NULL,
  `ThanhTien` int(11) DEFAULT NULL,
  `TrangThai` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donvitinh`
--

CREATE TABLE `donvitinh` (
  `Id` int(11) NOT NULL,
  `DonVi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `donvitinh`
--

INSERT INTO `donvitinh` (`Id`, `DonVi`) VALUES
(1, 'Chai'),
(2, 'Bao'),
(3, 'Viên'),
(4, 'Chai'),
(5, 'Bao'),
(6, 'Viên');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `Id` int(11) NOT NULL,
  `TenKH` varchar(100) DEFAULT NULL,
  `DienThoai` varchar(20) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `DiaChi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`Id`, `TenKH`, `DienThoai`, `Email`, `DiaChi`) VALUES
(1, 'Nguyen Thanh Binh', '0395342134', 'binhnt.it28@gmail.com', '33 xô viết nghệ tĩnh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai_sp`
--

CREATE TABLE `loai_sp` (
  `id_loai` int(11) NOT NULL,
  `ten_loai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `luong`
--

CREATE TABLE `luong` (
  `He_so_luong` int(11) NOT NULL COMMENT 'Hệ số lương',
  `Luong_co_ban` int(11) NOT NULL COMMENT 'Lương cơ bản'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `luong`
--

INSERT INTO `luong` (`He_so_luong`, `Luong_co_ban`) VALUES
(1, 7000000),
(2, 7500000),
(3, 6000000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nghi_viec`
--

CREATE TABLE `nghi_viec` (
  `id` int(11) NOT NULL,
  `Ma_nv` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ngay_nghi` date NOT NULL,
  `den_ngay` date NOT NULL,
  `li_do` varchar(50) NOT NULL,
  `trang_thai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhacungcap`
--

CREATE TABLE `nhacungcap` (
  `Id` int(11) NOT NULL,
  `TenNCC` varchar(100) DEFAULT NULL,
  `DienThoai` varchar(20) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `DiaChi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhacungcap`
--

INSERT INTO `nhacungcap` (`Id`, `TenNCC`, `DienThoai`, `Email`, `DiaChi`) VALUES
(1, 'Đông Á', '1900023', 'donga@gmail.com', '33 XVNT'),
(2, 'Đông Á', '1900023', 'donga@gmail.com', '33 XVNT');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `Id` int(11) NOT NULL,
  `TenNV` varchar(100) DEFAULT NULL,
  `DienThoai` varchar(20) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `DiaChi` varchar(100) DEFAULT NULL,
  `TaiKhoan` varchar(50) DEFAULT NULL,
  `MatKhau` varchar(50) DEFAULT NULL,
  `IsActive` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`Id`, `TenNV`, `DienThoai`, `Email`, `DiaChi`, `TaiKhoan`, `MatKhau`, `IsActive`) VALUES
(1, 'Nguyen Thanh Binh', '0395342134', 'binhnt.it28@gmail.com', '33 xô viết nghệ tĩnh', 'admin', '21232f297a57a5a743894a0e4a801fc3', '1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhan_luong`
--

CREATE TABLE `nhan_luong` (
  `ID` int(11) NOT NULL COMMENT 'ID nhân lương',
  `Ma_nv` varchar(50) NOT NULL COMMENT 'Mã nhân viên',
  `He_so_luong` int(11) NOT NULL COMMENT 'Hệ số lương',
  `So_ngay_lam` int(11) NOT NULL COMMENT 'Số ngày làm',
  `Tien_thuong` int(11) NOT NULL COMMENT 'Tiền thưởng',
  `Tien_phat` int(11) NOT NULL COMMENT 'Tiền phạt',
  `Tien_ung` int(11) NOT NULL COMMENT 'Tiền ứng',
  `Tong` int(11) NOT NULL COMMENT 'Tổng',
  `Thoi_gian` date NOT NULL,
  `Tinh_trang` varchar(50) NOT NULL DEFAULT 'Chưa thanh toán'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nhan_luong`
--

INSERT INTO `nhan_luong` (`ID`, `Ma_nv`, `He_so_luong`, `So_ngay_lam`, `Tien_thuong`, `Tien_phat`, `Tien_ung`, `Tong`, `Thoi_gian`, `Tinh_trang`) VALUES
(20, 'NV01', 1, 0, 0, 0, 0, 0, '2024-05-26', 'Chưa thanh toán');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhan_vien`
--

CREATE TABLE `nhan_vien` (
  `Ma_nv` varchar(50) NOT NULL COMMENT 'Mã nhân viên',
  `password` varchar(255) NOT NULL,
  `Avatar` varchar(255) DEFAULT NULL,
  `Hoten` varchar(50) NOT NULL COMMENT 'Họ tên nhân viên',
  `Gioitinh` varchar(20) NOT NULL COMMENT 'Giới tính',
  `Ngaysinh` date NOT NULL COMMENT 'Ngày sinh',
  `Quequan` varchar(50) NOT NULL COMMENT 'Quê quán',
  `SDT` int(11) NOT NULL COMMENT 'Số điện thoại',
  `ID_bophan` int(11) NOT NULL,
  `ID_ca_lam` int(11) NOT NULL,
  `He_so_luong` int(11) NOT NULL COMMENT 'Hệ số lương',
  `qr` varchar(255) DEFAULT NULL,
  `qr_banking` varchar(255) DEFAULT NULL,
  `Ngaylamviec` date NOT NULL COMMENT 'Ngày làm việc'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nhan_vien`
--

INSERT INTO `nhan_vien` (`Ma_nv`, `password`, `Avatar`, `Hoten`, `Gioitinh`, `Ngaysinh`, `Quequan`, `SDT`, `ID_bophan`, `ID_ca_lam`, `He_so_luong`, `qr`, `qr_banking`, `Ngaylamviec`) VALUES
('NV01', '87939804ae7b49e62b47a798e7cd0511', '1716612748_cv.jpg', 'Trần Hữu Minh', 'Nam', '2002-10-06', 'Bình Thuận', 123456789, 1, 1, 1, NULL, NULL, '2023-12-01'),
('NV2', '59dd95a03c5340784a3d4f8b1e529649', '1726996496_1633623655_10138-08-c1.jpg', 'Trần', 'Nam', '2024-09-11', 'bình thuận', 964770175, 3, 1, 2, 'NV2.png', 'NV2_365981699_3495281124070128_8146095337155246783_n.jpg', '2024-09-22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quyen`
--

CREATE TABLE `quyen` (
  `Id` int(11) NOT NULL,
  `TenQuyen` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `quyen`
--

INSERT INTO `quyen` (`Id`, `TenQuyen`) VALUES
(1, 'admin');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `Id` int(11) NOT NULL,
  `TenSP` varchar(100) DEFAULT NULL,
  `IdDVT` int(11) DEFAULT NULL,
  `IdNCC` int(11) DEFAULT NULL,
  `GiaMua` int(11) DEFAULT NULL,
  `GiaBan` int(11) DEFAULT NULL,
  `img_sanpham` varchar(255) NOT NULL,
  `id_loai` int(11) NOT NULL,
  `lo_nhap` datetime NOT NULL,
  `ngay_het_han` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thuong_phat`
--

CREATE TABLE `thuong_phat` (
  `ID_thuong_phat` int(11) NOT NULL COMMENT 'ID thưởng phạt',
  `Ma_nv` varchar(50) NOT NULL COMMENT 'Mã nhân viên',
  `Loai_hinh` varchar(50) NOT NULL COMMENT 'Loại hình',
  `So_tien` int(11) NOT NULL COMMENT 'Số tiền',
  `Li_do` varchar(50) NOT NULL COMMENT 'Lí do',
  `Ngay_thuc_hien` date NOT NULL COMMENT 'Ngày thực hiện'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ung_luong`
--

CREATE TABLE `ung_luong` (
  `ID` int(11) NOT NULL,
  `Ma_nv` varchar(50) NOT NULL,
  `So_tien` int(11) NOT NULL,
  `Ngay_ung` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `yeu_cau_cham_cong`
--

CREATE TABLE `yeu_cau_cham_cong` (
  `id_yeu_cau` int(11) NOT NULL,
  `Ma_nv` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ngay` date NOT NULL,
  `ca_lam` int(11) NOT NULL,
  `gio_gui` varchar(15) NOT NULL,
  `li_do` varchar(50) NOT NULL,
  `trang_thai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `yeu_cau_cham_cong`
--

INSERT INTO `yeu_cau_cham_cong` (`id_yeu_cau`, `Ma_nv`, `ngay`, `ca_lam`, `gio_gui`, `li_do`, `trang_thai`) VALUES
(4, 'NV02', '2024-05-25', 2, '', 'Đổi ca với NV3', 'Từ chối'),
(5, 'NV02', '2024-05-26', 1, '22:35:48', 'đổi ca ', 'Đã chấm công giúp');

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
(5, 'NV02', '2024-05-25', 70707070, 'thích', 'Chờ duyệt'),
(6, 'NV02', '2024-05-25', 3948348, 'okoko ', 'Từ chối');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bo_phan`
--
ALTER TABLE `bo_phan`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Ten` (`Ten`);

--
-- Chỉ mục cho bảng `ca_lam_viec`
--
ALTER TABLE `ca_lam_viec`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `cham_cong`
--
ALTER TABLE `cham_cong`
  ADD PRIMARY KEY (`ID_cham_cong`),
  ADD KEY `fk_nhanvien` (`Ma_nv`);

--
-- Chỉ mục cho bảng `chitietban`
--
ALTER TABLE `chitietban`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdDonBan` (`IdDonBan`),
  ADD KEY `IdSP` (`IdSP`);

--
-- Chỉ mục cho bảng `chitietmua`
--
ALTER TABLE `chitietmua`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdDonMua` (`IdDonMua`),
  ADD KEY `IdDVT` (`IdDVT`);

--
-- Chỉ mục cho bảng `danhsachquyen`
--
ALTER TABLE `danhsachquyen`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdNV` (`IdNV`),
  ADD KEY `IdQuyen` (`IdQuyen`);

--
-- Chỉ mục cho bảng `donban`
--
ALTER TABLE `donban`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdNV` (`IdNV`),
  ADD KEY `IdKH` (`IdKH`);

--
-- Chỉ mục cho bảng `donmua`
--
ALTER TABLE `donmua`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdNV` (`IdNV`),
  ADD KEY `IdNCC` (`IdNCC`);

--
-- Chỉ mục cho bảng `donvitinh`
--
ALTER TABLE `donvitinh`
  ADD PRIMARY KEY (`Id`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`Id`);

--
-- Chỉ mục cho bảng `luong`
--
ALTER TABLE `luong`
  ADD PRIMARY KEY (`He_so_luong`);

--
-- Chỉ mục cho bảng `nghi_viec`
--
ALTER TABLE `nghi_viec`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Ma_nv` (`Ma_nv`),
  ADD KEY `trang_thai` (`trang_thai`);

--
-- Chỉ mục cho bảng `nhacungcap`
--
ALTER TABLE `nhacungcap`
  ADD PRIMARY KEY (`Id`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`Id`);

--
-- Chỉ mục cho bảng `nhan_luong`
--
ALTER TABLE `nhan_luong`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ma_nv` (`Ma_nv`);

--
-- Chỉ mục cho bảng `nhan_vien`
--
ALTER TABLE `nhan_vien`
  ADD PRIMARY KEY (`Ma_nv`),
  ADD KEY `ID_bophan` (`ID_bophan`),
  ADD KEY `fk_nhanvien_calam` (`ID_ca_lam`),
  ADD KEY `He_so_luong` (`He_so_luong`);

--
-- Chỉ mục cho bảng `quyen`
--
ALTER TABLE `quyen`
  ADD PRIMARY KEY (`Id`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdDVT` (`IdDVT`),
  ADD KEY `IdNCC` (`IdNCC`);

--
-- Chỉ mục cho bảng `thuong_phat`
--
ALTER TABLE `thuong_phat`
  ADD PRIMARY KEY (`ID_thuong_phat`),
  ADD KEY `fk_thuong_phat` (`Ma_nv`),
  ADD KEY `So_tien` (`So_tien`);

--
-- Chỉ mục cho bảng `ung_luong`
--
ALTER TABLE `ung_luong`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Ma_nv` (`Ma_nv`),
  ADD KEY `So_tien` (`So_tien`);

--
-- Chỉ mục cho bảng `yeu_cau_cham_cong`
--
ALTER TABLE `yeu_cau_cham_cong`
  ADD PRIMARY KEY (`id_yeu_cau`);

--
-- Chỉ mục cho bảng `yeu_cau_ung_luong`
--
ALTER TABLE `yeu_cau_ung_luong`
  ADD PRIMARY KEY (`id_ung`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bo_phan`
--
ALTER TABLE `bo_phan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `ca_lam_viec`
--
ALTER TABLE `ca_lam_viec`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `cham_cong`
--
ALTER TABLE `cham_cong`
  MODIFY `ID_cham_cong` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID chấm công', AUTO_INCREMENT=62982;

--
-- AUTO_INCREMENT cho bảng `chitietban`
--
ALTER TABLE `chitietban`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `chitietmua`
--
ALTER TABLE `chitietmua`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `danhsachquyen`
--
ALTER TABLE `danhsachquyen`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `donban`
--
ALTER TABLE `donban`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `donmua`
--
ALTER TABLE `donmua`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `donvitinh`
--
ALTER TABLE `donvitinh`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `nghi_viec`
--
ALTER TABLE `nghi_viec`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `nhacungcap`
--
ALTER TABLE `nhacungcap`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `nhan_luong`
--
ALTER TABLE `nhan_luong`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID nhân lương', AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `quyen`
--
ALTER TABLE `quyen`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `thuong_phat`
--
ALTER TABLE `thuong_phat`
  MODIFY `ID_thuong_phat` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID thưởng phạt', AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `ung_luong`
--
ALTER TABLE `ung_luong`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `yeu_cau_cham_cong`
--
ALTER TABLE `yeu_cau_cham_cong`
  MODIFY `id_yeu_cau` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `yeu_cau_ung_luong`
--
ALTER TABLE `yeu_cau_ung_luong`
  MODIFY `id_ung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cham_cong`
--
ALTER TABLE `cham_cong`
  ADD CONSTRAINT `fk_nhanvien` FOREIGN KEY (`Ma_nv`) REFERENCES `nhan_vien` (`Ma_nv`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `chitietban`
--
ALTER TABLE `chitietban`
  ADD CONSTRAINT `chitietban_ibfk_1` FOREIGN KEY (`IdDonBan`) REFERENCES `donban` (`Id`),
  ADD CONSTRAINT `chitietban_ibfk_2` FOREIGN KEY (`IdSP`) REFERENCES `sanpham` (`Id`);

--
-- Các ràng buộc cho bảng `chitietmua`
--
ALTER TABLE `chitietmua`
  ADD CONSTRAINT `chitietmua_ibfk_1` FOREIGN KEY (`IdDonMua`) REFERENCES `donmua` (`Id`),
  ADD CONSTRAINT `chitietmua_ibfk_2` FOREIGN KEY (`IdDVT`) REFERENCES `donvitinh` (`Id`);

--
-- Các ràng buộc cho bảng `danhsachquyen`
--
ALTER TABLE `danhsachquyen`
  ADD CONSTRAINT `danhsachquyen_ibfk_1` FOREIGN KEY (`IdNV`) REFERENCES `nhanvien` (`Id`),
  ADD CONSTRAINT `danhsachquyen_ibfk_2` FOREIGN KEY (`IdQuyen`) REFERENCES `quyen` (`Id`);

--
-- Các ràng buộc cho bảng `donban`
--
ALTER TABLE `donban`
  ADD CONSTRAINT `donban_ibfk_1` FOREIGN KEY (`IdNV`) REFERENCES `nhanvien` (`Id`),
  ADD CONSTRAINT `donban_ibfk_2` FOREIGN KEY (`IdKH`) REFERENCES `khachhang` (`Id`);

--
-- Các ràng buộc cho bảng `donmua`
--
ALTER TABLE `donmua`
  ADD CONSTRAINT `donmua_ibfk_1` FOREIGN KEY (`IdNV`) REFERENCES `nhanvien` (`Id`),
  ADD CONSTRAINT `donmua_ibfk_2` FOREIGN KEY (`IdNCC`) REFERENCES `nhacungcap` (`Id`);

--
-- Các ràng buộc cho bảng `nghi_viec`
--
ALTER TABLE `nghi_viec`
  ADD CONSTRAINT `nghi_viec_ibfk_1` FOREIGN KEY (`Ma_nv`) REFERENCES `nhan_vien` (`Ma_nv`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `nhan_luong`
--
ALTER TABLE `nhan_luong`
  ADD CONSTRAINT `ma_nv` FOREIGN KEY (`Ma_nv`) REFERENCES `nhan_vien` (`Ma_nv`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `nhan_vien`
--
ALTER TABLE `nhan_vien`
  ADD CONSTRAINT `fk_luong` FOREIGN KEY (`He_so_luong`) REFERENCES `luong` (`He_so_luong`),
  ADD CONSTRAINT `fk_nhanvien_bophan` FOREIGN KEY (`ID_bophan`) REFERENCES `bo_phan` (`ID`),
  ADD CONSTRAINT `fk_nhanvien_calam` FOREIGN KEY (`ID_ca_lam`) REFERENCES `ca_lam_viec` (`ID`);

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`IdDVT`) REFERENCES `donvitinh` (`Id`),
  ADD CONSTRAINT `sanpham_ibfk_2` FOREIGN KEY (`IdNCC`) REFERENCES `nhacungcap` (`Id`);

--
-- Các ràng buộc cho bảng `thuong_phat`
--
ALTER TABLE `thuong_phat`
  ADD CONSTRAINT `fk_thuong_phat` FOREIGN KEY (`Ma_nv`) REFERENCES `nhan_vien` (`Ma_nv`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `ung_luong`
--
ALTER TABLE `ung_luong`
  ADD CONSTRAINT `fk_ungtien` FOREIGN KEY (`Ma_nv`) REFERENCES `nhan_vien` (`Ma_nv`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
