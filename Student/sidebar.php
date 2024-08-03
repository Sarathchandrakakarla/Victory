<nav>
    <div class="logo">
        <img src="/Victory/Images/Victory Logo.png" alt="..." width="70px">
    </div>
    <div class="heading">
        <h3>Victory Schools, Kodur</h3>
    </div>
    <input type="checkbox" id="click" />
    <label for="click" class="menu-btn">
        <i class="fas fa-bars"></i>
    </label>
    <ul>
        <li>
            <img src="/Victory/Images/stu_img/<?php echo $_SESSION['Id_No']; ?>.jpg" style="color: white;" alt="Student Image">
        </li>
        <li>
            <a href="#"><?php echo $_SESSION['Id_No'] . "(Student)" ?></a>
            <ul class="login-sub-menu sub-menu">
                <li><a href="/Victory/php/logout.php">Sign Out</a></li>
            </ul>
        </li>
        <li id="sign-out"><a href="/Victory/php/logout.php">Sign Out</a></li>
    </ul>
</nav>
<div class="sidebar close">
    <div class="logo-details">
        <i class="bx bx-menu"></i>
        <span class="logo_name">Student</span>
    </div>
    <ul class="nav-links">
        <li>
            <a href="/Victory/Student/student_dashboard.php">
                <i class="bx bx-home"></i>
                <span class="link_name">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="/Victory/Student/profile.php">
                <i class="bx bx-user"></i>
                <span class="link_name">Profile</span>
            </a>
        </li>
        <li>
            <a href="/Victory/Student/my_marks.php">
                <i class="bx bx-book"></i>
                <span class="link_name">Marks</span>
            </a>
        </li>
        <li>
            <a href="/Victory/Student/attendance.php">
                <i class="bx bx-user-check"></i>
                <span class="link_name">Attendance</span>
            </a>
        </li>
        <li>
            <a href="/Victory/Student/homework.php">
                <i class="bx bx-edit"></i>
                <span class="link_name">Homeworks</span>
            </a>
        </li>
        <li>
            <div class="iocn-link">
                <a href="#">
                    <i class="bx bx-cog"></i>
                    <span class="link_name">Settings</span>
                </a>
                <i class="bx bxs-chevron-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li>
                    <a class="link_name" href="#"><label for="">Settings</label></a>
                </li>
                <li><a href="/Victory/Student/change_pwd.php">Reset Password</a></li>
            </ul>
        </li>
    </ul>
</div>
<script src="/Victory/js/script.js"></script>