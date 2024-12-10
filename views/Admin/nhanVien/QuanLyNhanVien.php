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
        <h2 class="mb-4">Quản Lý Nhân Viên</h2>

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <!-- Tìm kiếm nhân viên -->
        <div class="mb-3" style="flex-grow: 1; max-width: 600px; padding-left: 10px;">
            <input type="text" id="searchInput" class="form-control" placeholder="Tìm kiếm nhân viên theo tên hoặc mã nhân viên">
        </div>
        <!-- Button hiển thị modal thêm nhân viên-->
            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addEmployeesModal">Thêm Nhân Viên Mới</button>
    </div>

        <!-- Bảng danh sách nhân viên -->
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th>Mã Nhân viên</th>
                    <th>Tên Nhân viên</th>
                    <th>Email</th>
                    <th>Số Điện Thoại</th>
                    <th>Ngày Sinh</th>
                    <th>Vai Trò</th>
                    <th>Thao Tác</th>
                </tr>
            </thead>
            <tbody id="customerTable">
                <?php foreach ($members as $member): ?>
                    <tr data-id="<?= $member['userID'] ?>">
                        <td><?= $member['userID'] ?></td>
                        <td><?= $member['hoTen'] ?></td>
                        <td><?= $member['email'] ?></td>
                        <td><?= $member['sdt'] ?></td>
                        <td><?= $member['ngaySinh'] ?></td>
                        <td class="status"><?= $member['vaiTro'] ?></td>
                        <td class="text-center">
                            <!-- button mở modal sửa thông tin nhân viên -->
                            <!-- <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editEmployeesModal" data-id="<?= $member['userID']?>">Sửa</button> -->
                            <button class="btn btn-info btn-editNhanVien" data-id="<?= $member['userID'] ?>" data-hoTen="<?= $member['hoTen'] ?>" data-email="<?= $member['email'] ?>" data-sdt="<?= $member['sdt'] ?>" data-ngaySinh="<?= $member['ngaySinh'] ?>" data-vaiTro="<?= $member['vaiTro'] ?>">Sửa</button>
                            <!-- nút xóa nhân viên -->
                             <button type="button" class="btn btn-danger"  onclick="deleteNhanVien(<?= $member['userID']?>)">Xóa</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Phân trang -->
        <div id="pagination" class="d-flex justify-content-center">
            <a href="/GYM-WEB/public/Admin/nhanVien?page=<?= max(1, $currentPage - 1) ?>" class="btn btn-secondary">Trang Trước</a>
            <span class="mx-3">Trang <?= $currentPage ?> / <?= $totalPages ?></span>
            <a href="/GYM-WEB/public/Admin/nhanVien?page=<?= min($totalPages, $currentPage + 1) ?>" class="btn btn-secondary">Trang Tiếp</a>
        </div>
    </div>

<!-- Modal Thêm Nhân Viên -->
<div class="modal fade" id="addEmployeesModal" tabindex="-1" aria-labelledby="addEmployeesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEmployeesModalLabel">Thêm Nhân Viên Mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addEmployeesForm">
                <input type="hidden" name="form_type" value="add" />
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="hoTen" class="form-label">Họ Tên</label>
                        <input type="text" class="form-control" style="color: white;" id="hoTen" name="hoTen" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" style="color: white;" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="sdt" class="form-label">Số Điện Thoại</label>
                        <input type="text" class="form-control" style="color: white;" id="sdt" name="sdt" required>
                    </div>
                    <div class="mb-3">
                        <label for="ngaySinh" class="form-label">Ngày Sinh</label>
                        <input type="date" class="form-control" style="color: white;" id="ngaySinh" name="ngaySinh" required>
                    </div>
                    <!-- note -->
                     <div class="mb-3">
                        <label for="vaiTro" class="form-label">Vai Trò</label>
                        <select class="form-select" style="color: white;" id="vaiTro" name="vaiTro" required>
                            <option value="">-- Chọn Vai Trò --</option>
                            <option value="NVQuay">Nhân viên Quầy</option>
                            <option value="NVHuongDanVien">Hướng dẫn viên</option>
                            <option value="NVBaoTri">Nhân viên Bảo trì</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="matKhau" class="form-label">Mật Khẩu</label>
                        <input type="password" class="form-control" style="color: white;" id="matKhau" name="matKhau" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-success">Thêm Nhân Viên</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Sửa Thông Tin Nhân Viên -->
