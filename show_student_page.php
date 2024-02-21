<?php
include 'link.php';
session_start();
if (!$_SESSION['Admin_Id_No']) {
  echo "<script>alert('Admin Id Not Available');
  location.replace('admin_dashboard.php');</script>";
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Victory EM School</title>
</head>

<body>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css" />
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="css/style2.css">
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
  <title>Victory EM School</title>
</head>
<style>
  body {
    font-family: Montserrat;
  }

  #main {
    width: 100%;
    height: 900px;
    background: #E3D2C4;
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

  .login-block {
    width: 420px;
    padding: 20px;
    background: #fff;
    border-radius: 5px;
    border-top: 5px solid #ff656c;
    margin: 0 auto;
    margin-top: 80px;
  }

  .login-block h1 {
    text-align: center;
    color: #000;
    font-size: 18px;
    text-transform: uppercase;
    margin-top: 0;
    margin-bottom: 20px;
  }

  .login-block input {
    width: 100%;
    height: 42px;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
    font-size: 14px;
    font-family: Montserrat;
    padding: 0 20px 0 50px;
    outline: none;
  }

  .login-block input#username {
    background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px top no-repeat;
    background-size: 16px 80px;
  }

  .login-block input#username:focus {
    background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px bottom no-repeat;
    background-size: 16px 80px;
  }

  .login-block input#password {
    background: #fff url('http://i.imgur.com/Qf83FTt.png') 20px top no-repeat;
    background-size: 16px 80px;
  }

  .login-block input#password:focus {
    background: #fff url('http://i.imgur.com/Qf83FTt.png') 20px bottom no-repeat;
    background-size: 16px 80px;
  }

  .login-block input:active,
  .login-block input:focus {
    border: 1px solid #ff656c;
  }

  .login-block button {
    height: 40px;
    background: #ff656c;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #e15960;
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
    font-family: Montserrat;
    outline: none;
    cursor: pointer;
    margin-left: 20px;
  }

  #show {
    margin-left: 70px;
  }

  .login-block button:hover {
    background: #ff7b81;
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
          <a class="nav-link" href="admin_dashboard.php">
            <i class="mdi mdi-home menu-icon"></i>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <i class="stu"><img src="Images/stu.png" width="30px"></i>
            <span class="menu-title">Student Data</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item">
                <a class="nav-link" href="Stu_Register1.php" id="stu_item">Add Student</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="show_student_page.php" id="stu_item">Modify Student Details</a>
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
        <nav id="sidebar">
        <div class="sidebar-header">
          <h3>Administrator</h3>
        </div>
        <ul class="list-unstyled components">
          <li class="active">
            <a href="admin_dashboard.php"><i class="mdi mdi-home menu-icon"></i> Dashboard</a>
          </li>
          <li class="submenu1">
            <a href=""><i class="mdi mdi-account menu-icon"></i> Student <span style="margin-left: 10px;">&rsaquo;</span></a>
            <ul class="collapse collapse1 list-unstyled">
              <li class="submenu11">
                <a href=""><i class="mdi mdi-circle-medium menu-icon"></i>Entry<span style="margin-left: 10px;">&rsaquo;</span></a>
                <ul class="collapse list-unstyled">
                  <li>
                    <a href="Stu_Register1.php"><i class="mdi mdi-circle-medium menu-icon"></i>Personal Details</a>
                  </li>
                  <li>
                    <a href="show_student_page.php"><i class="mdi mdi-circle-medium menu-icon"></i>Modify Personal Details</a>
                  </li>
                </ul>
              </li>
              <li class="submenu12">
                <a href=""><i class="mdi mdi-circle-medium menu-icon"></i>View<span style="margin-left: 10px;">&rsaquo;</span></a>
                <ul class="collapse list-unstyled">
                  <li>
                    <a href="Reports/class_wise_stu_report.php"><i class="mdi mdi-circle-medium menu-icon"></i>Class Wise Student Details</a>
                  </li>
                  <li>
                    <a href="Reports/search_student.php"><i class="mdi mdi-circle-medium menu-icon"></i>Search Student</a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="submenu2">
            <a href=""><i class="mdi mdi-library-books menu-icon"></i>Examinations<span style="margin-left: 10px;">&rsaquo;</span></a>
            <ul class="collapse collapse1 list-unstyled">
              <li class="submenu21">
                <a href=""><i class="mdi mdi-circle-medium menu-icon"></i>Entry<span style="margin-left: 10px;">&rsaquo;</span></a>
                <ul class="collapse list-unstyled">
                  <li>
                    <a href="Marks/class_wise_examination.php"><i class="mdi mdi-circle-medium menu-icon"></i>Class Wise Examinations</a>
                  </li>
                  <li>
                    <a href="Marks/class_wise_subjects.php"><i class="mdi mdi-circle-medium menu-icon"></i>Class Wise Subjects</a>
                  </li>
                  <li>
                    <a href="Marks/class_marks.php"><i class="mdi mdi-circle-medium menu-icon"></i>Class Wise Marks</a>
                  </li>
                </ul>
              </li>
              <li class="submenu22">
                <a href=""><i class="mdi mdi-circle-medium menu-icon"></i>View<span style="margin-left: 10px;">&rsaquo;</span></a>
                <ul class="collapse list-unstyled">
                  <li>
                    <a href=""><i class="mdi mdi-circle-medium menu-icon"></i>Class Wise Examinations</a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="submenu3">
            <a href=""><i class="mdi mdi-account menu-icon"></i> Employee <span style="margin-left: 10px;">&rsaquo;</span></a>
            <ul class="collapse collapse2 list-unstyled">
              <li class="submenu31">
                <a href=""><i class="mdi mdi-circle-medium menu-icon"></i>Entry<span style="margin-left: 10px;">&rsaquo;</span></a>
                <ul class="collapse list-unstyled">
                  <li>
                    <a href="Employee/Emp_register.php"><i class="mdi mdi-circle-medium menu-icon"></i>Emp Personal Details</a>
                  </li>
                  <li>
                    <a href="Employee/show_emp_page.php"><i class="mdi mdi-circle-medium menu-icon"></i>Modify Emp Personal Details</a>
                  </li>
                </ul>
              </li>
              <!--
              <li class="submenu32">
                <a href=""><i class="mdi mdi-circle-medium menu-icon"></i>View<span style="margin-left: 10px;">&rsaquo;</span></a>
                <ul class="collapse list-unstyled">
                  <li>
                    <a href="Reports/class_wise_stu_report.php"><i class="mdi mdi-circle-medium menu-icon"></i>Class Wise Student Details</a>
                  </li>
                  <li>
                    <a href="Reports/search_student.php"><i class="mdi mdi-circle-medium menu-icon"></i>Search Student</a>
                  </li>
                </ul>
              </li>
              -->
            </ul>
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
          <div class="heading col-md-6">
            <h1 id="heading">VICTORY SCHOOLS</h1>
          </div>
          <img src="Images/<?php echo $_SESSION['Admin_Id_No'] . ".jpg" ?>" alt="Img Not Available" id="user-img" width="100px" height="100px" style="border-radius: 50%;">
          <div class="profile col-md-3">
            <a href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <h4><?php echo $_SESSION['Admin_Id_No'] . "(Administrator)" ?><img src="Images/arrow.png" width="20px" id="arrow"></h4>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <button style="border-radius:8px;margin-left:5px; margin-top:2px;" onclick="document.getElementById('getFile').click()">Upload New Photo</button>
              <input type='file' id="getFile" name="img" accept=".png,.jpg,.jpeg" onchange="if(!confirm('Confirm to Update User Image?')){location.replace('admin_dashboard.php')}; document.getElementById('user-img').src = window.URL.createObjectURL(this.files[0])" style="display:none">
              <div class="dropdown-divider"></div>
              <button class="btn btn-success" onclick="location.replace('logout.php')">Sign Out</button>
            </div>
          </div>
        </div>
      </div>
      <div class="logo"></div>
      <div class="login-block">
        <h1>Show Details</h1>
        <script type="text/javascript">
          function submitForm(action) {
            var form = document.getElementById('form1');
            form.action = action;
            form.submit();
          }
        </script>
        <form method="post" autocomplete="off" id="form1">
          <input type="text" placeholder="Student Id No" id="username" name="show_id" required />
          <button class="button" id="show" name="show" onclick="submitForm('show_student_validate.php')">Show</button>
          <button class="button" id="update" name="update" onclick="submitForm('update_student_validate.php')">Update</button>
          <button class="button" id="delete" name="delete" onclick="submitForm('delete_student_validate.php')">Delete</button>
        </form>
      </div>
    </div>
</div>
  </div>
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="assets/js/misc.js"></script>
  <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>

</html>