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
    <!-- css -->
    <style>
        table.table td {
        vertical-align: middle; /* Căn giữa theo chiều dọc */
        }    
    </style>
</head>
<body>
    <?php require_once('../views/Admin/layout/header.php'); ?>

    <?php require_once('../views/Admin/layout/sidebar.php'); ?>

    <?php require_once('../views/Admin/layout/spinner.php'); ?>
    <div class="container-fluid pt-4 px-4 my-1">
        <h2 class="mb-4">Báo Cáo Thiết Bị</h2>

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <!-- Tìm kiếm thiết bị -->
        <div class="mb-3" style="flex-grow: 1; max-width: 600px; padding-left: 10px;">
            <input type="text" id="searchInput" class="form-control" placeholder="Tìm kiếm thiết bị theo tên/mã thiết bị/trạng thái bảo trì">
        </div>
    </div>
        <!-- Bảng danh sách thiết bị -->
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th>Mã Thiết Bị</th>
                    <th>Tên Thiết Bị</th>
                    <th>Hình Ảnh</th>
                    <th>Trạng Thái Hoạt Động</th>
                    <th>Trạng Thái Bảo Trì</th>
                    <th>Số Lần Bảo Trì</th>
                    <th>Ngày Bảo Trì Gần Nhất</th>
                </tr>
            </thead>
            <tbody id="customerTable">
                <?php foreach ($members as $member): ?>
                    <tr data-id="<?= $member['maThietBi'] ?>">
                        <td><?= $member['maThietBi'] ?></td>
                        <td><?= $member['tenThietBi'] ?></td>
                        <td>
                        <img src="/GYM-WEB/asset/image/<?= $member['hinhAnh'] ?>" alt="Hình Ảnh" width="100" height="100">
                        </td>
                        <td><?= $member['trangthai'] ?></td>
                        <td><?= $member['trangThaiBaoTri'] ?></td>
                        <td><?= $member['soLanBaoTri'] ?></td>
                        <td><?= $member['ngayBaoTriGanNhat'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- Phân trang -->
        <div id="pagination" class="d-flex justify-content-center">
            <a href="/GYM-WEB/public/Admin/baoCaoThietBi?page=<?= max(1, $currentPage - 1) ?>" class="btn btn-secondary">Trang Trước</a>
            <span class="mx-3">Trang <?= $currentPage ?> / <?= $totalPages ?></span>
            <a href="/GYM-WEB/public/Admin/baoCaoThietBi?page=<?= min($totalPages, $currentPage + 1) ?>" class="btn btn-secondary">Trang Tiếp</a>
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
<!-- JavaScript cho tìm kiếm thiết bị -->
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
                const idEquip = row.getElementsByTagName("td")[0];  // Cột ID thiết bị
                const nameCell = row.getElementsByTagName("td")[1];  // Cột tên thiết bị
                const statusCell = row.getElementsByTagName("td")[4];  // Cột trạng thái bảo trì

                if (idEquip || nameCell || statusCell) {
                    const id = idEquip.textContent.toLowerCase();  // Lấy mã thiết bị và chuyển thành chữ thường
                    const name = nameCell.textContent.toLowerCase();  // Lấy tên thiết bị và chuyển thành chữ thường
                    const status = statusCell.textContent.toLowerCase();  // Lấy trạng thái bảo trì và chuyển thành chữ thường

                    // Kiểm tra nếu từ khóa tìm kiếm có trong ID và Tên thiết bị/Trạng thái bảo trì
                    if (id.includes(searchValue) || name.includes(searchValue) || status.includes(searchValue)) {
                        row.style.display = "";  // Hiển thị dòng
                    } else {
                        row.style.display = "none";  // Ẩn dòng nếu không khớp
                    }
                }
            });
        });
    </script>

</html>
