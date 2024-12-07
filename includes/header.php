<style>
    /* .account-dropdown{
        padding:auto;
        display: flex;
        gap: 1em;
    }
    .account-dropdown p{
        color: #fff;
    } */
.account-dropdown {
    position: relative;
    display: inline-block;
}
.account-dropdown button{
    background-color: #ffae52;
}
.account-name {
    cursor: pointer;
    font-weight: bold;
    color: #fff;
    padding: 10px;
}

.hidden {
    display: none;
}

.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    background-color: #fff;
    border: 1px solid #ccc;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    padding: 10px;
    z-index: 10;
}

.dropdown-menu a {
    display: block;
    padding: 8px;
    text-decoration: none;
    color: #333;
}

.dropdown-menu a:hover {
    background-color: #f0f0f0;
}
</style>
<header class="header-section">
        <div class="container-fluid">
            <div class="logo">
                <a href="./index.html">
                    <img src="../asset/img/logo1.png" alt="" style="width: 180px; height: 60px;">
                </a>
            </div>
                <div class="top-social f-right d-none d-lg-block ml-30">
                    <!-- Icon Account -->
                    <div class="account-dropdown">
                        <?php if (isset($user) && $user !== null && isset($user['hoTen'])): ?>
                            <!-- Nếu đã đăng nhập, hiển thị tên người dùng -->
                            <p class="account-name">Chào, <?= htmlspecialchars($user['hoTen']); ?></p>
                            <div class="dropdown-menu">
                                <a href="profile.php">Quản lý thông tin</a>
                                <a href="logout.php">Đăng xuất</a>
                            </div>
                        <?php else: ?>
                            <!-- Nếu chưa đăng nhập, hiển thị nút đăng nhập -->
                            <button><a href="login-signup.php" class="login-button">Đăng nhập</a></button>
                            
                        <?php endif; ?>
                    </div>

                </div>
            <div class="container-menu" >
                <div class="nav-menu">
                    <nav class="mainmenu mobile-menu">
                        <ul>
                            <li ><a href="./index.php">Trang Chủ</a></li>
                            <li><a href="./index.html#home-about">Giới Thiệu
                            </a></li>
                            <!-- <li><a href="./schedule.html">Schedule</a></li>
                            <li><a href="./gallery.html">Gallery</a></li>
                            <li><a href="./blog.html">Blog</a>
                                <ul class="dropdown">
                                    <li><a href="./about-us.html">About Us</a></li>
                                    <li><a href="./blog-single.html">Blog Details</a></li>
                                </ul>
                            </li> -->
                            <li><a href="./index.php#price">Mua Gói</a></li>
                            <li><a href="./index.php#contact">Liên Hệ</a></li>
                            

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const accountToggle = document.querySelector('.account-toggle');
        const dropdownMenu = document.querySelector('.dropdown-menu');

        if (accountToggle) {
            accountToggle.addEventListener('click', () => {
                dropdownMenu.classList.toggle('hidden');
            });

            // Ẩn dropdown khi click ra ngoài
            document.addEventListener('click', (e) => {
                if (!accountToggle.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        }
    });
</script>

