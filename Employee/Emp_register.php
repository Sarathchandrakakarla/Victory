<?php
session_start();
if (!$_SESSION['Admin_Id_No']) {
  echo "<script>alert('Admin Id Not Available')
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
    font-weight: bold;
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

  .btn {
    margin-left: 50px;
  }
  .starlabel label:after {
  content:" *";
  color: red;
}
</style>

<body>
  <div class="container-scroller">
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
      <div class="details-form">
        <h1 style="margin-left: auto; margin-right:auto; padding-left: 25px;">Employee Details Form</h1>
        <form autocomplete="off" method="post" action="">
          <h2 style="margin-left: auto; margin-right:auto;">Personal Details</h2>
          <table width="100%">
            <tr>
              <td>
                <label for="emp_id">Employee Id No.</label>
              </td>
              <td>
                <input type="text" name="Id_No" size="15" required>
                <span style="color: red;">*</span>
              </td>
            </tr>
            <tr>
              <td>First Name</td>
              <td>
                <input type="text" id="first_name" name="First_Name" required>
                <span style="color: red;">*</span>
              </td>
              <td>SurName</td>
              <td>
                <input type="text" name="sur_name" required>
                <span style="color: red;">*</span>
              </td>
            </tr>
            <tr>
              <td>Father's Name</td>
              <td>
                <input type="text" name="Father_Name" size="25" required>
                <span style="color: red;">*</span>
              </td>
            </tr>
            <tr>
              <td>Qualification</td>
              <td>
                <input type="text" name="qualification" size="25" required>
                <span style="color: red;">*</span>
              </td>
              <td>Date of Birth</td>
              <td>
                <input type="date" name="DOB" required>
                <span style="color: red;">*</span>
              </td>
            </tr>
            <tr>
              <td colspan="3">
                <input type="radio" name="Gender" value="s/o" required>Son of
                <input type="radio" name="Gender" value="d/o" style="margin-left: 50px;">Daughter of
                <input type="radio" name="Gender" value="w/o" style="margin-left: 50px;">Wife of
                <span style="color: red;">*</span>
              </td>
            </tr>
            <tr>
              <td>Mobile Number</td>
              <td>
                <input type="text" name="Mobile" size="25" minlength="10" maxlength="10" required>
                <span style="color: red;">*</span>
              </td>
              <td>Employee Image</td>
              <td>
                <button style="width:200px; height:30px; border-radius:8px" onclick="document.getElementById('getFile').click()">Upload New Photo</button>
                <input type='file' id="getFile" name="Img" accept=".png,.jpg,.jpeg" onchange="if(!confirm('Confirm to Update User Image?')){location.replace('update_student.php')}; document.getElementById('stu_img').src = window.URL.createObjectURL(this.files[0])" style="display:none">
              </td>
            </tr>
            <tr>
              <td>Aadhar Number</td>
              <td>
                <input type="text" name="Aadhar" minlength="12" maxlength="12" size="25" required>
                <span style="color: red;">*</span>
              </td>
            </tr>
          </table>

          <h2>Address Details</h2>
          <table width="100%">
            <tr>
              <td>House No</td>
              <td>
                <input type="text" name="House_No" size="25" required>
                <span style="color: red;">*</span>
              </td>
              <td>Area</td>
              <td>
                <input type="text" name="Area" size="25" required>
                <span style="color: red;">*</span>
              </td>
            </tr>
            <tr>
              <td>Village/Town</td>
              <td>
                <input type="text" name="Village" size="25" required>
                <span style="color: red;">*</span>
              </td>
              <!--
              <td>Pin Code</td>
              <td>
                <input type="text" name="Pin_Code" placeholder="Pin Code" size="25" required>
                <span style="color: red;">*</span>
              </td>
-->
            </tr>
          </table>
          <h2>Salary Details</h2>
          <table width="100%">
            <tr>
              <td>Date of Join</td>
              <td> 
                <input type="date" name="DOJ" required>
                <span style="color: red;">*</span>
              </td>
            </tr>
            <tr>
              <td>Designation</td>
              <td>
                <input type="text" name="designation">
              </td>
            </tr>
            <tr>
              <td>Salary</td>
            <td>
              <input type="text" name="salary">
            </td>
            </tr>
            <tr>
              <td>PF Deduction</td>
              <td>
                <input type="text" name="Referred_By">
              </td>
            </tr>
            <tr>
              <td>Date of PF Commit</td>
              <td>
                <input type="text" name="Referred_By">
              </td>
            </tr>
            <tr>
              <td>Working Status</td>
              <td>
                <select class="form-control" name="status">
                  <option value="selectstatus" selected disabled>--Select Status--</option>
                  <option value="Working">Working</option>
                  <option value="Left Service">Left Service</option>
                </select>
              </td>
            </tr>
          </table>
          <h2>Bank Details</h2>
          <table width="100%">
            <tr>
              <td>Bank A/C No.</td>
              <td>
                <input type="text" name="bank_ac" size="30">
              </td>
            </tr>
            <tr>
              <td>Name of the Bank</td>
              <td>
                <input type="text" name="bank_name" size="30">
              </td>
            </tr>
          </table>
          <div class="buttons">
            <input type="submit" class="btn btn-primary" name="add" id="submit">
            <input type="reset" class="btn btn-warning" id="reset" style="color: white;">
          </div>
        </form>
      </div>
    </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="../assets/js/misc.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>

</html>