<style>
    .account-dropdown{
        padding:auto;
        display: flex;
        gap: 1em;
    }
    .account-dropdown p{
        color: #fff;
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
                    
                        <img src="../asset/img/account.png" alt="Account" class="account-icon">
                        <?php
                        if (isset($user) && $user !== null && isset($user['hoTen'])) {
                            echo '<p>Xin chào, ' . htmlspecialchars($user['hoTen']) . '</p>';
                        }                        ?>
                        <!-- Dropdown Menu -->

                        <div class="dropdown-menu">
                        <?php 
                            if ($userId) {
                                // Nếu người dùng đã đăng nhập, hiển thị thông tin
                                
                                echo '<a href="profile.php">Quản lý thông tin</a>';
                                echo '<a href="logout.php">Đăng xuất</a>';
                            } else {
                                // Nếu chưa đăng nhập, chỉ hiển thị nút "Đăng nhập"
                                echo '<a href="login-signup.php">Đăng nhập</a>';
                            }
                        ?>
                        </div>
                    </div>
                </div>
            <div class="container-menu" >
                <div class="nav-menu">
                    <nav class="mainmenu mobile-menu">
                        <ul>
                            <li ><a href="./index.php">Trang Chủ</a></li>
                            <li><a href="./index.html#home-about">Giới Thiệu</a></li>
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