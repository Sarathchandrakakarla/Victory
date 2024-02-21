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
    <link rel="stylesheet" href="style1.css">
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
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Bootstrap Sidebar</h3>
            </div>

            <ul class="list-unstyled components">
                <p>Dummy Heading</p>
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="#">Home 1</a>
                        </li>
                        <li>
                            <a href="#">Home 2</a>
                        </li>
                        <li>
                            <a href="#">Home 3</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#">Page 1</a>
                        </li>
                        <li>
                            <a href="#">Page 2</a>
                        </li>
                        <li>
                            <a href="#">Page 3</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">Portfolio</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>

            <ul class="list-unstyled CTAs">
                <li>
                    <a href="https://bootstrapious.com/tutorial/files/sidebar.zip" class="download">Download source</a>
                </li>
                <li>
                    <a href="https://bootstrapious.com/p/bootstrap-sidebar" class="article">Back to article</a>
                </li>
            </ul>
        </nav>
    </div>
        <div class="container-fluid" id="main">
            <div class="container-fluid" id="header">
                <div class="row">
                    <div class="logo col-md-2">
                        <button class="navbar-toggler navbar-toggler align-self-center mr-2" type="button" data-toggle="minimize">
                            <i class="mdi mdi-menu"></i>
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
                            <button class="btn btn-success" onclick="location.replace('index.html')">Sign Out</button>
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
    <script src="assets/js/misc.js"></script>
</body>
</html>