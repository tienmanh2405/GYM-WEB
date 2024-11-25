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
        <h2 class="mb-4">Quản Lý Thiết Bị</h2>

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <!-- Tìm kiếm thiết bị -->
        <div class="mb-3" style="flex-grow: 1; max-width: 600px; padding-left: 10px;">
            <input type="text" id="searchInput" class="form-control" placeholder="Tìm kiếm thiết bị theo tên hoặc mã thiết bị">
        </div>
        <!-- Button hiển thị modal thêm thiết bị-->
            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addEquipmentModal">Thêm Thiết Bị Mới</button>
    </div>
        <!-- Bảng danh sách thiết bị -->
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th>Mã Thiết Bị</th>
                    <th>Tên Thiết Bị</th>
                    <th>Ngày Mua</th>
                    <th>Trạng Thái</th>
                    <th>Hình Ảnh</th>
                    <th>Thao Tác</th>
                </tr>
            </thead>
            <tbody id="customerTable">
                <?php foreach ($members as $member): ?>
                    <tr data-id="<?= $member['maThietBi'] ?>">
                        <td><?= $member['maThietBi'] ?></td>
                        <td><?= $member['tenThietBi'] ?></td>
                        <td><?= $member['ngayMua'] ?></td>
                        <td><?= $member['trangthai'] ?></td>
                        <td>
                        <img src="/GYM-WEB/asset/image/<?= $member['hinhAnh'] ?>" alt="Hình Ảnh" width="100" height="100">
                        </td>
                        <td class="text-center">
                            <!-- button mở modal sửa thông tin nhân viên -->
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#updateEquipmentModal" data-id="<?= $member['maThietBi']?>">Sửa</button>
                            <!-- nút xóa nhân viên -->
                             <button type="button" class="btn btn-danger"  onclick="deleteThietBi(<?= $member['maThietBi']?>)">Xóa</button>                        
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- Phân trang -->
        <div id="pagination" class="d-flex justify-content-center">
            <a href="/GYM-WEB/public/Admin/thietBi?page=<?= max(1, $currentPage - 1) ?>" class="btn btn-secondary">Trang Trước</a>
            <span class="mx-3">Trang <?= $currentPage ?> / <?= $totalPages ?></span>
            <a href="/GYM-WEB/public/Admin/thietBi?page=<?= min($totalPages, $currentPage + 1) ?>" class="btn btn-secondary">Trang Tiếp</a>
        </div>
    </div>

<!-- Modal Thêm Thiết Bị -->
<div class="modal fade" id="addEquipmentModal" tabindex="-1" aria-labelledby="addEquipmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEquipmentModalLabel">Thêm Thiết Bị Mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addEquipmentForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tenThietBi" class="form-label">Tên Thiết Bị</label>
                        <input type="text" class="form-control" style="color: white;" id="tenThietBi" name="tenThietBi" required>
                    </div>
                    <div class="mb-3">
                        <label for="ngayMua" class="form-label">Ngày Mua</label>
                        <input type="date" class="form-control" style="color: white;" id="ngayMua" name="ngayMua" required>
                    </div>
                     <div class="mb-3">
                        <label for="trangthai" class="form-label">Trạng Thái</label>
                        <select class="form-select" style="color: white;" id="trangthai" name="trangthai" required>
                            <option value="">Chọn trạng thái</option>
                            <option value="Đang sử dụng">Đang sử dụng</option>
                            <option value="Hỏng">Hỏng</option>
                            <option value="Bảo trì">Bảo trì</option>
                            <option value="Không sử dụng">Không sử dụng</option>
                        </select>
                    </div>
                    <!-- form thêm hình ảnh cho cột hinhAnh định dạng là jpg, jpeg, png -->
                     <div class="mb-3">
                        <label for="hinhAnh" class="form-label">Hình ảnh</label>
                        <input type="file" class="form-control" style="color: white;" id="hinhAnh" name="hinhAnh" required>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-success">Thêm Thiết Bị</button>
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
        document.getElementById('addEquipmentForm').addEventListener('submit', function (e) {
            e.preventDefault();

            // Lấy giá trị từ form
            const tenThietBi = document.getElementById('tenThietBi').value.trim();
            const ngayMua = document.getElementById('ngayMua');
            const trangThai = document.getElementById('trangthai');
            const hinhAnh = document.getElementById('hinhAnh');
            
            

            // Kiểm tra dữ liệu nhập (tên thiết bị không được trống, ngày mua phải nhỏ hơn hoặc bằng ngày hiện tại, trạng thái không được trống, hình ảnh chỉ được các dạng jpg/png/jpeg)
            if (!tenThietBi) {
                alert('Vui lòng nhập tên thiết bị.');
                return;
            }
            
            const ngayMuaDate = new Date(ngayMua.valueAsDate);
            ngayMuaDate.setHours(0, 0, 0, 0); // Đặt giờ về 00:00:00 để chỉ tính ngày

            // Chuẩn hóa ngày, tháng, năm cho ngày hiện tại
            const today = new Date();
            today.setHours(0, 0, 0, 0); // Đặt giờ về 00:00:00 để chỉ tính ngày

            if (ngayMuaDate > today) {
                alert('Ngày mua phải bé hơn hoặc bằng ngày hiện tại.');
                return;
            }

            
            if (!trangThai) {
                alert('Vui lòng chọn trạng thái.');
                return;
            }
            //hình ảnh không được trống
            //hình ảnh chỉ được các dạng jpg/png/jpeg
            if (!hinhAnh ||/image\/(jpeg|png|jpg)$/.test(hinhAnh.type)) {
                alert('Hình ảnh phải có dạng jpg/png/jpeg.');
                return;
            }
            
            
        
            const formData = new FormData(this);
            fetch('models/handle_ThietBi_add.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Thiết bị đã được thêm thành công!');
                    location.reload(); // Tải lại trang để cập nhật danh sách
                } else {
                    alert('Có lỗi xảy ra, vui lòng thử lại.');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>

    <!-- xóa thiết bị -->
<script>
    function deleteThietBi(maThietBi) {
        // Xác nhận xóa thiết bị
        if (confirm('Bạn có chắc chắn muốn xóa thiết bị này?')) {
            // Gọi đến file xóa thiết bị (thay đổi đường dẫn theo yêu cầu của bạn)
            fetch('models/handle_ThietBi_delete.php',{
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'idThietBi=' + maThietBi,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Nếu xóa thành công, ẩn dòng của thiết bị trong bảng
                    document.querySelector(`tr[data-id="${maThietBi}"]`).style.display = 'none';
                    alert('Đã xóa thành công thiết bị');
                } else {
                    // Nếu xóa không thành công, hiển thị thông báo lỗi
                    alert('Đã xảy ra lỗi khi xóa thiết bị.');
                }
            })
            .catch(error => {
                // Nếu có lỗi khi gọi API, hiển thị thông báo lỗi
                alert('Đã xảy ra lỗi khi xóa thiết bị.');
            });
        }
    }
</script>
</html>
