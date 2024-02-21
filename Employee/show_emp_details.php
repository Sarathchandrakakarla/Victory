<?php
session_start();
if (!$_SESSION['Admin_Id_No']) {
  echo "<script>alert('Admin ID Not Available');
    location.replace('admin_dashboard.php');
    </script>";
}
if (!$_SESSION['Stu_Id_No']) {
  echo "<script>alert('Student ID Not Available');
  location.replace('admin_dashboard.php');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Victory EM School</title>
  <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css" />
  <link rel="stylesheet" href="../assets/css/style.css" />
  <link rel="stylesheet" href="../css/style2.css">
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>
<style>
  #main {
    width: 100%;
    height: 1200px;
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

  .details-view {
    padding: 50px;
  }

  td {
    width: 100px;
    padding: 7px;
  }

  .sidebar {
    padding-top: 50px;
  }

  #tab-head {
    text-align: center;
    font-weight: bold;
    font-size: 30px;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    background-color: darkgray;
  }

  #tbl_sub_head {
    font-weight: bold;
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
                <a class="nav-link" href="show_student_page.php" style="text-decoration: none;color:black;">Modify Student Details</a>
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
            <a href="../admin_dashboard.php"><i class="mdi mdi-home menu-icon"></i> Dashboard</a>
          </li>
          <li class="submenu1">
            <a href=""><i class="mdi mdi-account menu-icon"></i> Student <span style="margin-left: 10px;">&rsaquo;</span></a>
            <ul class="collapse collapse1 list-unstyled">
              <li class="submenu11">
                <a href=""><i class="mdi mdi-circle-medium menu-icon"></i>Entry<span style="margin-left: 10px;">&rsaquo;</span></a>
                <ul class="collapse list-unstyled">
                  <li>
                    <a href="../Stu_Register1.php"><i class="mdi mdi-circle-medium menu-icon"></i>Personal Details</a>
                  </li>
                  <li>
                    <a href="../show_student_page.php"><i class="mdi mdi-circle-medium menu-icon"></i>Modify Personal Details</a>
                  </li>
                </ul>
              </li>
              <li class="submenu12">
                <a href=""><i class="mdi mdi-circle-medium menu-icon"></i>View<span style="margin-left: 10px;">&rsaquo;</span></a>
                <ul class="collapse list-unstyled">
                  <li>
                    <a href="../Reports/class_wise_stu_report.php"><i class="mdi mdi-circle-medium menu-icon"></i>Class Wise Student Details</a>
                  </li>
                  <li>
                    <a href="../Reports/search_student.php"><i class="mdi mdi-circle-medium menu-icon"></i>Search Student</a>
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
                    <a href="../Marks/class_wise_examination.php"><i class="mdi mdi-circle-medium menu-icon"></i>Class Wise Examinations</a>
                  </li>
                  <li>
                    <a href="../Marks/class_wise_subjects.php"><i class="mdi mdi-circle-medium menu-icon"></i>Class Wise Subjects</a>
                  </li>
                  <li>
                    <a href="../Marks/class_marks.php"><i class="mdi mdi-circle-medium menu-icon"></i>Class Wise Marks</a>
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
                    <a href="Emp_register.php"><i class="mdi mdi-circle-medium menu-icon"></i>Emp Personal Details</a>
                  </li>
                  <li>
                    <a href="show_emp_page.php"><i class="mdi mdi-circle-medium menu-icon"></i>Modify Emp Personal Details</a>
                  </li>
                </ul>
              </li>../
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
              <img src="../Images/Victory Logo2.jpg" alt="Victory Logo" style="width: 100px;">
            </div>
            <div class="heading col-md-6">
              <h1 id="heading">VICTORY SCHOOLS</h1>
            </div>
            <img src="../Images/<?php echo $_SESSION['Admin_Id_No'] . ".jpg" ?>" alt="Img Not Available" id="user-img" width="100px" height="100px" style="border-radius: 50%;">
            <div class="profile col-md-3">
              <a href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <h4><?php echo $_SESSION['Admin_Id_No'] . "(Administrator)" ?><img src="../Images/arrow.png" width="20px" id="arrow"></h4>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <button style="border-radius:8px;margin-left:5px; margin-top:2px;" onclick="document.getElementById('getFile').click()">Upload New Photo</button>
                <input type='file' id="getFile" name="img" accept=".png,.jpg,.jpeg" onchange="if(!confirm('Confirm to Update User Image?')){location.replace('admin_dashboard.php')}; document.getElementById('user-img').src = window.URL.createObjectURL(this.files[0])" style="display:none">
                <div class="dropdown-divider"></div>
                <button class="btn btn-success" onclick="location.replace('../logout.php')">Sign Out</button>
              </div>
            </div>
          </div>
        </div>
        <div class="details-view">
          <table class="table-bordered" width="100%">
            <th id="tab-head" colspan="3">
              Personal Details
            </th>
            <tr>
              <td id="tbl_sub_head">
                ID No.
              </td>
              <td style="width: 70%;">
                <?php echo $_SESSION['Stu_Id_No']; ?>
              </td>
              <td rowspan="4" style="padding-left: 30px;">
                <img src="Images/<?php echo $_SESSION['Stu_Id_No'] . ".jpg" ?>" width="120px" style="border-radius: 10%;" alt="Student Image">
              </td>
            </tr>
            <tr>
              <td id="tbl_sub_head">
                Admission No.
              </td>
              <td style="width: 70%;">
                <?php echo $_SESSION['Stu_Adm_No']; ?>
              </td>
            </tr>
            <tr>
              <td id="tbl_sub_head">
                Class
              </td>
              <td>
                <?php echo $_SESSION['Stu_Class']; ?>
              </td>
            </tr>
            <tr>
              <td id="tbl_sub_head">
                Section
              </td>
              <td>
                <?php echo $_SESSION['Stu_Section']; ?>
              </td>
            </tr>
            <tr>
              <td id="tbl_sub_head">
                First Name
              </td>
              <td colspan="3">
                <?php echo $_SESSION['First_Name']; ?>
              </td>
            </tr>
            <tr>
              <td id="tbl_sub_head">
                SurName
              </td>
              <td colspan="3">
                <?php echo $_SESSION['Sur_Name']; ?>
              </td>
            </tr>
            <tr>
              <td id="tbl_sub_head">
                Father Name
              </td>
              <td colspan="3">
                <?php echo $_SESSION['Father_Name']; ?>
              </td>
            </tr>
            <tr>
              <td id="tbl_sub_head">
                Mother Name
              </td>
              <td colspan="3">
                <?php echo $_SESSION['Mother_Name']; ?>
              </td>
            </tr>
            <tr>
              <td id="tbl_sub_head">
                Date of Birth
              </td>
              <td colspan="3">
                <?php echo $_SESSION['DOB']; ?>
              </td>
            </tr>
            <tr>
              <td id="tbl_sub_head">
                Gender
              </td>
              <td colspan="3">
                <?php echo $_SESSION['Gender']; ?>
              </td>
            </tr>
            <tr>
              <td id="tbl_sub_head">
                Mobile Number
              </td>
              <td colspan="3">
                <?php echo $_SESSION['Mobile']; ?>
              </td>
            </tr>
            <tr>
              <td id="tbl_sub_head">
                AADHAR Number
              </td>
              <td colspan="3">
                <?php echo $_SESSION['Aadhar']; ?>
              </td>
            </tr>
            <th id="tab-head" colspan="3">
              Address Details
            </th>
            <tr>
              <td id="tbl_sub_head">
                Religion
              </td>
              <td colspan="3">
                <?php echo $_SESSION['Religion']; ?>
              </td>
            </tr>
            <tr>
              <td id="tbl_sub_head">
                Caste
              </td>
              <td colspan="3">
                <?php echo $_SESSION['Caste']; ?>
              </td>
            </tr>
            <tr>
              <td id="tbl_sub_head">
                Category
              </td>
              <td colspan="3">
                <?php echo $_SESSION['Category']; ?>
              </td>
            </tr>
            <tr>
              <td id="tbl_sub_head">
                House No.
              </td>
              <td colspan="3">
                <?php echo $_SESSION['House_No']; ?>
              </td>
            </tr>
            <tr>
              <td id="tbl_sub_head">
                Area/Street
              </td>
              <td colspan="3">
                <?php echo $_SESSION['Area']; ?>
              </td>
            </tr>
            <tr>
              <td id="tbl_sub_head">
                Village/Town
              </td>
              <td colspan="3">
                <?php echo $_SESSION['Village']; ?>
              </td>
            </tr>
            <th id="tab-head" colspan="3">
              Other Details
            </th>
            <tr>
              <td id="tbl_sub_head">
                DOJ
              </td>
              <td colspan="3">
                <?php echo $_SESSION['DOJ']; ?>
              </td>
            </tr>
            <tr>
              <td id="tbl_sub_head">
                Previous School
              </td>
              <td colspan="3">
                <?php echo $_SESSION['Previous_School']; ?>
              </td>
            </tr>
            <tr>
              <td id="tbl_sub_head">
                Van Route
              </td>
              <td colspan="3">
                <?php echo $_SESSION['Van_Route']; ?>
              </td>
            </tr>
            <tr>
              <td id="tbl_sub_head">
                Referred By
              </td>
              <td colspan="3">
                <?php echo $_SESSION['Referred_By']; ?>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="../assets/js/misc.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#sidebarCollapse').on('click', function() {
        $('#sidebar').toggleClass('active');
      });
    });
  </script>
  <script src="../script.js"></script>
