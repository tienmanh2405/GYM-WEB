-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3307
-- Thời gian đã tạo: Th12 12, 2024 lúc 03:27 AM
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
  `trangThai` enum('Đang hoạt động','Hết hạn','Đã hủy','Đang chờ thanh toán') NOT NULL DEFAULT 'Đang chờ thanh toán',
  `ngayMua` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `goidangky`
--

INSERT INTO `goidangky` (`idDangKy`, `userID`, `maGoiTap`, `ngayHetHan`, `trangThai`, `ngayMua`) VALUES
(68, 2, 2, '2024-12-11', 'Hết hạn', '2024-12-12'),
(69, 1, 1, '2025-01-12', 'Đang hoạt động', '2024-12-12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `goitap`
--

CREATE TABLE `goitap` (
  `maGoiTap` int(11) NOT NULL,
  `tenGoiTap` varchar(255) NOT NULL,
  `thoiHan` int(11) NOT NULL,
  `gia` decimal(10,2) NOT NULL,
  `moTa` text DEFAULT NULL,
  `anhGoiTap` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `goitap`
--

INSERT INTO `goitap` (`maGoiTap`, `tenGoiTap`, `thoiHan`, `gia`, `moTa`, `anhGoiTap`) VALUES
(1, 'Gói Tập Cơ Bản', 1, 300000.00, 'Gói tập cơ bản dành cho người mới bắt đầu, giúp làm quen với các thiết bị và bài tập nhẹ nhàng.', 'asset/image/basic-package.jpg'),
(2, 'Gói Tập Nâng Cao', 3, 800000.00, 'Gói tập nâng cao cho những người có kinh nghiệm, bao gồm các bài tập chuyên sâu và sử dụng thiết bị nâng cao.', 'asset/image/basic-package.jpg'),
(3, 'Gói Tập Giảm Cân', 2, 600000.00, 'Gói tập tập trung vào giảm cân, kết hợp giữa cardio và các bài tập giúp đốt mỡ.', 'asset/image/basic-package.jpg'),
(4, 'Gói Tập Tăng Cơ', 6, 1500000.00, 'Gói tập dành cho những ai muốn tăng cơ bắp, bao gồm các bài tập sức mạnh và chế độ dinh dưỡng đi kèm.', 'asset/image/basic-package.jpg'),
(5, 'Gói Tập Yoga', 1, 400000.00, 'Gói tập Yoga giúp tăng cường sự linh hoạt và cải thiện sức khỏe tổng thể.', 'asset/image/basic-package.jpg'),
(6, 'Gói Tập Boxing', 2, 500000.00, 'Gói tập Boxing giúp cải thiện thể lực, sự nhanh nhẹn và giảm căng thẳng.', 'asset/image/basic-package.jpg');

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
  `ngayThanhToan` date DEFAULT NULL,
  `trangThai` enum('Đã thanh toán','Chưa thanh toán') NOT NULL DEFAULT 'Chưa thanh toán'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `hoadon`
--

INSERT INTO `hoadon` (`maHoaDon`, `idDangKy`, `ngayTao`, `phuongThucThanhToan`, `soTien`, `maKhuyenMai`, `ngayThanhToan`, `trangThai`) VALUES
(66, 68, '2024-12-12', 'Chuyển khoản', 680000.00, 2, '2024-12-12', 'Đã thanh toán'),
(67, 69, '2024-12-12', 'Tiền mặt', 270000.00, 1, '2024-12-12', 'Đã thanh toán');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyenmai`
--

CREATE TABLE `khuyenmai` (
  `maKhuyenMai` int(11) NOT NULL,
  `giamGia` decimal(5,2) NOT NULL,
  `ngayBatDau` date NOT NULL,
  `ngayKetThuc` date NOT NULL,
  `moTa` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `khuyenmai`
--

INSERT INTO `khuyenmai` (`maKhuyenMai`, `giamGia`, `ngayBatDau`, `ngayKetThuc`, `moTa`) VALUES
(1, 10.00, '2024-11-01', '2024-12-31', 'Giảm 10% toàn bộ gói tập'),
(2, 15.00, '2024-12-01', '2024-12-31', 'Giảm 15% gói nâng cao'),
(3, 20.00, '2024-10-15', '2024-10-31', 'Giảm 20% gói Yoga');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyenmai_goitap`
--

CREATE TABLE `khuyenmai_goitap` (
  `maKhuyenMai` int(11) NOT NULL,
  `maGoiTap` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `khuyenmai_goitap`
--

INSERT INTO `khuyenmai_goitap` (`maKhuyenMai`, `maGoiTap`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(2, 2),
(3, 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lichlamviec`
--

CREATE TABLE `lichlamviec` (
  `maLich` int(11) NOT NULL,
  `ngayBatDau` date NOT NULL,
  `caLamViec` enum('Ca sáng','Ca chiều') DEFAULT NULL,
  `ngayLamViec` date NOT NULL,
  `userID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `lichlamviec`
--

INSERT INTO `lichlamviec` (`maLich`, `ngayBatDau`, `caLamViec`, `ngayLamViec`, `userID`) VALUES
(6, '2024-12-09', 'Ca sáng', '2024-12-09', 11),
(7, '2024-12-09', 'Ca sáng', '2024-12-09', 12),
(8, '2024-12-09', 'Ca chiều', '2024-12-09', 13),
(9, '2024-12-09', 'Ca chiều', '2024-12-09', 14),
(10, '2024-12-09', 'Ca chiều', '2024-12-09', 23),
(11, '2024-12-10', 'Ca sáng', '2024-12-10', 13),
(12, '2024-12-10', 'Ca sáng', '2024-12-10', 14),
(13, '2024-12-10', 'Ca chiều', '2024-12-10', 23),
(14, '2024-12-10', 'Ca chiều', '2024-12-10', 24),
(15, '2024-12-10', 'Ca chiều', '2024-12-10', 11),
(16, '2024-12-11', 'Ca sáng', '2024-12-11', 23),
(17, '2024-12-11', 'Ca sáng', '2024-12-11', 24),
(18, '2024-12-11', 'Ca chiều', '2024-12-11', 11),
(19, '2024-12-11', 'Ca chiều', '2024-12-11', 12),
(20, '2024-12-11', 'Ca chiều', '2024-12-11', 13),
(21, '2024-12-12', 'Ca sáng', '2024-12-12', 11),
(22, '2024-12-12', 'Ca sáng', '2024-12-12', 12),
(23, '2024-12-12', 'Ca chiều', '2024-12-12', 14),
(24, '2024-12-12', 'Ca chiều', '2024-12-12', 23),
(25, '2024-12-12', 'Ca chiều', '2024-12-12', 24),
(26, '2024-12-13', 'Ca sáng', '2024-12-13', 14),
(27, '2024-12-13', 'Ca sáng', '2024-12-13', 11),
(28, '2024-12-13', 'Ca chiều', '2024-12-13', 12),
(29, '2024-12-13', 'Ca chiều', '2024-12-13', 13),
(30, '2024-12-13', 'Ca chiều', '2024-12-13', 23),
(31, '2024-12-14', 'Ca sáng', '2024-12-14', 24),
(32, '2024-12-14', 'Ca sáng', '2024-12-14', 11),
(33, '2024-12-14', 'Ca chiều', '2024-12-14', 12),
(34, '2024-12-14', 'Ca chiều', '2024-12-14', 13),
(35, '2024-12-14', 'Ca chiều', '2024-12-14', 14),
(36, '2024-12-15', 'Ca sáng', '2024-12-15', 11),
(37, '2024-12-15', 'Ca sáng', '2024-12-15', 12),
(38, '2024-12-15', 'Ca chiều', '2024-12-15', 23),
(39, '2024-12-15', 'Ca chiều', '2024-12-15', 24),
(40, '2024-12-15', 'Ca chiều', '2024-12-15', 14),
(41, '2024-12-16', 'Ca sáng', '2024-12-16', 13),
(42, '2024-12-16', 'Ca sáng', '2024-12-16', 14),
(43, '2024-12-16', 'Ca chiều', '2024-12-16', 11),
(44, '2024-12-16', 'Ca chiều', '2024-12-16', 12),
(45, '2024-12-16', 'Ca chiều', '2024-12-16', 23),
(46, '2024-12-17', 'Ca sáng', '2024-12-17', 23),
(47, '2024-12-17', 'Ca sáng', '2024-12-17', 24),
(48, '2024-12-17', 'Ca chiều', '2024-12-17', 11),
(49, '2024-12-17', 'Ca chiều', '2024-12-17', 12),
(50, '2024-12-17', 'Ca chiều', '2024-12-17', 13),
(51, '2024-12-18', 'Ca sáng', '2024-12-18', 11),
(52, '2024-12-18', 'Ca sáng', '2024-12-18', 12),
(53, '2024-12-18', 'Ca chiều', '2024-12-18', 14),
(54, '2024-12-18', 'Ca chiều', '2024-12-18', 23),
(55, '2024-12-18', 'Ca chiều', '2024-12-18', 24),
(56, '2024-12-19', 'Ca sáng', '2024-12-19', 14),
(57, '2024-12-19', 'Ca sáng', '2024-12-19', 11),
(58, '2024-12-19', 'Ca chiều', '2024-12-19', 12),
(59, '2024-12-19', 'Ca chiều', '2024-12-19', 13),
(60, '2024-12-19', 'Ca chiều', '2024-12-19', 23),
(61, '2024-12-20', 'Ca sáng', '2024-12-20', 24),
(62, '2024-12-20', 'Ca sáng', '2024-12-20', 11),
(63, '2024-12-20', 'Ca chiều', '2024-12-20', 12),
(64, '2024-12-20', 'Ca chiều', '2024-12-20', 13),
(65, '2024-12-20', 'Ca chiều', '2024-12-20', 14),
(66, '2024-12-21', 'Ca sáng', '2024-12-21', 11),
(67, '2024-12-21', 'Ca sáng', '2024-12-21', 12),
(68, '2024-12-21', 'Ca chiều', '2024-12-21', 23),
(69, '2024-12-21', 'Ca chiều', '2024-12-21', 24),
(70, '2024-12-21', 'Ca chiều', '2024-12-21', 14);

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
  `vaiTro` enum('Admin','NVQuay','NVBaoTri','ThanhVien','NVHuongDanVien') NOT NULL,
  `hinhAnh` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nguoidung`
--

INSERT INTO `nguoidung` (`userID`, `hoTen`, `sdt`, `ngaySinh`, `email`, `matKhau`, `vaiTro`, `hinhAnh`, `token`) VALUES
(1, 'Nguyen Thi Mai', '0901234567', '1998-05-10', 'mai@example.com', 'password1', 'ThanhVien', '', ''),
(2, 'Tran Minh Tuan', '0902345678', '1995-07-21', 'tuan@example.com', 'password2', 'ThanhVien', '', ''),
(3, 'Le Thi Lan', '0903456789', '1993-08-15', 'lan@example.com', 'password3', 'ThanhVien', '', ''),
(4, 'Nguyen Quang Hieu', '0904567890', '1996-09-30', 'hieu@example.com', 'password4', 'ThanhVien', '', ''),
(5, 'Pham Thanh Son', '0905678901', '1997-01-12', 'son@example.com', 'password5', 'ThanhVien', '', ''),
(6, 'Bui Minh Anh', '0906789012', '1999-11-18', 'anh@example.com', 'password6', 'ThanhVien', '', ''),
(7, 'Vu Hoang Nam', '0907890123', '1994-04-05', 'nam@example.com', 'password7', 'ThanhVien', '', ''),
(8, 'Phan Minh Tien', '0908901234', '1995-12-22', 'tien@example.com', 'password8', 'ThanhVien', '', ''),
(9, 'Trinh Thi Mai', '0909012345', '1992-03-28', 'mai2@example.com', 'password9', 'ThanhVien', '', ''),
(10, 'Dang Minh Thu', '0900123456', '1998-06-02', 'thu@example.com', 'password10', 'ThanhVien', '', ''),
(11, 'Nguyen Thi Bao', '0912345678', '1990-05-15', 'bao@example.com', 'passwordnvq1', 'NVQuay', '', ''),
(12, 'Tran Minh Tam', '0913456789', '1989-08-20', 'tam@example.com', 'passwordnvq2', 'NVQuay', '', ''),
(13, 'Le Thi Lan', '0914567890', '1991-11-05', 'lan2@example.com', 'passwordnvq3', 'NVQuay', '', ''),
(14, 'Nguyen Hoang Son', '0915678901', '1992-02-25', 'son2@example.com', 'passwordnvq4', 'NVQuay', '', ''),
(15, 'Pham Minh Tu', '0923456789', '1987-04-10', 'tu@example.com', 'passwordnvbt1', 'NVBaoTri', '', ''),
(16, 'Bui Thi Lan', '0924567890', '1990-03-18', 'lan3@example.com', 'passwordnvbt2', 'NVBaoTri', '', ''),
(17, 'Nguyen Thi Lan', '0987654321', '1985-06-15', 'admin@example.com', 'passwordadmin', 'Admin', '', ''),
(18, 'Nguyen Minh Tu', '0933456789', '1991-10-05', 'tu2@example.com', 'passwordnvhd1', '', '', ''),
(19, 'Tran Thi Bao', '0934567890', '1988-12-17', 'bao2@example.com', 'passwordnvhd2', '', '', ''),
(20, 'Nguyen Tien Manh', '0906512692', '2003-05-24', 'tienmanh0167@gmail.com', '$2y$10$3J19ZnxNva8Txxeg19CtQ.BecXV0r.uFBogQjZ5QTfsCcaxJR6GHC', 'ThanhVien', '', ''),
(21, 'Le Minh', '0906512698', '2003-05-24', 'leminh0000@gmail.com', '$2y$10$g77aAZ.4WOYQWQKBMjh3geRvxYh3F78oIhA.zygB0pWNXQt7MK9nO', 'ThanhVien', '', ''),
(23, 'Nguyễn Đình Tấn', '0385743450', '1990-05-15', 'a.nguyen@example.com', 'password123', 'NVQuay', '', ''),
(24, 'Trần Thị Tuyết Mai', '0906512699', '1992-08-20', 'b.tran@example.com', 'password456', 'NVQuay', '', '');

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
(14),
(23),
(24);

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
  `userID` int(11) DEFAULT NULL,
  `ngayTao` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(10, '2024-11-18'),
(20, '2024-11-19'),
(21, '2024-11-20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thietbi`
--

CREATE TABLE `thietbi` (
  `maThietBi` int(11) NOT NULL,
  `tenThietBi` varchar(255) NOT NULL,
  `ngayMua` date DEFAULT NULL,
  `trangthai` enum('Đang sử dụng','Hỏng','Bảo trì','Không sử dụng') NOT NULL,
  `hinhAnh` varchar(255) DEFAULT NULL
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
-- Chỉ mục cho bảng `khuyenmai_goitap`
--
ALTER TABLE `khuyenmai_goitap`
  ADD PRIMARY KEY (`maKhuyenMai`,`maGoiTap`),
  ADD KEY `maGoiTap` (`maGoiTap`);

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
  MODIFY `idDangKy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT cho bảng `goitap`
--
ALTER TABLE `goitap`
  MODIFY `maGoiTap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `maHoaDon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  MODIFY `maKhuyenMai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `lichlamviec`
--
ALTER TABLE `lichlamviec`
  MODIFY `maLich` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT cho bảng `lichsuhoatdong`
--
ALTER TABLE `lichsuhoatdong`
  MODIFY `IDHoatDong` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
-- Các ràng buộc cho bảng `khuyenmai_goitap`
--
ALTER TABLE `khuyenmai_goitap`
  ADD CONSTRAINT `khuyenmai_goitap_ibfk_1` FOREIGN KEY (`maKhuyenMai`) REFERENCES `khuyenmai` (`maKhuyenMai`),
  ADD CONSTRAINT `khuyenmai_goitap_ibfk_2` FOREIGN KEY (`maGoiTap`) REFERENCES `goitap` (`maGoiTap`);

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
