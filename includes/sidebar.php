<aside class="sidebar">
        <ul>
            <!-- <li><a href="profile.php">Thông tin tài khoản</a></li> -->
            <!-- nếu url là profile.php thì thêm class active -->
            <li>
                <a href="profile.php" 
               <?php echo basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'class="active"' : ''; ?>>
                Thông tin tài khoản
                </a>
            </li>
            <li>
                <a href="change-pass.php"
               <?php echo basename($_SERVER['PHP_SELF']) == 'change-pass.php' ? 'class="active"' : ''; ?>>
                Thay đổi mật khẩu
                </a>
            </li>
            <li>
                <a href="trackpack.php"
               <?php echo basename($_SERVER['PHP_SELF']) == 'trackpack.php' ? 'class="active"' : ''; ?>>
                Theo dõi gói tập
                </a>
            </li>
            <li><a href="#">Đăng xuất</a></li>
        </ul>
</aside>