</body>

</html>
<!--
  if (isset($_POST['show'])) {
                                        $searchvar = $_POST['txtinp'];
                                        $radio = $_POST['search'];
                                        if($radio == 'stu_name'){
                                            $sql = "SELECT * FROM `student_master_data` WHERE Stu_Name = '$searchvar'";
                                        }
                                        elseif($radio == 'stu_id'){
                                            $sql = "SELECT * FROM `student_master_data` WHERE Id_No = '$searchvar'";
                                        }
                                        elseif($radio == 'sur_name'){
                                            $sql = "SELECT * FROM `student_master_data` WHERE Sur_Name = '$searchvar'";
                                        }
                                        elseif($radio == 'father_name'){
                                            $sql = "SELECT * FROM `student_master_data` WHERE Father_Name = '$searchvar'";
                                        }
                                    }
                                    $result = mysqli_query($link, $sql);
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<tr>
              <td>' . $i . '</td>
              <td>' . $row['Id_No'] . '</td>
              <td>' . $row['First_Name'] . '</td>
              <td>' . $row['Sur_Name'] . '</td>
              <td>' . $row['Father_Name'] . '</td>
              <td>' . $row['Stu_Class'] . '</td>
              <td>' . $row['Stu_Section'] . '</td>
              </tr>';
                                        $i++;
                                    }
                                    ?>
                                </tr>
-->