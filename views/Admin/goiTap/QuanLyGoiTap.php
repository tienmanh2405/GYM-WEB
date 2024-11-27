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
        <h2 class="mb-4">Quản Lý Gói Tập</h2>

        <div style="display: flex; justify-content: space-between; align-items: center;">
        <!-- Tìm kiếm gói tập -->
        <div class="mb-3" style="flex-grow: 1; max-width: 600px; padding-left: 10px;">
            <input type="text" id="searchInput" class="form-control" placeholder="Tìm kiếm gói tập theo tên hoặc mã gói tập">
        </div>
        <!-- Button mở modal thêm gói tập mới-->
        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addGoiTapModal">Thêm Gói Tập Mới</button>
        </div>

        <!-- Bảng danh sách khách hàng -->
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th>Mã Gói Tập</th>
                    <th>Tên Gói Tập</th>
                    <th>Thời Hạn (Tháng)</th>
                    <th>Giá (VND)</th>
                    <th>Mô Tả</th>
                    <th>Thao Tác</th>
                </tr>
            </thead>
            <tbody id="customerTable">
                <?php foreach ($members as $member): ?>
                    <tr data-id="<?= $member['maGoiTap'] ?>">
                        <td><?= $member['maGoiTap'] ?></td>
                        <td><?= $member['tenGoiTap'] ?></td>
                        <td><?= $member['thoiHan'] ?></td>
                        <td><?= number_format($member['gia'], 0, '.', '.')?></td>
                        <td><?= $member['moTa'] ?></td>
                        <!-- <td class="status"><?= $member['vaiTro'] ?></td> -->
                        <td class="text-center">
                            <!-- button mở modal sửa thông tin gói tập -->
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#updateEquipmentModal" data-id="<?= $member['maGoiTap']?>">Sửa</button>
                            <!-- nút xóa gói tập -->
                            <button type="button" class="btn btn-danger"  onclick="deleteGoiTap(<?= $member['maGoiTap']?>)">Xóa</button>                         
                        </td>
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

<!-- Modal Thêm gói tập -->
<div class="modal fade" id="addGoiTapModal" tabindex="-1" aria-labelledby="addGoiTapModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addGoiTapModalLabel">Thêm Gói Tập Mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addGoiTapForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tenGoiTap" class="form-label">Tên Gói Tập</label>
                        <input type="text" class="form-control" style="color: white;" id="tenGoiTap" name="tenGoiTap" required>
                    </div>
                    <div class="mb-3">
                        <label for="thoiHan" class="form-label">Thời Hạn (Tháng)</label>
                        <input type="number" class="form-control" style="color: white;" id="thoiHan" name="thoiHan" required>
                    </div>
                    <div class="mb-3">
                        <label for="gia" class="form-label">Giá (VND)</label>
                        <input type="number" class="form-control" style="color: white;" id="gia" name="gia" required>
                    </div>
                    <div class="mb-3">
                        <label for="moTa" class="form-label">Mô Tả</label>
                        <textarea class="form-control" style="color: white;" id="moTa" name="moTa" required></textarea>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-success">Thêm Gói Tập</button>
                </div>
            </form>
        </div>
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
                const idCell = row.getElementsByTagName("td")[0];  // Cột ID
                const nameCell = row.getElementsByTagName("td")[1];  // Cột Tên gói tập

                if (idCell || nameCell) {
                    const id = idCell.textContent.toLowerCase();  // Lấy ID và chuyển thành chữ thường
                    const name = nameCell.textContent.toLowerCase();  // Lấy tên gói tập và chuyển thành chữ thường

                    // Kiểm tra nếu từ khóa tìm kiếm có trong số điện thoại
                    if (id.includes(searchValue) || name.includes(searchValue)) {
                        row.style.display = "";  // Hiển thị dòng
                    } else {
                        row.style.display = "none";  // Ẩn dòng nếu không khớp
                    }
                }
            });
        });
    </script>

<script>
        document.getElementById('addGoiTapForm').addEventListener('submit', function (e) {
            e.preventDefault();

            // Lấy giá trị từ form
            const tenGoiTap = document.getElementById('tenGoiTap').value;
            const thoiHan = document.getElementById('thoiHan').value;
            const gia = document.getElementById('gia').value;
            const mota = document.getElementById('moTa').value;
            

            // Kiểm tra dữ liệu nhập
            if (tenGoiTap === '' || thoiHan === '' || gia === '' || mota === '') {
                alert('Vui lòng nhập đầy đủ thông tin gói tập.');
                return;
            }
            
        
            const formData = new FormData(this);
            fetch('models/handle_GoiTap_add.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Gói tập đã được thêm thành công!');
                    location.reload(); // Tải lại trang để cập nhật danh sách
                } else {
                    alert('Có lỗi xảy ra, vui lòng thử lại.');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>

    <!-- xóa gói tập -->
<script>
    function deleteGoiTap(maGoiTap) {
        // Xác nhận xóa gói tập
        if (confirm('Bạn có chắc chắn muốn xóa gói tập này?')) {
            // Gọi đến file xóa gói tập (thay đổi đường dẫn theo yêu cầu của bạn)
            fetch('models/handle_GoiTap_delete.php',{
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'idGoiTap=' + maGoiTap,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Nếu xóa thành công, ẩn dòng của gói tập trong bảng
                    alert('Đã xóa thành công gói tập');
                    location.reload(); // Tải lại trang để cập nhật danh sách
                } else {
                    // Nếu xóa không thành công, hiển thị thông báo lỗi
                    alert('Đã xảy ra lỗi khi xóa gói tập.');
                }
            })
            .catch(error => {
                // Nếu có lỗi khi gọi API, hiển thị thông báo lỗi
                alert('Đã xảy ra lỗi khi xóa gói tập.');
            });
        }
    }
</script>
</html>
