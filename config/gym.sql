-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3307
-- Thời gian đã tạo: Th10 15, 2024 lúc 02:28 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `gym`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`userID`) VALUES
(17);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `goidangky`
--

CREATE TABLE `goidangky` (
  `idDangKy` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `maGoiTap` int(11) NOT NULL,
  `ngayHetHan` date NOT NULL,
  `trangThai` enum('Đang hoạt động','Hết hạn','Đã hủy') NOT NULL,
  `ngayMua` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `goitap`
--

CREATE TABLE `goitap` (
  `maGoiTap` int(11) NOT NULL,
  `tenGoiTap` varchar(255) NOT NULL,
  `thoiHan` int(11) NOT NULL,
  `gia` decimal(10,2) NOT NULL,
  `moTa` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

CREATE TABLE `hoadon` (
  `maHoaDon` int(11) NOT NULL,
  `idDangKy` int(11) NOT NULL,
  `ngayTao` date NOT NULL,
  `phuongThucThanhToan` enum('Tiền mặt','Thẻ tín dụng','Chuyển khoản') NOT NULL,
  `soTien` decimal(10,2) NOT NULL,
  `maKhuyenMai` int(11) DEFAULT NULL,
  `ngayThanhToan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyenmai`
--

CREATE TABLE `khuyenmai` (
  `maKhuyenMai` int(11) NOT NULL,
  `giamGia` decimal(5,2) NOT NULL,
  `ngayBatDau` date NOT NULL,
  `ngayKetThuc` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lichlamviec`
--

CREATE TABLE `lichlamviec` (
  `maLich` int(11) NOT NULL,
  `ngayBatDau` date NOT NULL,
  `caLamViec` varchar(50) NOT NULL,
  `ngayLamViec` date NOT NULL,
  `ngayKetThuc` date NOT NULL,
  `userID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `lichlamviec`
--

INSERT INTO `lichlamviec` (`maLich`, `ngayBatDau`, `caLamViec`, `ngayLamViec`, `ngayKetThuc`, `userID`) VALUES
(1, '2024-11-01', 'Ca sáng', '2024-11-01', '2024-11-01', 11),
(2, '2024-11-02', 'Ca chiều', '2024-11-02', '2024-11-02', 15);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lichsuhoatdong`
--

CREATE TABLE `lichsuhoatdong` (
  `IDHoatDong` int(11) NOT NULL,
  `thoiGianVao` datetime NOT NULL,
  `thoiGianRa` datetime DEFAULT NULL,
  `trangthai` enum('checkin','checkout') NOT NULL,
  `userID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `lichsuhoatdong`
--

INSERT INTO `lichsuhoatdong` (`IDHoatDong`, `thoiGianVao`, `thoiGianRa`, `trangthai`, `userID`) VALUES
(2, '0000-00-00 00:00:00', '2024-11-11 16:00:00', 'checkout', 1),
(4, '0000-00-00 00:00:00', '2024-11-11 18:00:00', 'checkout', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoidung`
--

CREATE TABLE `nguoidung` (
  `userID` int(10) NOT NULL,
  `hoTen` varchar(100) NOT NULL,
  `sdt` varchar(15) DEFAULT NULL,
  `ngaySinh` date DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `matKhau` varchar(255) NOT NULL,
  `vaiTro` enum('Admin','NVQuay','NVBaoTri','ThanhVien','NVHuongDanVien') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nguoidung`
--

INSERT INTO `nguoidung` (`userID`, `hoTen`, `sdt`, `ngaySinh`, `email`, `matKhau`, `vaiTro`) VALUES
(1, 'Nguyen Thi Mai', '0901234567', '1998-05-10', 'mai@example.com', 'password1', 'ThanhVien'),
(2, 'Tran Minh Tuan', '0902345678', '1995-07-21', 'tuan@example.com', 'password2', 'ThanhVien'),
(3, 'Le Thi Lan', '0903456789', '1993-08-15', 'lan@example.com', 'password3', 'ThanhVien'),
(4, 'Nguyen Quang Hieu', '0904567890', '1996-09-30', 'hieu@example.com', 'password4', 'ThanhVien'),
(5, 'Pham Thanh Son', '0905678901', '1997-01-12', 'son@example.com', 'password5', 'ThanhVien'),
(6, 'Bui Minh Anh', '0906789012', '1999-11-18', 'anh@example.com', 'password6', 'ThanhVien'),
(7, 'Vu Hoang Nam', '0907890123', '1994-04-05', 'nam@example.com', 'password7', 'ThanhVien'),
(8, 'Phan Minh Tien', '0908901234', '1995-12-22', 'tien@example.com', 'password8', 'ThanhVien'),
(9, 'Trinh Thi Mai', '0909012345', '1992-03-28', 'mai2@example.com', 'password9', 'ThanhVien'),
(10, 'Dang Minh Thu', '0900123456', '1998-06-02', 'thu@example.com', 'password10', 'ThanhVien'),
(11, 'Nguyen Thi Bao', '0912345678', '1990-05-15', 'bao@example.com', 'passwordnvq1', 'NVQuay'),
(12, 'Tran Minh Tam', '0913456789', '1989-08-20', 'tam@example.com', 'passwordnvq2', 'NVQuay'),
(13, 'Le Thi Lan', '0914567890', '1991-11-05', 'lan2@example.com', 'passwordnvq3', 'NVQuay'),
(14, 'Nguyen Hoang Son', '0915678901', '1992-02-25', 'son2@example.com', 'passwordnvq4', 'NVQuay'),
(15, 'Pham Minh Tu', '0923456789', '1987-04-10', 'tu@example.com', 'passwordnvbt1', 'NVBaoTri'),
(16, 'Bui Thi Lan', '0924567890', '1990-03-18', 'lan3@example.com', 'passwordnvbt2', 'NVBaoTri'),
(17, 'Nguyen Thi Lan', '0987654321', '1985-06-15', 'admin@example.com', 'passwordadmin', 'Admin'),
(18, 'Nguyen Minh Tu', '0933456789', '1991-10-05', 'tu2@example.com', 'passwordnvhd1', ''),
(19, 'Tran Thi Bao', '0934567890', '1988-12-17', 'bao2@example.com', 'passwordnvhd2', '');

--
-- Bẫy `nguoidung`
--
DELIMITER $$
CREATE TRIGGER `after_insert_NguoiDung` AFTER INSERT ON `nguoidung` FOR EACH ROW BEGIN
    -- Kiểm tra vai trò 'NVQuay'
    IF NEW.vaiTro = 'NVQuay' THEN
        INSERT INTO NVQuay (userID)
        VALUES (NEW.userID); -- Giá trị ví dụ, có thể thay đổi tùy theo yêu cầu
    END IF;

    -- Kiểm tra vai trò 'NVBaoTri'
    IF NEW.vaiTro = 'NVBaoTri' THEN
        INSERT INTO NVBaoTri (userID)
        VALUES (NEW.userID); -- Giá trị ví dụ, có thể thay đổi tùy theo yêu cầu
    END IF;

    -- Kiểm tra vai trò 'ThanhVien'
    IF NEW.vaiTro = 'ThanhVien' THEN
        INSERT INTO ThanhVien (userID, ngayDangKy)
        VALUES (NEW.userID, CURDATE()); -- Ngày đăng ký là ngày hiện tại
    END IF;

    -- Kiểm tra vai trò 'NVHuongDanVien'
    IF NEW.vaiTro = 'NVHuongDanVien' THEN
        INSERT INTO NVHuongDanVien (userID)
        VALUES (NEW.userID); -- Giá trị ví dụ, có thể thay đổi tùy theo yêu cầu
    END IF;

    -- Kiểm tra vai trò 'Admin'
    IF NEW.vaiTro = 'Admin' THEN
        INSERT INTO Admin (userID)
        VALUES (NEW.userID); -- Giá trị ví dụ, có thể thay đổi tùy theo yêu cầu
    END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nvbaotri`
--

CREATE TABLE `nvbaotri` (
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nvbaotri`
--

INSERT INTO `nvbaotri` (`userID`) VALUES
(15),
(16);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nvhuongdanvien`
--

CREATE TABLE `nvhuongdanvien` (
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nvquay`
--

CREATE TABLE `nvquay` (
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nvquay`
--

INSERT INTO `nvquay` (`userID`) VALUES
(11),
(12),
(13),
(14);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieubaotri`
--

CREATE TABLE `phieubaotri` (
  `maBaoTri` int(11) NOT NULL,
  `maThietBi` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `ngayBaoTri` date NOT NULL,
  `trangthai` enum('Đã hoàn thành','Đang thực hiện','Chưa thực hiện') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieudanhgia`
--

CREATE TABLE `phieudanhgia` (
  `maPhieuDanhGia` int(11) NOT NULL,
  `noiDung` text NOT NULL,
  `diemDanhGia` decimal(3,2) NOT NULL,
  `userID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `phieudanhgia`
--

INSERT INTO `phieudanhgia` (`maPhieuDanhGia`, `noiDung`, `diemDanhGia`, `userID`) VALUES
(1, 'Rất hài lòng với dịch vụ', 9.50, 2),
(2, 'Chất lượng phòng tập cần cải thiện', 7.00, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieughinhanloaithietbi`
--

CREATE TABLE `phieughinhanloaithietbi` (
  `maPhieu` int(11) NOT NULL,
  `maThietBi` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `moTaTinhTrang` text NOT NULL,
  `ngayGhiNhan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thanhvien`
--

CREATE TABLE `thanhvien` (
  `userID` int(11) NOT NULL,
  `ngayDangKy` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `thanhvien`
--

INSERT INTO `thanhvien` (`userID`, `ngayDangKy`) VALUES
(1, '2024-11-11'),
(2, '2024-11-11'),
(3, '2024-11-11'),
(4, '2024-11-11'),
(5, '2024-11-11'),
(6, '2024-11-11'),
(7, '2024-11-11'),
(8, '2024-11-11'),
(9, '2024-11-11'),
(10, '2024-11-11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thietbi`
--

CREATE TABLE `thietbi` (
  `maThietBi` int(11) NOT NULL,
  `tenThietBi` varchar(255) NOT NULL,
  `ngayMua` date DEFAULT NULL,
  `trangthai` enum('Đang sử dụng','Hỏng','Bảo trì','Không sử dụng') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`userID`);

--
-- Chỉ mục cho bảng `goidangky`
--
ALTER TABLE `goidangky`
  ADD PRIMARY KEY (`idDangKy`),
  ADD KEY `userID` (`userID`),
  ADD KEY `maGoiTap` (`maGoiTap`);

--
-- Chỉ mục cho bảng `goitap`
--
ALTER TABLE `goitap`
  ADD PRIMARY KEY (`maGoiTap`);

--
-- Chỉ mục cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`maHoaDon`),
  ADD KEY `idDangKy` (`idDangKy`),
  ADD KEY `maKhuyenMai` (`maKhuyenMai`);

--
-- Chỉ mục cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  ADD PRIMARY KEY (`maKhuyenMai`);

--
-- Chỉ mục cho bảng `lichlamviec`
--
ALTER TABLE `lichlamviec`
  ADD PRIMARY KEY (`maLich`),
  ADD KEY `FKich_NVQuay` (`userID`);

--
-- Chỉ mục cho bảng `lichsuhoatdong`
--
ALTER TABLE `lichsuhoatdong`
  ADD PRIMARY KEY (`IDHoatDong`),
  ADD KEY `FK_ThanhVien` (`userID`);

--
-- Chỉ mục cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `nvbaotri`
--
ALTER TABLE `nvbaotri`
  ADD PRIMARY KEY (`userID`);

--
-- Chỉ mục cho bảng `nvhuongdanvien`
--
ALTER TABLE `nvhuongdanvien`
  ADD PRIMARY KEY (`userID`);

--
-- Chỉ mục cho bảng `nvquay`
--
ALTER TABLE `nvquay`
  ADD PRIMARY KEY (`userID`);

--
-- Chỉ mục cho bảng `phieubaotri`
--
ALTER TABLE `phieubaotri`
  ADD PRIMARY KEY (`maBaoTri`),
  ADD KEY `maThietBi` (`maThietBi`),
  ADD KEY `userID` (`userID`);

--
-- Chỉ mục cho bảng `phieudanhgia`
--
ALTER TABLE `phieudanhgia`
  ADD PRIMARY KEY (`maPhieuDanhGia`),
  ADD KEY `FK_ThanhVien_PhongDanhGia` (`userID`);

--
-- Chỉ mục cho bảng `phieughinhanloaithietbi`
--
ALTER TABLE `phieughinhanloaithietbi`
  ADD PRIMARY KEY (`maPhieu`),
  ADD KEY `maThietBi` (`maThietBi`),
  ADD KEY `userID` (`userID`);

--
-- Chỉ mục cho bảng `thanhvien`
--
ALTER TABLE `thanhvien`
  ADD PRIMARY KEY (`userID`);

--
-- Chỉ mục cho bảng `thietbi`
--
ALTER TABLE `thietbi`
  ADD PRIMARY KEY (`maThietBi`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `goidangky`
--
ALTER TABLE `goidangky`
  MODIFY `idDangKy` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `goitap`
--
ALTER TABLE `goitap`
  MODIFY `maGoiTap` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `maHoaDon` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  MODIFY `maKhuyenMai` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `lichlamviec`
--
ALTER TABLE `lichlamviec`
  MODIFY `maLich` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `lichsuhoatdong`
--
ALTER TABLE `lichsuhoatdong`
  MODIFY `IDHoatDong` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `phieubaotri`
--
ALTER TABLE `phieubaotri`
  MODIFY `maBaoTri` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `phieudanhgia`
--
ALTER TABLE `phieudanhgia`
  MODIFY `maPhieuDanhGia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `phieughinhanloaithietbi`
--
ALTER TABLE `phieughinhanloaithietbi`
  MODIFY `maPhieu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `thietbi`
--
ALTER TABLE `thietbi`
  MODIFY `maThietBi` int(11) NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `nguoidung` (`userID`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `goidangky`
--
ALTER TABLE `goidangky`
  ADD CONSTRAINT `goidangky_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `thanhvien` (`userID`) ON DELETE CASCADE,
  ADD CONSTRAINT `goidangky_ibfk_2` FOREIGN KEY (`maGoiTap`) REFERENCES `goitap` (`maGoiTap`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `hoadon_ibfk_1` FOREIGN KEY (`idDangKy`) REFERENCES `goidangky` (`idDangKy`) ON DELETE CASCADE,
  ADD CONSTRAINT `hoadon_ibfk_2` FOREIGN KEY (`maKhuyenMai`) REFERENCES `khuyenmai` (`maKhuyenMai`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `lichlamviec`
--
ALTER TABLE `lichlamviec`
  ADD CONSTRAINT `FKich_NVQuay` FOREIGN KEY (`userID`) REFERENCES `nguoidung` (`userID`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `lichsuhoatdong`
--
ALTER TABLE `lichsuhoatdong`
  ADD CONSTRAINT `FK_ThanhVien` FOREIGN KEY (`userID`) REFERENCES `thanhvien` (`userID`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `nvbaotri`
--
ALTER TABLE `nvbaotri`
  ADD CONSTRAINT `nvbaotri_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `nguoidung` (`userID`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `nvhuongdanvien`
--
ALTER TABLE `nvhuongdanvien`
  ADD CONSTRAINT `nvhuongdanvien_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `nguoidung` (`userID`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `nvquay`
--
ALTER TABLE `nvquay`
  ADD CONSTRAINT `nvquay_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `nguoidung` (`userID`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `phieubaotri`
--
ALTER TABLE `phieubaotri`
  ADD CONSTRAINT `phieubaotri_ibfk_1` FOREIGN KEY (`maThietBi`) REFERENCES `thietbi` (`maThietBi`) ON DELETE CASCADE,
  ADD CONSTRAINT `phieubaotri_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `nvbaotri` (`userID`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `phieudanhgia`
--
ALTER TABLE `phieudanhgia`
  ADD CONSTRAINT `FK_ThanhVien_PhongDanhGia` FOREIGN KEY (`userID`) REFERENCES `thanhvien` (`userID`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `phieughinhanloaithietbi`
--
ALTER TABLE `phieughinhanloaithietbi`
  ADD CONSTRAINT `phieughinhanloaithietbi_ibfk_1` FOREIGN KEY (`maThietBi`) REFERENCES `thietbi` (`maThietBi`) ON DELETE CASCADE,
  ADD CONSTRAINT `phieughinhanloaithietbi_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `nvquay` (`userID`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `thanhvien`
--
ALTER TABLE `thanhvien`
  ADD CONSTRAINT `thanhvien_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `nguoidung` (`userID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
