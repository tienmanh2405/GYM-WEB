<!-- <?php ?> -->
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
    <link href="../asset/image/favicon.ico" rel="icon">

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
    <div class="container-fluid pt-4 px-4 my-1">
        <h2 class="mb-4">Báo Cáo Doanh Thu</h2>

        <div style="display: flex; justify-content: space-between; align-items: center;">
        <!-- Tìm kiếm gói tập -->
        <div class="mb-3" style="flex-grow: 1; max-width: 600px; padding-left: 10px;">
            <input type="text" id="searchInput" class="form-control" placeholder="Tìm kiếm gói tập theo tên hoặc mã gói tập">
        </div>
        <!-- Button chuyển sang trang thêm gói tập mới-->
        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addGoiTapModal">Thêm Gói Tập Mới</button>
        </div>

        <!-- Bảng doanh thu -->
        <table class="table table-striped text-center">
    <thead>
        <tr>
            <th>Ngày thanh toán</th>
            <th>Tên Khách hàng</th>
            <th>Gói đăng ký</th>
            <th>Đơn giá</th>
            <th>Tổng tiền</th>
        </tr>
    </thead>
    <tbody id="customerTable">
        <?php foreach ($members as $member): ?>
            <tr data-id="<?= $member['maHoaDon'] ?>">
                <td><?= date('d/m/Y', strtotime($member['ngayThanhToan'])) ?></td>
                <td><?= htmlspecialchars($member['tenKhachHang']) ?></td>
                <td><?= htmlspecialchars($member['tenGoiTap']) ?></td>
                <td><?= number_format($member['donGia'], 0, '.', '.') ?>₫</td>
                <td><?= number_format($member['tongTien'], 0, '.', '.') ?>₫</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

        <!-- Phân trang -->
        <div id="pagination" class="d-flex justify-content-center">
            <a href="/GYM-WEB/public/Admin/goiTap?page=<?= max(1, $currentPage - 1) ?>" class="btn btn-secondary">Trang Trước</a>
            <span class="mx-3">Trang <?= $currentPage ?> / <?= $totalPages ?></span>
            <a href="/GYM-WEB/public/Admin/goiTap?page=<?= min($totalPages, $currentPage + 1) ?>" class="btn btn-secondary">Trang Tiếp</a>
        </div>
    </div>


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
</body>
<!-- Template Javascript -->
<script src="asset/js/main.js"></script>
<!-- JavaScript cho tìm kiếm gói tập -->
    <script>
        // Lấy các phần tử từ HTML
        const searchInput = document.getElementById("searchInput");
        const customerTable = document.getElementById("customerTable");

        // Lắng nghe sự kiện tìm kiếm
        searchInput.addEventListener("keyup", function() {
            const searchValue = searchInput.value.toLowerCase();  // Lấy giá trị tìm kiếm và chuyển thành chữ thường
            const rows = customerTable.getElementsByTagName("tr");  // Lấy tất cả các dòng trong bảng

            // Lặp qua từng dòng và kiểm tra nội dung
            Array.from(rows).forEach(row => {
                const phoneCell = row.getElementsByTagName("td")[3];  // Cột Số Điện Thoại

                if (phoneCell) {
                    const phone = phoneCell.textContent.toLowerCase();  // Lấy số điện thoại và chuyển thành chữ thường

                    // Kiểm tra nếu từ khóa tìm kiếm có trong số điện thoại
                    if (phone.includes(searchValue)) {
                        row.style.display = "";  // Hiển thị dòng
                    } else {
                        row.style.display = "none";  // Ẩn dòng nếu không khớp
                    }
                }
            });
        });
    </script>


<script>

</script>
</html>
