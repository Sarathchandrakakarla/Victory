<?php
session_start();
if (!$_SESSION['Id_No']) {
    echo "<script>alert('Id_No Not Available')
    location.replace('student_login.html');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Victory EM School</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="css/style2.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>
<style>
    #main {
        width: 100%;
        height: 900px;
        background: linear-gradient(#abbaab, #ffffff);
    }

    #header {
        background: linear-gradient(#6A11CB, #2754c7);
        padding: 10px;
        padding-left: 40px;
        border-radius: 10px;
    }

    #side_logo {
        margin-left: 50px;
    }

    #heading {
        color: white;
        margin-top: 20px;
        font-family: Georgia, 'Times New Roman', Times, serif;
    }

    #stu_item {
        text-decoration: none;
        color: black;
        opacity: 80%;
    }

    .details-form {
        margin-top: 20px;
        font-family: "comic sans ms", sans serif;
        padding-left: 100px;
        padding-right: 100px;
        padding-bottom: 50px;
    }

    h2 {
        background-color: forestgreen;
        color: white;
        padding: 10px;
        text-align: center;
        border-radius: 10px;
    }

    td {
        padding: 7px;
    }

    input {
        height: 30px;
        border-radius: 10px;
        border: none;
    }

    input:focus {
        outline: none;
        border: 1px solid forestgreen;
    }

    input:hover {
        box-shadow: 5px 5px 5px black;
    }

    .form-control {
        width: 285px;
        border-radius: 10px;
    }

    .buttons {
        margin-left: 500px;
        margin-top: 20px;
    }

    .btn {
        height: 40px;
        margin-left: 20px;
    }

    .sidebar {
        padding-top: 50px;
    }

    .profile {
        color: white;
        margin-top: 30px;
    }

    .profile a {
        color: white;
        text-decoration: none;
    }

    .dropdown-menu {
        width: 200px;
        margin-left: 20px;
    }

    .profile_img {
        border-radius: 15px;
        background-color: darkgrey;
    }

    #user-img {
        width: 140px;
        border-radius: 10px;
        margin-left: 20px;
    }

    .btn {
        margin-left: 50px;
    }
</style>

<body>
    <div class="container-scroller">
        <!--
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="student_dashboard.php">
                        <i class="mdi mdi-home menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                        <i class="stu"><img src="Images/stu.png" width="30px"></i>
                        <span class="menu-title">Personal Details</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="ui-basic">
                        <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="Stu_Register1.html" id="stu_item">Add Student</a>
                </li>
                
                            <li class="nav-item">
                                <a class="nav-link" href="my_information.php">My Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="pages/ui-features/typography.html">Typography</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pages/icons/mdi.html">
                        <i class="mdi mdi-contacts menu-icon"></i>
                        <span class="menu-title">Icons</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pages/forms/basic_elements.html">
                        <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                        <span class="menu-title">Forms</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pages/charts/chartjs.html">
                        <i class="mdi mdi-chart-bar menu-icon"></i>
                        <span class="menu-title">Charts</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pages/tables/basic-table.html">
                        <i class="mdi mdi-table-large menu-icon"></i>
                        <span class="menu-title">Tables</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://www.bootstrapdash.com/demo/breeze-free/documentation/documentation.html">
                        <i class="mdi mdi-file-document-box menu-icon"></i>
                        <span class="menu-title">Documentation</span>
                    </a>
                </li>
                <li class="nav-item sidebar-actions">
                    <div class="nav-link">
                        <div class="mt-4">
                            <div class="border-none">
                                <p class="text-black">Notification</p>
                            </div>
                            <ul class="mt-4 pl-0">
                                <li>Sign Out</li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
        -->
        <div class="wrapper">
        <!-- Sidebar  -->
        <nav>
            <div class="sidebar-header">
                <h3>Administrator</h3>
            </div>
            <ul class="list-unstyled components">
                <li class="active">
                    <a href="admin_dashboard.php"><i class="mdi mdi-home menu-icon"></i> Dashboard</a>
                </li>
                <li class="submenu1">
                    <a href=""><i class="mdi mdi-account menu-icon"></i> Student <span style="margin-left: 10px;">&rsaquo;</span></a>
                    <ul class="collapse1 list-unstyled">
                        <li class="submenu2">
                            <a href=""><i class="mdi mdi-circle-medium menu-icon"></i>Entry<span style="margin-left: 10px;">&rsaquo;</span></a>
                            <ul class="list-unstyled">
                              <li>
                                <a href="Stu_Register1.php"><i class="mdi mdi-circle-medium menu-icon"></i>Add Student</a>
                              </li>
                            </ul>
                        </li>
                        <li>
                          <a href=""><i class="mdi mdi-circle-medium menu-icon"></i>View<span style="margin-left: 10px;">&rsaquo;</span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="mdi mdi-information menu-icon"></i>About</a>
                </li>
                <li>
                    <a href="#">Portfolio</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>
        </nav>

        <div class="container-fluid" id="main">
            <div class="container-fluid" id="header">
                <div class="row">
                    <div class="logo col-md-2">
                    <button type="button" id="sidebarCollapse" class="navbar-toggler navbar-toggler align-self-center mr-2" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-left"></i>
                    </button>
                        <img src="Images/Victory Logo2.jpg" alt="Victory Logo" style="width: 100px;">
                    </div>
                    <div class="heading col-md-7">
                        <h1 id="heading">VICTORY SCHOOLS</h1>
                    </div>

                    <div class="profile col-md-3">
                        <a href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <h4><?php echo $_SESSION['Id_No'] . "(Student)" ?><img src="Images/arrow.png" width="20px" id="arrow"></h4>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <div class="profile_img">
                                <img src="Images/<?php echo $_SESSION['Id_No'] . ".jpg" ?>" class="dropdown-item" id="user-img">
                            </div>
                            <div class="dropdown-divider"></div>
                            <button class="btn btn-success" onclick="location.replace('logout.php')">Sign Out</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>
</html>