<div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editEmployeeForm" method="post">
                <input type="hidden" id="edit-idNhanVien" name="idNhanVien">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEmployeeModalLabel" style="color: black;">Sửa Thông Tin Nhân Viên</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit-hoTen" class="form-label">Họ Tên</label>
                        <input type="text" class="form-control" style="color: white;" id="edit-hoTen" name="hoTen" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-email" class="form-label">Email</label>
                        <input type="email" class="form-control" style="color: white;" id="edit-email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-sdt" class="form-label">Số Điện Thoại</label>
                        <input type="text" class="form-control" style="color: white;" id="edit-sdt" name="sdt" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-ngaySinh" class="form-label">Ngày Sinh</label>
                        <input type="date" class="form-control" style="color: white;" id="edit-ngaySinh" name="ngaySinh" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-vaiTro" class="form-label">Vai Trò</label>
                        <select class="form-select" style="color: white;" id="edit-vaiTro" name="vaiTro" required>
                            <option value="NVQuay">Nhân viên Quầy</option>
                            <option value="NVHuongDanVien">Hướng dẫn viên</option>
                            <option value="NVBaoTri">Nhân viên Bảo trì</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Cập Nhật</button>
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
<!-- JavaScript cho tìm kiếm nhân viên -->
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
                const idCell = row.getElementsByTagName("td")[0];  // Cột mã nhân viên
                const nameCell = row.getElementsByTagName("td")[1];  // Cột tên nhân viên
                // const phoneCell = row.getElementsByTagName("td")[3];  // Cột Số Điện Thoại

                if (idCell || nameCell || phoneCell) {
                    const id = idCell.textContent.toLowerCase();  // Lấy mã nhân viên và chuyển thành chữ thường
                    const name = nameCell.textContent.toLowerCase();  // Lấy tên nhân viên và chuyển thành chữ thường
                    // const phone = phoneCell.textContent.toLowerCase();  // Lấy số điện thoại và chuyển thành chữ thường

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
    
    <!-- Thêm nhân viên -->
    <script>
        //biểu thức chính quy kiểm tra dữ liệu cho addEmployeesForm
        document.getElementById('addEmployeesForm').addEventListener('submit', function (e) {
            e.preventDefault();

            // Lấy giá trị từ form
            const hoTen = document.getElementById('hoTen').value.trim();
            const email = document.getElementById('email').value.trim();
            const sdt = document.getElementById('sdt').value.trim();
            const ngaySinh = document.getElementById('ngaySinh').value;
            const vaiTro = document.getElementById('vaiTro').value;
            const matKhau = document.getElementById('matKhau').value.trim();

            // Kiểm tra dữ liệu nhập
            if (!hoTen) {
                alert('Vui lòng nhập họ tên.');
                return;
            }
        
            if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                alert('Email không hợp lệ.');
                return;
            }
        
            if (!sdt || !/^\d{10}$/.test(sdt)) {
                alert('Số điện thoại phải bao gồm 10 chữ số.');
                return;
            }
        
            if (!ngaySinh) {
                alert('Vui lòng chọn ngày sinh.');
                return;
            }
        
            if (!matKhau || matKhau.length < 6) {
                alert('Mật khẩu phải có ít nhất 6 ký tự.');
                return;
            }
        
            const formData = new FormData(this);
            fetch('models/handle_NhanVien_add.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Nhân viên đã được thêm thành công!');
                    location.reload(); // Tải lại trang để cập nhật danh sách
                } else {
                    alert('Có lỗi xảy ra, vui lòng thử lại.');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>

<!-- Sửa thông tin nhân viên -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.btn-editNhanVien');
    const editForm = document.getElementById('editEmployeeForm');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            document.getElementById('edit-idNhanVien').value = this.dataset.id;
            document.getElementById('edit-hoTen').value = this.dataset.hoten;
            document.getElementById('edit-email').value = this.dataset.email;
            document.getElementById('edit-sdt').value = this.dataset.sdt;
            document.getElementById('edit-ngaySinh').value = this.dataset.ngaysinh;
            document.getElementById('edit-vaiTro').value = this.dataset.vaitro;

            const modal = new bootstrap.Modal(document.getElementById('editEmployeeModal'));
            modal.show();
        });
    });

    editForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(editForm);

        fetch('models/handle_NhanVien_edit.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Cập nhật thành công!');
                location.reload();
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    });
});

</script>
<!-- xóa nhân viên -->
<script>
    function deleteNhanVien(userID) {
        // Xác nhận xóa nhân viên
        if (confirm('Bạn có chắc chắn muốn xóa nhân viên này?')) {
            // Gọi đến file xóa nhân viên (thay đổi đường dẫn theo yêu cầu của bạn)
            fetch('models/handle_NhanVien_delete.php',{
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'idNhanVien=' + userID,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Nếu xóa thành công, ẩn dòng của nhân viên trong bảng
                    alert('Đã xóa thành công nhân viên');
                    location.reload(); // Tải lại trang để cập nhật danh sách
                } else {
                    // Nếu xóa không thành công, hiển thị thông báo lỗi
                    alert('Đã xảy ra lỗi khi xóa nhân viên.');
                }
            })
            .catch(error => {
                // Nếu có lỗi khi gọi API, hiển thị thông báo lỗi
                alert('Đã xảy ra lỗi khi xóa nhân viên.');
            });
        }
    }
</script>
</html>
