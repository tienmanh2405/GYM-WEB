<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DarkPan - Bootstrap 5 Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <base href="/GYM-WEB/">
    <!-- Favicon -->
    <link href="asset/image/favicon.ico" rel="icon">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link href="asset/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="asset/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <!-- Customized Bootstrap Stylesheet -->
    <link href="asset/css/bootstrap.min.css" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="asset/css/style.css" rel="stylesheet">
</head>

<body>
    <?php require_once('../views/Admin/layout/header.php'); ?>
    <?php require_once('../views/Admin/layout/sidebar.php'); ?>
    <?php require_once('../views/Admin/layout/spinner.php'); ?>

    <div class="container mt-5">
        <h2>Danh sách khuyến mãi</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
            Thêm Khuyến Mãi
        </button>
        <table class="table">
            <thead>
                <tr>
                    <th>Mã Khuyến Mãi</th>
                    <th>Áp dụng cho gói</th>
                    <th>Giảm Giá</th>
                    <th>Ngày Bắt Đầu</th>
                    <th>Ngày Kết Thúc</th>
                    <th>Mô tả</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($khuyenMais as $khuyenMai): ?>
                <tr>
                    <td><?php echo $khuyenMai['maKhuyenMai']; ?></td>
                    <td><?php echo $khuyenMai['maGoiTap']; ?></td>
                    <td><?php echo $khuyenMai['giamGia']; ?></td>
                    <td><?php echo $khuyenMai['ngayBatDau']; ?></td>
                    <td><?php echo $khuyenMai['ngayKetThuc']; ?></td>
                    <td><?php echo $khuyenMai['moTa']; ?></td>
                    <td>
                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $khuyenMai['maKhuyenMai']; ?>">Sửa</button>
                        <a href="<?php echo BASE_URL . 'NV_BaoTri/quanlykhuyenmai/delete/' . $khuyenMai['maKhuyenMai']; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa không?');">Xóa</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Thêm Khuyến Mãi -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Thêm Khuyến Mãi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="<?php echo BASE_URL . 'Admin/quanlykhuyenmai/create'; ?>" onsubmit="return validateInput(event)">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="maKhuyenMai" class="form-label">Mã Khuyến Mãi</label>
                            <input type="text" class="form-control" name="maKhuyenMai" required>
                        </div>
                        <div class="mb-3">
                            <label for="maGoiTap" class="form-label">Mã Gói Tập</label>
                            <select class="form-select" name="maGoiTap" required>
                                <option value="">Chọn mã gói tập</option>
                                <?php foreach ($maGoiTapList as $goiTap): ?>
                                <option value="<?php echo $goiTap['maGoiTap']; ?>"><?php echo $goiTap['maGoiTap']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="giamGia" class="form-label">Giảm Giá</label>
                            <input type="number" class="form-control" name="giamGia" required>
                        </div>
                        <div class="mb-3">
                            <label for="ngayBatDau" class="form-label">Ngày Bắt Đầu</label>
                            <input type="date" class="form-control" name="ngayBatDau" required>
                        </div>
                        <div class="mb-3">
                            <label for="ngayKetThuc" class="form-label">Ngày Kết Thúc</label>
                            <input type="date" class="form-control" name="ngayKetThuc" required>
                        </div>
                        <div class="mb-3">
                            <label for="moTa" class="form-label">Mô Tả</label>
                            <input type="text" class="form-control" name="moTa" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Thêm Khuyến Mãi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal sửa -->
    <?php foreach ($khuyenMais as $khuyenMai): ?>
    <div class="modal fade" id="editModal<?php echo $khuyenMai['maKhuyenMai']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Sửa Khuyến Mãi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="<?php echo BASE_URL . 'Admin/quanlykhuyenmai/update'; ?>" onsubmit="return validateInput(event)">
                    <div class="modal-body">
                        <input type="hidden" name="maKhuyenMai" value="<?php echo $khuyenMai['maKhuyenMai']; ?>">
                        <div class="mb-3">
                            <label for="maGoiTap" class="form-label">Mã Gói Tập</label>
                            <select class="form-select" name="maGoiTap" required>
                                <option value="">Chọn mã gói tập</option>
                                <?php foreach ($maGoiTapList as $goiTap): ?>
                                <option value="<?php echo $goiTap['maGoiTap']; ?>"
                                    <?php echo (in_array($goiTap['maGoiTap'], explode(',', $khuyenMai['maGoiTap']))) ? 'selected' : ''; ?>>
                                    <?php echo $goiTap['maGoiTap']; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="giamGia" class="form-label">Giảm Giá</label>
                            <input type="number" class="form-control" name="giamGia" value="<?php echo $khuyenMai['giamGia']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="ngayBatDau" class="form-label">Ngày Bắt Đầu</label>
                            <input type="date" class="form-control" name="ngayBatDau" value="<?php echo $khuyenMai['ngayBatDau']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="ngayKetThuc" class="form-label">Ngày Kết Thúc</label>
                            <input type="date" class="form-control" name="ngayKetThuc" value="<?php echo $khuyenMai['ngayKetThuc']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="moTa" class="form-label">Mô Tả</label>
                            <input type="text" class="form-control" name="moTa" value="<?php echo $khuyenMai['moTa']; ?>" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <!-- JavaScript kiểm tra -->
    <script>
        function validateInput(event) {
            const form = event.target;
            const startDate = new Date(form.ngayBatDau.value);
            const endDate = new Date(form.ngayKetThuc.value);
            const discount = parseFloat(form.giamGia.value); // Lấy giá trị giảm giá và chuyển đổi thành số

            // Kiểm tra ngày
            if (startDate > endDate) {
                alert('Ngày kết thúc không thể thấp hơn ngày bắt đầu. Vui lòng kiểm tra lại.');
                return false;
            }

            // Kiểm tra giá trị giảm giá
            if (discount < 1 || discount > 100) {
                alert('Giảm giá phải nằm trong khoảng từ 1% đến 100%. Vui lòng kiểm tra lại.');
                return false;
            }
            return true;
        }
    </script>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="asset/lib/chart/chart.min.js"></script>
    <script src="asset/lib/easing/easing.min.js"></script>
    <script src="asset/lib/waypoints/waypoints.min.js"></script>
    <script src="asset/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="asset/lib/tempusdominus/js/moment.min.js"></script>
    <script src="asset/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="asset/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Template Javascript -->
    <script src="asset/js/main.js"></script>
</body>

</html>
